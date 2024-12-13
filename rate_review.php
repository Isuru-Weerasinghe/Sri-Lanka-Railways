<?php
session_start();

require './classes/DbConnector.php';
require './classes/Review.php';

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
    <title>Reviews</title>
    <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png" type="image/x-icon">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bot-style.css" />
    <link rel="stylesheet" href="assets/css/Contact-Details-icons.css">
    <link rel="stylesheet" href="assets/css/styles-reviews.css">
    <link rel="stylesheet" href="assets/css/hero-styles.css">
    <link rel="stylesheet" href="assets/css/review-scorecard.css">
    <link rel="stylesheet" href="assets/css/Reviews-floating-styles.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
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
                            <li><a class="dropdown-item active" href="rate_review.php">Rate & Review</a></li>
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
                    <?php
                    if (isset($_SESSION["login"])) {
                        if (isset($_SESSION["login"]) == true) {
                            echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="includes/logout.inc.php">Log Out</a>';
                        } else {
                            echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="login.php">Log in</a>';
                        }
                    } else {
                        echo '<a class="btn btn-primary ms-md-2" role="button" data-bss-hover-animate="pulse" href="login.php">Log in</a>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- floating buttons -->

    <?php
    if (isset($_SESSION['userId'])) {
    ?>
        <div class="floating-button" style="margin-top: 80px;">
            <span title="Edit or delete my reviews"><a href="includes/myreviews.php" target="_blank"><i class="fa-regular fa-pen-to-square fa-fade"></i></a></span>
        </div>
        <div class="floating-button">
            <span title="Add a new review"><a data-bs-toggle="modal" data-bs-target="#addNewReview"><i class="fa-solid fa-plus fa-beat-fade"></i></a></span>
        </div>
    <?php
    }
    ?>

    <!-- Modal -->

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 5) {
    ?>
            <script>
                window.alert("We received your feedback.thank you!");
            </script>
    <?php
        }
    }
    ?>
    <form action="includes/reviews_process.php" method="POST">
        <div class="modal fade" id="addNewReview" tabindex="-1" aria-labelledby="addNewReview" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title h3" id="addNewReview">Give us your feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="modal-body" class="modal-body">
                        <div class="form-outline form-white h6">
                            <div class="form-group mb-3">
                                <label class="form-label ">&nbsp;Review Title</label>
                                <br>
                                <div class="form-group mb-3"><input class="form-control" type="text" name="title" placeholder="Review title" required /></div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="rate" class="form-label">&nbsp;Select your Rating</label>
                                <select class="form-select" name="rate">
                                    <option value="1">1 (Unacceptable)</option>
                                    <option value="2">2 (Weak)</option>
                                    <option value="3">3 (Good)</option>
                                    <option value="4">4 (Very Good)</option>
                                    <option value="5">5 (Excellent)</option>


                                </select>
                                <br>
                            </div>

                            <div class="form-group mb-3"><textarea class="form-control" name="body" placeholder="Review" rows="5" required /></textarea></div>
                            <input type="hidden" name="user_id" value=<?php echo $userId ?> />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_review">Post</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end-->
    </form>
    <div class="carousel-inner">
        <div class="carousel-item active c-item">
            <img src="assets/img/rating/ratings.png" class="d-block w-100 c-img" alt="bg_image">
            <div class="carousel-caption top-0 mt-4">
                <div style="margin-top: 440px">
                    <a href="#reviews" class="btn btn-primary">Show Reviews</a>
                </div>
            </div>
        </div>
    </div>

    <!-- review carousel -->

    <section class="section-review-main">
        <div class="container">
            <h1 class="section-review-header">Client Reviews<span> what our clients say about their user experience</span></h1>
            <div class="testimonials">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <!--hardcoded one-->

                        <div class="carousel-item active">
                            <div class="single-review-item" style=" border-radius: 25px;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="review-profile">
                                            <div class="profile-img-area">
                                                <img src="assets/img/rating/IMG_20220820_101255.jpg" alt="user1">
                                            </div>
                                            <div>
                                                <h5>Dinidu Madushan</h5>
                                                <h6>@dinidumadushan</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 review-head">
                                        <h4 class="room_type">Very useful App..</h4>
                                        <div class="stars" data-rating="5"></div>
                                        <div class="review-content">
                                            <p><span><i class="fa fa-quote-left"></i></span>Hi everyone.I have used this app for many times.
                                                i would like to say that this is very useful app.recomended for all </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- this is the iteration part-->

                        <?php
                        $top_rates = Review::showByStars(5);

                        foreach ($top_rates as $top_rate) {
                        ?>
                            <div class="carousel-item ">
                                <div class="single-review-item" style=" border-radius: 25px;">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="review-profile">
                                                <div class="profile-img-area">
                                                    <img src="assets/img/rating/anonymousUser.jpg" alt="user1">
                                                </div>
                                                <div>
                                                    <h5><?= $top_rate->getUserName() ?>******</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 review-head">
                                            <h4 class="room_type"><?= $top_rate->getTitle() ?>..</h4>
                                            <div class="stars" data-rating="5"></div>
                                            <div class="review-content">
                                                <p><span><i class="fa fa-quote-left"></i></span> <?= $top_rate->getBody() ?> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div>
        </div>
    </section>
    <hr>

    <!--  user ratings summary-->

    <?php
    $total_count = Review::getTotalCount();

    if ($total_count > 0) {

        //calculate relevant rate counts according to the stars

        $_1_stars = Review::getRateCounts(1);
        $_2_stars = Review::getRateCounts(2);
        $_3_stars = Review::getRateCounts(3);
        $_4_stars = Review::getRateCounts(4);
        $_5_stars = Review::getRateCounts(5);

        //calculate average rating

        $total_star_count = 1 * $_1_stars + 2 * $_2_stars + 3 * $_3_stars + 4 * $_4_stars + 5 * $_5_stars;
        $avg = $total_star_count / $total_count;
        $average = number_format($avg, 1);

        //calculate scorecard bar widths

        $width_1 = number_format(($_1_stars / $total_count) * 100, 2);
        $width_2 = number_format(($_2_stars / $total_count) * 100, 2);
        $width_3 = number_format(($_3_stars / $total_count) * 100, 2);
        $width_4 = number_format(($_4_stars / $total_count) * 100, 2);
        $width_5 = number_format(($_5_stars / $total_count) * 100, 2);
    ?>

        <section class="section-score-card " style="background-color: #f1f1f1">
            <div class="score-card" style="background-color: #f1f1f1">
                <span class="heading">User Ratings Summary</span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <p> <?= $average ?> average based on <?= $total_count ?> reviews.</p>
                <hr style="border:3px solid #f1f1f1">

                <div class="row">
                    <div class="side">
                        <div>5 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-5" style="width:<?= $width_5 ?>%"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div><?= $_5_stars ?></div>
                    </div>
                    <div class="side">
                        <div>4 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-4" style="width:<?= $width_4 ?>%"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div><?= $_4_stars ?></div>
                    </div>
                    <div class="side">
                        <div>3 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-3" style="width:<?= $width_3 ?>%"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div><?= $_3_stars ?></div>
                    </div>
                    <div class="side">
                        <div>2 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-2" style="width:<?= $width_2 ?>%"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div><?= $_2_stars ?></div>
                    </div>
                    <div class="side">
                        <div>1 star</div>
                    </div>
                    <div class="middle">
                        <div class="bar-container">
                            <div class="bar-1" style="width:<?= $width_1 ?>%"></div>
                        </div>
                    </div>
                    <div class="side right">
                        <div><?= $_1_stars ?></div>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <br>

        <!-- Filter options-->

        <div id="reviews" class="container">
            <div class="row">
                <div class="col-md-2" style="text-align: center">
                    <a href="?content=x" style="text-decoration: none">
                        <div class="card" style="border:2px solid #00bcd4">
                            <div style="font-size: 25px">All</div>
                            ( <?= $total_count ?> )
                        </div>
                    </a>
                </div>

                <div class="col-md-2" style="text-align: center">
                    <a href="?content=1" style="text-decoration: none">
                        <div class="card" style="border:2px solid #00bcd4">
                            <div class="stars" style="font-size: 25px" data-rating="1"></div>
                            ( <?= $_1_stars ?> )
                        </div>
                    </a>
                </div>

                <div class="col-md-2" style="text-align: center">
                    <a href="?content=2" style="text-decoration: none">
                        <div class="card" style="border:2px solid #00bcd4">
                            <div class="stars" style="font-size: 25px" data-rating="2"></div>
                            ( <?= $_2_stars ?> )
                        </div>
                    </a>
                </div>

                <div class="col-md-2" style="text-align: center">
                    <a href="?content=3" style="text-decoration: none">
                        <div class="card" style="border:2px solid #00bcd4">
                            <div class="stars" style="font-size: 25px" data-rating="3"></div>
                            ( <?= $_3_stars ?> )
                        </div>
                    </a>
                </div>

                <div class="col-md-2" style="text-align: center">
                    <a href="?content=4" style="text-decoration: none">
                        <div class="card" style="border:2px solid #00bcd4">
                            <div class="stars" style="font-size: 25px" data-rating="4"></div>
                            ( <?= $_4_stars ?> )
                        </div>
                    </a>
                </div>

                <div class="col-md-2" style="text-align: center">
                    <a href="?content=5" style="text-decoration: none">
                        <div class="card" style="border:2px solid #00bcd4">
                            <div class="stars" style="font-size: 25px" data-rating="5"></div>
                            ( <?= $_5_stars ?> )
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <br>
        <hr>

        <?php
        $review_list = Review::showAllReviews();

        if (isset($_GET['content'])) {
            $contentId = $_GET['content'];
            switch ($contentId) {
                case 1:
                    $review_list = Review::showByStars(1);
                    break;
                case 2:
                    $review_list = Review::showByStars(2);
                    break;
                case 3:
                    $review_list = Review::showByStars(3);
                    break;
                case 4:
                    $review_list = Review::showByStars(4);
                    break;
                case 5:
                    $review_list = Review::showByStars(5);
                    break;
                default:
                    $review_list = Review::showAllReviews();
            }
        }
        ?>

        <!--review cards-->

        <div class="container" id="reviews">
            <div class="row" style="margin-top: 10px;margin-bottom: 10px;">

                <!--  iteration part-->

                <?php
                foreach ($review_list as $review) {
                ?>
                    <div class="col-md-4" style="margin-top: 10px;margin-bottom: 10px">
                        <div class="card" style="border:2px solid black;height: 200px">
                            <div class="card-body">
                                <p class="card-subtitle mb-2 text-muted" style="font-size: 20px"><i class="fa-solid fa-user"></i>&nbsp;
                                    <?php
                                    $username = $review->getUserName();
                                    echo $username;
                                    ?>
                                </p>
                                <p class="card-text">
                                <div class="stars" style="font-size: 25px" data-rating="<?= $review->getRate() ?>"> </div>
                                </p>
                                <h6 class="card-subtitle mb-2 text-muted" style="font-size: 20px">
                                    <?php
                                    $reviewHeading = $review->getTitle();
                                    echo $reviewHeading;
                                    ?>.....
                                </h6>
                                <p class="card-text">
                                    <?php
                                    $reviewBody = $review->getBody();
                                    echo $reviewBody;
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <h6 class="text-center" style="font-size: 20px">No reviews to display</h6>
            <?php
            }
            ?>
            </div>
        </div>

        <?php
        include_once "footer.php";
        ?>