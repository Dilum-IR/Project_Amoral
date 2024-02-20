<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/customer-orders.css">

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

        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <i class='bx bx-chevron-right'></i>
            <li>
                <a href="#" class="active">Orders</a>
            </li>

        </ul>

        <form>
            <div class="form">
                <form>
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
				<!-- <input class="new-btn" type="button" onclick="openNew()" value="+New Order"> -->
				<input class="btn" type="button" onclick="openReport()" value="Report Problem">
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
                            <th>Placed Date</th>
                            <th>Material</th>
                            <th>Quantity</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($data['order'] as $order):?>
                            <?php if(!$order->is_quotation && $order->order_status != "cancelled"): ?>
                                <?php $material = array(); ?>
                        <tr>
                            
                            <td><?php echo $order->order_id ?></td>
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
                            <td class="st">
                                <div class="text-status <?php echo $order->order_status ?>"><?php echo $order->order_status ?></div>
                            </td>
                        
                            <td><button type="submit" name="selectItem" class="edit" data-order='<?= json_encode($order); ?>' data-material='<?= json_encode($material); ?>' onclick="openView(this)"><i class="fas fa-edit"></i> View</button>
                            <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                        </tr>
                        
                        <?php endif; ?>
                        <?php endforeach; ?>
               
                    </tbody>
                </table>
            </div>
        </div>

    </section>


    <!-- POPUP -->
               
  

    <div class="popup-report">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Report Your Problem</h2>
            <form method="POST">

                <h4>Title : <span class="error title"></span>  </h4> 
                <input name="title" type="text" placeholder="Enter your title">
                <h4>Your email : <span class="error email"></span></h4>
                <input name="email" type="text" placeholder="Enter your email">
                <h4>Problem : <span class="error description"></span></h4>
                <textarea name="description" id="problem" cols="30" rows="5" placeholder="Enter your problem"></textarea>
                
                <button type="submit" class="close-btn pb" name="report" value="Submit" >Submit</button>
                <button type="button" class="cancelR-btn pb" onclick="closeReport()" >Cancel</button>
            

            </form>
        </div>
    </div>


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
                    <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                    <div class="progress two">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Processing</p>
                </li>
                <li>
                    <iconify-icon icon="tabler:truck-delivery"></iconify-icon>
                    <div class="progress three">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Delivery In Progress</p>
                </li>
                <li>
                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                    <div class="progress four">

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
                        <span class="details">Order Id </span>
                        <input name="order_id" type="text" required onChange="" readonly value="" />
                    </div>
                    <div class="input-box" style="height: 0;">

                    </div>
                    <div class="input-box placedDate">
                        <span class="details">Order Placed On</span>
                        <input name="order_placed_on" type="text" required onChange="" readonly value="" />
                    </div>

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
                    
                        <input type="text" name="dispatch_date_pickup" readonly value="" />
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
                    
                        <input type="text" name="dispatch_date_delivery" readonly value="" />
                    </div>
                    <div class="input-box">
                        <span class="details addr">City</span>
                    
                        <select name="city">

                        </select>
                    </div>


                    <div class="input-box location">
                        <span class="details">Location</span>
                        <div id="map" style="height: 400px; width: 100%;"></div>
                    </div>

                    <!-- hidden element -->
                    <div class="input-box">
                        <input name="latitude" type="hidden" required />
                        <input name="longitude" type="hidden" required />
                    </div>
                
                    
                </div>

                <hr class="second">


                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Unit Price</span>
                        <input name="unit_price" type="text" required onChange="" readonly value="" />
                    </div>
                    <div class="input-box">
                        <span class="details">Discount</span>
                        <input name="discount" type="text" required onChange="" readonly value="" />
                    </div>
                    <div class="input-box">
                        <span class="details">Total Price</span>
                        <input name="total_price" type="text" required onChange="" readonly value="" />
                    </div>
                    <div class="input-box">
                        <span class="details">Remaining Payment</span>
                        <input name="remaining_payment" type="text" required onChange="" readonly value="" />
                        <button class="pay" >Pay</button>
                    </div>
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



    <div class="cd-popup" role="alert">
        <div class="cd-popup-container">
            <p>Are you sure you want to cancel this order?</p>
            <div class="cd-buttons">
                <a href="">Yes</a>
                <a href="">No</a>
            </div>
            
        </div> 
    </div> 




    
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Fo-CyT14-vq_yv62ZukPosT_ZjLglEk&loading=async&callback=initMap"></script>
    <script src="<?= ROOT ?>/assets/js/customer/customer-orders.js"></script>

</body>

</html>