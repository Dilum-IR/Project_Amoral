<!-- <img src="<?= ROOT ?>/assets/images/logo.JPG"> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amoral</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home/nav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home/home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


</head>

<body>
    <?php include 'navigationbar.php'; ?>

    <a href="<?= ROOT ?>/signin">SignIN</a>
    <h1> Home file view</h1>

    <section id="welcome-section" class="welcome-section">
        <!-- <div class="welcome-text">
                    <h2>
                        Welcome to AMORAL
                    </h2>
                    <h3>
                        Welcome to Amoral, your one-stop destination for custom-designed T-shirts that perfectly reflect your unique style and preferences. <a href="<?= ROOT ?>/signin" class="text-nav-link">Register</a> now to place your order. (If you have a garment factory you can <a href="<?= ROOT ?>/guest" class="text-nav-link">join with us</a>. Let's work together. Join us now.)
                    </h3>

                    <br>
                    <a href="<?= ROOT ?>/signin" class="home-nav-link">
                        <i class='bx bxs-user icon'></i>
                        Sign Up
                    </a>
                    <br>
                    <a href="<?= ROOT ?>/guest" class="home-partnership-link">
                        <i class='bx bxs-file icon'></i>
                        Partnership with AMORAL
                    </a>

                </div> -->

        <div class="main-img">
            <img class="welcome-img" id="welcome-img" src="<?= ROOT ?>/assets/images/home/fullscreen-image-1.jpg">
            <!-- <img class="welcome-img" src="3.jpg">
                    <img class="welcome-img" src="2.jpg">
                    <img class="welcome-img" src="1.jpg"> -->

            <h3 class="brand-name" data-text="AMORAL...">AMORAL...</h3>

            <div class="main-text">
                <div class="wellcome-text">
                    Welcome to Amoral, your ultimate destination for personalized style! Dive into a seamless design experience on our platform, where you can effortlessly create, print, and order custom t-shirts that reflect your individuality. Let your imagination run wild as you embark on a journey of self-expression with Amoral.
                </div>
                <div class="sign-up-text">
                    <a href="<?= ROOT ?>/signin">
                        Sign Up
                    </a>
                    <br>
                    <a href="<?= ROOT ?>/guest">
                        Partnership
                    </a>
                </div>
            </div>
        </div>

        <div class="slide-images">

            <div class="image-slider">
                <img class="image-slider-image" src="<?= ROOT ?>/assets/images/home/2.jpg">
            </div>

            <div class="image-slider">
                <img class="image-slider-image" src="<?= ROOT ?>/assets/images/home/2.jpg">
            </div>

            <div class="image-slider ">
                <img class="image-slider-image" src="<?= ROOT ?>/assets/images/home/3.jpg">
            </div>

            <div class="image-slider">
                <img class="image-slider-image" src="<?= ROOT ?>/assets/images/home/4.jpg">
            </div>

            <div class="slide-text">
                Welcome to Amoral, your ultimate destination for personalized style! Dive into a seamless design experience on our platform, where you can effortlessly create, print, and order custom t-shirts that reflect your individuality. Let your imagination run wild as you embark on a journey of self-expression with Amoral.
            </div>

        </div>
        <br>

        <div style="text-align:center">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>

        <!-- <div class="welcome-text">
            Welcome to Amoral, your ultimate destination for personalized style! Dive into a seamless design experience on our platform, where you can effortlessly create, print, and order custom t-shirts that reflect your individuality. Let your imagination run wild as you embark on a journey of self-expression with Amoral.
        </div> -->

        <div class="design-tool">
            <div class="tool-description">
                Revamp your T-shirt collection effortlessly now, an online tool that lets you add personalized designs to your favorite tees with a simple drag-and-drop interface.
                <button class="design-tool-button">Start Designing</button>
            </div>

            <!-- <div class="tool-button">
               
            </div> -->


            <div class="tool-images">
                <img class="design-tool-images" src="<?= ROOT ?>/assets/images/home/4.jpg">
                <img class="design-tool-images" src="<?= ROOT ?>/assets/images/home/4.jpg">
            </div>
        </div>


    </section>


    <footer>
        <div class="footer-links">
            <a href="#">Home</a>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
            <a href="#">Report</a>
        </div>
        <div class="contact-info">
            <p>AMORAL</p>
            <p>185 West 74th Street, New York, USA</p>
            <p>Contact: 000-000-0000</p>
            <p>© 2023 Amoral.com, Times Internet Limited. All rights reserved </p>
        </div>
    </footer>
    <script src="<?= ROOT ?>/assets/js/home/home.js"></script>

</body>

</html>