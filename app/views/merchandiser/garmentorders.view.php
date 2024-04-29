<!DOCTYPE html>
<html lang="en">

<head>
    <title>Merchandiser</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/garment-orders.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    <!-- content  -->
    <section id="main" class="main">

        <div class="success-msg"> </div>

        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <i class='bx bx-chevron-right'></i>
            <li>
                <a href="#" class="active">Garment Orders</a>
            </li>

        </ul>

        <form>
            <div class="form">
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
				<!-- <input class="new-btn" type="button" onclick="openNew()" value="+New Order"> -->
			</div>

        </form>

        <div class="table">
            <!-- <div class="table-header">
                <p>Order Details</p>
                <div>
                    <input placeholder="order"/>
                    <button class="add_new">+ Add New</button>
                </div>
            </div> -->
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Order Id</th>	
                            <th>Garment Name</th>
                            <th>Cutting Done On</th>
                            <th>Sewing Done On</th>
                            <th>Customer Order Id</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($data['garment_orders'])): ?>
                            <?php foreach($data['garment_orders'] as $order): ?>
                                <?php if($order->emp_id =$_SESSION['USER']->emp_id) : ?>
                                <?php $materials = array(); ?>
                                <?php $customer_order; ?>
                                <?php foreach($data['material_sizes'] as $order_material): ?>
                                    <?php if($order_material->order_id == $order->order_id): ?>
                                        <?php $materials[] = $order_material; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php foreach($data['customer_orders'] as $cus_order): ?>
                                    <?php if($cus_order->order_id == $order->order_id): ?>
                                        <?php $customer_order = $cus_order; ?>
                                    
                                    <?php endif; ?>
                                    
                                <?php endforeach; ?>

                                <?php $garment_name = ''; ?>
                                <?php foreach($data['garments'] as $garment): ?>
                                    <?php if($garment->garment_id == $order->garment_id): ?>
                                        <?php $garment_name = $garment->emp_name; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <tr>
                                <td>G-ORD-<?php echo $order->garment_order_id ?></td>
                                <td><?php echo $garment_name ?></td>
                                <td><?php echo $order->cut_dispatch_date ?></td>
                                <td><?php echo $order->sew_dispatch_date ?></td>
                                <td>ORD-<?php echo $order->order_id ?> </td>
                                <td class="st">
                                    <?php
                                        switch ($order->status) {
                                            case 'sent to company':
                                                $status = 'cut';
                                                break;
                                            case 'company process':
                                                $status = 'printing';
                                                break;
                                            case 'sent to garment':
                                                $status = 'sent to stitch';
                                                break;
                                            case 'returned':
                                                $status = 'sent to stitch';
                                                break;
                                            default:
                                                $status = $order->status;
                                        }
                                    ?>
                                
                                    <div class="text-status <?php echo $status?>"><?php echo $status ?></div>
                                    <div class="progress-bar"></div>
                                </td>
                            
                                <td><button type="submit" name="selectItem" class="edit" data-order='<?= json_encode($order); ?>' data-material='<?= json_encode($materials); ?>' data-customerOrder='<?= json_encode($customer_order); ?>'  onclick="openView(this)"><i class="fas fa-edit"></i> View</button></td>
                                <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No orders to display</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>


    <!-- POPUP -->
               

    <div class="popup-view" id="popup-view">
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
        <div class="popup-content">
            <span class="close">&times;</span>
          
            <h2>Order Details</h2>
            <div class="status">

                <ul>
                    <li>
    
                        <div class="progress one">

                            <i class="uil uil-check"></i>
                        </div>
                        <p class="text"></p>
                    </li>
                    <li>
                        <iconify-icon icon="fluent-mdl2:cut"></iconify-icon>
                        <div class="progress two">

                            <i class="uil uil-check"></i>
                        </div>
                        <p class="text">Cutting</p>
                    </li>
                    <li>
        
                        <div class="progress three">

                            <i class="uil uil-check"></i>
                        </div>
                        <p class="text"></p>
                    </li>
                    <li>
                        <iconify-icon icon="game-icons:sewing-string"></iconify-icon>
                        <div class="progress four">

                            <!-- <i class="uil uil-check"></i> -->
                        </div>
                        <p class="text">Sewing</p>
                    </li>
                    <li>
                        
                        <div class="progress five">

                            <i class="uil uil-check"></i>
                        </div>
                        <p class="text"></p>
                    </li>

                </ul>

            </div>

        
            <form class="update-form" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Garment Order Id </span>
                        <input name="garment_order_id" type="text" required onChange="" readonly value="" />
                    </div>

                    <div class="input-box">
                        <span class="details">Customer Order Id </span>
                        <input name="order_id" type="text" required onChange="" readonly value="" />
                    </div>

                    <div class="input-box">
                        <span class="details">Cutting Done On</span>
                        <input name="cut_dispatch_date" type="date" required onChange="" />
                    </div>

                    <div class="input-box">
                        <span class="details">Sewing Done On</span>
                        <input name="sew_dispatch_date" type="date" required onChange=""  />
                    </div>


                    <div class="input-box">
                        <span class="details">Cutting Price(Rs.)</span>
                        <input name="cut_price" type="text" required onChange="" readonly value="" />
                    </div>

                    <div class="input-box">
                        <span class="details">Sewing Price(Rs.)</span>
                        <input name="sewed_price" type="text" required onChange="" readonly value="" />
                    </div>

                </div>

                <hr class="second">
                
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Order Placed On</span>
                        <input name="order_placed_on" type="text" required onChange="" readonly value="" />
                    </div>
                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                    
                        <input type="text" name="dispatch_date" required onChange="" readonly value="">
                    </div>
                </div>

                <hr class="second">

                <h3>Materials & Quantities </h3>

                <div class="add card"></div>
                
                <!-- hidden element -->
                <div class="input-box">
                    <!-- <span class="details">Order Id </span> -->
                    <input name="latitude" type="hidden" required />
                    <input name="longitude" type="hidden" required />
                </div>


                <!-- <form method="POST" class="popup-view" id="popup-view"> -->
                <input type="submit" class="update-btn pb" name="updateOrder" value="Update Order" />
                <button type="button" onclick="" class="cancel-btn pb">Cancel Order</button>
                <!-- </form> -->


            </form>
        </div>
    </div>
    <script>
        // ajax function for updating the order
        $('.popup-view .update-btn').click(function(e) {
            e.preventDefault();
            var garment_order_id = $('.popup-view input[name="garment_order_id"]').val();
            var cut_dispatch_date = $('.popup-view input[name="cut_dispatch_date"]').val();
            var sew_dispatch_date = $('.popup-view input[name="sew_dispatch_date"]').val();

            var order_id = $('.popup-view input[name="order_id"]').val();
            var cut_price = $('.popup-view input[name="cut_price"]').val();
            var sewed_price = $('.popup-view input[name="sewed_price"]').val();

            $.ajax({
                url: '<?= ROOT ?>/merchandiser/updateGarmentOrder',
                type: 'POST',
                data: {garment_order_id: garment_order_id, cut_dispatch_date: cut_dispatch_date, sew_dispatch_date: sew_dispatch_date, order_id: order_id, cut_price: cut_price, sewed_price: sewed_price},
                success: function(response) {
                    console.log(response);
                    sessionStorage.setItem('successMsg', 'Order updated successfully');
                    sessionStorage.setItem('id', garment_order_id);
                    location.reload();
                }
            });

        });



    </script>


    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfuuowb7aC4EO89QtfL2NQU0YO5q17b5Y&callback=initMap"></script> -->

    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    
    <script src="<?= ROOT ?>/assets/js/manager/garment-orders.js"></script>
</body>

</html>