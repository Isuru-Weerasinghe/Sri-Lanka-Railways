<?php
session_start();

use classes\User;

require_once '../classes/User.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['submit_login'])) {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = strip_tags($_POST['username']);
            $password = strip_tags($_POST['password']);

            $login = new User($username, $password);
            if (!$login->wrongUsername() || !$login->wrongPassword()) {
                header("Location: ../login.php?status=2");
                exit;
            } else if ($login->login()) {
                if (isset($_POST['remember_me'])) {
                    $token = bin2hex(random_bytes(32));
                    $expiry = time() + (30 * 24 * 60 * 60);

                    $login->setToken($token);
                    $login->setExpiry($expiry);
                    if ($login->update()) {
                        setcookie("remember_me", $token, $expiry, "/");
                    } else {
                        header("Location: ../login.php");
                    }
                }

                if ($_SESSION['role'] == "Passenger") {
                    header("Location: ../index.php");
                    exit;
                } else if ($_SESSION['role'] == "Admin") {
                    header("Location: ../admin/admin_dashboard.php");
                    exit;
                } else if ($_SESSION['role'] == "Cater Staff") {
                    header("Location: ../admin/cater_staff_dashboard.php");
                    exit;
                } else if ($_SESSION['role'] == "Railway Operator") {
                    header("Location: ../admin/railway_operator_dashboard.php");
                    exit;
                } else if ($_SESSION['role'] == "Station Staff") {
                    header("Location: ../admin/station_staff_dashboard.php");
                    exit;
                }
            }
        } else {
            header("Location: ../login.php?status=1");
            exit;
        }
    } else {
        header("Location: ../login.php");
        exit;
    }
} else if($_SERVER['REQUEST_METHOD'] === "GET"){
    if (isset($_COOKIE['remember_me'])) {
        $login = new User(NULL, NULL);
        $login->setToken($_COOKIE['remember_me']);
        if ($login->validateCookie()) {
            if ($_SESSION['role'] == "Passenger") {
                header("Location: ../index.php");
                exit;
            } else if ($_SESSION['role'] == "Admin") {
                header("Location: ../admin/admin_dashboard.php");
                exit;
            } else if ($_SESSION['role'] == "Cater Staff") {
                header("Location: ../admin/cater_staff_dashboard.php");
                exit;
            } else if ($_SESSION['role'] == "Railway Operator") {
                header("Location: ../admin/railway_operator_dashboard.php");
                exit;
            } else if ($_SESSION['role'] == "Station Staff") {
                header("Location: ../admin/station_staff_dashboard.php");
                exit;
            }
        } else {
            unset($_COOKIE['remember_user']); 
            setcookie("remember_me", "", -1, "/");
            header("Location: ../login.php");
            exit;
        }
    }
}else {
    header("Location: ../login.php");
    exit;
}