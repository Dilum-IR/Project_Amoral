<div class="sidebar">
    <div class="logo_details">
        <img src="<?= ROOT ?>/assets/images/manager/amoral80.png" class="logo_icon">
        <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
        <li>
            <a href="<?= ROOT ?>/manager/overview">
                <i class="bx bxs-grid-alt"></i>
                <span class="link_name">Overview</span>
            </a>
            <span class="tooltip">Overview</span>
        </li>
        <li>
            <a href="<?= ROOT ?>/manager/customerorders">
                <i class="bx bxs-cart-alt"></i>
                <span class="link_name">Customer Orders</span>
            </a>
            <span class="tooltip">Customer Orders</span>
        </li>
        <li>
            <a href="<?= ROOT ?>/manager/garmentorders">
                <i class="bx bxs-t-shirt"></i>
                <span class="link_name">Garment Orders</span>
            </a>
            <span class="tooltip">Garment Orders</span>
        </li>
        <li>
            <a href="<?= ROOT ?>/manager/printingprocess">
                <i class="bx bxs-printer"></i>
                <span class="link_name">Printing Process</span>
            </a>
            <span class="tooltip">Printing Process</span>
        </li>
        <li>
            <a href="<?= ROOT ?>/manager/assigndelivery">
                <i class="bx bxs-package"></i>
                <span class="link_name">Deliver Packages</span>
            </a>
            <span class="tooltip">Deliver Packages</span>
        </li>
        <li>
            <a href="<?= ROOT ?>/manager/employeedetails">
                <i class="bx bxs-user-detail"></i>
                <span class="link_name">Employee Details</span>
            </a>
            <span class="tooltip">Employee Details</span>
        </li>
        <li>
            <a href="<?= ROOT ?>/manager/customerdetails">
                <i class="bx bxs-user-account"></i>
                <span class="link_name">Customer Details</span>
            </a>
            <span class="tooltip">Customer Details</span>
        </li>
        <li>
            <a href="<?= ROOT ?>/manager/garmentdetails">
                <i class="bx bxs-factory"></i>
                <span class="link_name">Garment Details</span>
            </a>
            <span class="tooltip">Garment Details </span>
        </li>
        <li>
            <a href="<?= ROOT ?>/manager/reports">
                <i class="bx bxs-message-alt-error"></i>
                <span class="link_name">Complaints</span>
            </a>
            <span class="tooltip">Complaints</span>
        </li>
        <li>
            <a href="<?= ROOT ?>/manager/profile">
                <i class="bx bxs-user-circle"></i>
                <span class="link_name">Profile</span>
            </a>
            <span class="tooltip">Profile</span>
        </li>
        <li class="logout">
            <a href="#" class="nav-link logout" id="logout-btn">
                <span class="link_name">Log Out</span>
                <i class="bx bx-log-out" id="log_out"></i>
            </a>
            <span class="tooltip">Logout</span>
        </li>
    </ul>
</div>

<?php
include __DIR__ . '/../utils/logoutPopup.php';

?>