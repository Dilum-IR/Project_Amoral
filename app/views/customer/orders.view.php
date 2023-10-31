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

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>

    <!-- content  -->
    <section id="main" class="main">

        <h2>Your Orders</h2>

        <form>
            <div class="form">
				<input class="form-group" type="text" placeholder="Search...">
				<i class='bx bx-search icon'></i>
				<input class="new-btn" type="button" onclick="openNew()" value="+New Order">
				<input class="btn" type="button" onclick="openReport()" value="Report Problem">
			</div>

        </form>

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th class="ordId">OrderId</th>
                    <th class="desc">Description</th>
                    <th class="stth">Status</th>
                    <th class="cost">Cost</th>
                    <th></th>
                </tr>
            </thead>
                <?php $count = 1; foreach($data as $order): ?>
                    <tr>
                        <td><?php echo $count; $count++; ?></td>
                        <td class="ordId"><?php echo $order->order_id ?></td>
                        <td class="desc">Material : <?php echo $order->material ?><br>Quantity : <?php echo $order->quantity ?></td>
                        <td class="st">
                            <div class="text-status"><?php echo $order->order_status ?></div>
                        </td>
                        <td class="cost"><?php echo $order->total_price ?></td>
                        <td><button type="submit" name="selectItem" class="view-order-btn" data-order='<?= json_encode($order); ?>' onclick="openView(this)">View Order</button></td>
                        <td><button type="button" class="pay-btn" onclick="">Pay</button></td>
                    </tr>
                <?php endforeach; ?>
    

            <!-- <tr>
                <td>1</td>
                <td class="ordId">002345</td>
                <td class="desc">Material : Wetlook <br>
                    Sizes & Quantity : S - 2
                </td>
                <td class="st">
                    <div class="text-status">Processing</div>
                </td>
                <td class="cost">Rs. 2400</td>
                <td><button type="submit" class="view-order-btn" onclick="openView()">View Order</button></td>
            </tr> -->
        </table>

    </section>


    <!-- POPUP -->
               

    <div class="popup-report">
        <h2>Report Your Problem</h2>
        <form method="POST">

            <h4>Title : </h4>
            <input name="title" type="text" placeholder="Enter your title">
            <h4>Your email : </h4>
            <input name="email" type="text" placeholder="Enter your email">
            <h4>Problem : </h4>
            <textarea name="description" id="problem" cols="30" rows="5" placeholder="Enter your problem"></textarea>
            <div class="btns">
                <button type="button" class="cancelR-btn" onclick="closeReport()" Style="color: white">Cancel</button>
                <button type="submit" class="close-btn" name="report" value="Submit" Style="color: white">Submit</button>
            </div>

        </form>
    </div>
    

    <div class="popup-view" id="popup-view">
        <!-- <button type="button" class="update-btn pb">Update Order</button> -->
        <!-- <button type="button" class="cancel-btn pb">Cancel Order</button> -->
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

        <div class="container1">
            <form class="update-form" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Order Id </span>
                        <input name="order_id" type="text" required onChange="" readonly value="0023456" />
                    </div>

                    <div class="input-box">
                        <span class="details">Material </span>
                        <input name="material" type="text" required onChange="" readonly value="Wetlook" />
                        
                    </div>

                    <div class="input-box sizes">
                    <span class="details">Sizes & Quantity</span><br>
                    <div class="sizeChart">
                        <span class="size">S</span>
                    
                        <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                        <input class="st" type="number" id="quantity" name="small" value="0" min="0" max="10">
                        <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                        <br>
                        <span class="size">M</span>
                        <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                        <input class="st" type="number" id="quantity" name="medium" value="0" min="0" max="10">
                        <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                        <br>
                        <span class="size">L</span>
                        <!-- <button class="btn btn-secondary" type="button" id="decrement-btn">-</button> -->
                            <input class="st" type="number" id="quantity" name="large" value="0" min="0" max="10">
                            <!-- <button class="btn btn-secondary" type="button" id="increment-btn">+</button> -->
                            <br>
                    </div>
                    </div>
                    <div class="input-box">
                    </div>
                    <div class="input-box">
                        <span class="details">Total Price</span>
                        <input name="total_price" type="text" required onChange="" readonly value="2023/10/01" />
                    </div>
                    <div class="input-box">
                        <span class="details">Remaining Payment</span>
                        <input name="remaining_payment" type="text" required onChange="" readonly value="2023/10/01" />
                    </div>
                    <div class="input-box">
                        <span class="details">Order Placed On</span>
                        <input name="order_placed_on" type="text" required onChange="" readonly value="2023/10/02" />
                    </div>
                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                    
                        <input type="date" name="dispatch_date">
                    </div>
                    <div class="input-box">
                        <span class="details addr">Address</span>
                    
                        <input type="text" name="address">
                    </div>
                </div>
                <!-- hidden element -->
                <div class="input-box">
                    <!-- <span class="details">Order Id </span> -->
                    <input name="order_status" type="hidden" required onChange="" readonly value="cutting" />
                    <input name="user_id" type="hidden" required onChange="" readonly value="0023456" />
                </div>


                <!-- <form method="POST" class="popup-view" id="popup-view"> -->
                <input type="submit" class="update-btn pb" name="updateOrder" value="Update Order" />
                <button type="button" onclick="" class="cancel-btn pb">Cancel Order</button>
                <!-- </form> -->


            </form>
        </div>
    </div>
    <div id="overlay" class="overlay"></div>




    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/customer/customer-orders.js"></script>
</body>

</html>