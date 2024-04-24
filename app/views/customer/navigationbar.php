<section class="home-section" id="navbar">
    <nav>
        <div class="nav-icons">
            <div class="nav-link notifi">
                <i class='bx bxs-bell-ring icon'></i>
                <span class="bell-notification">5</span>
            </div>
            <div>
                <a href="<?= ROOT ?>/customer/profile" class="nav-link" id="user_image">
                    <img src="<?= ROOT ?>/uploads/profile_img/<?= $_SESSION['USER']->user_image?>" alt="user">
                </a>

            </div>

        </div>

        <div class="notifi-box">
            <h2>Notifications <span>5</span></h2>
            <div class="notifi-item">
                <i class='bx bx-right-arrow-alt'></i>
                <h4>This is a notification</h4>
            </div>
        </div>
    </nav>

    <style>
        nav .nav-icons {

            padding-top: 12px !important;
        }
    </style>
</section>