<?php
session_start();

use classes\Passenger;

require_once '../classes/Passenger.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['submit_reservation'])) {
        if (!empty($_POST["sch_Id"]) && !empty($_POST["class"]) && !empty($_POST["date"]) && !empty($_POST["qty"])) {
            if (strtotime(date("Y-m-d")) < strtotime($_POST["date"])) {
                $_SESSION['schId'] = $_POST["sch_Id"];
                $_SESSION['class'] = $_POST["class"];
                $_SESSION['date'] = $_POST["date"];
                $_SESSION['qty'] = strip_tags($_POST["qty"]);
                $_SESSION['price'] = Passenger::calculatePrice($_POST["class"], $_POST["qty"]);

                if(Passenger::checkSeatAvailability()){
                    header("Location: ../pay.php");
                    exit;
                } else {
                    header("Location: ../reservations.php?status=4");
                    exit;
                }
            } else {
                header("Location: ../reservations.php?status=2");
                exit;
            }
        } else {
            header("Location: ../reservations.php?status=1");
            exit;
        }
    } else if (isset($_POST['submit_pay'])) {
        $ticket_id = bin2hex(random_bytes(32));

        if (Passenger::placeReservation($_SESSION['schId'], $_SESSION['class'], $_SESSION['date'], $_SESSION['qty'], $ticket_id)) {
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
                'text' => "Hello {$_SESSION['username']},\n\nYour reservation has successfully completed.\n\nSchedule ID: {$_SESSION['schId']}\nTicket ID: {$ticket_id}\nClass: {$_SESSION['class']}\nQuantity: {$_SESSION['qty']}\nDate: {$_SESSION['date']}\nPrice: {$_SESSION['price']}\n\nThank you for using our service!",
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
            header("Location: ../my_reservations.php");
            exit;
        } else {
            header("Location: ../reservations.php?status=3");
            exit;
        }
    } else {
        header("Location: ../reservations.php");
        exit;
    }
} else {
    header("Location: ../reservations.php");
    exit;
}