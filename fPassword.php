<?php
session_start();

if (isset($_SESSION["login"])) {
    if ($_SESSION["login"] = true) {
        echo '<script>alert("Please log out before proceed!");window.location="index.php";</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
	<title>Forgot Password</title>
    <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/login-signup.css" />
	<link rel="stylesheet" href="assets/css/Contact-Details-icons.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <script src="https://kit.fontawesome.com/79271f9696.js" crossorigin="anonymous"></script>
    <style>
        section {
            min-height: 100vh;
        }
        
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
                    <li class="nav-item"><a id="anchor2" class="nav-link" data-bss-hover-animate="pulse" href="train_schedule.php">Train Schedule</a></li>
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
	<form action="includes/fPassword.inc.php" method="POST">
		<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
					<div class="card bg-dark text-white" style="border-radius: 1rem;">
						<div class="card-body p-5 text-center">
							<span class="text-danger">
								<?php if (isset($_GET["status"])) {
                                    if ($_GET["status"] == 1) {
                                        echo "Please fill all fields!";
                                    } elseif ($_GET["status"] == 2) {
                                        echo "User does not exist!";
                                    }
                                } ?>
                            </span>
                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Forgot Password</h2>
                                <p class="text-white-50 mb-5">Please enter your username to find your account!</p>
                                <div class="form-outline form-white mb-4">
                                    <input type="text" id="username" class="form-control form-control-lg" name="username" required />
                                    <label class="form-label" for="username">Username</label>
                                </div>
                                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="submit_fpassword">Go</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

<?php include_once "footer.php";
?>
