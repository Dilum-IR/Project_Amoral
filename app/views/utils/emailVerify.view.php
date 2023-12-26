<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/emailverify.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>Amoral Verify</title>
</head>
<body>
    
    <div class="otp-card">
        <img src="<?= ROOT ?>/assets/images/logo.JPG" width="100px" height="100px" alt="">
        <h1>OTP Verification</h1>
        <p>Code has been send to <span>rdind</span>******<span>rdind</span></p>
        <div class="otp-card-inputs">
            <input type="text" maxlength="1" autofocus>
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
        </div>
        <p>Don't receive the OTP ? <span class="timer"> </span><button  id="resend">Resend</button></p>
        <button class="verify" disabled><span>Verify</span> <i class='bx bx-loader-circle bx-spin' style='color:#ffffff'></i></button>

    </div>
    <script src="<?= ROOT ?>/assets/js/emailverify.js"></script>
</body>
</html>