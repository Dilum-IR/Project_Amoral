<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/assigndelivery.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
</head>
<body>

    <?php include_once 'sidebar.php' ?>
    <?php include_once 'navigationbar.php' ?>

    <section id="main" class="main">

        <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <i class='bx bx-chevron-right'></i>
                <li>
                    <a href="#" class="active">Assign Delivery Orders</a>
                </li>

        </ul>

        <div class="content">
            <div class="map">

            </div>

            <div class="orders">
                <h3>Selected Orders <i class='bx bx-chevron-right'></i></h3>

                <div class="order">
                    <p>This is an order </p>
                </div>
                <h4>Select a deliveryman</h4>
                
                <button>Assign</button>
            </div>

        </div>

    </section>

    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    
</body>
</html>