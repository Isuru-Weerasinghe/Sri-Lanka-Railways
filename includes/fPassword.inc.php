<?php
session_start();

use classes\Passenger;

require_once '../classes/Passenger.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['submit_fpassword'])) {
        $username = strip_tags($_POST['username']);
        $_SESSION['username'] = $username;

        if (!Passenger::forgotPasswordEmptyInput($username)) {
            header("Location: ../fPassword.php?status=1");
            exit;
        } else if (!Passenger::forgotPasswordFindUser($username)) {
            header("Location: ../fPassword.php?status=2");
            exit;
        } else {
            $_SESSION['fpassword'] = true;
            $otp = rand(1000, 9999);
            $expiry = time() + (5 * 60);
            if (Passenger::generateOtp($otp, $expiry)) {
                // Initialize cURL session
                $ch = curl_init();

                // Set the URL
                curl_setopt($ch, CURLOPT_URL, 'https://messages-sandbox.nexmo.com/v1/messages');

                // Set HTTP Basic Authentication username and password
                curl_setopt($ch, CURLOPT_USERPWD, 'e89c3ff8:T59hdUhrwSD55E7F');

                // Set the HTTP headers
                $headers = array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                );

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                // Set the request method to POST
                curl_setopt($ch, CURLOPT_POST, true);

                // Set the request data in JSON format
                $data = array(
                    'from' => '14157386102',
                    'to' => '94767579998',
                    'message_type' => 'text',
                    'text' => "Hello {$_SESSION['username']},\n\nYour OTP is: {$otp}. Please note that the OTP will be expired after 5 minutes.",
                    'channel' => 'whatsapp',
                );

                $json_data = json_encode($data);

                curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

                // Return the response as a string
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Execute the cURL request
                $response = curl_exec($ch);

                unset($_SESSION['schId']);
                unset($_SESSION['class']);
                unset($_SESSION['date']);
                unset($_SESSION['qty']);
                unset($_SESSION['price']);

                curl_close($ch);
                header("Location: ../fPassword2.php?otp=success");
                exit;
            } else {
                header("Location: ../fPassword2.php?otp=failure");
                exit;
            }
        }
    } else {
        header("Location: ../fPassword.php");
        exit;
    }
} else if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['new_otp'])) {
        $otp = rand(1000, 9999);
        $expiry = time() + (5 * 60);
        if (Passenger::generateOtp($otp, $expiry)) {
            // Initialize cURL session
            $ch = curl_init();

            // Set the URL
            curl_setopt($ch, CURLOPT_URL, 'https://messages-sandbox.nexmo.com/v1/messages');

            // Set HTTP Basic Authentication username and password
            curl_setopt($ch, CURLOPT_USERPWD, 'e89c3ff8:T59hdUhrwSD55E7F');

            // Set the HTTP headers
            $headers = array(
                'Content-Type: application/json',
                'Accept: application/json',
            );

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // Set the request method to POST
            curl_setopt($ch, CURLOPT_POST, true);

            // Set the request data in JSON format
            $data = array(
                'from' => '14157386102',
                'to' => '94767579998',
                'message_type' => 'text',
                'text' => "Hello {$_SESSION['username']},\n\nYour OTP is: {$otp}. Please note that the OTP will be expired after 5 minutes.",
                'channel' => 'whatsapp',
            );

            $json_data = json_encode($data);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

            // Return the response as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute the cURL request
            $response = curl_exec($ch);

            unset($_SESSION['schId']);
            unset($_SESSION['class']);
            unset($_SESSION['date']);
            unset($_SESSION['qty']);
            unset($_SESSION['price']);

            curl_close($ch);
            header("Location: ../fPassword2.php?otp=success");
            exit;
        } else {
            header("Location: ../fPassword2.php?otp=failure");
            exit;
        }
    } else {
        header("Location: ../fPassword.php");
        exit;
    }
} else {
    header("Location: ../fPassword.php");
    exit;
}