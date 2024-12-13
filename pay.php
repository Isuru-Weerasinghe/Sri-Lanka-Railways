<?php
session_start();

if (isset($_SESSION['schId'], $_SESSION['class'], $_SESSION['date'], $_SESSION['qty'], $_SESSION['price'])) {
    $schId = $_SESSION["schId"];
    $class = $_SESSION["class"];
    $date = $_SESSION["date"];
    $qty = $_SESSION["qty"];
    $price = $_SESSION["price"];
} else{
    header("Location: reservations.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <title>Payment Checkout</title>
    <link rel="icon" href="https://icons.veryicon.com/png/o/object/material-design-icons/train-21.png"
        type="image/x-icon">
    <link rel="stylesheet" href="assets/css/payment.css" />
    <script src="https://kit.fontawesome.com/79271f9696.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form action="includes/reservation.inc.php" method="POST" id="form">
            <div class="row">
                <div class="col">
                    <h3 class="title">Payment Details</h3>
                    <div class="inputBox">
                        <span>Reservation ID:</span>
                        <input type="text" placeholder="<?php echo $schId; ?>" readonly />
                    </div>
                    <div class="inputBox">
                        <span>Class:</span>
                        <input type="text" placeholder="<?php echo $class; ?>" readonly />
                    </div>
                    <div class="inputBox">
                        <span>Number of Seats:</span>
                        <input type="text" placeholder="<?php echo $qty; ?>" readonly />
                    </div>
                    <div class="inputBox">
                        <span>Price (LKR):</span>
                        <input type="text" placeholder="<?php echo $price; ?>" readonly />
                    </div>
                    <div class="inputBox">
                        <span>Reservation Date:</span>
                        <input type="text" placeholder="<?php echo $date; ?>" readonly />
                    </div>
                </div>
                <div class="col">
                    <h3 class="title">payment</h3>

                    <div class="inputBox">
                        <span>cards accepted:</span>
                        <img src="assets/img/card_img.png" alt="" />
                    </div>
                </div>
                <div class="inputBox">
                        <input type="hidden" placeholder="<?php echo $schId; ?>" name="submit_pay" readonly />
                    </div>
            </div>
            <button type="submit" class="submit-btn">Proceed to Payment</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
<script>
    // Get a reference to the form element
    var form = document.getElementById("form");

    // Add an event listener to the form's submit button
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
        
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () => {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                var obj = JSON.parse(xhttp.responseText);
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    form.submit();
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    // window.location.href = "http://localhost/railway/reservations.php";
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    alert("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1224297",    // Replace your Merchant ID
                    "return_url": "http://localhost/railway/pay.php",     // Important
                    "cancel_url": "http://localhost/railway/pay.php",     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["order_id"],
                    "items": obj["item"],
                    "amount": obj["amount"],
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": "Saman",
                    "last_name": "Perera",
                    "email": "samanp@gmail.com",
                    "phone": "0771234567",
                    "address": "No.1, Galle Road",
                    "city": "Colombo",
                    "country": "Sri Lanka",
                    "delivery_address": "No. 46, Galle road, Kalutara South",
                    "delivery_city": "Kalutara",
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };
                payhere.startPayment(payment);
            }
        };
        xhttp.open("GET", "includes/payment.php", true);
        xhttp.send();
    });
</script>
</body>

</html>