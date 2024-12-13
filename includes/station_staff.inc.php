<?php
session_start();

use classes\StationStaff;

require_once '../classes/User.php';
require_once '../classes/StationStaff.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['addStation'])) {
        if (!empty($_POST['station_name'])) {
            $station = $_POST['station_name'];

            StationStaff::addStation($station);
        } else {
            header("Location: ../admin/station_staff_stations.php?status=1");
            exit;
        }
    } else if (isset($_POST['addNotice'])) {
        if (!empty($_POST['notice'])) {
            $notice = $_POST['notice'];
            $userId = $_SESSION['userId'];

            StationStaff::addNotice($notice, $userId);
        } else {
            header("Location: ../admin/station_staff_notices.php?status=1");
            exit;
        }
    } else {
        header("Location: ../admin/station_staff_dashboard.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['action']) && isset($_GET['target']) && isset($_GET['id'])) {
        if ($_GET['action'] == "delete" && $_GET['target'] == "station") {
            $stationId = $_GET['id'];

            if (StationStaff::deleteStation($stationId)) {
                header("Location: ../admin/station_staff_stations.php?status=4");
                exit;
            } else {
                header("Location: ../admin/station_staff_stations.php?status=5");
                exit;
            }
        } if ($_GET['action'] == "delete" && $_GET['target'] == "notice") {
            $noticeId = $_GET['id'];

            if (StationStaff::deleteNotice($noticeId)) {
                header("Location: ../admin/station_staff_notices.php?status=4");
                exit;
            } else {
                header("Location: ../admin/station_staff_notices.php?status=5");
                exit;
            }
        }
    } else {
        header("Location: ../admin/station_staff_dashboard.php");
        exit;
    }
} else {
    header("Location: ../admin/station_staff_dashboard.php");
    exit;
}