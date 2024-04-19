<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/quotations.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/reports.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include_once 'navigationbar.php' ?>
    <!-- Scripts -->
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>

    <div class="container">
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
        <div class="report-input-box">
            <input type="text" readonly onclick="showPopup(this)">
        </div>
    </div>

    <!-- popup -->

    <div class="popup-report">
        <div class="popup-input">

        </div>
        <div class="popup-buttons">
            <button class="popup-read-btn rd" onclick="closePopup()">Read</button>
            <button class="popup-close-btn rd" onclick="closePopup()">Delete</button>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/manager/reports.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>