<!DOCTYPE html>
<html lang="en">

<head>

    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/garment/overview.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>
    <?php

    $flag = htmlspecialchars($_GET['flag'] ?? 2);
    $success_no = htmlspecialchars($_GET['success_no'] ?? 0);
    $success = htmlspecialchars($_GET['success'] ?? 0);

    $error_no = htmlspecialchars($_GET['error_no'] ?? 0);

    // include "loading.php";
    include __DIR__ . '/../utils/toastMsg.php';
    ?>

    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->

    <!-- Content -->
    <section id="main" class="main">

        <div class="content">

            <nav class="sub-nav">
                <a href="" class="nav-link">Garment</a>
                <!-- <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form> -->
            </nav>

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
                    </div>
                    <!-- Navigation path -->

                    <div class="insights">
                        <div class="orders">
                            <i class='bx bxs-calendar-check'></i>

                            <div class="firstmiddle middle">
                                <div>
                                    <div class="left">

                                        <h3 class="text-muted"> Pending Orders </h3> &nbsp;
                                        <h1><?= (!empty($overview['sales']['current_pending'])) ? $overview['sales']['current_pending'] : "0" ?>
                                        </h1>
                                    </div>
                                    <div class="left">
                                        <h3>Current Orders </h3> &nbsp;&nbsp;&nbsp;
                                        <h1><?= (!empty($overview['current'])) ? $overview['current'] : "0" ?></h1>
                                    </div>
                                </div>
                                <div class="order-stat">
                                    <small class="text-muted"><b>
                                            Cutting Orders :&nbsp;&nbsp; <?= (!empty($overview['sales']['current_cutting'])) ? $overview['sales']['current_cutting'] : "0" ?>
                                        </b></small>
                                    <small class="text-muted"><b>
                                            Sewing Orders :&nbsp;&nbsp;&nbsp;<?= (!empty($overview['sales']['current_sewed'])) ? $overview['sales']['current_sewed'] : "0" ?>
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
                                        <h3>Total Sales</h3> &nbsp;&nbsp;
                                        <h1>LKR <?= number_format((!empty($overview['sales']['total_sales'])) ? $overview['sales']['total_sales'] : "0", 2, '.', ',') ?></h1>
                                    </div>
                                    <small class="text-muted"><b>
                                            Cutting Sales : &nbsp;&nbsp; LKR <?= number_format((!empty($overview['sales']['total_cutting'])) ? $overview['sales']['total_cutting'] : "0", 2, '.', ',') ?>
                                        </b></small>
                                    <small class="text-muted"><b>
                                            Sewing Sales : &nbsp;&nbsp;&nbsp;LKR <?= number_format((!empty($overview['sales']['total_sewed'])) ? $overview['sales']['total_sewed'] : "0", 2, '.', ',') ?>
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

                    <style>
                        .order {
                            background-color: white !important;
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
                            border-radius: 36px;
                            align-items: center;
                            justify-content: center;
                            /* grid-gap: 8px; */
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
                            height: 170px;
                            display: flex;
                            gap: 90px;
                            /* margin-bottom: 20px; */
                            align-items: center;
                            /* justify-content: space-around; */

                        }

                        .lable-and-date {
                            /* width: 100%; */
                            /* height: 100px; */
                            margin-left: 20px;
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

                        .text-warning {
                            color: green;
                            font-weight: 700;
                            font-size: 18px;
                            margin-bottom: 10px;
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

                        #gen {
                            margin-left: 10px;
                        }

                        .bx-x {
                            font-size: 25px;
                            cursor: pointer;
                        }

                        .report-title {

                            margin-left: 20px;
                            margin-top: 20px;

                            span {
                                color: red;
                            }
                        }
                    </style>

                    <!-- Anlysis Containers -->

                    <div class="table-data">

                        <!-- left side container -->
                        <div class="order">
                            <div class="head">
                                <h3>Sales</h3>
                                <button class="chart-more-btn info-btn" onclick="changeToDaily()">Daily</button>
                                <button class="chart-more-btn info-btn" onclick="changeToMonthly()">Monthly</button>
                            </div>
                            <div class="chart">

                            </div>

                            <hr>
                            <div class="head re-head">
                                <h3>Genarate Your Reports</h3>

                            </div>
                            <p class="report-title"><span>*</span> Select Date Range </p>

                            <div class="report-gen-container">
                                <div class="lable-and-date">
                                    <label class="label" for="">From Date</label>
                                    <input id="start_date" class="rep-gen-date" type="date" value="" min="<?php $regi_date = new DateTime($info->register_date);
                                                                                                            echo $regi_date->format('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">
                                    <label for="" class="label to-date">To Date</label>
                                    <input id="end_date" class="rep-gen-date" type="date" min="<?php $regi_date = new DateTime($info->register_date);
                                                                                                echo $regi_date->format('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="warn-with-btns">
                                    <p class="text-warning" id="message"></p>

                                    <button disabled class="btn-download" id="gen" onclick="generatePDF()">
                                        <i class='bx bxs-cloud-download'></i>
                                        <span class="text">Genarate Report</span>
                                    </button>

                                    <button class="view-btn btn-download after-gen-btn" id="view" onclick="viewPDF()" style="display: none;">View</button>
                                    <button class="download-btn btn-download after-gen-btn" id="down" onclick="downloadBlob()" style="display: none;">Download</button>

                                </div>

                            </div>
                            <hr>
                            <div class="head">
                                <h3>Recent Orders</h3>
                                <a id="info-btn-1" class="info-btn" href="<?= ROOT ?>/garment/orders">All Orders</a>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Total Qty</th>
                                        <th><small>Cut Date / </br>
                                                Sewed Date
                                            </small> </th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (!empty($data['recent_orders'])) {

                                        // show($data);
                                        foreach ($recent_orders as $key => $item) {
                                    ?>
                                            <tr>

                                                <td>ORD-<?= $item->order_id ?></td>
                                                <td><?= $item->total_qty ?></td>
                                                <td><?= $item->cut_dispatch_date ?> <br> <small><?= $item->sew_dispatch_date ?> </small></td>

                                                <td class="st"><span class="text-status <?= $item->status ?>">
                                                        <?php if ($item->status == "pending") { ?>
                                                            <iconify-icon icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                                                        <?php } else if ($item->status == "cutting") { ?>
                                                            <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                                                        <?php } else if ($item->status == "cut") { ?>
                                                            <iconify-icon class="status-icon" icon="tabler:cut"></iconify-icon>
                                                        <?php } else if ($item->status == "sent to company" || $item->status == "company process" || $item->status == "sent to garment" || $item->status == "returned") { ?>
                                                            <iconify-icon icon="mdi:company"></iconify-icon>
                                                        <?php } else if ($item->status == "sewing") { ?>
                                                            <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                                                        <?php } else if ($item->status == "sewed") { ?>
                                                            <iconify-icon icon="game-icons:sewing-string"></iconify-icon>
                                                        <?php } else if ($item->status == "completed") { ?>
                                                            <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                                                        <?php } ?>
                                                        <?php echo ucfirst($item->status) ?></span>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td></td>
                                            <td>

                                                No Available recent orders
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- left side container -->

                        <!-- right side container -->
                        <div class="todo">
                            <div class="head">
                                <h3>Garment information</h3>
                            </div>

                            <div class="orders">
                                <div class="middle">
                                    <div class="left">
                                        <i class='bx bx-wallet-alt'></i>
                                        <h3>Current Cuting Price</h3>
                                    </div>
                                    <div class="count">

                                        <h4>LKR </h4>
                                        <input disabled type="text" class="input-count" value="<?= number_format($info->cut_price, 2, '.', ',')  ?>">

                                    </div>
                                </div>

                            </div>
                            <div class="orders">
                                <div class="middle">
                                    <div class="left">
                                        <i class='bx bx-credit-card'></i>
                                        <h3>Current Sewed Price</h3>
                                    </div>
                                    <div class="count">

                                        <h4>LKR </h4>
                                        <input disabled type="text" class="input-count" value="<?= number_format($info->sewed_price, 2, '.', ',') ?>">

                                    </div>
                                </div>

                            </div>
                            <hr class="dotted">

                            <style>
                                .dotted {

                                    border: none;
                                    border-top: 3px dotted rgba(0, 0, 0, 0.597);
                                    height: 1px;
                                    margin-bottom: 15px;

                                }
                            </style>

                            <div class="orders">
                                <div class="middle">
                                    <div class="left">
                                        <i class='bx bx-objectects-vertical-center'></i>
                                        <h3>Daily capacity</h3>

                                    </div>
                                    <div class="count">
                                        <i id="d-cap-up" class='bx bx-caret-up-circle up'></i>

                                        <input id="g-capacity" type="number" class="input-count" value="<?= $info->day_capacity ?>">
                                        <i id="d-cap-down" class='bx bx-caret-down-circle down'></i>
                                    </div>
                                </div>

                            </div>

                            <div class="orders">
                                <div class="middle">
                                    <div class="left">
                                        <i class='g-info bx bx-group'></i>
                                        <h3>No. of workers</h3>

                                    </div>
                                    <div class="count">
                                        <i id="n-work-up" class='bx bx-caret-up-circle up'></i>

                                        <input id="g-workers" type="number" class="input-count" value="<?= $info->no_workers ?>">
                                        <i id="n-work-down" class='bx bx-caret-down-circle down'></i>
                                    </div>
                                </div>

                            </div>

                            <button id="info-btn" class="info-btn">Update</button>

                        </div>



                    </div>

                </main>

            </div>

        </div>
    </section>

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

    <script>
        const endpoint = "<?= ROOT ?>/garment/update_info";
        const report_endpoint = "<?= ROOT ?>/garment/genarate/report";

        const garment_id = <?= $_SESSION['USER']->emp_id ?>;
        const garment_name = "<?= $_SESSION['USER']->emp_name ?>";
        const contact_number = "<?= $_SESSION['USER']->contact_number ?>";

        let salesProgressEndValue = "<?= (!empty($overview['sales']['sales_percentage'])) ? $overview['sales']['sales_percentage'] : "0" ?>",
            completedProgressEndValue = "<?= (!empty($overview['sales']['completed_percentage'])) ? $overview['sales']['completed_percentage'] : "0" ?>";
    </script>

    <script src="<?= ROOT ?>/assets/js/garment/garment-overview.js"> </script>
    <script src="<?= ROOT ?>/assets/js/garment/report_genaration.js"> </script>

    <!-- Import JQuary Library script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        // daily revenue proccess
        let revenue_data = <?= (!empty($chart_analysis_data['total_sales'])) ? json_encode($chart_analysis_data['total_sales']) : "0" ?>;
        let cutting_data = <?= (!empty($chart_analysis_data['cut_sales'])) ? json_encode($chart_analysis_data['cut_sales']) : "0" ?>;
        let sewed_data = <?= (!empty($chart_analysis_data['sewed_sales'])) ? json_encode($chart_analysis_data['sewed_sales']) : "0" ?>;

        // monthly revenue proccess
        let monthly_revenue_data = <?= (!empty($chart_analysis_data['monthly_revenue'])) ? json_encode($chart_analysis_data['monthly_revenue']) : "0" ?>;
        let monthly_qty_data = <?= (!empty($chart_analysis_data['monthly_qty'])) ? json_encode($chart_analysis_data['monthly_qty']) : "0" ?>;


        var chart;

        var dates = {};
        var cutting_dates = {};
        var sewed_dates = {};

        var monthly_qty_dates = {};
        var monthly_revenue_dates = {};

        var today = new Date();
        //avoid time
        today.setHours(0, 0, 0, 0);

        for (var i = 0; i < 20; i++) {

            var date = new Date();
            date.setDate(today.getDate() - i);

            // format the date in 'YYYY-MM-DD' 
            var key = date.toISOString().slice(0, 10);

            // initial value is 0
            dates[key] = 0;
            cutting_dates[key] = 0;
            sewed_dates[key] = 0;

            // month object creation only added with 12 months
            if (i < 12) {

                let month = date.getMonth() - i;
                let year = date.getFullYear();

                if (month < 0) {
                    month += 12;
                    year -= 1;
                }

                let monthKey = `${year}-${(month + 1).toString().padStart(2, '0')}`;

                monthly_qty_dates[monthKey] = 0;
                monthly_revenue_dates[monthKey] = 0;
            }
        }

        Object.keys(revenue_data).forEach(element => {

            if (dates[element] != undefined)
                dates[element] = revenue_data[element]

            if (cutting_dates[element] != undefined)
                cutting_dates[element] = cutting_data[element]

            if (sewed_dates[element] != undefined)
                sewed_dates[element] = sewed_data[element]

        });

        Object.keys(monthly_qty_data).forEach(element => {

            if (monthly_qty_dates[element] != undefined)
                monthly_qty_dates[element] = monthly_qty_data[element]

            if (monthly_revenue_dates[element] != undefined)
                monthly_revenue_dates[element] = monthly_revenue_data[element]
        });


        var salesValuesArray = Object.values(dates).reverse();
        var cuttingValuesArray = Object.values(cutting_dates).reverse();
        var sewedValuesArray = Object.values(sewed_dates).reverse();

        var revenueValuesArray = Object.values(monthly_revenue_dates).reverse();
        var qtyValuesArray = Object.values(monthly_qty_dates).reverse();

        console.log(revenueValuesArray);
        console.log(qtyValuesArray);

        // check chart data all are zeros or not when zeros then display hide
        if (areAllValuesZero(salesValuesArray)) {

        }


        function changeToDaily() {
            var options = {
                series: [{
                        name: 'Total Revenue',
                        data: salesValuesArray,
                        color: '#008FFB',
                    },
                    {
                        name: 'Cutting Revenue',
                        data: cuttingValuesArray,
                        color: '#7d2ae8',
                    },
                    {
                        name: 'Sewing Revenue',
                        data: sewedValuesArray,
                        color: '#12d300',
                    }
                ],
                chart: {
                    height: 350,
                    type: 'bar'
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
                        data: revenueValuesArray,
                        color: '#7d2ae8',
                    },
                    {
                        name: 'Monthly Total Qty',
                        data: qtyValuesArray,
                        color: '#000000',
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
                    categories: getPast12Months(),

                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
                grid: {
                    show: false,
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

    <script src="https://unpkg.com/jspdf-invoice-template@latest/dist/index.js" type="text/javascript"></script>

</body>

</html>