<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= ROOT ?>/assets/css/guest/guest.css">
  <!-- <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">/ -->
  <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

  <title>Amoral</title>
</head>

<body>
  <div class="containerStu">

    <div>
      <div class="title">
        Guest Garment Registration
      </div>

      <span>
        <a href="<?= ROOT ?>/home">
          <ion-icon name="chevron-back-outline"></ion-icon>
          <!-- <ion-icon name="chevron-back-circle-outline"></ion-icon> -->
          Back
        </a>
      </span>

    </div>

    <!-- <span class="title">Student & Parent Registration</span> -->
    <form method="POST">

      <div class="user-details">
        <div class="input-box">
          <span class="details">Garment Name</span>
          <input name="name" type="text" placeholder="Garment name" required />
        </div>

        <div class="input-box">
          <span class="details">Email</span>
          <input name="email" type="text" placeholder="Garment email" required />
        </div>
        <!-- <div class="input-box">
          <span class="details">Date of Birth</span>
          <input type="date" placeholder="Enter your Birthday" required />
        </div> -->

        <div class="input-box">
          <span class="details">Address</span>
          <input name="address" type="text" placeholder="Garment Address" required />
        </div>

        <div class="input-box">
          <span class="details">City</span>
          <input name="city" type="text" placeholder="City" required />
        </div>

        <!-- <div class="input-box">
          <span class="details">Select Department</span>
          <select name="department" id="department" required>
            <option value="Computer Science">
              Computer Science
            </option>
            <option value="Mathematics">Mathematics</option>
            <option value="Technology">Technology</option>
            <option value="Science">Science</option>
          </select>
        </div> -->
      </div>

      <!-- <div class="stugender-details">
        <input type="radio" name="gender" id="dot-1" checked="male" />
        <input type="radio" name="gender" id="dot-2" checked="female" />
        <span class="gender-title">Gender</span>
        <div class="category">
          <label for="dot-1">
            <span class="dot one" value="male"></span>
            <span class="gender">Male</span>
          </label>

          <label for="dot-2">
            <span class="dot two" value="female"></span>
            <span class="gender">Female</span>
          </label>
        </div>
      </div> -->
      <div class="parent-details">
        <div class="input-box">
          <span class="details">Garment manager name</span>
          <input name="manager_name" type="text" placeholder="Manager Name" required />
        </div>

        <!-- <div class="input-box">
          <span class="details">Parent with relationship</span>
          <select name="department" id="department" required>
            <option value="Mother">
              Mother
            </option>
            <option value="Father">Father</option>
            <option value="Other">Other</option>
          </select>
        </div> -->

        <div class="input-box">
          <span class="details">Manager's E-mail Adddress</span>
          <input name="manager_email" type="email" placeholder="Manager Enter email" required />
        </div>

        <div class="input-box">
          <span class="details">Manager's Contact number</span>
          <input name="manager_contact" type="text" placeholder="Manager Contact number" required />
        </div>
      </div>


      <div class="button">
        <input type="submit" value="Register" name="guest_register" />
      </div>
    </form>
  </div>
</body>

</html>