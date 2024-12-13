<?php
session_start();

use classes\DbConnector;
use classes\Passenger;

require_once "classes/DbConnector.php";
require_once "classes/Passenger.php";

$dbcon = new DbConnector();
$con = $dbcon->connect();
$routeId = null;

if (isset($_POST["submit_train_schedule"])) {
    $start = $_POST["start"];
    $end = $_POST["end"];
    $startTime = $_POST["start_time"];
    $endTime = $_POST["end_time"];

    if ($start == $end) {
        header("Location: train_schedule.php?status=1");
    } elseif (empty($start) && empty($end)) {
        header("Location: train_schedule.php?status=2");
    } else {
        $query1 =
            "SELECT Route_Id FROM Route_Station WHERE Station_Id = (SELECT Station_Id FROM Station WHERE Station_Name = ?);";
        $query2 =
            "SELECT Route_Id FROM Route_Station WHERE Station_Id = (SELECT Station_Id FROM Station WHERE Station_Name = ?);";
        $query3 =
            "SELECT Route_Id FROM Route_Station WHERE Station_Id = (SELECT Station_Id FROM Station WHERE Station_Name = 'Colombo Fort');";

        try {
            $pstmt1 = $con->prepare($query1);
            $pstmt1->bindValue(1, $start);
            $pstmt1->execute();
            $rs1 = $pstmt1->fetch(PDO::FETCH_BOTH);
            $a = $rs1[0];

            $pstmt2 = $con->prepare($query2);
            $pstmt2->bindValue(1, $end);
            $pstmt2->execute();
            $rs2 = $pstmt2->fetch(PDO::FETCH_BOTH);
            $b = $rs2[0];

            $pstmt3 = $con->prepare($query3);
            $pstmt3->execute();
            $rs3 = $pstmt3->fetch(PDO::FETCH_BOTH);
            $c = $rs3[0];

            if ($a == $b) {
                $routeId = $a;
            } elseif ($a == $c) {
                $routeId = $b;
            } elseif ($b == $c) {
                $routeId = $a;
            }

            if (!empty($startTime) && !empty($endTime)) {
                $startTime = date("G:i", strtotime($startTime));
                $endTime = date("G:i", strtotime($endTime));
                $query4 =
                    "SELECT * FROM Schedule WHERE (Route_Id = ? AND (Dept_Time BETWEEN ? AND ?)) ORDER BY Dept_Time;";
                $pstmt4 = $con->prepare($query4);
                $pstmt4->bindValue(1, $routeId);
                $pstmt4->bindValue(2, $startTime);
                $pstmt4->bindValue(3, $endTime);
                $pstmt4->execute();
                $rs4 = $pstmt4->fetchAll(PDO::FETCH_BOTH);
            } elseif (!empty($startTime) && empty($endTime)) {
                $query4 =
                    "SELECT * FROM Schedule WHERE (Route_Id = ? AND Dept_Time > ?) ORDER BY Dept_Time;";
                $pstmt4 = $con->prepare($query4);
                $pstmt4->bindValue(1, $routeId);
                $pstmt4->bindValue(2, $startTime);
                $pstmt4->execute();
                $rs4 = $pstmt4->fetchAll(PDO::FETCH_BOTH);
            } elseif (empty($startTime) && !empty($endTime)) {
                $query4 =
                    "SELECT * FROM Schedule WHERE (Route_Id = ? AND Dept_Time < ?) ORDER BY Dept_Time;";
                $pstmt4 = $con->prepare($query4);
                $pstmt4->bindValue(1, $routeId);
                $pstmt4->bindValue(2, $endTime);
                $pstmt4->execute();
                $rs4 = $pstmt4->fetchAll(PDO::FETCH_BOTH);
            } else {
                $query4 =
                    "SELECT * FROM Schedule WHERE Route_Id = ? ORDER BY Dept_Time;";
                $pstmt4 = $con->prepare($query4);
                $pstmt4->bindValue(1, $routeId);
                $pstmt4->execute();
                $rs4 = $pstmt4->fetchAll(PDO::FETCH_BOTH);
            }
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}

$rs = Passenger::getStation();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
	<title>Train Schedule</title>
    <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/login-signup.css" />
	<link rel="stylesheet" href="assets/css/Contact-Details-icons.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <script src="https://kit.fontawesome.com/79271f9696.js" crossorigin="anonymous"></script>
    <style>
        <?php
        if (!isset($_POST["submit_train_schedule"])) {
            echo "section {
                min-height: 100vh;
            }";
        }
        
        ?>
        /* Hide scrollbar for Chrome, Safari and Opera */
        .modal-body::-webkit-scrollbar,
        body::-webkit-scrollbar {
            display: none;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .modal-body,
        body {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

        .scroll-to-top {
            position: fixed;
            right: 1rem;
            bottom: 1rem;
            display: none;
            width: 2.75rem;
            height: 2.75rem;
            text-align: center;
            color: #fff;
            background: rgba(90, 92, 105, .5);
            line-height: 46px
        }

        .scroll-to-top:focus,
        .scroll-to-top:hover {
            color: #fff
        }

        .scroll-to-top:hover {
            background: #5a5c69
        }

        .scroll-to-top i {
            font-weight: 800
        }
    </style>
</head>

<body id="page-top">
    <nav class="navbar navbar-dark navbar-expand-md bg-dark py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
                    <img src="assets/img/icon.png" class="img-thumbnail">
                </span>
                <span>Sri Lanka Railways</span>
            </a>
            <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-5">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a id="anchor1" class="nav-link" data-bss-hover-animate="pulse" href="index.php">Home</a></li>
                    <li class="nav-item"><a id="anchor2" class="nav-link active" data-bss-hover-animate="pulse" href="train_schedule.php">Train Schedule</a></li>
                    <li class="nav-item"><a id="anchor3" class="nav-link" data-bss-hover-animate="pulse" href="reservations.php">Reservations</a></li>
                    <li class="nav-item"><a id="anchor3" class="nav-link" data-bss-hover-animate="pulse" href="e-catering-homepage.php" target="_blank">E-Catering</a></li>
                    <li class="nav-item"><a id="anchor5" class="nav-link" data-bss-hover-animate="pulse" href="contact_us.php">Contact Us</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Other
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="notices.php">Notices</a></li>
                            <li><a class="dropdown-item" href="rate_review.php">Rate & Review</a></li>
                            <li><a class="dropdown-item" href="other.php">Station Details</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About Us
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="overview.php">Overview</a></li>
                            <li><a class="dropdown-item" href="history.php">History</a></li>
                            <li><a class="dropdown-item" href="our_network.php">Our Network</a></li>
                        </ul>
                    </li>
                    <?php if (isset($_SESSION["login"])) {
                        if (isset($_SESSION["login"]) == true) {
                            echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="includes/logout.inc.php">Log Out</a>';
                        } else {
                            echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="login.php">Log in</a>';
                        }
                    } else {
                        echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="login.php">Log in</a>';
                    } ?>
                </ul>
            </div>
        </div>
    </nav>
<section class="vh-200 gradient-custom">
	<div class="container py-5 h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-12 col-md-8 col-lg-6 col-xl-5">
				<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
					<div class="card bg-dark text-white" style="border-radius: 1rem;">
						<div class="card-body p-5 text-center">
							<span class="text-danger">
								<!--error handling-->
								<?php if (isset($_GET["status"])) {
									if ($_GET["status"] == 1) {
										echo "Start and End select stations can not be same!";
									} elseif ($_GET["status"] == 2) {
										echo "Please fill Start and End station fields!";
									}
								} ?>
							</span>
							<div class="mb-md-5 mt-md-4 pb-5">
								<h2 class="fw-bold mb-2 text-uppercase">Find Schedule</h2>
								<p class="text-white-50 mb-5">Please select start & end stations!</p>
								<div class="row mb-4">
									<div class="col">
										<div class="form-outline">
											<select class="form-select" aria-label="Default select example" name="start" required>
												<option value="" disabled selected>Start</option>
												<?php if (count($rs) > 0) {
													foreach ($rs as $start) {
														echo "<option>" . $start[0] . "</option>";
													}
												} else {
													echo '<option value="" disabled selected>Start</option>';
												} ?>
											</select>
										</div>
									</div>
									<div class="col">
										<div class="form-outline">
											<select class="form-select" aria-label="Default select example" name="end" required>
												<option value="" disabled selected>End</option>
												<?php if (count($rs) > 0) {
													foreach ($rs as $end) {
														echo "<option>" . $end[0] . "</option>";
													}
												} else {
													echo '<option value="" disabled selected>End</option>';
												} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row mb-4">
									<div class="col">
										<div class="form-outline">
											<input type="time" id="start_time" class="form-control form-control-lg" name="start_time" />
											<label class="form-label" for="start_time">Start Time</label>
										</div>
									</div>
									<div class="col">
										<div class="form-outline">
											<input type="time" id="end_time" class="form-control form-control-lg" name="end_time" />
											<label class="form-label" for="end_time">End Time</label>
										</div>
									</div>
								</div>
								<button class="btn btn-outline-light btn-lg px-5" type="submit" name="submit_train_schedule">Find</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php 
if (isset($_POST["submit_train_schedule"])) {
?>
<section>
	<div class="container py-4 py-xl-5">
		<div class="row table-responsive mb-5">
			<table class="table table-bordered table-hover">
				<thead class="thead-dark table-active text-center">
					<tr>
						<th scope="col"><b>#</b></th>
						<th scope="col">Schedule ID</th>
						<th scope="col">Route</th>
						<th scope="col">Train Name</th>
						<th scope="col">Arrival Time</th>
						<th scope="col">Depature Time</th>
						<th scope="col">Start Station</th>
						<th scope="col">End Station</th>
						<th scope="col">Canteen</th>
                        <th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($pstmt4->rowCount() > 0) {
							for ($i = 0; $i < $pstmt4->rowCount(); $i++) {

								$row = $rs4[$i];
								$query5 = "SELECT Route_Name FROM Route WHERE Route_Id = ?;";
								$pstmt5 = $con->prepare($query5);
								$pstmt5->bindValue(1, $routeId);
								$pstmt5->execute();
								$rs5 = $pstmt5->fetch(PDO::FETCH_BOTH);

								$trainId = $row["Train_Id"];
								$query6 = "SELECT Train_Name, Canteen FROM Train WHERE Train_Id = ?;";
								$pstmt6 = $con->prepare($query6);
								$pstmt6->bindValue(1, $trainId);
								$pstmt6->execute();
								$rs6 = $pstmt6->fetch(PDO::FETCH_BOTH);

								$startId = $row["Start_Station_Id"];
								$query7 = "SELECT Station_Name FROM Station WHERE Station_Id = ?;";
								$pstmt7 = $con->prepare($query7);
								$pstmt7->bindValue(1, $startId);
								$pstmt7->execute();
								$rs7 = $pstmt7->fetch(PDO::FETCH_BOTH);

								$endId = $row["End_Station_Id"];
								$query8 = "SELECT Station_Name FROM Station WHERE Station_Id = ?;";
								$pstmt8 = $con->prepare($query8);
								$pstmt8->bindValue(1, $endId);
								$pstmt8->execute();
								$rs8 = $pstmt8->fetch(PDO::FETCH_BOTH);
								?>
								<tr class="text-center">
									<td><b>
											<?php echo $i + 1; ?>
										</b></td>
									<td>
										<?php echo $row["Schedule_Id"]; ?>
									</td>
									<td>
										<?php echo $rs5[0]; ?>
									</td>
									<td>
										<?php echo $rs6[0]; ?>
									</td>
									<td>
										<?php echo $row["Arr_Time"]; ?>
									</td>
									<td>
										<?php echo $row["Dept_Time"]; ?>
									</td>
									<td>
										<?php echo $rs7[0]; ?>
									</td>
									<td>
										<?php echo $rs8[0]; ?>
									</td>
									<td>
										<?php echo $rs6[1]; ?>
									</td>
                                    <td>
                                        <a type="button" class="btn btn-danger" href="reservations.php?id=<?php echo $row["Schedule_Id"];?>" name="reserve">Reserve</a>
                                    </td>
								</tr>
								<?php
							}
						} else {
							?>
							<tr>
								<td colspan="10">No data found</td>
							</tr>
							<?php
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</section>
<?php
}
?>

<?php include_once "footer.php";
?>
