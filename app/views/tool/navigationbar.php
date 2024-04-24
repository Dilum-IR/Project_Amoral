<!-- Navigation Bar -->

<style>
    .company-logo {
        display: flex;
        align-items: center;
    }

    .nav-sign-btn {
        position: relative;
        font-size: 14px;
        width: max-content !important;
        /* height: 40px; */
        border-radius: 30px;
        border-style: none;
        transition: 0.3s ease;

        cursor: pointer;
        align-items: flex-end;
        justify-content: center;
        align-self: center;
        padding: 8px 20px;
        text-decoration: none;
    }

    .white-btn {
        background-color: white;
        color: #191919 !important;
        border-style: solid;
        border-color: white;
        border-width: 1px;
        transition: 0.5s ease-in-out;
        /* margin-right: 20px; */
    }

    .white-btn:hover {
        color: white !important;
        background-color: black;
        margin-left: 10px;

    }
</style>

<section class="home-section" id="navbar">

    <nav>
        <div class="company-logo">

            <a href="<?= ROOT ?>/home">
                <img src="<?= ROOT ?>/assets/images/amorallogo.png" alt="logo" class="logo">
            </a>
        </div>
        <div class="nav-icons">
            <?php

            if (!empty($_SESSION['USER']) && $_SESSION['USER'] != "User" && $_SESSION['USER']->user_status === 'customer') {
            ?>
                <a href="<?= ROOT ?>/customer/overview" class="nav-sign-btn white-btn"> Home </a>
            <?php
            } else {
            ?>
                <a href="#" class="nav-link">
                    <i class='bx bxs-t-shirt icon'> </i>
                    <!-- <span class="bell-notification">Design</span> -->
                </a>
                <a href="<?= ROOT ?>/signin" class="nav-link">
                    <i class='bx bxs-user icon'></i>
                    <!-- <span class="chat-notification">Sign Up</span> -->
                </a>
            <?php
            }
            ?>
            <!-- <a href="#" class="nav-link-profile">
              <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
            </a> -->
        </div>
    </nav>
</section>