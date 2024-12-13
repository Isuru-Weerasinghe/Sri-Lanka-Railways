<?php
session_start();

$item = $_SESSION['schId'];
$amount = $_SESSION['price'];
$merchant_id = 1224297;
$order_id = uniqid();
$currency = "LKR";
$merchant_secret = 'Mzc5NzYwMjcyNDEwNTU4OTk0MDc0MjIyMDM0ODE0MTA2NDYyNjQwMA=='; // Replace with your Merchant Secret

$hash = strtoupper(
    md5(
        $merchant_id .
        $order_id .
        number_format($amount, 2, ".", "") .
        $currency .
        strtoupper(md5($merchant_secret))
    )
);

$arr = array();

$arr['item'] = $item;
$arr['merchant_id'] = $merchant_id;
$arr['order_id'] = $order_id;
$arr['amount'] = $amount;
$arr['hash'] = $hash;

$json_obj = json_encode($arr);
echo $json_obj;