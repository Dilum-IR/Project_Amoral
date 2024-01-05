<!DOCTYPE html>
<html lang="en">

<head>
  <title>Amoral</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/manager/profile.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/manager/managersidenav.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/manager/style-bar.css">

  <link rel="stylesheet" href="boxicons.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">
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
  

  
  <section class="main" id="main">
    <div class="wrapper">

      <!-- Left Section -->
      <div class="left">
        <div class="left-part">
          <img src="https://i.imgur.com/cMy8V5j.png" alt="user">
          <h2 class="profile-name">Alex William</h2>
          <h4 class="profession">Manager</h4>
          <div class="edit-pic">
            <div class="edit-icon">
              <a href="#">
                <i class="bx bxs-edit"></i>
                <span class="link_name">Change Image</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Section -->
      <div class="right">
        <!-- Information Section -->
        <div class="info">
          <h3 class="h3">Personal Information
            <hr>
          </h3>
          <form method="POST">

            <?php if (isset($data)) {
              ?>
              <div class="info_data">
                <div class="data">
                  <label class="pro_label" for="pro_username"><i class='bx bx-user'></i> Full Name </label>
                  <input class="pro_input" type="text" id="pro_username" name="emp_name" value=<?= $data->emp_name ?>>
                </div>
                <div class="data">
                  <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> City</label>
                  <input class="pro_input" type="text" id="pro_city" name="city" value="<?= $data->city ?>">
                </div>
              </div>

              <div class="info_data">
                <div class="data">
                  <label class="pro_label" for="pro_address">Address</label>
                  <input class="pro_input" type="text" id="pro_address" name="address"
                    value="<?= $data->address ?>">
                </div>

                <div class="data">
                  <label class="pro_label" for="pro_date">Date of Birth</label>
                  <input class="pro_input" type="date" id="pro_date" name="DOB" value="<?= $data->DOB ?>">
                </div>
              </div>

              <div class="info_data">
                <div class="data">

                  <label class="pro_label" for="pro_email">Email</label>
                  <input class="pro_input" type="email" id="pro_email" name="email" value="<?= $data->email ?>">
                </div>
                <div class="data">
                  <label class="pro_label" for="pro_number">Contact Number</label>
                  <input class="pro_input" type="text" id="pro_number" name="contact_number" value="<?= $data->contact_number ?>">
                </div>


              </div>

              <div class="info_data" id="last-element">
                <div class="data">
                  <label class="pro_label" for="pro_profession">Profession</label>
                  <input class="pro_input" type="text" id="pro_profession" name="emp_status" value="<?= $data->emp_status ?>" disabled>
                </div>
                <div class="pro_button">
                  <button type="button" class="small_btn discard_btn" name="discard" value="discard">Discard</button>
                  <button type="submit" class="small_btn save_btn" name="save" value="save">Save Changes</button>
                </div>
              </div>


              <?php
            }else{
              redirect("signin");
            }
             ?>

          </form>

        </div>

        <!-- Change Password Section -->
        <div class="info">
          <h3 class="h3">Security Update
            <hr>
          </h3>
          <form method="POST">
            <div class="info_data">
              <div class="data">
                <label class="pro_label" for="pro_email">Current Password</label>
                <span class="hide-icon">
                  <input class="pro_input" type="password" id="c-password" name="password"
                    placeholder="Enter current password">

                  <a href="#" class="hide active" onclick="togglePasswordVisibility('c-password','s-toggleIcon')">
                    <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                  </a>
                </span>
              </div>
              <div class="data">
                <label class="pro_label" for="pro_date">New Password</label>
                <span class="hide-icon">

                  <input class="pro_input" type="password" id="n-password" name="new_password"
                    placeholder="Enter New password">
                  <a href="#" class="hide active" onclick="togglePasswordVisibility('n-password','s-toggleIcon')">
                    <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                  </a>
                </span>
              </div>
            </div>

            <div class="info_data" id="last-element">
              <div class="data">
                <label class="pro_label" for="pro_profession">Confirm Password</label>
                <span class="hide-icon">

                  <input class="pro_input" type="text" id="re-password" name="confirm_password"
                    placeholder="Enter Confirm password">
                  <a href="#" class="hide active" onclick="togglePasswordVisibility('re-password','s-toggleIcon')">
                    <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                  </a>
                </span>
              </div>
              <div class="pro_button">
                <button type="button" class="small_btn discard_btn" name="discardP" value="discardP">Discard</button>
                <button type="submit" class="small_btn save_btn" name="saveP" value="saveP">Save Changes</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
    <!-- Scripts -->
    <!-- <script src="<?=ROOT?>/assets/js/manager/profile.js"></script> -->
    <script src="<?=ROOT?>/assets/js/script-bar.js"></script>

</body>
</html>