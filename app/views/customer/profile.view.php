<!DOCTYPE html>
<html lang="en">

<head>
  <title>Amoral</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/style-bar.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customer/profile.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/customer/boxicons.min.css">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  
  <!-- Sidebar -->
   <!-- Sidebar -->
   <?php include 'sidebar.php'?>
    <!-- Sidebar -->
  <!-- <div class="sidebar">
    <div class="logo_details">
      <img src="<?=ROOT?>/assets/images/manager/amoral80.png" class="logo_icon">
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="#">
          <i class="bx bxs-grid-alt"></i>
          <span class="link_name">Overview</span>
        </a>
        <span class="tooltip">Overview</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bxs-cart-alt"></i>
          <span class="link_name">Customer Orders</span>
        </a>
        <span class="tooltip">Customer Orders</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bxs-t-shirt"></i>
          <span class="link_name">Garment Orders</span>
        </a>
        <span class="tooltip">Garment Orders</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bxs-package"></i>
          <span class="link_name">Deliver Packages</span>
        </a>
        <span class="tooltip">Deliver Packages</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bxs-user-detail"></i>
          <span class="link_name">Employee Details</span>
        </a>
        <span class="tooltip">Employee Details</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bxs-building-house"></i>
          <span class="link_name">Garments</span>
        </a>
        <span class="tooltip">Garments</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bxs-user-circle"></i>
          <span class="link_name">Profile</span>
        </a>
        <span class="tooltip">Profile</span>
      </li>
      <li class="profile">
        <div class="profile_details">
          <img src="elon_musk.jpg" alt="profile image">
          <div class="profile_content">
            <div class="name">Elon Musk</div>
            <div class="designation">Manager</div>
          </div>
        </div>
        <i class="bx bx-log-out" id="log_out"></i>
      </li>
    </ul>
  </div> -->
  <!-- Sidebar -->

  <!-- Navigation Bar -->
  <!-- <section class="home-section" id="navbar">
    <nav>
      <div class="nav-icons">
        <a href="#" class="nav-link">
          <i class='bx bxs-bell-ring icon'></i>
          <span class="bell-notification">5</span>
        </a>
        <a href="#" class="nav-link">
          <i class='bx bxs-chat icon'></i>
          <span class="chat-notification">8</span>
        </a>
      </div>
    </nav>
 </div>

  </section> -->
  <?php include 'navigationbar.php'?>
  
  <section class="main-section" id="main-section">
    <main id="middle">
      <div class="profile-picture">
        <img src="<?= ROOT ?>/assets/images/customer/elon_musk.jpg" class="profile-image" alt="">
      </div>
      <div class="edit-pic">
        <div class="edit-icon">
          <a href="#">
            <i class="bx bxs-edit"></i>
            <span class="link_name">Edit Picture</span>
          </a>
        </div>
      </div>
      <h1>General Information</h1>
      <div class="info-gen">
        <div class="info-type">
          <div class="profile-info">
            <div class="info-box">
              <div class="info-inside">
                <div class="user-info">
                  <h1>
                    Full Name
                  </h1>
                </div>
                <div class="text-info">
                  <input type="name" name="fullname" value="Elon Reeve Musk" class="edit-gen" readonly>
                </div>
                <div class="user-info">
                  <h1>
                    City
                  </h1>
                </div>
                <div class="text-info">
                  <input type="text" name="city" value="Hambanthota" class="edit-gen" readonly>
                </div>
                <div class="user-info">
                  <h1>
                    Address
                  </h1>
                </div>
                <div class="text-info">
                  <input type="text" name="address" value="27/A, School Road, Sooriyawewa, Hambanthota" class="edit-gen"
                    readonly>
                </div>
                <div class="user-info">
                  <h1>
                    Contact Number
                  </h1>
                </div>
                <div class="text-info">
                  <input type="text" name="contactno" value="0766464639" class="edit-gen" readonly>
                </div>
                <div class="user-info">
                  <h1>
                    Date of Birth
                  </h1>
                </div>
                <div class="text-info">
                  <input type="date" name="birthday" value='2012-12-12' class="edit-gen" readonly>
                </div>

                <div class="edit-info-icon">
                  <a href="#">
                    <i class="bx bxs-edit"></i>
                    <span class="link_name" id="gen-info-edit">Edit Info.</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <h1>Security Information</h1>
      <div class="info-sec">
        <div class="info-type">
          <div class="profile-info">
            <div class="info-box">
              <div class="info-inside">
                <div class="user-info">
                  <h1>
                    E-mail
                  </h1>
                </div>
                <div class="text-info">
                  <input type="email" name="emailaddress" value="elonmusk@spacex.com" class="edit-gen" readonly>
                </div>
                <div class="user-info">
                  <h1>
                    Password
                  </h1>
                </div>
                <div class="text-info">
                  <input type="password" name="password" value="elon123" class="edit-gen" readonly>
                </div>
                <div class="change-pw-icon">
                  <a href="#">
                    <i class="bx bxs-edit"></i>
                    <span class="link_name" id="sec-info-edit">Change Password</span>
                  </a>
                </div>
              </div>
            </div>
          </div>

    </main>
  </section>

    <!-- Popup -->
    <section class="popup-section-gen" id="popup-section-gen">
      <div class="info-pop" id="gen-info-pop">
        <div class="close-icon">
          <a href="#">
            <i class="bx bx-x" id="gen-pop-close"></i>
            <!-- <span class="link_name">Close</span> -->
          </a>
        </div>
        <div class="info-type">
          <div class="profile-info">
            <div class="info-box">
              <div class="info-inside">
                <div class="user-info">
                  <h1>
                    Full Name
                  </h1>
                </div>
                <div class="text-info">
                  <input type="text" name="city" required class="edit-popup-gen">
                </div>
                <div class="user-info">
                  <h1>
                    City
                  </h1>
                </div>
                <div class="text-info">
                  <input type="text" name="city" required class="edit-popup-gen">
                </div>
                <div class="user-info">
                  <h1>
                    Address
                  </h1>
                </div>
                <div class="text-info">
                  <input type="text" name="address" required class="edit-popup-gen">
                </div>
                <div class="user-info">
                  <h1>
                    Contact Number
                  </h1>
                </div>
                <div class="text-info">
                  <input type="tel" name="contactno" required class="edit-popup-gen">
                </div>
                <div class="user-info">
                  <h1>
                    Date of Birth
                  </h1>
                </div>
                <div class="text-info">
                  <input type="date" name="birthday" required class="edit-popup-gen">
                </div>
              
  
              </div>
              <div class="save-cancel-buttons">
                <button class="save">Save Changes</button>
                <button class="cancel" id="gen-edit-cancel">Cancel</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="sec-pop" id="sec-info-pop">
        <div class="close-icon">
          <a href="#">
            <i class="bx bx-x" id="sec-pop-close"></i>
            <!-- <span class="link_name">Close</span> -->
          </a>
        </div>
        <div class="info-type">
          <div class="profile-info">
            <div class="info-box">
              <div class="info-inside">
                <div class="user-info">
                  <h1>
                    E-mail
                  </h1>
                </div>
                <div class="text-info">
                  <input type="email" name="emailaddress" value="elonmusk@spacex.com" class="edit-gen">
                </div>
                <div class="user-info">
                  <h1>
                    Current Password
                  </h1>
                </div>
                <div class="text-info">
                  <input type="password" name="password" value="elon123" class="edit-gen">
                </div>
                <div class="user-info">
                  <h1>
                    New Password
                  </h1>
                </div>
                <div class="text-info">
                  <input type="password" name="newpassword" class="edit-gen" >
                </div>
                <div class="user-info">
                  <h1>
                    Confirm New Password
                  </h1>
                </div>
                <div class="text-info">
                  <input type="password" name="confirmnewpassword"  class="edit-gen">
                </div>
              </div>
              <div class="change-pw-icon">
                <a href="#">
                  <i class="bx bxs-edit"></i>
                  <span class="link_name" id="forgot-password">Forgot Password?</span>
                </a>
                <div class="pw-save-cancel-buttons">
                  <button class="save">Save Changes</button>
                  <button class="cancel" id="sec-edit-cancel">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Scripts -->
    <script src="<?=ROOT?>/assets/js/customer/profile.js"></script>
    <script src="<?=ROOT?>/assets/js/script-bar.js"></script>
    <script src="<?=ROOT?>/assets/js/nav-bar.js"></script>

</body>

</html>