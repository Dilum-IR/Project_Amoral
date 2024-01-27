<?php

// echo $_POST['type'];

$merchant_id = "1225460";
$merchant_secret = "MzAzMzgwMzY2MzEyMzU2MzU5Njk4MTU2MTI5NTMzMzYzMTMyMzY2";
$currency = "LKR";

$order_id = uniqid();
$amount = 3000;

$hash = strtoupper(
    md5(
        $merchant_id .
            $order_id .
            number_format($amount, 2, '.', '') .
            $currency .
            strtoupper(md5($merchant_secret))
    )
);

$arr = [];

$arr['first_name'] = "Saman";
$arr['last_name'] = "Perera";
$arr['email'] = "samanp@gmail.com";
$arr['phone'] = "0771234567";
$arr['address'] = "No.1, Galle Road";
$arr['city'] = "Colombo";
$arr['country'] = "Sri Lanka";

$arr['items'] = "New T-Shirt";
$arr['amount'] = $amount;
$arr['merchant_id'] = $merchant_id;
$arr['order_id'] = $order_id;
$arr['amount'] = $amount;
$arr['merchant_id'] = $merchant_id;
$arr['currency'] = $currency;
$arr['hash'] = $hash;

$json_obj = json_encode($arr);

echo $json_obj;
