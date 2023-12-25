<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sidebar</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/delivery/style1.css">
  <link rel="stylesheet" href="boxicons.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
<?php include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include 'navigationbar.php' ?>

  <!-- Navigation Bar -->
  <section class="home-section" id="navbar">
  <div class="wrapper">
  <!-- Left Section -->
  <div class="left">
    <img src="https://i.imgur.com/cMy8V5j.png" alt="user">
    <div class="edit-pic">
      <div class="edit-icon">
        <a href="#">
          <i class="bx bxs-edit"></i>
          <span class="link_name">Edit Picture</span>
        </a>
      </div>
    </div>
    <h2>Alex William</h2>
    <h4>Distributor</h4>
  </div>

  <!-- Right Section -->
  <div class="right">
    <!-- Information Section -->
    <div class="info">
      <h3>Information</h3>
      <div class="info_data">
        <div class="data">
          <label class="pro_label" for="pro_username">Full Name</label>
          <input class="pro_input" type="text" id="pro_username" name="pro_username" value="Sadeep">
        </div>
        <div class="data">
          <label class="pro_label" for="pro_city">City</label>
          <input class="pro_input" type="text" id="pro_city" name="pro_city" value="Matara">
        </div>
      </div>

      <div class="info_data">
        <div class="data">
          <label class="pro_label" for="pro_address">Address</label>
          <input class="pro_input" type="text" id="pro_address" name="pro_address" value="No:614/2,Matarahena, Beragama,Makandura">
        </div>
        <div class="data">
            <label class="pro_label" for="pro_number">Contact Number</label>
            <input class="pro_input" type="text" id="pro_number" name="pro_number" value="077-8827260">
          </div>
      </div>

      <div class="info_data">
        <div class="data">
          <label class="pro_label" for="pro_email">Email</label>
          <input class="pro_input" type="email" id="pro_email" name="pro_email" value="chathu43sadeep@gmail.com">
        </div>
        <div class="data">
          <label class="pro_label" for="pro_date">Date of Birth</label>
          <input class="pro_input" type="date" id="pro_date" name="pro_date" value="">
        </div>
        
      </div>

      <div class="info_data">
        <div class="data">
          <label class="pro_label" for="pro_profession">Profession</label>
          <input class="pro_input" type="text" id="pro_profession" name="pro_profession" value="Distributor">
        </div>
        
      </div>
      <div class="info_data">
      <div class="pro_button">
        <button type="button" class="small_btn discard_btn">Discard</button>
        <button type="submit" class="small_btn save_btn">Save Changes</button>
      </div>
    </div>
    </div>

    <!-- Change Password Section -->
    <div class="projects">
      <h3>Change Password</h3>
      <div class="projects_data">
        <form action="#" method="POST">
          <div class="info_data">
            <div class="pro_inline"> 
              <div class="pro_name">
                <label class="pro_label" for="pro_current_password">Current Password</label>
                <input class="pro_input" type="password" id="pro_current_password" name="pro_current_password">
              </div>

              <div class="pro_name">
                <label class="pro_label" for="pro_new_password">New Password</label>
                <input class="pro_input" type="password" id="pro_new_password" name="pro_new_password">
              </div>
            </div>
          </div>
          <div class="info_data">
            <div class="pro_inline">
              <div class="pro_name">
                <label class="pro_label" for="pro_reenter_password">Re-enter Password</label>
                <input class="pro_input" type="password" id="pro_reenter_password" name="pro_reenter_password">
              </div>
              <div class="pro_button">
                <button type="button" class="small_btn discard_btn">Discard</button>
                <button type="submit" class="small_btn save_btn">Save Changes</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
   
    
    <!-- Scripts -->
    <script src="<?=ROOT ?>/assets/js/delivery/profilescript.js"></script>
    <script src="<?=ROOT?>/assets/js/script-bar.js"></script>

</body>

</html>