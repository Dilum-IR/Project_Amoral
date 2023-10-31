<!-- <img src="<?= ROOT ?>/assets/images/logo.JPG"> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amoral</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home/nav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home/home.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home/slider.css">
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
                <div class="welcome-text">
                    <h2>
                        Welcome to AMORAL
                    </h2>
                    <h3>
                        Welcome to Amoral, your one-stop destination for custom-designed T-shirts that perfectly reflect your unique style and preferences. <a href="<?= ROOT ?>/signin" class="text-nav-link">Register</a> now to place your order. (If you have a garment factory you can <a href="#" class="text-nav-link">join with us</a>. Let's work together. Join us now.)
                    </h3>

                    <br>
                    <a href="<?= ROOT ?>/signin" class="home-nav-link">
                        <i class='bx bxs-user icon'></i>
                        Sign Up
                        <!-- <span class="chat-notification">8</span> -->
                    </a>
                    <br>
                    <a href="#" class="home-partnership-link">
                        <i class='bx bxs-file icon'></i>
                        Partnership with AMORAL
                        <!-- <span class="chat-notification">8</span> -->
                    </a>



                </div>
                <div class="main-img">
                    <img class="welcome-img" src="<?= ROOT ?>/assets/images/signin-up/4.jpg">
                    <!-- <img class="welcome-img" src="3.jpg">
                    <img class="welcome-img" src="2.jpg">
                    <img class="welcome-img" src="1.jpg"> -->
                </div>
            </section>


        <script src="<?= ROOT ?>/assets/js/home.js"></script>

</body>

</html>