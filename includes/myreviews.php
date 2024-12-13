<?php
session_start();

require '../classes/DbConnector.php';
require '../classes/Review.php';

use classes\DbConnector;
use classes\Review;

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
        <title>My reviews</title>
        <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png" type="image/x-icon">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/css/login-signup.css" />
        <link rel="stylesheet" href="../assets/css/Contact-Details-icons.css">
        <link rel="stylesheet" href="../assets/css/animate.min.css">
        <script src="https://kit.fontawesome.com/79271f9696.js" crossorigin="anonymous"></script>
        <style>
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
                <a class="navbar-brand d-flex align-items-center" href="../index.php">
                    <span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon">
                        <img src="../assets/img/icon.png" class="img-thumbnail">
                    </span>
                    <span>Sri Lanka Railways</span>
                </a>
                <button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-5"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-5">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a id="anchor1" class="nav-link" data-bss-hover-animate="pulse" href="../index.php">Home</a></li>
                        <li class="nav-item"><a id="anchor2" class="nav-link active" data-bss-hover-animate="pulse" href="../train_schedule.php">Train Schedule</a></li>
                        <li class="nav-item"><a id="anchor3" class="nav-link" data-bss-hover-animate="pulse" href="../reservations.php">Reservations</a></li>
                        <li class="nav-item"><a id="anchor3" class="nav-link" data-bss-hover-animate="pulse" href="../e-catering-homepage.php" target="_blank">E-Catering</a></li>
                        <li class="nav-item"><a id="anchor5" class="nav-link" data-bss-hover-animate="pulse" href="../contact_us.php">Contact Us</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Other
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../notices.php">Notices</a></li>
                                <li><a class="dropdown-item" href="../rate_review.php">Rate & Review</a></li>
                                <li><a class="dropdown-item" href="../other.php">Station Details</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                About Us
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../overview.php">Overview</a></li>
                                <li><a class="dropdown-item" href="../history.php">History</a></li>
                                <li><a class="dropdown-item" href="../our_network.php">Our Network</a></li>
                            </ul>
                        </li>
                        <?php
                        if (isset($_SESSION["login"])) {
                            if (isset($_SESSION["login"]) == true) {
                                echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="logout.inc.php">Log Out</a>';
                            } else {
                                echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="../login.php">Log in</a>';
                            }
                        } else {
                            echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="../login.php">Log in</a>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="vh-200 gradient-custom">
            <div class="carousel-inner">
                <div class="carousel-item active c-item">
                    <img src="../assets/img/rating/ratings.png" class="d-block w-100 c-img" alt="bg_image">
                    <div class="carousel-caption top-0 mt-4">
                    </div>
                </div>
            </div>

            <!-- display available reviews-->


            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table table-hover my-0 " id="dataTable">
                            <thead>
                                <tr>

                                    <th>Title</th>
                                    <th>Rating</th>
                                    <th>feedback</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                try {
                                    $dbcon = new DbConnector();
                                    $con = $dbcon->connect();
                                    $query = "SELECT *FROM review WHERE User_Id=?";
                                    $pstmt = $con->prepare($query);
                                    $pstmt->bindValue(1, $userId);
                                    $pstmt->execute();
                                    $result = $pstmt->fetchAll(PDO::FETCH_ASSOC);
                                    if ($result) {
                                        foreach ($result as $row) {
                                            ?>            
                                            <tr>

                                                <td> <?= $row['Title'] ?> </td>
                                                <td><?= $row['Rate'] ?></td>
                                                <td> <?= $row['Body'] ?></td>
                                                <td><a type="button" class="btn btn-danger" onclick="showConfirm('Are you sure want to delete this review?')" href='reviews_process.php?rev_id=<?= $row['Review_Id'] ?>'>Delete</a></td>
                                            </tr>

                                            <?php
                                        }
                                    } else {
                                        echo '<h3 style=color:Green;text-align:center>you do not have any reviews yet.</h3>';
                                    }
                                } catch (PDOException $exc) {
                                    echo $exc->getMessage();
                                }
                                ?>

                                <?php
                                if (isset($_GET['status'])) {
                                    if ($_GET['status'] == 7) {
                                        ?>
                                    <script>window.alert("Review has been successfully deleted!");</script>
                                    <?php
                                }
                            }
                            ?>            




                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </section>



        <?php
        include_once "../footer.php";

        