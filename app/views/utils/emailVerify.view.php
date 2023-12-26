<?php
if (
    !$_SERVER['REQUEST_METHOD'] === "GET" &&
    !isset($_GET) &&
    !isset($_GET['email']) &&
    !isset($_GET['hash']) &&
    !isset($_GET['code'])
) {
    redirect("signup");
    exit;
} else {
    // Get the pass data from URL for after sign Up
    $email = htmlspecialchars($_GET['email']);
    $hash = htmlspecialchars($_GET['hash']);
    $code = htmlspecialchars($_GET['code']);
    if (
        password_verify($email, $hash) &&
        $code == 19258387 &&
        filter_var($email, FILTER_VALIDATE_EMAIL)
    ) {

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="<?= ROOT ?>/assets/css/emailverify.css">
            <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

            <!-- toast css -->
            <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">
            <!-- loading css -->
            <link rel="stylesheet" href="<?= ROOT ?>/assets/css/loading.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

            <title>Amoral Verify</title>
        </head>

        <body>

            <!-- loading page  & toast msg content-->
            <?php
            include "loading.php";
            include 'toastMsg.php'
            ?>

            <div class="page-content">

                <div class="otp-card">
                    <img src="<?= ROOT ?>/assets/images/logo.JPG" width="100px" height="100px" alt="">
                    <h1>OTP Verification</h1>
                    <p>Code has been send to <span><?= substr($email, 0, 4) ?? ''; ?></span>******<span><?= substr($email, -10) ?? ''; ?></span></p>
                    <div class="otp-card-inputs">
                        <input type="text" maxlength="1" autofocus>
                        <input type="text" maxlength="1">
                        <input type="text" maxlength="1">
                        <input type="text" maxlength="1">
                        <input type="text" maxlength="1">
                        <input type="text" maxlength="1">
                    </div>
                    <p>Don't receive the OTP ? <span class="timer"> </span><button id="resend">Resend</button></p>
                    <button class="verify" id="otpVerify" disabled onclick=""><span>Verify</span> <i class='bx bx-loader-circle bx-spin' style='color:#ffffff'></i></button>

                </div>
            </div>

            <?php

            $flag = htmlspecialchars($_GET['flag'] ?? 2);
            $success_no = htmlspecialchars($_GET['success_no'] ?? 0);

            $error_no = htmlspecialchars($_GET['error_no'] ?? 0);

            ?>
            <script>
                let verify = "<?= $email; ?>"


                let successData = {
                    "success_no": <?= $success_no ?>,
                    "flag": <?= $flag ?>,
                }
                let dataValidate = {
                    "flag": <?= $flag ?>,
                    "error_no": <?= $error_no ?>
                }
            </script>

            <!-- Import JQuary Library script -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
            <script src="<?= ROOT ?>/assets/js/toast.js"> </script>
            <script src="<?= ROOT ?>/assets/js/emailverify.js"></script>

            <script>
                document.addEventListener("DOMContentLoaded", () => {

                    $(document).ready(function() {

                        // Prevent the default form submission
                        $("#otpVerify").click(function(event) {

                            event.preventDefault();
                            let otp = getOtp();

                            data = {
                                email_otp: otp,
                                email: verify
                            }


                            $.ajax({
                                type: "POST",
                                url: "http://localhost/project_Amoral/public/verifyOtp",
                                data: data,
                                cache: false,
                                success: function(res) {
                                    if (res == 1) {
                                        // otp valid state
                                        toastApply("Valid OTP Code ", "Verification Successfull 😀🎉", 0);

                                        setTimeout(() => {
                                            toastApply("Signup Success", "Login with Amoral... 😀🎉", 0);
                                        }, 5500);
                                        window.location.href = "http://localhost/project_Amoral/public/signin"
                                        return

                                    } else {
                                        toastApply("Invalid OTP Code ", "Verification Invalid. Try Again", 1);
                                    }

                                },
                                error: function(xhr, status, error) {
                                    return xhr;
                                }
                            })

                        })



                    })

                })
            </script>

        </body>

        </html>
<?php
    } else {
        // add toast msg for refresh time
        redirect("signin");
    }
}
