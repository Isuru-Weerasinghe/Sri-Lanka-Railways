<?php
session_start();

use classes\RailwayOperator;

require_once '../classes/User.php';
require_once '../classes/RailwayOperator.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['addTrain'])) {
        if (!empty($_POST['train_name']) && isset($_POST['canteen'])) {
            $train = $_POST['train_name'];
            $canteen = $_POST['canteen'];

            RailwayOperator::addTrain($train, $canteen);
        } else {
            header("Location: ../admin/railway_operator_trains.php?status=1");
            exit;
        }
    } else if (isset($_POST['addRoute'])) {
        if (!empty($_POST['route_name'])) {
            $route = $_POST['route_name'];

            RailwayOperator::addRoute($route);
        } else {
            header("Location: ../admin/railway_operator_routes.php?status=1");
            exit;
        }
    } else if (isset($_POST['addSchedule'])) {
        if ($_POST['route'] != "0" && $_POST['train'] != "0" && strlen($_POST['arr_time']) != 0 && !empty($_POST['dep_time']) &&  !empty($_POST['start_station'])  && $_POST['end_station'] != "0") {
            $route = $_POST['route'];
            $train = $_POST['train'];
            $arrTime = $_POST['arr_time'];
            $depTime = $_POST['dep_time'];
            $startStation = $_POST['start_station'];
            $endStation = $_POST['end_station'];

            RailwayOperator::addSchedule($route, $train, $arrTime, $depTime, $startStation, $endStation);
        } else {
            header("Location: ../admin/railway_operator_schedules.php?status=1");
            exit;
        }
    } else {
        header("Location: ../admin/railway_operator_dashboard.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['action']) && isset($_GET['target']) && isset($_GET['id'])) {
        if ($_GET['action'] == "delete" && $_GET['target'] == "schedule") {
            $scheduleId = $_GET['id'];

            if (RailwayOperator::deleteSchedule($scheduleId)) {
                header("Location: ../admin/railway_operator_schedules.php?status=4");
                exit;
            } else {
                header("Location: ../admin/railway_operator_schedules.php?status=5");
                exit;
            }
        } if ($_GET['action'] == "delete" && $_GET['target'] == "train") {
            $trainId = $_GET['id'];

            if (RailwayOperator::deleteTrain($trainId)) {
                header("Location: ../admin/railway_operator_trains.php?status=4");
                exit;
            } else {
                header("Location: ../admin/railway_operator_trains.php?status=5");
                exit;
            }
        } if ($_GET['action'] == "delete" && $_GET['target'] == "route") {
            $routeId = $_GET['id'];

            if (RailwayOperator::deleteRoute($routeId)) {
                header("Location: ../admin/railway_operator_routes.php?status=4");
                exit;
            } else {
                header("Location: ../admin/railway_operator_routes.php?status=5");
                exit;
            }
        }
    } else {
        header("Location: ../admin/railway_operator_dashboard.php");
        exit;
    }
} else {
    header("Location: ../admin/railway_operator_dashboard.php");
    exit;
}