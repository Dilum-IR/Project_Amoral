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


    <?php include 'navigationbar.php' ?>
    <div class="loader">
        <div class="loading-logo">
            <img src="<?= ROOT ?>/assets/images/home/amorallogo.png" alt="">
        </div>
    </div>
    <a href="<?= ROOT ?>/signin">Sign</a>
    <h1> Home file view</h1>

    <section id="welcome-section" class="welcome-section">
        <div class="main-slider-container">
            <h3 class="brand-name" data-text="AMORAL">AMORAL</h3>
            <!--image slider start-->
            <div class="main-slider">
                <div class="main-slides">
                    <!--radio buttons start-->
                    <input type="radio" name="radio-btn" id="radio1">
                    <input type="radio" name="radio-btn" id="radio2">
                    <input type="radio" name="radio-btn" id="radio3">
                    <input type="radio" name="radio-btn" id="radio4">
                    <!--radio buttons end-->

                    <!--slide images start-->
                    <div class="main-slide first">
                        <img src="<?= ROOT ?>/assets/images/home/home_cover_1.jpg" alt="">
                    </div>
                    <div class="main-slide">
                        <img src="<?= ROOT ?>/assets/images/home/home_cover_2.jpg" alt="">
                    </div>
                    <div class="main-slide">
                        <img src="<?= ROOT ?>/assets/images/home/home_cover_3.jpg" alt="">
                    </div>
                    <div class="main-slide">
                        <img src="<?= ROOT ?>/assets/images/home/home_cover_4.jpg" alt="">
                    </div>
                    <!--slide images end-->

                    <!--automatic navigation start-->
                    <div class="main-navigation-auto">
                        <div class="auto-btn1"></div>
                        <div class="auto-btn2"></div>
                        <div class="auto-btn3"></div>
                        <div class="auto-btn4"></div>
                    </div>
                    <!--automatic navigation end-->
                </div>
                <!--manual navigation start-->
                <div class="main-navigation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                    <label for="radio3" class="manual-btn"></label>
                    <label for="radio4" class="manual-btn"></label>
                </div>
                <!--manual navigation end-->

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
                <div class="sign-up-text">
                    <!-- <a class="sign-up-box" href="<?= ROOT ?>/signin">
                        <i class='bx bxs-user icon'></i>
                        Sign In
                    </a> -->
                    <button id="home-sign-up-box-1" class="home-sign-up-box-1" href="<?= ROOT ?>/signup">
                        <i class='bx bxs-user icon'></i>
                        Sign Up
                    </button>
                    <br>
                    <button id="home-sign-up-box-2" class="home-sign-up-box-2" href="<?= ROOT ?>/guest">
                        <i class='bx bxs-user icon'></i>
                        Sign Up for a Partnership
                    </button>
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
                <button class="design-tool-button">Start Designing</button>
            </div>

            <!-- <div class="tool-button">
               
            </div> -->

            <div class="tool-images">
                <img class="design-tool-images" src="<?= ROOT ?>/assets/images/home/4.jpg">
                <img class="design-tool-images" src="<?= ROOT ?>/assets/images/home/4.jpg">
            </div>
        </div>

        <div class="partnership-deal">
            <div class="partnership-deal-images">
                <img class="partnership-images" src="<?= ROOT ?>/assets/images/home/4.jpg" alt="">
            </div>

            <div class="deal-description">
                A strategic partnership deal has been forged between two industry leaders, promising to leverage their respective strengths to drive innovation, expand market reach, and create a synergistic impact on the ever-evolving business landscape.
                <br>
                <br>
                <button class="partnership-deal-button">Partnership Deal</button>
            </div>
        </div>

        <div class="shopping-deals">
            <div class="deal-section shop-now">
                <img class="deal-images" src="<?= ROOT ?>/assets/images/home/4.jpg" alt="">
                <div class="deal-text">
                    <p class="deal-p">See the Collection</p>
                    <button class="deal-button"> <span>Shop Now</span> </button>
                </div>
            </div>
            <div class="deal-section place-now">
                <img class="deal-images" src="<?= ROOT ?>/assets/images/home/4.jpg" alt="">
                <div class="deal-text">
                    <p class="deal-p">Place your order now</p>
                    <button class="deal-button"><span>Place Order</span></button>
                </div>
            </div>
        </div>

        <div class="our-services">
            <div class="services-text">Our services</div>
            <div class="services">
                <div class="services-tab">
                    Custom T-Shirt Printing
                    <div class="service-description">Choose from a variety of t-shirt styles, colors, and sizes, and let your creativity run wild. Whether it's a single personalized t-shirt or a bulk order for an event, we ensure vibrant prints that stand out.
                    </div>
                </div>
                <div class="services-tab">
                    Design Your Own T-Shirt
                    <div class="service-description">Unleash your creativity with our user-friendly design tool. Create your own unique t-shirt designs with ease. Experiment with colors, fonts, and graphics to craft a personalized masterpiece.</div>
                </div>
                <div class="services-tab">
                    Bulk Orders for Events and Businesses
                    <div class="service-description">Planning an event or looking for branded merchandise for your business? Our bulk ordering option is tailored to meet your needs. Get high-quality, consistent prints for team-building events, promotional giveaways, or corporate branding. Elevate your brand with customized apparel that leaves a lasting impression.</div>
                </div>
                <div class="services-tab">
                    Quality Materials and Printing Techniques
                    <div class="service-description">We take pride in using only the finest materials and cutting-edge printing techniques. Our commitment to quality ensures that your t-shirts not only look great but also stand the test of time. </div>
                </div>
                <div class="services-tab">
                    Doorstep Delivery
                    <div class="service-description">Sit back and relax while we bring your custom t-shirts directly to your doorstep. Our reliable and secure delivery service ensures that your orders reach you on time and in pristine condition. Enjoy the convenience of having your personalized apparel delivered hassle-free.</div>
                </div>
                <div class="services-tab">
                    Fast Turnaround Time
                    <div class="service-description">We understand the importance of deadlines. Our streamlined processes and efficient team enable us to offer fast turnaround times without compromising on quality. Get your custom t-shirts when you need them, without the wait.</div>
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

    <footer>
        <div class="main-content">
            <div class="left box">
                <h2>About Us</h2>
                <div class="content">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet iste facilis harum eos vel incidunt distinctio corrupti iure? Rem</p>

                    <div class="social">
                        <a href="#" class="social-icons" id="facebook"><i class='bx bxl-facebook'></i></a>
                        <a href="#" class="social-icons" id="instagram"><i class='bx bxl-instagram-alt'></i></a>
                        <a href="#" class="social-icons" id="twitter"><i class='bx bxl-twitter'></i></a>
                        <a href="#" class="social-icons" id="youtube"><i class='bx bxl-youtube'></i></a>
                    </div>
                </div>
            </div><!--left box-->
            <div class="center box">
                <h2>Address</h2>
                <div class="content">
                    <div class="place">
                        <a href="" class="address-icons"><i class='bx bxs-map icon'></i></a>
                        <span class="text">Av.Brasil, New Capital</span>
                    </div>

                    <div class="phone">
                        <a href="" class="address-icons"><i class='bx bxs-phone icon'></i></a>
                        <span class="text">+55 61 9999-9999</span>
                    </div>

                    <div class="e-mail">
                        <a href="" class="address-icons"><i class='bx bxs-message icon'></i></a>
                        <span class="text">example@example.com</span>
                    </div>
                </div>
            </div>
            <div class="right box">
                <h2>Contact</h2>
                <div class="content">
                    <form action="#">
                        <div class="email">
                            <div class="text">Email *</div>
                            <input type="email" required>
                        </div>
                        <div class="msg">
                            <div class="text">Message *</div>
                            <textarea rows="2" cols="25" required></textarea>
                        </div>
                        <div class="btn">
                            <button type="submit">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--main-content-->
    </footer>
    <script src="<?= ROOT ?>/assets/js/home/home.js"></script>
</body>

</html>