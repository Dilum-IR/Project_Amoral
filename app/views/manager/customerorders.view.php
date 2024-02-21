<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manager</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/customer-orders.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    </head>

<body>
    <!-- Sidebar -->
    <?php include_once 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include_once 'navigationbar.php' ?>
    <!-- Scripts -->
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>

    <!-- content  -->
    <section id="main" class="main">

        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <i class='bx bx-chevron-right'></i>
            <li>
                <a href="#" class="active">Customer Orders</a>
            </li>

        </ul>

        <form>
            <div class="form">
                <form >
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
				<input class="new-btn" type="button" onclick="openNew()" value="+New Order">
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
                            <th>User Id</th>
                            <th>Placed Date</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Dispatch Date</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['orders'] as $order): ?>
                        
                            <?php $material = array(); ?>
                        <tr>
                            <td class="ordId"><?php echo $order->order_id ?></td>
                            <td><?php echo $order->user_id ?></td>
                            <td><?php echo $order->order_placed_on ?></td>
                            <td>
                            <?php foreach($data['material_sizes'] as $sizes):?>
                                    <?php if($sizes->order_id == $order->order_id) :?>
                                        <?php $material[] = $sizes?>
                                    <?php echo $sizes->material_type ?><br>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>
                            <td class="desc">
                                <?php foreach($data['material_sizes'] as $sizes):?>
                                    <?php if($sizes->order_id == $order->order_id) :?>
                                        <?php echo $sizes->xs + $sizes->small + $sizes->medium + $sizes->large + $sizes->xl + $sizes->xxl ?> <br>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>
                            <td><?php echo $order->dispatch_date ?></td>
                            <td class="st">
                                <div class="text-status <?php echo $order->order_status?>"><?php echo $order->order_status ?></div>
                                <div class="progress-bar"></div>
                            </td>
                        
                            <td><button type="submit" name="selectItem" class="edit" data-order='<?= json_encode($order); ?>' data-material='<?= json_encode($material); ?>' data-customers='<?= json_encode($data['customers']) ?>' onclick="openView(this)" ><i class="fas fa-edit"></i> View</button>
                            <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                        </tr>
                        
                     
                        <?php endforeach; ?>
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
                    <iconify-icon
                        icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                    <div class="progress one">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Pending</p>
                </li>

                <li>
                    <iconify-icon icon="tabler:cut"></iconify-icon>
                    <div class="progress two">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Cutting</p>
                </li>
                <li>
                    <iconify-icon icon="tabler:shirt-filled"></iconify-icon>
                    <div class="progress three">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Printing</p>
                </li>
                <li>
                    <iconify-icon icon="game-icons:sewing-string"></iconify-icon>
                    <div class="progress four">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Sewing</p>
                </li>

                <li>
                    <iconify-icon icon="tabler:truck-delivery"></iconify-icon>
                    <div class="progress five">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Delivery In Progress</p>
                </li>
                <li>
                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                    <div class="progress six">

                        <!-- <i class="uil uil-check"></i> -->
                    </div>
                    <p class="text">Delivered</p>
                </li>

            </ul>

        </div>

        
        <form class="update-form" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <embed name="design" type="application/pdf" style="display: block; width: 250px; height: 249px; margin-bottom:0.8rem; background-color:white; border-radius:10px;">

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
                
                <div class="radio-btns">
                    <input type="radio" id="pickup" name="deliveryOption" value="Pick Up">
                    <label for="pickup">Pick Up</label>

                    <input type="radio" id="delivery" name="deliveryOption" value="Delivery">
                    <label for="delivery">Delivery</label>
                </div>

                <div class="user-details pickup">
                    <div class="input-box">
                        <span class="details">Pick Up Date</span>
                    
                        <input type="date" name="dispatch_date_pickup" >
                    </div>
                </div>

                <script>
                    //toggle delivery options
                    let delivery = document.getElementById("delivery");
                    let pickUp = document.getElementById("pickup");


                    pickUp.addEventListener('click', togglePickUp);
                    delivery.addEventListener('click', toggleDelivery);



                    function togglePickUp(){
                        
                        document.querySelector(".user-details.pickup").classList.add("is-checked");
                        document.querySelector(".user-details.delivery").classList.remove("is-checked");
                        
                    }

                    function toggleDelivery(){
                        document.querySelector(".user-details.delivery").classList.add("is-checked");
                        document.querySelector(".user-details.pickup").classList.remove("is-checked");
                    }
                </script>                

                <div class="user-details delivery">

                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                    
                        <input type="date" name="dispatch_date_delivery" >
                    </div>
                    <div class="input-box">
                        <span class="details addr">City</span>
                    
                        <input name="city" type="text">

                        
                    </div>


                    <div class="input-box location">
                        <span class="details">Location</span>
                        <div id="map" style="height: 400px; width: 100%;"></div>
                    </div>

                    <!-- hidden element -->
                    <div class="input-box">
                        <input name="latitude" type="hidden"  />
                        <input name="longitude" type="hidden"  />
                    </div>
                
                    
                </div>

                <hr class="second">

                <div style="display: flex;text-align: center;flex-direction: column;padding: 5px;">
                    <h3>Customer Details</h3>
                </div>

                <div class="user-details customer">
                    <div class="input-box">
                        <span class="details">Customer ID</span>
                        <input name="id" type="text"  />
                    </div>
                    <div class="input-box">
                        <span class="details">Customer Name</span>
                        <input name="fullname" type="text"  />
                    </div>
                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input name="phone" type="text"  />
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input name="email" type="email"  />
                    </div>
                </div>

                <hr class="second">

                <div style="display: flex;text-align: center;flex-direction: column;padding: 5px;">
                    <h3>Payment Details</h3>
                </div>

                <div class="prices">
                    
                    <p style="text-align: right; margin: 10px 30px;"></p><br>
                    
                    <table class="price-details-container">
                        <tr>
                            <th>Material</th>
                            <th>Sleeve Type</th>
                            <th>Printing Type</th>
                            <th>Quantity</th>
                            <th>Unit Price(Rs.)</th>
                        </tr>

                        <tr class="discount">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Discount</td>
                            <td class="discountPercentage">0</td>
                        </tr>
    
                        <tr class="total">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total</td>
                            <td class="totalPrice">0</td>

                            <input type="hidden" name="total_price" />
                        </tr>
                    </table>
                </div>

                

                <input type="button" class="update-btn pb"  value="Update Order" />
                <button type="button" class="cancel-btn pb">Cancel Order</button>

                <div class="cu-popup" role="alert">
                    <div class="cu-popup-container">
                        <p>Are you sure you want to update this order?</p>
                        <div class="cu-buttons">
                            <input type="submit" class="yes"  value="Yes" name="updateOrder"/>
                            <input type="button" class="no" value="No"/>
                        </div>
                        
                    </div> 
                </div> 
                
            </div>
        </form>
    </div>

    <script>
            // clear the other option when one is selected in the delivery options
            document.querySelectorAll("input[name='dispatch_date_pickup']").forEach(pickupDate => {
                pickupDate.addEventListener('change', function(){
                    document.querySelectorAll("input[name='dispatch_date_delivery']").forEach(deliveryDate =>{
                        deliveryDate.value = "";
                    });

                });
            });

            document.querySelectorAll("input[name='dispatch_date_delivery']").forEach(deliveryDate => {
                deliveryDate.addEventListener('change', function(){
                    document.querySelectorAll("input[name='dispatch_date_pickup']").forEach(pickupDate =>{
                        pickupDate.value = "";
                    });

                });
            });
    </script>



    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAfuuowb7aC4EO89QtfL2NQU0YO5q17b5Y&callback=initMap"></script>

    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/manager/customer-orders.js"></script>
</body>

</html>