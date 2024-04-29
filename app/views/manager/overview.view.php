<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta http-equiv="refresh" content="2; url=<?= ROOT ?>/garment/overview"> -->

    <title>Amoral - Manager</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/overview.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/loading.css">


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <style>
        .loader-wrapper {
            z-index: 10;
        }
    </style>
    <?php

    $flag = htmlspecialchars($_GET['flag'] ?? 2);
    $success_no = htmlspecialchars($_GET['success_no'] ?? 0);
    $success = htmlspecialchars($_GET['success'] ?? 0);

    $error_no = htmlspecialchars($_GET['error_no'] ?? 0);

    include __DIR__ . '/../utils/loading.php';

    // loading content hide when error popup times 
    ?>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->

    <?php include 'navigationbar.php';
    include __DIR__ . '/../utils/toastMsg.php';

    ?>
    <!-- Scripts -->

    <!-- Content -->
    <section id="main" class="main">

        <div class="success-msg"> </div>


        <div class="content">

            <!-- <nav class="sub-nav">
                <a href="" class="nav-link">Garment</a>
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
            </nav> -->

            <div class="left-right">


                <main>
                    <!-- Navigation path -->
                    <div class="head-title">
                        <div class="left">
                            <ul class="breadcrumb">
                                <li>
                                    <a href="#">Home</a>
                                </li>
                                <i class='bx bx-chevron-right'></i>
                                <li>
                                    <a href="#" class="active">Overview</a>
                                </li>

                            </ul>
                        </div>
                        <!-- <a href="" class="btn-download">
                            <i class='bx bxs-cloud-download'></i>
                            <span class="text">Download PDF</span>
                        </a> -->
                    </div>



                    <div class="insights">
                        <div class="orders">
                            <i class='bx bxs-calendar-check'></i>

                            <div class="firstmiddle middle">
                                <div>
                                    <div class="left">

                                        <h3 class="text-muted"> Pending Orders </h3> &nbsp;&nbsp;
                                        <h1><?= (!empty($overview['pending_orders'])) ? $overview['pending_orders'] : "0" ?>
                                        </h1>
                                    </div>
                                    <div class="left">
                                        <h3>Current Orders </h3> &nbsp;&nbsp;&nbsp;
                                        <h1><?= (!empty($overview['current'])) ? $overview['current'] : "0" ?></h1>
                                    </div>
                                </div>
                                <div class="order-stat">
                                    <small class="text-muted"><b>
                                            Cutting Orders :&nbsp;&nbsp; <?= (!empty($overview['cutting_orders'])) ? $overview['cutting_orders'] : "0" ?>
                                        </b></small>
                                    <small class="text-muted"><b>
                                            Sewing Orders :&nbsp;&nbsp;&nbsp;<?= (!empty($overview['sewing_orders'])) ? $overview['sewing_orders'] : "0" ?>
                                        </b></small>

                                </div>
                            </div>

                        </div>


                        <div class="sales">
                            <i class='bx bxs-calendar-check'></i>
                            <div class="middle">
                                <div>

                                    <div class="left">
                                        <h3>Completed Orders</h3> &nbsp;&nbsp;
                                        <h1><?= (!empty($overview['sales']['compleated_orders'])) ? $overview['sales']['compleated_orders'] : "0" ?></h1>

                                    </div>
                                    <small class="text-muted"><b>
                                            Cancel Orders :&nbsp;&nbsp;&nbsp;<?= (!empty($overview['cancel_orders'])) ? $overview['cancel_orders'] : "0" ?>
                                        </b></small>
                                </div>
                                <div class="container">
                                    <div class="circular-progress" id="completed-orders">
                                        <span class="progress-value" id="completed-orders-num">0%</span>
                                    </div>
                                </div>
                            </div>
                            <small class="small-last-2 text-muted">From last month</small>
                        </div>
                        <div class="sales">
                            <i class=' bx bxs-dollar-circle'></i>
                            <div class="middle">
                                <div>
                                    <div class="left">
                                        <h3>Total Revenue</h3> &nbsp;&nbsp;
                                        <h1>LKR <?= number_format((!empty($overview['sales']['total_sales'])) ? $overview['sales']['total_sales'] : "0", 2, '.', ',') ?></h1>
                                    </div>
                                    <small class="text-muted"><b>
                                            Total Cost : &nbsp;&nbsp; LKR <?= number_format((!empty($overview['sales']['total_cost'])) ? $overview['sales']['total_cost'] : "0", 2, '.', ',') ?>
                                        </b></small>
                                    <small class="text-muted"><b>
                                            Total Remainings : &nbsp;&nbsp;&nbsp;LKR <?= number_format((!empty($overview['sales']['total_remainings'])) ? $overview['sales']['total_remainings'] : "0", 2, '.', ',') ?>
                                        </b></small>

                                </div>

                                <div class="container">
                                    <div class="circular-progress" id="total-sales">
                                        <span class="progress-value" id="total-sales-num">0%</span>
                                    </div>
                                </div>

                                <!-- <div class="progress">
                                    <svg>
                                        <circle cx='38' cy='38' r='36'></circle>
                                    </svg>

                                    <div class="number">
                                        <p>%</p>
                                    </div>
                                </div> -->
                            </div>
                            <small class="small-last-2 text-muted">From last month</small>
                        </div>
                    </div>
                </main>
            </div>

            <style>
                /* analysis component css */
                main .insights i::before {
                    background: rgb(18, 211, 0);
                    border-radius: 20%;
                    /* padding: 5px; */
                    font-size: 28px;
                    margin-left: 0px;
                }

                main .insights>div {
                    padding: 20px 5px 10px 20px;
                }

                main .insights>div .middle {
                    margin-right: 10px;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                }

                .firstmiddle {
                    margin-top: 10px;
                }

                .insights .middle .left,
                .count {
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }

                main .insights small {
                    display: block;
                }

                .small-last-2 {
                    margin-top: 2px;
                    margin-left: 5px;
                    float: right;
                }

                .container {
                    margin-right: 10px;
                }

                .circular-progress {
                    position: relative;
                    height: 80px;
                    width: 80px;
                    border-radius: 50%;
                    background: conic-gradient(#7d2ae8 3.6deg, #ededed 0deg);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .circular-progress::before {
                    content: "";
                    position: absolute;
                    height: 65px;
                    width: 65px;
                    border-radius: 50%;
                    background-color: #fff;
                }

                .progress-value {
                    position: relative;
                    font-size: 20px;
                    /* font-weight: 600; */
                    color: black;
                }

                /* analysis component css end */

                .table-data-new {
                    margin-top: 0 !important;
                }

                .ordernew {
                    display: flex;
                    background-color: transparent !important;
                    height: 450px;
                    gap: 2%;
                    margin-top: 13px !important;
                    padding: 9px !important;
                    box-shadow: none !important;
                    overflow-x: unset !important;

                }

                .chart-component {
                    width: 70%;
                    padding: 5px;
                    background-color: white;
                    border-radius: 20px;
                    box-shadow: 0 0 10px 0px rgb(161, 161, 161);

                    .head {
                        margin-left: 15px;
                        margin-top: 15px;

                    }
                }

                .report-component {
                    width: 29%;
                    padding: 5px;
                    background-color: white;
                    border-radius: 20px;
                    box-shadow: 0 0 10px 0px rgb(161, 161, 161);
                    /* display: flex; */
                    align-items: center;

                    .head {
                        margin-left: 15px;
                        margin-top: 15px;
                    }
                }

                .small-last-2 {
                    margin-top: 2px;
                    float: right;
                }


                .chart-more-btn {
                    background-color: white !important;
                    color: #000 !important;
                    border: #000 solid 2px;
                    padding: 2px 10px;
                    font-size: 13px;
                    font-weight: 500;
                    transition: 0.5s ease-in-out;
                    margin-right: 10px;
                    border-radius: 36px !important;
                }

                .chart-more-btn:hover {
                    background-color: #000 !important;
                    color: white !important;
                }

                .btn-download {

                    display: flex;
                    text-decoration: none;
                    padding: 10px 15px;
                    background-color: black;
                    color: white;
                    border-radius: 36px !important;
                    align-items: center;
                    justify-content: center;
                    transition: 0.5s ease-in-out;
                    transform: scale(1.0);
                    cursor: pointer;
                    gap: 8px;
                }

                .btn-download:hover {
                    transform: scale(1.06);
                }

                .btn-download .text {
                    font-size: 15px !important;
                    color: white;


                }

                .rep-gen-date {
                    background-color: white;
                    outline: none;
                    border: black solid 1.6px;
                    padding: 10px 10px;
                    border-radius: 10px;
                    width: 200px;
                }

                .report-gen-container {
                    height: 100%;
                    margin-bottom: 37px;

                }

                .lable-and-date {
                    margin-left: 37px;
                    margin-bottom: 37px;
                    display: block !important;
                }

                .label {
                    display: block !important;

                }

                .re-head {
                    margin-bottom: -5px !important;
                }

                .to-date {
                    margin-top: 5px;
                }

                .after-gen-btn {
                    padding: 7px 15px;

                }

                .download-btn {
                    background-color: white !important;
                    color: #000;
                    border: black 1px solid;
                    transition: 0.5s ease-in-out 0.5s;
                }

                button:disabled {
                    cursor: not-allowed;
                    background-color: rgba(0, 0, 0, 0.6) !important;
                }

                .text-warning {
                    color: green;
                    font-weight: 700;
                    font-size: 18px;
                    margin-bottom: 10px;
                    margin-left: -42px !important;
                }

                #view:disabled,
                #down:disabled {
                    transition: 0.5s ease-in-out 0.5;
                }

                #view:disabled,
                #down:disabled {
                    color: white !important;
                    border: none !important;
                    background-color: #0c5fcdc7 !important;
                    cursor: not-allowed;
                    text-align: center;
                    display: flex;
                }

                .warn-with-btns {
                    margin-left: 50px;
                    align-items: center;
                    justify-content: center;
                }

                .bx-x {
                    font-size: 25px;
                    cursor: pointer;
                }

                .report-title {

                    margin-left: 20px;
                    margin-bottom: 20px;

                    span {
                        color: red;
                    }
                }
            </style>
            <div class="left-right">

                <main>
                    <!-- chart with report container -->
                    <div class="table-data table-data-new">

                        <div class="order ordernew">
                            <div class="chart-component">

                                <div class="head">
                                    <h3>Sales</h3>
                                    <button class="chart-more-btn info-btn" onclick="changeToDaily()">Daily</button>
                                    <button class="chart-more-btn info-btn" onclick="changeToMonthly()">Monthly</button>
                                </div>

                                <div class="chart"></div>

                            </div>
                            <div class="report-component">

                                <div class="head">
                                    <h3>Genarate Reports</h3>
                                </div>

                                <p class="report-title"><span>*</span> Select Date Range </p>
                                <div class="report-gen-container">
                                    <div class="lable-and-date">
                                        <label class="label" for="">From Date</label>
                                        <input id="start_date" class="rep-gen-date" type="date" value="" min="<?php ?>" max="<?php echo date('Y-m-d'); ?>">
                                        <label for="" class="label to-date">To Date</label>
                                        <input id="end_date" class="rep-gen-date" type="date" min="" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div class="warn-with-btns">
                                        <p class="text-warning" id="message"></p>

                                        <button class="btn-download" id="gen" onclick="generatePDF()">
                                            <i class='bx bxs-cloud-download'></i>
                                            <span class="text">Genarate Report</span>
                                        </button>

                                        <button class="view-btn btn-download after-gen-btn" id="view" onclick="viewPDF()" style="display: none;">View</button>
                                        <button class="download-btn btn-download after-gen-btn" id="down" onclick="downloadBlob()" style="display: none;">Download</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end chart with report container -->
                    <div class="material">
                        <span>
                            <h2>Material Stock</h2>
                            <button class="edit-material-btn">
                                <i class="bx bx-edit"></i>
                            </button>
                        </span>


                        <div class="add card">
                            <!-- <i class='bx bxs-calendar-check'></i> -->
                            <!-- <div class="middle"> -->
                            <div class="left">
                                <i class='bx bxs-plus-circle'></i>
                                <h3 style="width: 100%; ">Add a material</h3>
                            </div>

                            <!-- </div> -->

                        </div>


                    </div>

                    <div class="printingType">
                        <span>
                            <h2>Printing Types</h2>
                            <button class="edit-printingType-btn">
                                <i class="bx bx-edit"></i>
                            </button>
                        </span>


                        <div class="add card">
                            <!-- <i class='bx bxs-calendar-check'></i> -->
                            <!-- <div class="middle"> -->
                            <div class="left">
                                <i class='bx bxs-plus-circle'></i>
                                <h3 style="width: 100%;">Add a printing type</h3>
                            </div>

                            <!-- </div> -->

                        </div>


                    </div>



                    <!--popup to add materials-->

                    <div id="add-material" class="popup-add">

                        <!-- Modal content -->
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Add a material</h2>
                            <form id="addMaterialForm" method="POST">
                                <label for="materialName">Material Name: <span class="error name"> </span></label><br>
                                <input type="text" id="materialName" name="material_type"><br>
                                <label for="materialQuantity">Quantity: <span class="error quantity"></span></label><br>
                                <input type="text" id="materialQuantity" name="quantity"><br>
                                <label for="materialPrice">Unit Price: <span class="error price"></span></label><br>
                                <input type="text" id="materialPrice" name="unit_price"><br><br>
                                <label for="ppm">Approximate products that can be made per 1Kg: <span class="error ppm"></span></label><br>
                                <input type="text" id="ppm" name="ppm"><br><br>
                                <input type="submit" class="btn-add" name="addMaterial" value="Add Material">
                            </form>
                        </div>

                    </div>

                    <script>
                        // ajax for adding materials
                        document.getElementById("addMaterialForm").addEventListener("submit", function(e) {
                            e.preventDefault();
                            var form = document.getElementById("addMaterialForm");
                            var noerrors = validateMaterial(form);
                            var formData = new FormData(form);
                            console.log(formData);
                            if (noerrors) {
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "<?= ROOT ?>/manager/addMaterial", true);
                                xhr.onload = function() {
                                    if (this.status == 200) {
                                        // console.log(this.responseText);
                                        var response = JSON.parse(this.responseText);
                                        console.log('response' + response);
                                        if (response == false) {
                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "Material added successfully";
                                            // successMsgElement.style.transition = 'all 1s ease-in-out';
                                            successMsgElement.style.display = 'block';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        } else {
                                            var successMsgElement = document.querySelector('.success-msg');
                                            if (response == 'Material already exists') {
                                                successMsgElement.innerHTML = "Material already exists";
                                            } else {
                                                successMsgElement.innerHTML = "There was an error adding the material";
                                            }

                                            // successMsgElement.style.transition = 'all 1s ease-in-out';

                                            successMsgElement.style.display = 'block';
                                            successMsgElement.style.backgroundColor = 'red';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        }
                                    }
                                }
                                xhr.send(formData);
                            }
                        });
                    </script>

                    <!-- Delete confirmation popup -->
                    <div id="deleteConfirmation-material" class="popup-delete">
                        <!-- Modal content -->
                        <div class="popup-content">
                            <h2>Are you sure you want to delete this?</h2>
                            <form id="deleteMaterialForm" method="POST">
                                <input type="hidden" id="materialId" name="stock_id">
                                <input type="submit" value="Yes, delete it" name="deleteMaterial">
                                <button type="button" id="cancelDelete" onclick="closeDelete()">No, cancel</button>
                            </form>
                        </div>
                    </div>

                    <script>
                        // ajax for deleting materials
                        document.getElementById("deleteMaterialForm").addEventListener("submit", function(e) {
                            e.preventDefault();
                            var form = document.getElementById("deleteMaterialForm");
                            var formData = new FormData(form);
                            console.log(formData);
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "<?= ROOT ?>/manager/deleteMaterial", true);
                            xhr.onload = function() {
                                if (this.status == 200) {
                                    console.log(this.responseText);
                                    var response = JSON.parse(this.responseText);
                                    console.log('response' + response);
                                    if (response == false) {
                                        var successMsgElement = document.querySelector('.success-msg');
                                        successMsgElement.innerHTML = "Material deleted successfully";
                                        // successMsgElement.style.transition = 'all 1s ease-in-out';
                                        successMsgElement.style.display = 'block';
                                        setTimeout(function() {
                                            successMsgElement.style.display = 'none';
                                            location.reload();
                                        }, 2000);
                                    } else {
                                        var successMsgElement = document.querySelector('.success-msg');
                                        successMsgElement.innerHTML = "There was an error deleting the material";
                                        // successMsgElement.style.transition = 'all 1s ease-in-out';

                                        successMsgElement.style.display = 'block';
                                        successMsgElement.style.backgroundColor = 'red';
                                        setTimeout(function() {
                                            successMsgElement.style.display = 'none';
                                            location.reload();
                                        }, 2000);
                                    }
                                }
                            }
                            xhr.send(formData);
                        });
                    </script>

                    <!--popup to update materials-->

                    <div id="update-material" class="popup-update">

                        <!-- Modal content -->
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Update material</h2>
                            <form id="updateMaterialForm" method="POST">
                                <label for="materialName">Material Name: <span class="error name"> </span></label><br>
                                <input type="text" id="materialName" name="material_type"><br>
                                <label for="materialQuantity">Quantity: <span class="error quantity"></span></label><br>
                                <input type="text" id="materialQuantity" name="quantity"><br>
                                <label for="materialPrice">Unit Price: <span class="error price"></span></label><br>
                                <input type="text" id="materialPrice" name="unit_price"><br><br>
                                <label for="ppm">Approximate products that can be made per 1Kg: <span class="error ppm"></span></label><br>
                                <input type="text" id="ppm" name="ppm"><br><br>
                                <input type="hidden" id="materialId" name="stock_id">
                                <br>
                                <input type="submit" class="btn-add" name="updateMaterial" value="Update Material">
                            </form>
                        </div>
                    </div>

                    <script>
                        // ajax for updating materials
                        document.getElementById("updateMaterialForm").addEventListener("submit", function(e) {
                            e.preventDefault();
                            var form = document.getElementById("updateMaterialForm");
                            var noerrors = validateMaterial(form);
                            var formData = new FormData(form);
                            console.log(formData);
                            if (noerrors) {
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "<?= ROOT ?>/manager/updateMaterial", true);
                                xhr.onload = function() {
                                    if (this.status == 200) {
                                        console.log(this.responseText);
                                        var response = JSON.parse(this.responseText);
                                        console.log('response' + response);
                                        if (response == false) {
                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "Material updated successfully";
                                            // successMsgElement.style.transition = 'all 1s ease-in-out';
                                            successMsgElement.style.display = 'block';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        } else {
                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "There was an error updating the material";
                                            // successMsgElement.style.transition = 'all 1s ease-in-out';

                                            successMsgElement.style.display = 'block';
                                            successMsgElement.style.backgroundColor = 'red';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        }
                                    }
                                }
                                xhr.send(formData);
                            }
                        });
                    </script>



                    <!--popup to add materials-->

                    <div id="add-printingType" class="popup-add">

                        <!-- Modal content -->
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Add a printing type</h2>
                            <form id="addPrintingTypeForm" method="POST">
                                <label for="pType">Printing Type: <span class="error ptype"></span></label><br>
                                <input type="text" id="pType" name="printing_type"><br>
                                <label for="materialQuantity">Materials: <span class="error materials"></span></label><br>
                                <div class="materialBx">
                                    <?php foreach ($data['materialStock'] as $material) : ?>
                                        <div class="checkbx">
                                            <input type="checkbox" id="<?php echo $material->material_type ?>" name="PtypeMaterials[]" value="<?php echo $material->material_type . ',' . $material->stock_id ?>">
                                            <label for="<?php echo $material->material_type ?>"><?php echo $material->material_type ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <br>
                                <label for="ptypePrice">Price Addition: <span class="error price"></span></label><br>
                                <input type="text" id="ptypePrice" name="price"><br><br>

                                <input type="submit" class="btn-add" name="addPrintingType" value="Add Printing Type">
                            </form>
                        </div>

                    </div>

                    <script>
                        // ajax for adding printing types
                        document.getElementById("addPrintingTypeForm").addEventListener("submit", function(e) {
                            e.preventDefault();
                            var form = document.getElementById("addPrintingTypeForm");
                            var noerrors = validatePrintingType(form);
                            var formData = new FormData(form);
                            // console.log(formData);
                            if (noerrors) {
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "<?= ROOT ?>/manager/addPrintingType", true);
                                xhr.onload = function() {
                                    if (this.status == 200) {
                                        console.log(this.responseText);
                                        var response = JSON.parse(this.responseText);
                                        // console.log('response'+response);
                                        if (response == false) {
                                            // delay(100);


                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "Printing type added successfully";
                                            successMsgElement.style.display = 'block';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);



                                        } else {
                                            var successMsgElement = document.querySelector('.success-msg');
                                            if (response == 'Printing type already exists') {
                                                successMsgElement.innerHTML = "Printing type already exists";
                                            } else {
                                                successMsgElement.innerHTML = "There was an error adding the printing type";
                                            }
                                            // successMsgElement.style.transition = 'all 1s ease-in-out';

                                            successMsgElement.style.display = 'block';
                                            successMsgElement.style.backgroundColor = 'red';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        }
                                    }
                                }
                                xhr.send(formData);
                            }
                        });
                    </script>

                    <!-- Delete confirmation popup -->
                    <div id="deleteConfirmation-ptype" class="popup-delete">
                        <!-- Modal content -->
                        <div class="popup-content">
                            <h2>Are you sure you want to delete this printing type?</h2>
                            <form id="deletePrintingTypeForm" method="POST">
                                <input type="hidden" id="ptypeId" name="ptype_id">
                                <input type="submit" value="Yes, delete it" name="deletePType">
                                <button type="button" id="cancelDelete" onclick="closeDelete()">No, cancel</button>
                            </form>
                        </div>
                    </div>

                    <script>
                        // ajax for deleting printing types
                        document.getElementById("deletePrintingTypeForm").addEventListener("submit", function(e) {
                            e.preventDefault();
                            var form = document.getElementById("deletePrintingTypeForm");
                            var formData = new FormData(form);
                            // console.log(formData);
                            var xhr = new XMLHttpRequest();
                            xhr.open("POST", "<?= ROOT ?>/manager/deletePrintingType", true);
                            xhr.onload = function() {
                                if (this.status == 200) {
                                    console.log(this.responseText);
                                    var response = JSON.parse(this.responseText);
                                    // console.log('response'+response);
                                    if (response == false) {
                                        var successMsgElement = document.querySelector('.success-msg');
                                        successMsgElement.innerHTML = "Printing type deleted successfully";
                                        // successMsgElement.style.transition = 'all 1s ease-in-out';
                                        successMsgElement.style.display = 'block';
                                        setTimeout(function() {
                                            successMsgElement.style.display = 'none';
                                            location.reload();
                                        }, 2000);
                                    } else {
                                        var successMsgElement = document.querySelector('.success-msg');
                                        successMsgElement.innerHTML = "There was an error deleting the printing type";

                                        // successMsgElement.style.transition = 'all 1s ease-in-out';

                                        successMsgElement.style.display = 'block';
                                        successMsgElement.style.backgroundColor = 'red';
                                        setTimeout(function() {
                                            successMsgElement.style.display = 'none';
                                            location.reload();
                                        }, 2000);
                                    }
                                }
                            }
                            xhr.send(formData);
                        });
                    </script>

                    <!--popup to update printing types-->

                    <div id="update-printingType" class="popup-update">

                        <!-- Modal content -->
                        <div class="popup-content">
                            <span class="close">&times;</span>
                            <h2>Update Printing Type</h2>
                            <form id="updatePrintingTypeForm" method="POST">
                                <label for="pType">Printing Type: <span class="error pType"> </span></label><br>
                                <input type="text" id="pType" name="printing_type"><br>
                                <label for="materialQuantity">Materials: <span class="error materials"></span></label><br>
                                <div class="materialBx">
                                    <?php foreach ($data['materialStock'] as $material) : ?>
                                        <div class="checkbx">
                                            <input type="checkbox" id="<?php echo $material->material_type ?>" name="PtypeMaterials[]" value="<?php echo $material->material_type . ',' . $material->stock_id ?>">
                                            <label for="<?php echo $material->material_type ?>"><?php echo $material->material_type ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <br>
                                <label for="ptypePrice">Price Addition: <span class="error price"></span></label><br>
                                <input type="text" id="materialPrice" name="price"><br><br>

                                <input type="hidden" id="ptypeId" name="ptype_id">
                                <br>
                                <input type="submit" class="btn-add" name="updatePrintingType" value="Update Printing Type">
                            </form>
                        </div>
                    </div>

                    <script>
                        // ajax for updating printing types
                        document.getElementById("updatePrintingTypeForm").addEventListener("submit", function(e) {
                            e.preventDefault();
                            var form = document.getElementById("updatePrintingTypeForm");
                            var noerrors = validatePrintingType(form);
                            var formData = new FormData(form);
                            console.log(noerrors);
                            if (noerrors) {
                                var xhr = new XMLHttpRequest();
                                xhr.open("POST", "<?= ROOT ?>/manager/updatePrintingType", true);
                                xhr.onload = function() {
                                    if (this.status == 200) {
                                        console.log(this.responseText);
                                        var response = JSON.parse(this.responseText);
                                        // console.log('response'+response);
                                        if (response == false) {
                                            var successMsgElement = document.querySelector('.success-msg');
                                            successMsgElement.innerHTML = "Printing type updated successfully";
                                            // successMsgElement.style.transition = 'all 1s ease-in-out';
                                            successMsgElement.style.display = 'block';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        } else {
                                            var successMsgElement = document.querySelector('.success-msg');

                                            successMsgElement.innerHTML = "There was an error adding the printing type";

                                            // successMsgElement.style.transition = 'all 1s ease-in-out';

                                            successMsgElement.style.display = 'block';
                                            successMsgElement.style.backgroundColor = 'red';
                                            setTimeout(function() {
                                                successMsgElement.style.display = 'none';
                                                location.reload();
                                            }, 2000);
                                        }
                                    }
                                }
                                xhr.send(formData);
                            }
                        });
                    </script>



                    <div class="table-data">

                        <!-- left side container -->
                        <div class="order">
                            <div class="head">
                                <h3>Recent Customer Orders</h3>
                                <a class="view-all-btn" href="<?= ROOT ?> /manager/customerorders">View All</a>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Placed On</th>
                                        <th>Material</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($data['customerOrder'])) : ?>
                                        <?php $i = 0; ?>

                                        <?php foreach ($data['customerOrder'] as $order) : ?>
                                            <?php if ($i < 4) : ?>
                                                <tr>
                                                    <td>
                                                        ORD-<?php echo $order->order_id ?>
                                                    </td>
                                                    <td><?php echo $order->order_placed_on ?></td>
                                                    <td>
                                                        <?php if (!empty($data['material_sizes'])) : ?>

                                                            <?php foreach ($data['material_sizes'] as $sizes) : ?>
                                                                <?php if ($sizes->order_id == $order->order_id) : ?>

                                                                    <?php echo $sizes->material_type ?><br>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="status">
                                                        <i class='bx bxs-circle <?php echo $order->order_status ?>' style="font-size: 12px;"></i>
                                                        <div>
                                                            <?php echo $order->order_status ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- left side container -->

                        <!-- right side container -->



                        <!-- right side container -->
                    </div>

                    <div class="table-data">

                        <!-- left side container -->
                        <div class="order">
                            <div class="head">
                                <h3>Recent Garment Orders</h3>
                                <a class="view-all-btn" href="<?= ROOT ?> /manager/garmentorders">View All</a>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>CustomerOrder Id</th>
                                        <th>Placed On</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data['garmentOrder'])) : ?>
                                        <?php $i = 0; ?>


                                        <?php foreach ($data['garmentOrder'] as $order) : ?>
                                            <?php if ($i < 3) : ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $order->garment_order_id ?>
                                                    </td>
                                                    <td><?php echo $order->order_id ?></td>
                                                    <td><?php echo $order->placed_date ?></td>
                                                    <td class="status">
                                                        <i class='bx bxs-circle <?php echo $order->status ?>' style="font-size: 12px;"></i>
                                                        <div>
                                                            <?php echo $order->status ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php $i++; ?>
                                            <?php endif; ?>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- left side container -->

                        <!-- right side container -->



                        <!-- right side container -->
                    </div>

                </main>


                <style>
                    .container-refund-list {
                        border-radius: 20px;
                        margin-top: 10px;
                        padding: 20px;
                        padding-top: 10px;
                        /* box-shadow: ; */
                        width: 100%;
                        height: 400px;
                        background-color: ghostwhite;
                        box-shadow: 0 0px 20px 0px rgb(161, 161, 161);
                        overflow-y: hidden;
                        
                        .head {
                            display: flex;
                            margin: 10px 10px;
                            margin-top: 5px;
                        }
                        
                    }
                    .container-refund-list:hover {
                        overflow-y: scroll;
                    }

                    .refund-list {
                        width: 100%;
                        height: 100%;
                        transform: scale(1.0);
                        border-radius: 10px;
                        margin: 7px 2px;
                        transition: 0.5s ease-in-out;
                        padding: 15px;
                    }
                    
                    .refund-list.full{
                        background-color: #03ad00cf;

                    }
                    
                    .refund-list.half{
                        background-color: #ffa500d1;

                    }

                    .refund-list:hover {
                        border: none;
                        transform: scale(1.03);
                        box-shadow: 0 0px 10px 0px rgb(161, 161, 161);
                    }

                    #re-order-id,
                    #re-order-paid {
                        display: flex;
                    }

                    #re-order-id p,
                    #re-order-paid p,
                    #re-bot-content {
                        color: white;
                    }

                    #re-top-content {
                        width: 100%;
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                        margin-bottom: 5px;
                    }

                    .no-refund {
                        margin-top: 100px;
                        color: #000;
                        width: 100%;
                        text-align: center;
                    }
                </style>

                <div class="right">

                    <div class="calendar">
                        <div class="month">
                            <i class="fas fa-angle-left prev"></i>
                            <div class="date">february 2024</div>
                            <i class="fas fa-angle-right next"></i>
                        </div>
                        <div class="weekdays">
                            <div>Sun</div>
                            <div>Mon</div>
                            <div>Tue</div>
                            <div>Wed</div>
                            <div>Thu</div>
                            <div>Fri</div>
                            <div>Sat</div>
                        </div>
                        <div class="days"></div>

                    </div>

                    <div class="display-orders">
                        <div class="today-date">
                            <div class="event-day"></div>
                            <div class="event-date"></div>
                        </div>
                        <div class="events"></div>

                    </div>

                    <!-- refund orders list -->
                    <div class="container-refund-list">
                        <div class="order">
                            <div class="head">
                                <h3>Cancelled Order To Refund</h3>
                                <hr>
                            </div>

                            <?php
                            if (!empty($refund_list)) {
                                foreach ($refund_list as $key => $value) {

                            ?>
                                    <div class="refund-list <?= $value->pay_type ?>">
                                        <div id="re-top-content">
                                            <div id="re-order-id">
                                                <p>Order ID : &nbsp;</p>
                                                <p>ORD-<?= $value->order_id ?></p>
                                            </div>
                                            <div id="re-order-paid">
                                                <p>Paid : &nbsp;</p>
                                                <p><b><?= ucfirst($value->pay_type) ?></b></p>
                                            </div>
                                        </div>
                                        <div id="re-bot-content">Refund amount (LKR.) :

                                            <?php
                                            if ($value->pay_type == 'full')
                                                echo number_format($value->total_price, 2, '.', ',');
                                            
                                            else if ($value->pay_type == 'half')
                                                echo number_format($value->remaining_payment, 2, '.', ',');

                                            ?>
                                        </div>

                                    </div>
                                <?php
                                }
                            } else { ?>
                                <p class="no-refund">No Refund Orders available...</p>
                            <?php
                            }


                            ?>

                        </div>
                    </div>

                    <!-- garment for payed amount list -->
                    <div class="container-refund-list">
                        <div class="order">
                            <div class="head">
                                <h3>Garment For Payed</h3>
                            </div>

                            <?php
                            if (!empty($refund_list)) {
                                foreach ($refund_list as $key => $value) {

                            ?>
                                    <div class="refund-list <?= $value->pay_type ?>">
                                        <div id="re-top-content">
                                            <div id="re-order-id">
                                                <p>Order ID : &nbsp;</p>
                                                <p>ORD-<?= $value->order_id ?></p>
                                            </div>
                                            <div id="re-order-paid">
                                                <p>Paid : &nbsp;</p>
                                                <p><b><?= ucfirst($value->pay_type) ?></b></p>
                                            </div>
                                        </div>
                                        <div id="re-bot-content">Refund amount (LKR.) :

                                            <?php
                                            if ($value->pay_type == 'full')
                                                echo number_format($value->total_price, 2, '.', ',');
                                            
                                            else if ($value->pay_type == 'half')
                                                echo number_format($value->remaining_payment, 2, '.', ',');

                                            ?>
                                        </div>

                                    </div>
                                <?php
                                }
                            } else { ?>
                                <p class="no-refund">No Refund Orders available...</p>
                            <?php
                            }


                            ?>

                        </div>
                    </div>

                </div>
                <!-- <div class="right">
                    <div class="today-date">
                    <div class="event-day">wed</div>
                    <div class="event-date">12th december 2022</div>
                    </div>
                    <div class="events"></div>
                    <div class="add-event-wrapper">
                    <div class="add-event-header">
                        <div class="title">Add Event</div>
                        <i class="fas fa-times close"></i>
                    </div>
                    <div class="add-event-body">
                        <div class="add-event-input">
                        <input type="text" placeholder="Event Name" class="event-name" />
                        </div>
                        <div class="add-event-input">
                        <input
                            type="text"
                            placeholder="Event Time From"
                            class="event-time-from"
                        />
                        </div>
                        <div class="add-event-input">
                        <input
                            type="text"
                            placeholder="Event Time To"
                            class="event-time-to"
                        />
                        </div>
                    </div>
                    <div class="add-event-footer">
                        <button class="add-event-btn">Add Event</button>
                    </div>
                    </div>
                </div> -->
                <!-- <button class="add-event">
                    <i class="fas fa-plus"></i>
                </button>
                </div> -->

            </div>

        </div>
    </section>
    <script src="https://unpkg.com/jspdf-invoice-template@latest/dist/index.js" type="text/javascript"></script>


    <script>
        var customerOrders = <?php echo json_encode($data['customerOrder']) ?>;
        // console.log(customerOrders);
        var comp_report_endpoint = "<?= ROOT ?>/manager/genarate/report";
        var emp_id = <?= $_SESSION['USER']->emp_id ?>;
        var emp_name = "<?= ucfirst($_SESSION['USER']->emp_name) ?>";
        var contact_number = "<?= $_SESSION['USER']->contact_number ?>";

        let salesProgressEndValue = "<?= (!empty($overview['sales']['sales_percentage'])) ? $overview['sales']['sales_percentage'] : "0" ?>",
            completedProgressEndValue = "<?= (!empty($overview['sales']['completed_percentage'])) ? $overview['sales']['completed_percentage'] : "0" ?>";
    </script>

    <script src="<?= ROOT ?>/assets/js/manager/report_genaration.js"></script>

    <script src="<?= ROOT ?>/assets/js/manager/overview.js"></script>
    <script>
        // let editMaterial = document.querySelector(".edit-material-btn");

        function addMaterialCard(name, quantity, price, ppm, id) {
            var newCard = document.createElement("div");
            newCard.className = "orders card";


            newCard.innerHTML = `
                <button class="delete-material-btn" data-id="${id}" onclick="openDeleteMaterial(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <div class="middle">
                    <div class="left">
                        <h3>${name}</h3>
                        <h1>${quantity} Kg</h1>
                        <p>Rs. ${price} per Kg</p>

                    </div>
                    <button class="update-btn" data-name="${name}" data-quantity="${quantity}" data-price="${price}" data-id="${id}" data-ppm="${ppm}" onclick="openUpdateMaterial(this)">Update</button>
                </div>
            `;

            if(quantity < 2){
                newCard.style.backgroundColor = "rgba(255, 0, 0, 0.2)";
            }else if(quantity < 5){
                newCard.style.backgroundColor = "rgba(255, 255, 0, 0.2)";
            }

            document.querySelector(".add.card").before(newCard);

            let deleteMaterial = newCard.querySelector(".delete-material-btn");
            let updateBtn = newCard.querySelector(".update-btn");

            editMaterial.addEventListener("click", function() {
                deleteMaterial.classList.toggle("open-delete-material-btn");
                updateBtn.classList.toggle("open-update-btn");
            });

            // updateBtn.onclick = function () {
            //     updateMaterial.style.display = "block";
            //     document.body.style.overflow = "hidden";
            // }

            // deleteMaterial.onclick = function () {
            //     document.getElementById("deleteConfirmation").style.display = "block";
            //     document.body.style.overflow = "hidden";

            // }

            // var deleteMaterialSuccess = <?php echo $data['deleteMaterial'] ?>;
            // console.log(deleteMaterialSuccess);
            // if(deleteMaterialSuccess){
            //     newCard.remove();
            // }

        }

        function addPrintingTypeCard(printingType, price, materialsJson, id) {
            var newCard = document.createElement("div");
            newCard.className = "orders card";

            newCard.innerHTML = `
                <button class="delete-printingType-btn" data-id="${id}" onclick="openDeletePrintingType(this)">
                    <i class="fa fa-trash"></i>
                </button>
                <div class="middle">
                    <div class="left">
                        <h3>${printingType}</h3>
                        <p>Rs. ${price}</p>
                    </div>
                    <button class="update-btn" data-printingType="${printingType}" data-price="${price}" data-materials='${materialsJson}' data-id="${id}" onclick="openUpdatePrintingType(this)">Update</button>
                </div>
            `;


            document.querySelector(".printingType .add.card").before(newCard);

            let deletePrintingType = newCard.querySelector(".delete-printingType-btn");
            let updateBtn = newCard.querySelector(".update-btn");

            editPrintingType.addEventListener("click", function() {
                deletePrintingType.classList.toggle("open-delete-printingType-btn");
                updateBtn.classList.toggle("open-update-btn");
            });

            // updateBtn.onclick = function () {
            //     updateMaterial.style.display = "block";
            //     document.body.style.overflow = "hidden";
            // }

            // deleteMaterial.onclick = function () {
            //     document.getElementById("deleteConfirmation").style.display = "block";
            //     document.body.style.overflow = "hidden";

            // }

            var deletePTypeSuccess = <?php echo $data['deletePType'] ?>;
            console.log(deletePTypeSuccess);
            if (deletePTypeSuccess) {
                newCard.remove();
            }

        }


        <?php foreach ($data['materialStock'] as $material) : ?>
            addMaterialCard('<?php echo $material->material_type ?>', '<?php echo $material->quantity ?>', '<?php echo $material->unit_price ?>', '<?php echo $material->ppm ?>', '<?php echo $material->stock_id ?>');
        <?php endforeach; ?>

        <?php foreach ($data['printingType'] as $printingType) : ?>
            <?php $materialsJson = json_encode($data['materialPrintingType'][$printingType->ptype_id]); ?>
            addPrintingTypeCard('<?php echo $printingType->printing_type ?>', '<?php echo $printingType->price ?>', '<?php echo $materialsJson ?>', '<?php echo $printingType->ptype_id ?>');
        <?php endforeach; ?>
    </script>




    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // daily revenue proccess
        let revenue_data = <?php echo (!empty($chart_analysis_data['total_sales'])) ? json_encode($chart_analysis_data['total_sales']) : "0" ?>;
        let cost_sales_data = <?php echo (!empty($chart_analysis_data['cost_sales'])) ? json_encode($chart_analysis_data['cost_sales']) : "0" ?>;
        let remaining_payment_data = <?php echo (!empty($chart_analysis_data['remaining_payment'])) ? json_encode($chart_analysis_data['remaining_payment']) : "0" ?>;

        // monthly revenue proccess
        let monthly_revenue_data = <?php echo (!empty($chart_analysis_data['monthly_revenue'])) ? json_encode($chart_analysis_data['monthly_revenue']) : "0" ?>;
        let monthly_cost_data = <?php echo (!empty($chart_analysis_data['monthly_cost'])) ? json_encode($chart_analysis_data['monthly_cost']) : "0" ?>;


        var chart;

        var dates = {};
        var cost_dates = {};
        var remaining_payment_dates = {};

        var monthly_cost_dates = {};
        var monthly_revenue_dates = {};

        var today_date = new Date();
        //avoid time
        today_date.setHours(0, 0, 0, 0);

        for (var i = 0; i <= 20; i++) {

            var get_date = new Date();
            get_date.setDate(today_date.getDate() - i);

            // format the date in 'YYYY-MM-DD' 
            var key = get_date.toISOString().slice(0, 10);

            // initial value is 0
            dates[key] = 0;
            cost_dates[key] = 0;
            remaining_payment_dates[key] = 0;

            // month object creation only added with 12 months
            if (i < 12) {

                let month = get_date.getMonth() - i;
                let year = get_date.getFullYear();

                if (month < 0) {
                    month += 12;
                    year -= 1;
                }

                let monthKey = `${year}-${(month + 1).toString().padStart(2, '0')}`;

                monthly_cost_dates[monthKey] = 0;
                monthly_revenue_dates[monthKey] = 0;
            }
        }

        console.log(monthly_cost_dates);
        console.log(monthly_revenue_data);


        //daily chart data add for each js include elements 
        // revenue data
        Object.keys(revenue_data).forEach(element => {

            if (dates[element] != undefined)
                dates[element] = revenue_data[element]

        });

        // cost data
        Object.keys(cost_sales_data).forEach(element => {

            if (cost_dates[element] != undefined)
                cost_dates[element] = cost_sales_data[element]

        });

        // remaining payment data
        Object.keys(remaining_payment_data).forEach(element => {

            if (remaining_payment_dates[element] != undefined)
                remaining_payment_dates[element] = remaining_payment_data[element]

        });

        //monthly chart data add for each js include elements
        // array for used ouer backend data array name
        Object.keys(monthly_cost_data).forEach(element => {

            if (monthly_cost_dates[element] != undefined)
                monthly_cost_dates[element] = monthly_cost_data[element];

            if (monthly_revenue_dates[element] != undefined)
                monthly_revenue_dates[element] = monthly_revenue_data[element];
        });

        var salesValuesArray = Object.values(dates).reverse();
        var costValuesArray = Object.values(cost_dates).reverse();
        var remainingValuesArray = Object.values(remaining_payment_dates).reverse();

        var monthlyRevenueValuesArray = Object.values(monthly_revenue_dates).reverse();
        var monthlyCostValuesArray = Object.values(monthly_cost_dates).reverse();

        // console.log(remainingValuesArray);

        // check chart data all are zeros or not when zeros then display hide
        if (areAllValuesZero(salesValuesArray)) {

        }


        function changeToDaily() {
            var options = {
                series: [{
                        name: 'Daily Revenue',
                        data: salesValuesArray,
                        color: '#008FFB',
                    },
                    {
                        name: 'Daily Remaining Payments',
                        data: remainingValuesArray,
                        color: '#7d2ae8',
                    },
                    {
                        name: 'Daily Cost',
                        data: costValuesArray,
                        color: '#12d300',
                    }
                ],
                chart: {
                    height: 350,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                xaxis: {
                    type: 'category',
                    categories: Array.from({
                        length: 20
                    }, (_, i) => {
                        let currentDate = new Date();

                        // alert(currentDate);
                        currentDate.setDate(currentDate.getDate() - (20 - i));
                        return currentDate.toLocaleDateString('en-US', {
                            month: 'short',
                            day: '2-digit'
                        });
                    }),

                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
                grid: {
                    show: true,
                }
            };

            if (chart) {
                chart.destroy();
            }

            chart = new ApexCharts(document.querySelector(".chart"), options);
            chart.render();
        }

        function changeToMonthly() {
            var options = {
                series: [{
                        name: 'Monthly Revenue',
                        data: monthlyRevenueValuesArray,
                        color: '#7d2ae8',
                    },
                    {
                        name: 'Monthly Cost',
                        data: monthlyCostValuesArray,
                        color: '#000000',
                    }
                ],
                chart: {
                    height: 345,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                xaxis: {
                    type: 'category',
                    categories: getPast12Months(),

                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
                grid: {
                    show: true,
                }
            };

            if (chart) {
                chart.destroy();
            }

            chart = new ApexCharts(document.querySelector(".chart"), options);
            chart.render();
        }

        changeToMonthly();

        function areAllValuesZero(object) {
            for (let key in object) {
                if (object.hasOwnProperty(key) && object[key] !== 0) {
                    return false;
                }
            }
            return true;
        }

        function getPast12Months() {
            let months = [];
            let currentDate = new Date();

            for (let i = 0; i < 12; i++) {
                let month = currentDate.getMonth() - i;
                let year = currentDate.getFullYear();

                if (month < 0) {
                    month += 12;
                    year -= 1;
                }

                let monthName = new Date(year, month, 1).toLocaleString('default', {
                    month: 'short'
                });
                months.unshift(monthName);
            }

            return months;
        }
    </script>

    <script>
        let successData = {
            "success_no": <?= $success_no ?>,
            "flag": <?= $flag ?>,
            "success": "<?= $success ?>",
        }
        let dataValidate = {
            "flag": <?= $flag ?>,
            "error_no": <?= $error_no ?>
        }
    </script>

    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>


    <!-- Import JQuary Library script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</body>

</html>