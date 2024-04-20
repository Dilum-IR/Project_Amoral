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

    
    <body>
      <!-- <img src="1.jpg" alt="image"> -->
      
      
      <div class="form-wrapper">
        <div class="inner">
          <div class="inner1">
            <div class="home">
        
              <span>
                <a href="<?= ROOT ?>/home">
                  <ion-icon name="chevron-back-outline"></ion-icon>
                  <!-- <ion-icon name="chevron-back-circle-outline"></ion-icon> -->
                  Back
                </a>
              </span>
        
            </div>

            <div class="image-holder">
              <img src="<?= ROOT ?>/assets/images/logo.JPG" alt="image">
            </div>

            <div class="diff">
              <h1>Geust Garment Registration</h1>

            </div>
          </div>
          <form method="POST">

            <span>
              <h2>Garment factory Details</h2>
            </span>

            <div class="form-group">
              <span class="details">Name</span>
              <input type="text" id="name" name="name" class="form-control">

              <?php if (isset($errors['name'])): ?>
              <div class="error"><?= htmlspecialchars($errors['name']); ?></div>
            <?php endif; ?>

              <span class="details">Email</span>
              <input type="email" id="email" name="email" class="form-control">

              <?php if (isset($errors['email'])): ?>
              <div class="error"><?= htmlspecialchars($errors['email']); ?></div>
            <?php endif; ?>

            </div>

            <div class="form-group">
              <span class="details">Address</span>
              <input type="text" id="address" name="address" class="form-control">
              <?php if (isset($errors['address'])): ?>
              <div class="error"><?= htmlspecialchars($errors['address']); ?></div>
            <?php endif; ?>


              <span class="details">City</span>
              <input type="text" id="city" name="city" class="form-control">
              <?php if (isset($errors['city'])): ?>
              <div class="error"><?= htmlspecialchars($errors['city']); ?></div>
            <?php endif; ?>

            </div>


            <span>
              <h2>Manager Contact Details</h2>
            </span>

            <div class="form-group">
              <span class="details">Manager Name</span>
              <input type="text" id="manager_name" name="manager_name" class="form-control">
              <?php if (isset($errors['manager_name'])): ?>
              <div class="error"><?= htmlspecialchars($errors['manager_name']); ?></div>
            <?php endif; ?>

              <span class="details">Email Address</span>
              <input type="email" id="manager_email" name="manager_email" class="form-control">
              <?php if (isset($errors['manager_email'])): ?>
              <div class="error"><?= htmlspecialchars($errors['manager_email']); ?></div>
            <?php endif; ?>
            </div>

            <div class="form-group">
              <span class="details">Contact Number</span>
              <input type="text" id="manager_contact" name="manager_contact" class="form-control">
              <?php if (isset($errors['manager_contact'])): ?>
              <div class="error"><?= htmlspecialchars($errors['manager_contact']); ?></div>
            <?php endif; ?>

            </div>

            <!-- <span>
              <h2>Capacity and Cost Metrics</h2>
            </span>

            <div class="form-group">
              <span class="details">Number of Workers</span>
              <input type="number" id="no_workers" name="no_workers" class="form-control">
              <?php if (isset($errors['no_workers'])): ?>
              <div class="error"><?= htmlspecialchars($errors['no_workers']); ?></div>
            <?php endif; ?>

              <span class="details">Cutting Price</span>
              <input type="number" id="cut_price" name="cut_price" class="form-control">
              <?php if (isset($errors['cut_price'])): ?>
              <div class="error"><?= htmlspecialchars($errors['cut_price']); ?></div>
            <?php endif; ?>
            </div>

            <div class="form-group">
              <span class="details">Daily Capacity</span>
              <input type="number" id="day_capacity" name="day_capacity" class="form-control">
              <?php if (isset($errors['day_capacity'])): ?>
              <div class="error"><?= htmlspecialchars($errors['day_capacity']); ?></div>
            <?php endif; ?>

              <span class="details">Product Capacity</span>
              <input type="number" id="productCapacity" name="productCapacity" class="form-control">
              <?php if (isset($errors['productCapacity'])): ?>
              <div class="error"><?= htmlspecialchars($errors['productCapacity']); ?></div>
            <?php endif; ?>
            </div> -->

            <div class="button">
              <input type="submit" value="Register" name="guest_register" />
            </div>

          </form>
        </div>
      </div>
    </body>

</html>