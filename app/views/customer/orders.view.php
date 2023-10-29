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
            <tr>
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
            </tr>
        </table>

    </section>


    <!-- POPUP -->
    <div class="popup-report">
        <h2>Report Your Problem</h2>
        <h4>Your name : </h4>
        <input type="text" placeholder="Enter your name">
        <h4>Your email : </h4>
        <input type="text" placeholder="Enter your email">
        <h4>Problem : </h4>
        <textarea name="problem" id="problem" cols="30" rows="10" placeholder="Enter your problem"></textarea>
		<div class="btns">
			<button type="button" class="cancelR-btn" onclick="closeReport()">Cancel</button>
			<button type="button" class="close-btn" onclick="closeReport()">Submit</button>
		</div>
    </div>



    <div class="popup-view" id="popup-view">
        <button type="button" class="update-btn pb">Update Order</button>
        <button type="button" class="cancel-btn pb">Cancel Order</button>
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
            <form>
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Order Id </span>
                        <input type="text" required onChange="" readonly value="0023456" />
                    </div>

                    <div class="input-box">
                        <span class="details">Material </span>
                        <input type="text" required onChange="" readonly value="Wetlook" />
                    </div>

                    <div class="input-box sizes">
                        <span class="details">Sizes & Quantity</span>
                        <input class="size" type="text" required onChange="" readonly value="S" />
                        <p>_</p>
                        <input class="size" type="text" required onChange="" readonly value="2" />
                    </div>

                    <div class="input-box">
                        <span class="details">Cost Per Product</span>
                        <input type="text" required onChange="" readonly value="Rs. 1200" />
                    </div>

                    <div class="input-box">
                        <span class="details">Total Cost</span>
                        <input type="text" required onChange="" readonly value="Rs. 2400" />
                    </div>

                    <div class="input-box">
                        <span class="details">Delivery Address</span>
                        <input type="text" required onChange="" readonly value="Colombo" />
                    </div>

                    <div class="input-box">
                        <span class="details">Order Placed On</span>
                        <input type="text" required onChange="" readonly value="2023/10/19" />
                    </div>

                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                        <input type="text" required onChange="" readonly value="2023/10/29" />
                    </div>
                </div>
            </form>
        </div>
        <button type="button" class="ok-btn" onclick="closeView()">OK</button>
    </div>
    <div id="overlay" class="overlay"></div>




    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/customer/customer-orders.js"></script>
</body>

</html>