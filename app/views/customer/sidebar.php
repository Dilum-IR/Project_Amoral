    <?php 
        $username = empty($_SESSION['USER']) ? 'User' : $_SESSION['USER']->email;
    
    ?>
    
    <div class="sidebar">
        <div class="logo_details">
            <img src="<?= ROOT ?>/assets/images/manager/amoral80.png" class="logo_icon">
            <i class="bx bx-menu" id="btn"></i>
        </div>
        <ul class="nav-list">
            <li>

                <a href="<?=ROOT?>/customer/overview">

                    <i class="bx bxs-grid-alt"></i>
                    <span class="link_name">Overview</span>
                </a>
                <span class="tooltip">Overview</span>
            </li>
            <li>
                <a href="<?= ROOT ?>/customer/orders">
                    <i class="bx bxs-cart-alt"></i>
                    <span class="link_name">Orders</span>
                </a>
                <span class="tooltip">Orders</span>
            </li>
            <li>
                <a href="<?=ROOT ?>/customer/quotation">
                    <i class="bx bxs-cart-alt"></i>
                    <span class="link_name">Quotation Requests</span>
                </a>
                <span class="tooltip">Quotation Requests</span>
            </li>
            <li>
                <a href="#">
                    <i class="bx bxs-t-shirt"></i>
                    <span class="link_name">Design Tool</span>
                </a>
                <span class="tooltip">Design Tool</span>
            </li>
            <li>
                <a href="<?=ROOT?>/customer/profile">
                    <i class="bx bxs-user-circle"></i>
                    <span class="link_name">Profile</span>
                </a>
                <span class="tooltip">Profile</span>
            </li>
            <li class="profile">

                <div class="profile_details">
                    <img src="<?= ROOT ?>/assets/images/manager/elon_musk.jpg" alt="profile image">
                   
                    <div class="profile_content">
                        <div class="name">Elon Musk</div>
                    </div>
                    <a href="<?= ROOT ?>/logout">
                    <i class="bx bx-log-out" id="log_out"></i>
                </a>
                </div>
            </li>
        </ul>
    </div>