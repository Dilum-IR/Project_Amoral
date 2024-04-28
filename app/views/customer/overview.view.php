<!DOCTYPE html>
<html lang="en">

<head>

    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/overview.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collection/collection.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- toast css -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">
    <!-- loading css -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/loading.css">

    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">
</head>

<body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- loading page  & toast msg content-->
    <?php

    $flag = htmlspecialchars($_GET['flag'] ?? 2);
    $success_no = htmlspecialchars($_GET['success_no'] ?? 0);
    $success = htmlspecialchars($_GET['success'] ?? 0);

    $error_no = htmlspecialchars($_GET['error_no'] ?? 0);

    include __DIR__ . '/../utils/loading.php';
    include __DIR__ . '/../utils/toastMsg.php';

    // loading content hide when error popup times 
    ?>

    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->

    <div class="page-content">

        <!-- chat box content -->
        <?php include 'chatBox.php' ?>

        <!-- Content -->
        <section id="main" class="main">

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
                            <div class="orders card">
                                <i class='bx bxs-calendar-check'></i>
                                <div class="middle">
                                    <div class="left">
                                        <h3>Total Orders</h3>
                                        <?php
                                        $count = 0;
                                        if (!empty($data['order'])) {
                                            // show($data);
                                            foreach ($data['order'] as $order) :

                                                $count++;

                                            endforeach;
                                        }
                                        ?>
                                        <h2><?php echo $count ?></h2>

                                    </div>
                                </div>

                            </div>

                            <div class="sales card">
                                <i class='bx bxs-dollar-circle'></i>
                                <div class="middle">
                                    <div class="left">
                                        <h3>Total Value</h3>
                                        <?php
                                        $total = 0;
                                        if (!empty($data['order'])) {

                                            foreach ($data['order'] as $order) :
                                                if (!empty($data['material_sizes'])) {
                                                    foreach ($data['material_sizes'] as $sizes) :
                                                        if ($order->order_id == $sizes->order_id) :
                                                            $total += ($order->total_price);
                                                        endif;
                                                    endforeach;
                                                }
                                            endforeach;
                                        }
                                        ?>
                                        <h2>Rs. <?= number_format($total, 2, '.', ',')  ?></h2>
                                    </div>

                                </div>

                            </div>
                            <div class="sales card">
                                <i class='bx bxs-dollar-circle'></i>
                                <div class="middle">
                                    <div class="left">
                                        <h3>Remaining Payments</h3>
                                        <?php
                                        $rem = 0;
                                        if (!empty($data['order'])) {

                                            foreach ($data['order'] as $order) :
                                                $rem += $order->remaining_payment;
                                            endforeach;
                                        } ?>
                                        <h2>Rs. <?= number_format($rem, 2, '.', ',')  ?></h2>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <!-- Anlysis Containers -->
                        <div class="table-data">

                        <div class="slider-main">
                        <?php include __DIR__ . '/../collection/collection.view.php'; ?>
                        </div>
                        </div>

                        <style>
                            .slider-main{
                                height: 680px;
                                width:100%;
                                padding: 0 10px !important;
                            }
                        </style>

                        <div class="table-data">

                            <!-- left side container -->
                            <div class="order">
                                <div class="head">
                                    <h3>Recent Orders</h3>
                                    <a href="<?= ROOT ?>/customer/orders" class="view-all-btn">
                                        <?php if (!empty($data['order'])) { ?>
                                            View All
                                        <?php
                                        } else { ?>
                                            Create Order
                                        <?php }
                                        ?>
                                    </a>
                                    <!-- <button class="view-all-btn">View All</button> -->
                                </div>
                                <table>
                                    <?php if (!empty($data['order'])) { ?>

                                        <thead>
                                            <tr>
                                                <th>Order Id</th>
                                                <th>Placed Date</th>
                                                <th>Material</th>
                                                <th>Status</th>
                                                <th>Delivery Expected On</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($data['order'])) {

                                                foreach ($data['order'] as $order) : ?>

                                                    <tr>
                                                        <td>
                                                            ORD-<?php echo $order->order_id ?>
                                                        </td>
                                                        <td><?php echo $order->order_placed_on ?></td>
                                                        <td>
                                                            <?php foreach ($data['material_sizes'] as $sizes) : ?>
                                                                <?php if ($sizes->order_id == $order->order_id) : ?>

                                                                    <?php echo $sizes->material_type ?><br>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </td>

                                                        <td class="st"><span class="text-status <?= $order->order_status ?>">
                                                                <?php if ($order->order_status == "pending") { ?>
                                                                    <iconify-icon icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                                                                <?php } else if (
                                                                    $order->order_status == "cutting" ||
                                                                    $order->order_status == "sewing" ||
                                                                    $order->order_status == "cut" ||
                                                                    $order->order_status == "sewed"
                                                                ) { ?>
                                                                    <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                                                                <?php } else if ($order->order_status == "delivering") { ?>
                                                                    <iconify-icon icon="tabler:truck-delivery"></iconify-icon>
                                                                <?php } else if ($order->order_status == "delivered") { ?>
                                                                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                                                                <?php } ?>


                                                                <?php

                                                                // echo ucfirst($order->order_status) 
                                                                if (
                                                                    $order->order_status == "sewing" ||
                                                                    $order->order_status == "cutting" ||
                                                                    $order->order_status == "sewed" ||
                                                                    $order->order_status == "cut"
                                                                ) {
                                                                    echo "Processing";
                                                                } else {
                                                                    echo ucfirst($order->order_status);
                                                                }

                                                                ?></span>
                                                        </td>
                                                        <td><?php echo $order->dispatch_date ?></td>
                                                    </tr>

                                            <?php endforeach;
                                            } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        Recent No Orders Avaliable...
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>

                            <style>
                                .order tbody tr {
                                    /* background-color: gainsboro; */
                                    transition: 0.5s ease-in-out;
                                    transform: scale(1.0);

                                }

                                .order tbody tr:hover {
                                    background-color: #f3f3f3 !important;
                                    transform: scale(1.01);
                                }

                                .text-status {
                                    gap: 3px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: space-around;
                                    width: max-content;
                                }

                                .table-data .order table tr td .text-status {
                                    font-size: 15px;
                                    padding: 6px 16px;
                                    color: white;
                                    border-radius: 20px;
                                    font-weight: 500;

                                }

                                .st {
                                    text-align: -webkit-center !important;
                                }

                                .table-data .order table td {
                                    padding: 12px 0;
                                }
                            </style>
                            <!-- left side container -->

                            <!-- right side container -->

                            <!-- right side container -->
                        </div>

                    </main>

                </div>

            </div>
        </section>
    </div>

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


    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
</body>

</html>