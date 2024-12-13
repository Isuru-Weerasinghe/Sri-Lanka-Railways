<?php
session_start();

use classes\Passenger;

require_once '../classes/Passenger.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['submit_signup'])) {
        if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['nic']) && !empty($_POST['tele']) && !empty($_POST['userName']) && !empty($_POST['email']) && !empty($_POST['pwd'])) {
            $fname = strip_tags($_POST["fname"]);
            $lname = strip_tags($_POST["lname"]);
            $nic = strip_tags($_POST["nic"]);
            $tele = strip_tags($_POST["tele"]);
            $userName = strip_tags($_POST["userName"]);
            $email = strip_tags($_POST["email"]);
            $password = strip_tags($_POST["pwd"]);
            $passwordRepeat = strip_tags($_POST["pwdRepeat"]);
            $hashedPwd = password_hash($password, PASSWORD_BCRYPT);

            $signUp = new Passenger($fname, $lname, $nic, $tele, $email, $userName, $password, $passwordRepeat);

            if (!($signUp->validateNic())) {
                header("Location: ../signup.php?status=2");
                exit;
            } else if (!($signUp->validateTelephone())) {
                header("Location: ../signup.php?status=3");
                exit;
            } else if (!($signUp->validateEmail())) {
                header("Location: ../signup.php?status=4");
                exit;
            } else if (!($signUp->validateUsername())) {
                header("Location: ../signup.php?status=5");
                exit;
            } else if (!($signUp->invalidUsername())) {
                header("Location: ../signup.php?status=6");
                exit;
            } else if (!($signUp->validatePassword())) {
                header("Location: ../signup.php?status=7");
                exit;
            } else if (!($signUp->passwordMatch())) {
                header("Location: ../signup.php?status=8");
                exit;
            } else if ($signUp->signUp($hashedPwd)) {
                header("Location: ../signup.php?status=9");
                exit;
            }
        } else {
            header("Location: ../signup.php?status=1");
            exit;
        }
    } else {
        header("Location: ../signup.php");
        exit;
    }
} else {
    header("Location: ../signup.php");
    exit;
}