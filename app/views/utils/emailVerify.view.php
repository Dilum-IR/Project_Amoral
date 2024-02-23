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
                    <p>Don't receive the OTP ? <span class="timer"></span>
                    <form method="POST">
                        <input id="resend" type="submit" name="resend" value="Resend">
                        <input type="hidden" name="dumy" value="dumy">
                        <input type="hidden" name="emaii" value="<? $email ?>">
                    </form>
                    </p>
                    <button class="verify" id="otpVerify" disabled onclick=""><span>Verify</span> <i class='bx bx-loader-circle bx-spin' style='color:#ffffff'></i></button>

                </div>
            </div>

            <?php

            $flag = htmlspecialchars($_GET['flag'] ?? 2);
            $success_no = htmlspecialchars($_GET['success_no'] ?? 0);

            $error_no = htmlspecialchars($_GET['error_no'] ?? 0);
            $u = htmlspecialchars($_GET['u'] ?? 0);

            ?>
            <script>
                let verify = "<?= $email; ?>"
                let u = "<?= $u; ?>"

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
                                email: verify,
                                un: u
                            }

                            $.ajax({
                                type: "POST",
                                url: "<?= ROOT ?>/verifyOtp",
                                data: data,
                                cache: false,
                                success: function(res) {
                                    try {

                                        console.log(res)
                                        // convet to the json type
                                        Jsondata = JSON.parse(res)


                                        if (Jsondata.flag === 1) {
                                            // otp valid state

                                            // toastApply(`${Jsondata.title}`, `${Jsondata.msg}`, 0);

                                            if (u == 1 || u == 2) {


                                                toastApply("Email Verified", "Login with Amoral... 😀🎉", 0);

                                                setTimeout(() => {
                                                    window.location.href = "<?= ROOT ?>/signin"
                                                }, 4000);

                                                return
                                            } else {
                                                // toastApply(`${Jsondata.title}`, `${Jsondata.msg}`, 0);

                                                toastApply("Signup Success", "Login with Amoral... 😀🎉", 0);

                                                setTimeout(() => {
                                                    window.location.href = "<?= ROOT ?>/signin"
                                                }, 4000);
                                                return
                                            }

                                        } else {
                                            toastApply(`${Jsondata.title}`, `${Jsondata.msg}`, 1);
                                        }
                                    } catch (error) {

                                    }


                                },
                                error: function(xhr, status, error) {
                                    // return xhr;
                                }
                            })

                        })

                        //      http://localhost/project_Amoral/public/verify?success_no=3&flag=0&hash=$2y$10$4TIw8dwyFPijeLLrl6/w3.qjeLOiKfObgfVzUUV/w5xw/u59Xh0XC&code=19258387&email=rdinduwara19158%40gmail.com&u=1

                    })

                })
            </script>

        </body>

        </html>
<?php
    } else {
        // add toast msg for refresh time
        redirect("404");
    }
}
