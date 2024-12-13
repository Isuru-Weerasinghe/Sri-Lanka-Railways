<?php
session_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>History</title>
    <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bot-style.css" />
    <link rel="stylesheet" href="assets/css/Contact-Details-icons.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <script src="https://kit.fontawesome.com/79271f9696.js" crossorigin="anonymous"></script>
    <style>
        #main {
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
                            <li><a class="dropdown-item active" href="history.php">History</a></li>
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

<div class="container py-4 py-xl-5" id="main">
    <h2><b>History Of Sri Lankan Railways</b></h2><br>
    <div class="row md-5 gy-4 row-cols-1 row-cols-md-2 row-cols-lg-3">
        <div class="col" data-bss-hover-animate="pulse">
            <img class="w-100 d-block" src="assets/img/old1.jpg" />
        </div>
        <div class="col" data-bss-hover-animate="pulse">
            <img class="w-100 d-block" src="assets/img/old2.jpg" />
        </div>
        <div class="col" data-bss-hover-animate="pulse">
            <img class="w-100 d-block" src="assets/img/old3.jpg" />
        </div>
    </div>
    <hr>
    <p>
        The idea of constructing a railway in Ceylon (now Sri Lanka) was first proposed by European coffee planters
        in 1842,
        aiming to establish a faster and more efficient means to transport their products between Kandy and Colombo.
        The Ceylon Railway Company was established in 1845 to undertake this project, and in 1856, Captain William
        Scarth Moorsom recommended a route for the railway.
        However, due to cost overruns and other challenges, the government took over the construction work in 1861,
        leading to the formation of the Ceylon Government Railway.
    </p>
    <p>
        The service commenced with a 54-kilometer main line connecting Colombo and Ambepussa.
        Over the years, various extensions were made, expanding the rail network to Kandy, Nawalapitiya, Nanu Oya,
        Bandarawela, Badulla, and other destinations.
        The rail infrastructure saw improvements between 1955 and 1970, with the introduction of diesel locomotives
        and upgrades to major stations.
    </p>
    <p>
        In the early 2010s, the government initiated a 10-year railway development strategy, ordering replacement
        DMUs and upgrading damaged lines,
        such as the southern line affected by the 2004 tsunami and the northern line impacted by decades of war.
        The railway system also introduced premium services in partnership with ExpoRail and Rajadhani Express.
        Additionally, extensions and rebuilding efforts are ongoing to cater to the needs of developing cities and
        improve connectivity across the country.
    </p>
</div>

<?php include_once "footer.php";
?>
