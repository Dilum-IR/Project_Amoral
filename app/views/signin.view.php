<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/signin-up.css">
</head>

<body>
    <main>
        <div class="box">
            <div class="inner-box">
                <div class="form-warp">
                    <form action="" autocomplete="off" class="sign-in-form">
                        <div class="logo">
                            <img src="<?= ROOT ?>/assets/images/logo.JPG" alt="company_logo">
                            <h4>Amoral</h4>
                        </div>

                        <div class="heading">
                            <h2>Welcome Back</h2>
                            <h6>Not Registred Yet ?</h6>
                            <a href="#" class="toggle">Sign Up</a>
                        </div>
                        <div class="actual-form">
                            <div class="input-wrap">
                                <input type="text" class="input-field" required autocomplete="off" minlength="5">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-wrap">
                                <input type="password" class="input-field" required autocomplete="off">
                                <label for="pass">Password</label>

                            </div>
                            <input type="submit" value="Sign In" class="sign-btn">
                            <p class="text">
                                Forget your password or your login details?
                                <a href="#" class="toggle">Get Help</a> Signing in
                            </p>

                        </div>
                    </form>
                    <form action="" autocomplete="off" class="sign-up-form">
                        <div class="logo">
                            <img src="<?= ROOT ?>/assets/images/logo.JPG" alt="company_logo">
                            <h4>Amoral</h4>
                        </div>

                        <div class="heading">
                            <h2>Get Started</h2>
                            <h6>Already Have an account ?</h6>
                            <a href="#" class="toggle">Sign In</a>
                        </div>
                        <div class="actual-form">
                            <!-- <div class="input-wrap">
                                <input type="text" class="input-field" required autocomplete="off" minlength="5">
                                <label for="email">Full Name</label>
                            </div> -->
                            <div class="input-wrap">
                                <input type="text" class="input-field" required autocomplete="off" minlength="5">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-wrap">
                                <input type="password" class="input-field" required autocomplete="off">
                                <label for="pass">Password</label>

                            </div>
                            <div class="input-wrap">
                                <input type="password" class="input-field" required autocomplete="off">
                                <label for="pass">Confirm Password</label>

                            </div>
                            <input type="submit" value="Sign Up" class="sign-btn">
                            <p class="text">
                                By signing up, I agree to the 
                                <a href="#" class="toggle-1">Terms of Services</a> and
                                <a href="#" class="toggle-1">Privacy Policy</a>
                            </p>

                        </div>
                    </form>
                </div>

                <div class="carousel"></div>
            </div>
        </div>
    </main>

    <script src="<?= ROOT ?>/assets/js/signin-up.js"></script>

</body>

</html>