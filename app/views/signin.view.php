<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/signin-up.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <main class="">
        <div class="box">
            <p><?echo $errors;?></p>
            <div class="inner-box">
                <div class="form-warp">

                    <!-- --------------------------
                        Sign-In Part
                    ------------------------------- -->
                    <form method="POST" autocomplete="off" class="sign-in-form">
                        <div class="logo">
                            <img src="<?= ROOT ?>/assets/images/logo.JPG" alt="company_logo">
                            <!-- <h4>Amoral</h4> -->
                            <span>
                                <a href="<?= ROOT ?>/home">
                                    <ion-icon name="chevron-back-outline"></ion-icon>
                                    <!-- <ion-icon name="chevron-back-circle-outline"></ion-icon> -->
                                    Back
                                </a>
                            </span>
                        </div>

                        <div class="heading">
                            <h2>Welcome Back</h2>
                            <h6>Not Registred Yet ?</h6>
                            <a href="#" class="toggle">Sign Up</a>
                        </div>
                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="email" class="input-field" autocomplete="off" minlength="5">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-wrap">
                                <input type="password" name="password" class="input-field" required autocomplete="off">
                                <label for="pass">Password</label>
                                <a href="#" class="hide active">
                                    <ion-icon name="eye-outline"></ion-icon>
                                </a>


                            </div>
                            <input type="submit" name="signIn" value="SignIn" class="sign-btn">
                            <p class="text">
                                Forget your password or your login details?
                                <a href="#" id="help" class="toggle-1">Get Help</a> Signing in
                            </p>

                        </div>
                    </form>

                    
                    <!-- --------------------------
                        Sign-Up Part
                    ------------------------------- -->
                    <form autocomplete="off" class="sign-up-form" id="signupForm" method="POST">
                        <div class="logo">
                            <img src="<?= ROOT ?>/assets/images/logo.JPG" alt="company_logo">
                            <!-- <h4>Amoral</h4> -->
                            <span>
                                <a href="<?= ROOT ?>/home">
                                    <ion-icon name="chevron-back-outline"></ion-icon>
                                    <!-- <ion-icon name="chevron-back-circle-outline"></ion-icon> -->
                                    Back
                                </a>
                            </span>
                        </div>

                        <div class="heading">
                            <h2>Get Started</h2>
                            <h6>Already Have an account ?</h6>
                            <a href="#" class="toggle">Sign In</a>
                        </div>
                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" name="fullname" class="input-field" autocomplete="off">
                                <label for="fullname">Full Name</label>
                            </div>
                            <div class="input-wrap">
                                <input type="email" name="email" class="input-field" autocomplete="off">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-wrap">
                                <input type="password" name="password" class="input-field" autocomplete="off">
                                <label for="pass">Password</label>

                            </div>
                            <div class="input-wrap">
                                <input type="password" name="re-password" class="input-field" autocomplete="off">
                                <label for="pass">Confirm Password</label>
                                <a href="#" class="hide active">
                                    <ion-icon name="eye-outline"></ion-icon>
                                </a>
                            </div>
                            <input type="submit" name="signUp" value="SignUp" class="sign-btn" id="sign-up-btn">
                            <!-- <button type="submit" name="signUp" value="SignUp" class="sign-btn" id="sign-up-btn">SignUp</button> -->
                            <p class="text">
                                By signing up, I agree to the
                                <a href="#" class="toggle-1">Terms of Services</a> and
                                <a href="#" class="toggle-1">Privacy Policy</a>
                            </p>

                        </div>
                    </form>
                </div>

                <!-- --------------------------
                    Images Slider
                ------------------------------- -->
                <div class="carousel">
                    <div class="images-wrapper">

                        <img src="<?= ROOT ?>/assets/images/signin-up/1.png" class="image img-1 show" alt="">
                        <img src="<?= ROOT ?>/assets/images/signin-up/2.jpg" class="image img-2" alt="">
                        <img src="<?= ROOT ?>/assets/images/signin-up/3.jpg" class="image img-3" alt="">
                        <img src="<?= ROOT ?>/assets/images/signin-up/4.jpg" class="image img-4" alt="">
                    </div>
                    <div class="text-slider">
                        <div class="text-wrap">
                            <div class="text-group">
                                <h2>Create Your Own Designs</h2>
                                <h2>Customize as you like</h2>
                                <h2>Follow Us On All Social Media</h2>
                                <!-- <span>
                                    <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                                    <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                                </span> -->

                            </div>
                        </div>
                        
                        <!-- --------------------------
                            Bullets
                        ------------------------------- -->
                        <div class="bullets">
                            <span class="bull-1 active" data-value="1"></span>
                            <span class="bull-2" data-value="2"></span>
                            <span class="bull-3" data-value="3"></span>
                            <span class="bull-4" data-value="4"></span>
                        </div>

                    </div>
                </div>
            </div>

            <!-- <?= implode("<br>", $errors) ?>  -->

        </div>
    </main>

    <!--  popup toast  -->
    <?php include 'utils/toastMsg.php' ?>
    <!-- pass the error msg -->
    <script>
        let dataValidate = <?php echo json_encode($errors); ?>
        // console.log(dataValidate)
    </script>

    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>

    <!-- <script>
        // page reloading stoping method
        document.addEventListener("DOMContentLoaded", () => {
            var form = document.getElementById("signupForm");

            form.addEventListener("submit", function(event) {
                event.preventDefault();
                // Prevent the default form submission
                var formData = new FormData(form);

                var fullname = formData.get("fullname");
                var email = formData.get("email");
                var password = formData.get("password");
                var confirmPassword = formData.get("re-password");

                console.log(fullname);
                console.log(email);
                console.log(password);
                console.log(confirmPassword);
                console.log(formData);

                fetch("<?= ROOT ?>/signin", {
                        method: "POST",
                        body: formData,
                    })
                    .then((response) => response.text())
                    .then((data) => {
                        // console.log("turegr")
                        // Handle the server's response here
                        // document.getElementById("result").innerHTML = data;
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            });
        });
    </script> -->

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="<?= ROOT ?>/assets/js/signin-up.js"></script>

</body>

</html>