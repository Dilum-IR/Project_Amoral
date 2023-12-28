<!DOCTYPE html>
<html lang="en">

<head>
  <title>Amoral Distributor Profile</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/delivery/profile.css">

  <link rel="stylesheet" href="boxicons.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

  <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>


  <!-- Sidebar -->
  <?php include 'sidebar.php' ?>
  <!-- Sidebar -->

  <!-- Navigation bar -->
  <?php include 'navigationbar.php' ?>
  <!-- Navigation Bar -->

  <section class="main" id="main">
    <div class="wrapper">

      <!-- Left Section -->
      <div class="left">
        <div class="left-part">
          <img src="https://i.imgur.com/cMy8V5j.png" alt="user">
          <h2 class="profile-name">Alex William</h2>
          <h4 class="profession">Distributor</h4>
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
          <h3 class="h3" >Personal Information
            <hr>
          </h3>
          <form action="">

            <div class="info_data">
              <div class="data">
                <label class="pro_label" for="pro_username"><i class='bx bx-user'></i> Full Name </label>
                <input class="pro_input" type="text" id="pro_username" name="pro_username" value="Sadeep">
              </div>
              <div class="data">
                <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> City</label>
                <input class="pro_input" type="text" id="pro_city" name="pro_city" value="Matara">
              </div>
            </div>

            <div class="info_data">
              <div class="data">
                <label class="pro_label" for="pro_address">Address</label>
                <input class="pro_input" type="text" id="pro_address" name="pro_address" value="No:614/2,Matarahena, Beragama,Makandura">
              </div>

              <div class="data">
                <label class="pro_label" for="pro_date">Date of Birth</label>
                <input class="pro_input" type="date" id="pro_date" name="pro_date" value="">
              </div>
            </div>

            <div class="info_data">
              <div class="data">

                <label class="pro_label" for="pro_email">Email</label>
                <input class="pro_input" type="email" id="pro_email" name="pro_email" value="chathu43sadeep@gmail.com">
              </div>
              <div class="data">
                <label class="pro_label" for="pro_number">Contact Number</label>
                <input class="pro_input" type="text" id="pro_number" name="pro_number" value="077-8827260">
              </div>


            </div>

            <div class="info_data" id="last-element">
              <div class="data">
                <label class="pro_label" for="pro_profession">Profession</label>
                <input class="pro_input" type="text" id="pro_profession" name="pro_profession" value="Distributor" disabled>
              </div>
              <div class="pro_button">
                <button type="button" class="small_btn discard_btn">Discard</button>
                <button type="submit" class="small_btn save_btn">Save Changes</button>
              </div>
            </div>
          </form>

        </div>

        <!-- Change Password Section -->
        <div class="info">
          <h3 class="h3">Security Update
            <hr>
          </h3>
          <form action="">
            <div class="info_data">
              <div class="data">
                <label class="pro_label" for="pro_email">Current Password</label>
                <span class="hide-icon">
                  <input class="pro_input" type="password" id="c-password" name="pro_email" placeholder="Enter current password">

                  <a href="#" class="hide active" onclick="togglePasswordVisibility('c-password','s-toggleIcon')">
                    <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                  </a>
                </span>
              </div>
              <div class="data">
                <label class="pro_label" for="pro_date">New Password</label>
                <span class="hide-icon">

                  <input class="pro_input" type="password" id="n-password" name="pro_date" placeholder="Enter New password">
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

                  <input class="pro_input" type="text" id="re-password" name="pro_profession" placeholder="Enter Confirm password">
                  <a href="#" class="hide active" onclick="togglePasswordVisibility('re-password','s-toggleIcon')">
                    <ion-icon name="eye-outline" id="s-toggleIcon"></ion-icon>
                  </a>
                </span>
              </div>
              <div class="pro_button">
                <button type="button" class="small_btn discard_btn">Discard</button>
                <button type="submit" class="small_btn save_btn">Save Changes</button>
              </div>
            </div>
          </form>
        </div>

        <!-- Change Password Section -->
      </div>
    </div>


    <!-- Scripts -->
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/delivery/profilescript.js"></script>

</body>

</html>