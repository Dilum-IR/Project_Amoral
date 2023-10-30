<?php

$fetchData = [

    "order_id" => "0085",
    "material" => "wetlook"
];

// echo $data['data']=>;
// show($data);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/customer-orders.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php

    use function PHPSTORM_META\map;

    include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>

    <!-- content  -->
    <section id="main">

        <div class="main-box">

            <h2>Your Orders</h2>

            <!-- <form>
                <div class="form">
                    <input class="form-group" type="text" placeholder="Search...">
                    <i class='bx bx-search icon'></i>
                    <input class="btn" type="button" onclick="openReport()" value="Report Problem">
                </div>
                
            </form> -->

            <table class="table">
                <thead>
                    <tr>

                        <th class="ordId">OrderId</th>
                        <th class="desc">Description</th>
                        <th class="stth">Status</th>
                        <th class="cost">sew_dispatch_date</th>
                        <th class="cost">cut_dispatch_date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($data)) {
                        $sn = 1;
                        foreach ($data as $item) {
                    ?>
                            <tr>
                                <td class="ordId"><?php echo $item->garment_order_id ?? '';  ?></td>
                                <td class="desc">Material : <br>
                                    Sizes & Quantity : <br> S - 2 <br>
                                    S - 2 <br>
                                </td>
                                <td class="st">
                                    <div class="text-status"><?php echo $item->status ?></div>
                                </td>
                                <td class="cost"><?php echo $item->sew_dispatch_date ?? '';  ?></td>
                                <td class="cost"><?php echo $item->cut_dispatch_date ?? '';  ?></td>
                               
                                <td><button type="submit" class="view-order-btn" onclick="openView(<?php echo $item->garment_id?>)">View Order</button></td>
                            </tr>
                    <?php
                            $sn++;
                        }
                    } else {
                    } ?>

                    <script>
                        function openView(garmentId) {

                            console.log(garmentId);

                            alert("Opening view for garment ID: " + garmentId);

                        }
                    </script>


                    <!-- <tr>
                        <td>1</td>
                        <td class="ordId">002345</td>
                        <td class="desc">Material : Wetlook <br>
                            Sizes & Quantity : <br> Small - 2 <br>
                            Large - 20
                        </td>
                        <td class="st">
                            <div class="text-status">Processing</div>
                        </td>
                        <td class="cost">2021/09/18</td>
                        <td><button type="submit" class="view-order-btn" onclick="openView()">View Order</button></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="ordId">002345</td>
                        <td class="desc">Material : Wetlook <br>
                            Sizes & Quantity : S - 2
                        </td>
                        <td class="st">
                            <div class="text-status">Processing</div>
                        </td>
                        <td class="cost"> </td>
                        <td><button type="submit" class="view-order-btn" onclick="openView()">View Order</button></td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </section>

    <!-- order update & cancel popup -->
    <div class="popup-view" id="popup-view">
        <button type="button" class="update-btn pb">Update Order</button>
        <button type="button" class="cancel-btn pb">Cancel Order</button>
        <h2>Order Details</h2>
        <div class="status">

            <ul>
                <li>
                    <iconify-icon icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
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