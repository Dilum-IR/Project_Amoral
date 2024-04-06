<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta http-equiv="refresh" content="2; url=<?= ROOT ?>/garment/overview"> -->

    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/overview.css">
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
                                        <h1><?php echo $count ?></h1>

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
                                        <h1>Rs. <?php echo $total ?></h1>
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
                                        <h1>Rs. <?php echo $rem ?></h1>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <!-- Anlysis Containers -->



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
                                                            <?php echo $order->order_id ?>
                                                        </td>
                                                        <td><?php echo $order->order_placed_on ?></td>
                                                        <td>
                                                            <?php foreach ($data['material_sizes'] as $sizes) : ?>
                                                                <?php if ($sizes->order_id == $order->order_id) : ?>

                                                                    <?php echo $sizes->material_type ?><br>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </td>
                                                        <td class="status">
                                                            <i class='bx bxs-circle <?php echo $order->order_status ?>' style="font-size: 12px;"></i>
                                                            <div>
                                                                <?php echo $order->order_status ?>
                                                            </div>
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


    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
</body>

</html>