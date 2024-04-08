<?php ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="https://www.payhere.lk" target="_blank"><img src="https://www.payhere.lk/downloads/images/payhere_square_banner.png" alt="PayHere" width="150" /></a>

    <!-- <form action="payment.php" method="POST"> -->

    <!-- <input type="text" placeholder="customer" name="customer">
        <input type="text" placeholder="address" name="address">
        <input type="text" placeholder="product" name="product">
        <input type="text" placeholder="qty" name="qty">
        <input type="text" placeholder="price" name="price"> -->

    <div class="btn">
        <button class="button" onclick="paymentGateway();">Pay Here</button>

        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        
        <script src="paymentScript.js"></script>
        <!-- </form> -->
    </div>


    <style>
        .btn {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .button {
            background-color: green;
            border-radius: 50px;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            transition: 0.5s ease-in-out;
        }

        .button:hover {
            background-color: blue;

        }
    </style>
</body>

</html>