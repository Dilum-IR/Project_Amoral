<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sidebar</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="<?=ROOT ?>/assets/css/profile.css">
  <link rel="stylesheet" href="boxicons.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <!-- Sidebar -->
  <?php include 'sidebar.php'?>
  <!-- Sidebar -->

  <!-- Navigation Bar -->
  <?php include 'navigationbar.php'?>
  <!-- Navigation Bar -->

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
                <div class="user-info">
                  <h1>
                    Profession
                  </h1>
                </div>
                <div class="text-info">
                  <select name="profession" id="profession" required class="edit-popup-gen">
                    <option value="anager">Manager</option>
                    <option value="merchandiser">Merchandiser</option>
                    <option value="employee">Employee</option>
                  </select>
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
    <script src="<?=ROOT ?>/assets/js/profile.js"></script>
</body>

</html>