<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta http-equiv="refresh" content="2; url=<?= ROOT ?>/garment/overview"> -->

    <!-- hard refresh -->
    <!-- ctrl+ F5 -->

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
                        <!-- <a href="" class="btn-download">
                            <i class='bx bxs-cloud-download'></i>
                            <span class="text">Download PDF</span>
                        </a> -->
                    </div>
                    <!-- Navigation path -->

                    <!-- Anlysis Containers -->
                    <!-- <ul class="box-info">
                    <li>
                        <i class='bx bxs-calendar-check'></i>
                        <span class="text">
                            <h3>1020</h3>
                            <p>New Order</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-group'></i>
                        <span class="text">
                            <span class="data-precentage">

                                <h3>2834</h3>
                               
                                <i class='bx bxs-down-arrow'></i>
                            </span>
                            <p>Pending</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-dollar-circle'></i>
                        <span class="text">
                            <h3>$2543</h3>
                            <p>Total Sales</p>
                        </span>
                    </li>
                    <li>
                        <i class='bx bxs-dollar-circle'></i>
                        <span class="text">
                            <h3>$2543</h3>
                            <p>Total Sales</p>
                        </span>
                    </li>
              </ul> -->

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
                                            Cancel Orders :&nbsp;&nbsp;&nbsp;<?= (!empty($overview['sales']['current_sewed'])) ? $overview['sales']['current_sewed'] : "0" ?>
                                        </b></small>
                                </div>
                                <div class="container">
                                    <div class="circular-progress" id="completed-orders">
                                        <span class="progress-value" id="completed-orders-num">0%</span>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">From last month</small>
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
                            <small class="text-muted">From last month</small>
                        </div>
                    </div>

                    <!-- Anlysis Containers -->

                    <div class="table-data">

                        <!-- left side container -->
                        <div class="order">
                            <div class="head">
                                <h3>Recent Orders</h3>
                                <a id="info-btn-1" class="info-btn" href="<?= ROOT ?>/garment/orders">View All</a>
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

                                                <td><?= $item->order_id ?></td>
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
                                                        <?php echo ucfirst($item->status) ?></span></td>
                                            </tr>
                                    <?php
                                        }
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
                                        <i class='bx bx-objects-vertical-center'></i>
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
        endpoint = "<?= ROOT ?>/garment/update_info";

        let salesProgressEndValue = "<?= (!empty($overview['sales']['sales_percentage'])) ? $overview['sales']['sales_percentage'] : "0" ?>",
            completedProgressEndValue = "<?= (!empty($overview['sales']['completed_percentage'])) ? $overview['sales']['completed_percentage'] : "0" ?>";
    </script>

    <script src="<?= ROOT ?>/assets/js/garment/garment-overview.js"> </script>

    <!-- Import JQuary Library script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
</body>

</html>