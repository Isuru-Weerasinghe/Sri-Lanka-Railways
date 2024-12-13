<?php

require '../classes/DbConnector.php';
require '../classes/Review.php';

use classes\DbConnector;
use classes\Review;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['title'], $_POST['rate'], $_POST['body'])) {

        if (!empty($_POST['title'] && $_POST['rate'] && $_POST['body'])) {

            $title = $_POST['title'];
            $rate = $_POST['rate'];
            $body = $_POST['body'];
            $user_id = $_POST['user_id'];

            //validate the title

            if (preg_match('/^[A-Za-z0-9\s]{1,20}$/', $title)) {
                $sanitizedTitle = htmlspecialchars($title, ENT_QUOTES);
            } else {
                header("Location:review_status.php?status=2");
            }

            // validate rating 

            $allowedRates = [1, 2, 3, 4, 5];
            if (in_array($rate, $allowedRates)) {
                $sanitizedRate = intval($rate);
            } else {
                header("Location:review_status.php?status=3");
            }

            //validate body of the review

            if (is_string($body) && strlen($body) <= 200) {

                $sanitizedbody = htmlspecialchars($body, ENT_QUOTES);
            } else {
                header("Location:review_status.php?status=4");
            }

            try {

                $review = new Review($user_id, $sanitizedTitle, $sanitizedRate, $sanitizedbody);

                if ($review->addReview()) {
                    header("Location:../rate_review.php?status=5");
                } else {
                    header("Location:review_status.php?status=6");
                }
            } catch (PDOException $exc) {
                echo $exc->getMessage();
            }
        } else {
            header("Location:review_status.php?status=1");
        }
    } else {

        header("Location:review_status.php?status=0");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['rev_id'])) {
        $rev_id = $_GET['rev_id'];
        if($x = Review::deleteReview($rev_id)){
           header("Location:myreviews.php?status=7"); 
        }
    }
}

