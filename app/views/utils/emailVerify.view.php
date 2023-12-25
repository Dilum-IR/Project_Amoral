<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/emailverify.css">

    <title>Document</title>
</head>
<body>
    <div class="otp-card">
        <h1>OTP Verification</h1>
        <p>Code has been send to ******@gmail.com</p>
        <div class="otp-card-inputs">
            <input type="text" maxlength="1" autofocus>
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
            <input type="text" maxlength="1">
        </div>
        <p>Didn't get the otp <a href="#">Resend</a></p>
        <button disabled>Verify</button>

    </div>
    <script src="<?= ROOT ?>/assets/js/emailverify.js"></script>
</body>
</html>