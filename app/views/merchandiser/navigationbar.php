<section class="home-section" id="navbar">
    <nav>
        <div class="nav-icons">
            <div>
                <a href="<?= ROOT ?>/customer/profile" class="nav-link" id="user_image">
                    <img src="<?= ROOT ?>/uploads/profile_img/<?= $_SESSION['USER']->user_image?>" alt="user">
                </a>

            </div>

        </div>

    </nav>

    <style>
        nav .nav-icons {
            padding-top: 12px !important;
        }
    </style>
</section>

    

