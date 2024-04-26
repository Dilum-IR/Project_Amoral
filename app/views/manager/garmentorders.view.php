<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer</title>
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

        <div >
            <div class="garmentsCard">

                <span>Assign Orders</span>
               
                <div class="left">
                    <div class="category orders" id="pickupCategory">
                        <h3>Unassigned Orders</h3>
                        <div class="items">
                            <div class="item">
                                <p>Order Id</p>
                                <p>Quantity</p>
                            </div>
                            <?php $pendingOrders = false; ?>
                            <!-- <?php $materials = array(); ?>
                            <?php $qtys = array(); ?> -->
                            <?php if(!empty($data['garment_orders'])): ?>
                                <?php foreach($data['garment_orders'] as $order): ?>
                                    <?php if($order->status == 'pending' && $order->garment_id == null): ?>
                                        <?php $totQuantity = 0; ?>
                                        <?php $pendingOrders = true; ?>
                                        <?php foreach($data['order_material'] as $order_material): ?>
                                            <?php if($order_material->order_id == $order->order_id): ?>
                                                <!-- <?php $materials[] = intval($order_material->material_id); ?> -->
                                                <?php $qty = $order_material->xs + $order_material->small + $order_material->medium + $order_material->large + $order_material->xl + $order_material->xxl; ?>
                                                <!-- <?php $qtys[] = $qty ?> -->
                                                <?php $totQuantity += $qty ?>                                            
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php $customer_order; ?>
                                        <?php foreach($data['customer_orders'] as $cus_order): ?>
                                            <?php if($cus_order->order_id == $order->order_id): ?>
                                                <?php $customer_order = $cus_order; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <div class="draggable pending" draggable="true" id="<?php echo $order->garment_order_id ?>" data-order='<?php echo json_encode($customer_order) ?>' qty="<?php echo $totQuantity ?>" ><p>Id: <?php echo $order->garment_order_id ?></p><p>Qty: <?php echo $totQuantity ?></p></div>
                                    <?php endif;?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if(!$pendingOrders): ?>
                                <script>
                                    // document.querySelector('.item').style.display = 'none';
                                    document.querySelector('.item').innerHTML = 'No orders to display';

                                </script>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="right">
                    <?php if(!empty($data['garments'])): ?>
                        <?php foreach($data['garments'] as $garment): ?>
                            <div class="category garments" id="<?php echo $garment->garment_id ?>">
                                <h3 style="text-align: center;"><?php echo $garment->emp_name ?> - <?php echo $garment->location ?></h3><br>
                                <div style="display: flex; gap: 30px;">
                                    <div>
                                        <h4>Day Capacity: <?php echo $garment->day_capacity ?></h4>
                                        <h4>Workers: <?php echo $garment->no_workers ?></h4>

                                    </div>
                                    <div>
                                        <h4>Cutting Price: <?= $garment->cut_price; ?></h4>
                                        <h4>Sewing Price: <?= $garment->sewed_price; ?></h4>

                                    </div>

                                </div>
                                <!-- <h3></h3> -->
                                <div class="items">
                                    <div class="item">
                                        <p>Current Orders</p>
                                        <p>Quantity</p>
                                    </div>
                                    <?php if(!empty($data['garment_orders'])): ?>
                                        <?php $count = 0; ?>
                                        <?php $totQuantity = 0; ?>

                                        <?php foreach($data['garment_orders'] as $order): ?>
                                            <?php if($order->garment_id == $garment->garment_id): ?>
                                                <p><?php $count++; ?></p>
                                                <?php foreach($data['order_material'] as $order_material): ?>
                                                    <?php if($order_material->order_id == $order->order_id): ?>
                                                        <!-- <?php $materials[] = $order_material; ?> -->
                                                        <?php $qty = $order_material->xs + $order_material->small + $order_material->medium + $order_material->large + $order_material->xl + $order_material->xxl; ?>
                                                        <!-- <?php $qtys[] = $qty ?> -->
                                                        <?php $totQuantity += $qty ?>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif;?>
                                        <?php endforeach; ?>

                                        <div class="item">
                                            <p><?php echo $count ?></p>
                                            <p><?php echo $totQuantity ?></p>

                                        </div>

                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
                
            </div>

            <button class="save-edit">
                <i class="bx bx-edit">Save</i>
            </button>
        </div>

        <!-- assign orders to garments -->
        <script>
            $('.save-edit').click(function() {
                var order = [];
                var garment = [];

                $('.garments').each(function() {
                    var id = $(this).attr('id');
                    var orders = [];
          
                    $(this).find('.draggable.set').each(function() {
                        var order_id = $(this).attr('id');
                        var order_details = JSON.parse($(this).attr('data-order'));
                        // console.log(order_details);
                        var customer_orderId = order_details.order_id;

                        orders.push({id: order_id, customer_orderId: customer_orderId});
                    });
                    garment.push({garment_id: id, orders: orders});
                });

                // console.log(garment);

                $.ajax({
                    url: '<?= ROOT ?>/manager/assignGarment',
                    type: 'POST',
                    data: {garments: garment},
                    success: function(response) {
                        // console.log(response);
                        sessionStorage.setItem('successMsg', 'Orders assigned successfully');
                        location.reload();

                    }
                });
            });

            $(document).ready(function(){
                var successMsg = sessionStorage.getItem('successMsg');
                if(successMsg){
                    $('.success-msg').html(successMsg);
                    $('.success-msg').fadeIn(500).delay(2000).fadeOut(500,
                    function() {
                        $(this).remove();
                        sessionStorage.removeItem('successMsg');
                    });
                }
            });
        </script>

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
                                                $status = 'sewing';
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
                        <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
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
                        <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
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
                        <span class="details">Sewing Done On</span>
                        <input name="sew_dispatch_date" type="date" required onChange=""  />
                    </div>

                    <div class="input-box">
                        <span class="details">Cutting Done On</span>
                        <input name="cut_dispatch_date" type="date" required onChange="" />
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

    <div class="popup-set-deadline" id="popup-set-deadline">
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
        <div class="popup-content">
            <span class="close" >&times;</span>
          
            <h2>Set Cutting and Sewing Deadlines</h2>

        
            <form class="set-deadline-form" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Order Id </span>
                        <input name="garment_order_id" type="text" required onChange="" readonly value="" />
                    </div>

                    <div class="input-box">
                        <span class="details">Quantity</span>
                        <input name="quantity" type="text" required onChange="" readonly value="" />
                    </div>

                    <!-- <div class="input-box"></div> -->
                    <div class="input-box">
                        <span class="details">Cutting Deadline</span>
                        <input name="cut_dispatch_date" type="date" required onChange="" />
                    </div>

                    <div class="input-box">
                        <span class="details">Sewing Deadline</span>
                        <input name="sew_dispatch_date" type="date" required onChange="" />
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

                <!-- hidden element -->
                <!-- <div class="input-box">
                    <input name="order_id" type="hidden" required />
                </div> -->


                <!-- <form method="POST" class="popup-view" id="popup-view"> -->
                <input type="submit" class="update-btn pb" name="updateDeadlines" value="Set Deadlines" />
                <!-- <button type="button" onclick="" class="cancel-btn pb">Cancel</button> -->
                <!-- </form> -->


            </form>
        </div>
    </div>

        <!-- set deadlines -->
    <script>
        $('.popup-set-deadline .update-btn').click(function(e) {
            // e.preventDefault();
            var garment_order_id = $('.popup-set-deadline input[name="garment_order_id"]').val();
            var cut_dispatch_date = $('.popup-set-deadline input[name="cut_dispatch_date"]').val();
            var sew_dispatch_date = $('.popup-set-deadline input[name="sew_dispatch_date"]').val();

            // var order_id = $('.popup-set-deadline input[name="order_id"]').val();


            $.ajax({
                url: '<?= ROOT ?>/manager/setDeadlines',
                type: 'POST',
                data: {garment_order_id: garment_order_id, cut_dispatch_date: cut_dispatch_date, sew_dispatch_date: sew_dispatch_date},
                success: function(response) {
                    console.log(response);
                    sessionStorage.setItem('successMsg', 'Deadlines set successfully');
                    sessionStorage.setItem('id', garment_order_id);
                    location.reload();
                }
            });

        });

        $(document).ready(function(){
            // localStorage.clear();
            var ids = JSON.parse(localStorage.getItem('setId')) || [];
            // var ids = JSON.parse(localStorage.getItem('setId'));
            if (!Array.isArray(ids)) {
                ids = [ids];
            }
            console.log(ids);
            if (ids) {
                ids.forEach(function(id) {
                    $('#' + id).addClass('set');
                });
            }

            var successMsg = sessionStorage.getItem('successMsg');
            var id = sessionStorage.getItem('id');

            if(successMsg){
                $('.draggable').each(function(){
                    if($(this).attr('id') == id){
                        $(this).addClass('set');

                        if(!ids.includes(id)){
                            // Add the new ID
                            ids.push(id);
                        }
                    }
                });

                // Store the updated IDs back to localStorage
                localStorage.setItem('setId', JSON.stringify(ids));

                $('.success-msg').html(successMsg);
                $('.success-msg').fadeIn(500).delay(2000).fadeOut(500, function() {
                    $(this).remove();
                    sessionStorage.removeItem('successMsg');
                    sessionStorage.removeItem('id');
                });
            }
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