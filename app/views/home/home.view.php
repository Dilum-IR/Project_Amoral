<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amoral</title>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home/nav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home/home.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/button.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home/footer.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>


    <?php include 'navigationbar.php' ?>
    <?php include 'chooseSignup.php' ?>

    <!-- <div class="loader">
        <div class="loading-logo">
            <img src="<?= ROOT ?>/assets/images/home/amorallogo.png" alt="">
        </div>
    </div> -->
    <a href="<?= ROOT ?>/signin">Sign</a>
    <h1> Home file view</h1>

    <section id="welcome-section" class="welcome-section">

        <div class="container">
            <div class="slider-wrapper">
            <div class="text-animation">AMORAL</div>
                <ul class="image-list">
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-1.jpg" alt="img-1" />
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-2.jpg" alt="img-2" />
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-3.jpg" alt="img-3" />
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-4.jpg" alt="img-4" />
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-5.jpg" alt="img-5" />
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-6.jpg" alt="img-6" />
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-7.jpg" alt="img-7" />
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-8.jpg" alt="img-8" />
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-9.jpg" alt="img-9" />
                    <img class="image-item" src="<?= ROOT ?>/assets/images/home/img-10.jpg" alt="img-10" />
                  
                </ul>
            </div>
        </div>

        <!-- <div class="text-animation">
            <div class="animated-text">
                AMORAL
            </div>
        </div> -->


        <div class="slide-images">

            <div class="image-slider">
                <img class="image-slider-image" src="<?= ROOT ?>/assets/images/home/home_cover_5.jpg">
            </div>

            <div class="image-slider">
                <img class="image-slider-image" src="<?= ROOT ?>/assets/images/home/home_cover_6.jpg">
            </div>

            <div class="image-slider ">
                <img class="image-slider-image" src="<?= ROOT ?>/assets/images/home/home_cover_7.jpg">
            </div>

            <div class="image-slider">
                <img class="image-slider-image" src="<?= ROOT ?>/assets/images/home/home_cover_8.jpg">
            </div>

            <div class="slide-text">
                Welcome to Amoral, your ultimate destination for personalized style! Dive into a seamless design experience on our platform, where you can effortlessly create, print, and order custom t-shirts that reflect your individuality. Let your imagination run wild as you embark on a journey of self-expression with Amoral.
                <div class="sign-up-text">
                    <!-- <a class="sign-up-box" href="<?= ROOT ?>/signin">
                        <i class='bx bxs-user icon'></i>
                        Sign In
                    </a> -->

                    <div id="home-sign-up-box-1" class="home-sign-up-box-1">
                        <i class='bx bxs-user icon'></i>
                        <a href="<?= ROOT ?>/signin">Sign In</a>
                    </div>

                    <br>

                    <div id="home-sign-up-box-2" class="home-sign-up-box-2" onclick="hidePopup('popup1')">
                        <i class='bx bxs-user icon'></i>
                        <a href="<?= ROOT ?>/signup">Sign Up</a>
                    </div>

                </div>
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
                Revamp your T-shirt collection effortlessly on your own, an online tool that lets you add personalized designs to your favorite tees with a simple drag-and-drop interface.
                <br>
                <br>
                <a href="<?= ROOT ?>/tool" class="design-tool-button">Start Designing</a>
            </div>

            <!-- <div class="tool-button">
               
            </div> -->

            <div class="tool-images">
                <img class="design-tool-images" src="<?= ROOT ?>/assets/images/home/tool-left.jpg">
                <img class="design-tool-images" src="<?= ROOT ?>/assets/images/home/tool-right.jpg">
            </div>
        </div>

        <div class="partnership-deal">
            <div class="partnership-deal-images">
                <img class="partnership-images" src="<?= ROOT ?>/assets/images/home/partnership-deal.jpg" alt="">
            </div>

            <div class="deal-description">
                A strategic partnership deal has been forged between two industry leaders, promising to leverage their respective strengths to drive innovation, expand market reach, and create a synergistic impact on the ever-evolving business landscape.
                <br>
                <br>
                <div class="partnership-deal-button">
                    <a href="<?= ROOT ?>/guest/new">Partnership Deal</a>
                </div>
                <!-- <button class="partnership-deal-button">Partnership Deal </button> -->
            </div>
        </div>

        <div class="shopping-deals">
            <div class="deal-section shop-now">
                <img class="deal-images" src="<?= ROOT ?>/assets/images/home/home-collection.jpg" alt="">
                <div class="deal-text">
                    <p class="deal-p">See the Collection</p>
                    <button class="deal-button" id="see-collection"> <span>Shop Now</span> </button>
                </div>
            </div>
            <div class="deal-section place-now">
                <img class="deal-images" src="<?= ROOT ?>/assets/images/home/4 copy.jpg" alt="">
                <div class="deal-text">
                    <p class="deal-p">Place your order now</p>
                    <button class="deal-button" id="place-order"><span>Place Order</span></button>
                </div>
            </div>
        </div>



        <div class="our-services">
            <div class="services-text">Our Services</div>
            <div class="services-container">
                <div class="services-row">
                    <div class="services-tab">
                        Custom T-Shirt Printing
                    </div>
                    <div class="services-tab">
                        Design Your Own T-Shirt
                    </div>
                    <div class="services-tab">
                        Bulk Orders for Events and Businesses
                    </div>
                </div>
                <div class="services-row">
                    <div class="services-tab">
                        Quality Materials and Printing Techniques
                    </div>
                    <div class="services-tab">
                        Doorstep Delivery
                    </div>
                    <div class="services-tab">
                        Fast Turnaround Time
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="line line-1">
            <div class="wave wave1"></div>
        </div>

        <div class="line line-2">
            <div class="wave wave2"></div>
        </div>

        <div class="line line-3">
            <div class="wave wave3"></div>
        </div> -->


    </section>

    <?php include 'footer.php' ?>
    <script src="<?= ROOT ?>/assets/js/home/home.js"></script>
</body>

</html>