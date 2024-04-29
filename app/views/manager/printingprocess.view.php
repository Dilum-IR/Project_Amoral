<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/printingprocess.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager</title>
</head>
<body>

    <?php
    // include "loading.php";
    // include __DIR__ . '/../utils/toastMsg.php';
    ?>

    <?php include_once 'sidebar.php' ?>
    <?php include_once 'navigationbar.php' ?>

    <section id="main" class="main">
        <div class="success-msg"></div>

        <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <i class='bx bx-chevron-right'></i>
                <li>
                    <a href="#" class="active">Printing Process</a>
                </li>

        </ul>

        <div class="table">
            <!-- Add buttons for the two types -->
            <div class="filters">
                <button id="all" class="active" onclick="filterTable('all')">All Orders</button>
                <button id="pending" onclick="filterTable('cut')">Pending Orders</button>
                <button id="printing" onclick="filterTable('printing')">Printing Orders</button>
                <button id="printed" onclick="filterTable('printed')">Printed Orders</button>
            </div>
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Order Id  <i class='bx bx-down-arrow-circle'></i></th>
                            <!-- <th>User Id  <i class='bx bx-down-arrow-circle'></i></th> -->
                            <th>Printing Type  <i class='bx bx-down-arrow-circle'></i></th>
                            <th>Material(s) <i class='bx bx-down-arrow-circle'></i></th>
                            <th>Quantity  <i class='bx bx-down-arrow-circle'></th>
                            <th>Dispatch Date  <i class='bx bx-down-arrow-circle'></i></th>
                            <th>Status  <i class='bx bx-down-arrow-circle'></i></th>
                            <th class="null"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x = 0; ?>
                        <?php if(!empty($data['orders'])): ?>
                            <?php foreach($data['orders'] as $order): ?>
                                <?php if($order->order_id !== null && ($order->status == 'sent to company')): ?>
                                    <?php $x++; ?>
                                    
                                    <?php $material = array(); ?>
                                <tr>
                                    <td class="ordId">ORD-<?php echo $order->order_id; ?></td>
                                    <!-- <td><?php echo $order->user_id; ?></td> -->
                                    <td>
                                        <?php foreach($data['printing_types'] as $ptype): 
                                            if($order->order_id == $ptype->order_id ): ?>
                                                <?php echo $ptype->printing_type; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <?php $material_types = array(); ?>
                                        <?php foreach($data['material_sizes'] as $sizes):?>
                                            <?php if($sizes->order_id == $order->order_id) :?>
                                                <?php $material[] = $sizes;?>
                                                <?php $material_types[] = $sizes->material_type; ?>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                        <?php $distinct_types = array_unique($material_types); ?>
                                        <?php foreach($distinct_types as $type): ?>
                                            <?php echo $type; ?><br>
                                        <?php endforeach; ?>
                                    </td>
                                    <td class="desc">
                                        <?php $total = 0; ?>
                                        <?php foreach($data['material_sizes'] as $sizes):?>
                                            <?php if($sizes->order_id == $order->order_id) :?>
                                                <?php $total += $sizes->xs + $sizes->small + $sizes->medium + $sizes->large + $sizes->xl + $sizes->xxl ?>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                        <?php echo $total; ?>
                                    </td>
                                    <td><?php echo $order->dispatch_date ?></td>
                                    <td class="st">
                                        <div class="text-status <?php echo $order->order_status?>"><?php echo $order->order_status ?></div>
                                        <div class="progress-bar"></div>
                                    </td>
                                
                                    <td>
                                        <button type="submit" name="selectItem" class="view-order-btn" data-order='<?= json_encode($order); ?>' data-material='<?= json_encode($material); ?>' data-customers='<?= json_encode($data['customers']) ?>' onclick="openView(this)" ><i class="fas fa-edit"></i> View</button>
                                        <button type="submit" name="selectItem" class="update-btn" id="table-status-btn<?= $order->order_id ?>" data-order='<?= json_encode($order); ?>' onclick="status_update_method(this)">Update Status</button>
                                    
                                    </td>
                                    <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                                </tr>

                                
                                <?php endif; ?>	
                            <?php endforeach; ?>
                            <?php if($x == 0): ?>
                                <tr>
                                    <td colspan="8">No orders to display</td>
                                </tr>
                            <?php endif; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No orders to display</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="popup-view" id="popup-view">
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
        <div class="popup-content">
        <span class="close">&times;</span>
        <h2>Order Details</h2>
        
        <form class="update-form" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <button type="button" class="download">Download</button>

                        <embed name="design" type="application/pdf" style="display: none; width: 250px; height: 249px; margin-bottom:0.8rem; background-color:white; border-radius:10px;">
                        
                        <div class="carousel" >
                            <button class="carousel-left-btn" id="prevBtn">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                            <div id="carouselImages" style="width: 50%; left: -90px; position: relative;">
                                <!-- Carousel images will be populated here -->
                            </div>
                            <button class="carousel-right-btn" id="nextBtn">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                    <div class="input-box">
                        <span class="details">Order ID </span>
                        <input name="order_id" type="text" required onChange="" readonly value="" />
                    </div>
                    <div class="input-box" style="height: 0;">

                    </div>
                    <div class="input-box placedDate">
                        <span class="details">Order Placed On</span>
                        <input name="order_placed_on" type="text" required onChange="" readonly value="" />
                    </div>

                    <input name="order_status" type="hidden" required onChange="" readonly value="" />

                </div>
                
                <div class="add card"></div>

                <hr class="second">


                <div style="display: flex;text-align: center;flex-direction: column;padding: 5px;">
                    <h3>Customer Details</h3>
                </div>

                <div class="user-details customer">
                    <div class="input-box">
                        <span class="details">Customer ID</span>
                        <input name="id" type="text" readonly  />
                    </div>
                    <div class="input-box">
                        <span class="details">Customer Name</span>
                        <input name="fullname" type="text" readonly  />
                    </div>
                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input name="phone" type="text" readonly  />
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input name="email" type="email" readonly />
                    </div>
                </div>


                <hr class="second">

                <div class="user-details pickup">
                    <div class="input-box">
                        <span class="details">Pick Up Date</span>
                    
                        <input type="text" name="dispatch_date_pickup" >
                    </div>
                </div>     
                
            </div>
        </form>
    </div>
</section>

    <script>
        // var baseUrl = "<?php echo ROOT . '/uploads/designs/'; ?>";
        var change_status_endpoint = "<?php echo ROOT . '/manager/updateOrderStatus'; ?>";
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/manager/printingprocess.js"></script>
        <script src="<?= ROOT ?>/assets/js/toast.js"> </script>
    <?php
    include 'status_confirm_popup.php'
    ?>
</body>
</html>
