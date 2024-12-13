<?php
session_start();

use classes\CaterStaff;

require_once '../classes/User.php';
require_once '../classes/CaterStaff.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['addFood'])) {
        if (!empty($_POST['food_name']) && !empty($_POST['price']) && $_FILES['food_image']['error'] === UPLOAD_ERR_OK) {
            if (pathinfo($_FILES['food_image']['name'])['extension'] == "jpg" || pathinfo($_FILES['food_image']['name'])['extension'] == "jpeg" || pathinfo($_FILES['food_image']['name'])['extension'] == "jpg" || pathinfo($_FILES['food_image']['name'])['extension'] == "png") {
                $food = $_POST['food_name'];
                $price = $_POST['price'];
                $filename = $_FILES['food_image']['name'];
                $tempname = $_FILES['food_image']['tmp_name'];
                $folder = "../assets/img/food/" . $filename;

                if (move_uploaded_file($tempname, $folder)) {
                    CaterStaff::addFood($food, $price, $filename);
                } else {
                    header("Location: ../admin/cater_staff_foods.php?status=3");
                    exit;
                }
            } else {
                header("Location: ../admin/cater_staff_foods.php?status=2");
                exit;
            }
        } else {
            header("Location: ../admin/cater_staff_foods.php?status=1");
            exit;
        }
    } else {
        header("Location: ../admin/cater_staff_dashboard.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['action']) && isset($_GET['target']) && isset($_GET['id'])) {
        if ($_GET['action'] == "delete" && $_GET['target'] == "foodOrder") {
            $foodOrderId = $_GET['id'];

            if (CaterStaff::deleteFoodOrder($foodOrderId)) {
                header("Location: ../admin/cater_staff_orders.php?status=1");
                exit;
            } else {
                header("Location: ../admin/cater_staff_orders.php?status=2");
                exit;
            }
        } if ($_GET['action'] == "prepare" && $_GET['target'] == "foodOrder") {
            $foodOrderId = $_GET['id'];

            if (CaterStaff::prepareFoodOrder($foodOrderId)) {
                header("Location: ../admin/cater_staff_orders.php?status=3");
                exit;
            } else {
                header("Location: ../admin/cater_staff_orders.php?status=4");
                exit;
            }
        } if ($_GET['action'] == "success" && $_GET['target'] == "foodOrder") {
            $foodOrderId = $_GET['id'];

            if (CaterStaff::successFoodOrder($foodOrderId)) {
                header("Location: ../admin/cater_staff_orders.php?status=5");
                exit;
            } else {
                header("Location: ../admin/cater_staff_orders.php?status=6");
                exit;
            }
        } else if ($_GET['action'] == "delete" && $_GET['target'] == "food") {
            $foodId = $_GET['id'];

            if (CaterStaff::deleteFood($foodId)) {
                header("Location: ../admin/cater_staff_foods.php?status=6");
                exit;
            } else {
                header("Location: ../admin/cater_staff_foods.php?status=7");
                exit;
            }
        }
    } else {
        header("Location: ../admin/admin_dashboard.php");
        exit;
    }
} else {
    header("Location: ../admin/cater_staff_dashboard.php");
    exit;
}