       <div class="sidebar">
           <div class="logo_details">
               <img src="<?= ROOT ?>/assets/images/manager/amoral80.png" class="logo_icon">
               <i class="bx bx-menu" id="btn"></i>
           </div>
           <ul class="nav-list">
               <li>

                   <a href="<?= ROOT ?>/customer/overview" class="nav-link">

                       <i class="bx bxs-grid-alt"></i>
                       <span class="link_name">Overview</span>
                   </a>
                   <span class="tooltip">Overview</span>
               </li>
               <li>
                   <a href="<?= ROOT ?>/customer/orders" class="nav-link">
                       <i class="fas fa-clipboard-list"></i>
                       <span class="link_name">Orders</span>
                   </a>
                   <span class="tooltip">Orders</span>
               </li>
               <li>
                   <a href="<?= ROOT ?>/tool" class="nav-link">
                       <i class="bx bxs-t-shirt"></i>
                       <span class="link_name">Design Tool</span>
                   </a>
                   <span class="tooltip">Design Tool</span>
               </li>
               <li>
                   <a href="<?= ROOT ?>/customer/profile" class="nav-link">
                       <i class="bx bxs-user-circle"></i>
                       <span class="link_name">Profile</span>
                   </a>
                   <span class="tooltip">Profile</span>
               </li>
               <li class="logout">
                   <a href="<?= ROOT ?>/logout" class="nav-link logout">
                       <span class="link_name">Log Out</span>
                       <i class="bx bx-log-out" id="log_out"></i>
                   </a>
                   <span class="tooltip">Logout</span>
               </li>
           </ul>
       </div>

       <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>