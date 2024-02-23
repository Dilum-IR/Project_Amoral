<!DOCTYPE html>
<html lang="en">

<head>
  <title>Amoral</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/profile.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/button.css">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/boxicons.min.css">

  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
  <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>

  <!-- Sidebar -->
  <?php include 'sidebar.php' ?>
  <!-- Navigationbar -->
  <?php include 'navigationbar.php' ?>

  <section class="main" id="main">
    <div class="wrapper">

      <!-- Left Section -->
      <div class="left">
        <div class="left-part">
          <div>
            <img src="<?= ROOT ?>/uploads/profile_img/<?= $_SESSION['USER']->user_image ?>" alt="user">
            <h2 class="profile-name"><?= ucfirst($_SESSION['USER']->fullname) ?></h2>
            <h4 class="profession"><?= ucfirst($_SESSION['USER']->user_status) ?></h4>
          </div>

          <form method="POST" enctype="multipart/form-data">
            <div class="edit">
              <div class="edit-icon">
                <input type="file" id="fileInput" name="p_p" />
                <label for="fileInput">
                  <i class="bx bxs-edit"></i>
                </label>
              </div>
            </div>
            <button type="submit" class="change_image" name="change_Image" value="changed">Change Image</button>
          </form>
          <p class="image-error">
            <?=
            (!empty($imagerror) &&  isset($imagerror['error']) && $imagerror['flag'] == 1) ?  "* " . $imagerror['error'] :  '';
            ?>

          </p>
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
            <span class="no-change">
              <?=
              (!empty($error) &&  isset($error['notchange']) && $error['flag'] == 1) ? $error['notchange'] :  '';
              ?>

            </span>

            <?php
            // show($pass);
            if (isset($data)) {
            ?>
              <div class="info_data">
                <div class="data">
                  <label class="pro_label" for="pro_username"><i class='bx bx-user'></i> Full Name &nbsp; <span class="data-error">
                      <?=
                      (!empty($error) &&  isset($error['name']) && $error['flag'] == 1) ?  "* " . $error['name'] :  '';
                      ?>

                    </span> </label>
                  <input class="pro_input" type="text" id="pro_username" name="fullname" value="<?= $data['fullname'] ?>">
                </div>
                <div class="data">
                  <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> City &nbsp; <span class="data-error">
                      <?=
                      (!empty($error) &&  isset($error['city']) && $error['flag'] == 1) ? "* " . $error['city'] :  '';
                      ?>

                    </span>
                  </label>
                  <input class="pro_input" type="text" id="pro_city" name="city" value="<?= $data['city'] ?>">
                </div>
              </div>

              <div class="info_data">
                <div class="data">
                  <label class="pro_label" for="pro_address">Address &nbsp; <span class="data-error">
                      <?=
                      (!empty($error) &&  isset($error['address']) && $error['flag'] == 1) ? "* " . $error['address'] :  '';
                      ?>

                    </span></label>
                  <input class="pro_input" type="text" id="pro_address" name="address" value="<?= $data['address'] ?>">
                </div>

                <!-- <div class="data">
                  <label class="pro_label" for="pro_date">Date of Birth</label>
                  <input class="pro_input" type="date" id="pro_date" name="DOB" value="<?= $data['DOB'] ?>">
                </div> -->
                <div class="data">

                  <label class="pro_label" for="pro_email">Email &nbsp; <span class="data-error">
                      <?=
                      (!empty($error) &&  isset($error['email']) && $error['flag'] == 1) ? "* " . $error['email'] :  '';
                      ?>

                    </span></label>
                  <input class="pro_input" type="text" id="pro_email" name="email" value="<?= $data['email'] ?>">
                </div>
              </div>

              <div class="info_data" id="last-element">
                <!-- <div class="data">
                  <label class="pro_label" for="pro_profession">Profession</label>
                  <input class="pro_input" type="text" id="pro_profession" name="emp_status" value="<?= $data['data']->emp_status ?>" disabled>
                </div> -->

                <div class="data">
                  <label class="pro_label" for="pro_number">Contact Number &nbsp; <span class="data-error">
                      <?=
                      (!empty($error) &&  isset($error['phone']) && $error['flag'] == 1) ? "* " . $error['phone'] :  '';
                      ?>

                    </span></label>
                  <input class="pro_input" type="text" id="pro_number" name="phone" value="<?= $data['phone'] ?>">
                </div>

                <div class="pro_button">
                  <button type="submit" class="small_btn discard_btn ltor-button" name="discard" value="discard" href="<?= ROOT ?>/customer/profile">
                    <span>

                      Discard
                    </span>

                  </button>
                  <button type="submit" class="small_btn save_btn rtol-button" name="save" value="save">
                    <span>
                      Save Changes
                    </span>
                  </button>
                </div>
              </div>


            <?php
            } else {
              redirect("customer/profile");
            }
            ?>

          </form>

        </div>

        <!-- Change Password Section -->
        <div class="info">
          <h3 class="h3">Change Password
            <hr>
          </h3>
          <form method="POST">
            <span class="data-error">
              <?=
              (!empty($passerror) &&  isset($passerror['password']) && $passerror['flag'] == 1) ? "* " . $passerror['password'] . "." :  ''; ?>
              &nbsp;
              <?=
              (!empty($passerror) &&  isset($passerror['passwordError']) && $passerror['flag'] == 1) ? $passerror['passwordError'] :  '';
              ?>
            </span>
            <div class="info_data">

              <div class="data">
                <label class="pro_label" for="pro_email">Current Password

                  &nbsp;
                  <span class="data-error">
                    <?=
                    (!empty($passerror) &&  isset($passerror['current_password']) && $passerror['flag'] == 1) ? "* " . $passerror['current_password'] . "." :  ''; ?>

                  </span>
                </label>
                <span class="hide-icon">
                  <input class="pro_input" type="password" id="c-password" name="password" placeholder="Enter current password" value="<?= isset($pass) ?  $pass['password'] : "" ?>">
                  <a href="#" class="hide active" onclick="togglePasswordVisibility('c-password','c-toggleIcon')">
                    <ion-icon name="eye-off-outline" id="c-toggleIcon"></ion-icon>
                  </a>
                </span>
              </div>
              <div class="data">
                <label class="pro_label" for="pro_date">New Password

                  &nbsp;
                  <span class="data-error">
                    <?=
                    (!empty($passerror) &&  isset($passerror['new_password']) && $passerror['flag'] == 1) ? "* " . $passerror['new_password'] . "." :  ''; ?>

                  </span>
                </label>
                <span class="hide-icon">

                  <input class="pro_input" type="password" id="n-password" name="new_password" placeholder="Enter New password" value="<?= isset($pass) ?  $pass['new_password'] : "" ?>">
                  <a href="#" class="hide active" onclick="togglePasswordVisibility('n-password','n-toggleIcon')">
                    <ion-icon name="eye-off-outline" id="n-toggleIcon"></ion-icon>
                  </a>
                </span>
              </div>
            </div>

            <div class="info_data" id="last-element">
              <div class="data">
                <label class="pro_label" for="pro_profession">Confirm Password

                  &nbsp;
                  <span class="data-error">
                    <?=
                    (!empty($passerror) &&  isset($passerror['confirm_password']) && $passerror['flag'] == 1) ? "* " . $passerror['confirm_password'] . "." :  ''; ?>

                  </span>
                </label>
                <span class="hide-icon">

                  <input class="pro_input" type="password" id="re-password" name="confirm_password" placeholder="Enter Confirm password" value="<?= isset($pass) ?  $pass['confirm_password'] : "" ?>">
                  <a href="#" class="hide active" onclick="togglePasswordVisibility('re-password','re-toggleIcon')">
                    <ion-icon name="eye-off-outline" id="re-toggleIcon"></ion-icon>
                  </a>
                </span>
              </div>
              <div class="pro_button">
                <button type="submit" class="small_btn discard_btn ltor-button" name="discardP" value="discardP" href="<?= ROOT ?>/customer/profile">
                  <span>
                    Discard
                  </span>

                </button>
                <button type="submit" class="small_btn save_btn rtol-button" name="saveP" value="saveP">
                  <span>
                    Save Changes
                  </span>
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>


    <!-- Scripts -->
    <script src="<?= ROOT ?>/assets/js/customer/profile.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>

</body>

</html>