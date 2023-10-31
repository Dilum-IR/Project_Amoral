<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/customer-orders.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/garment/order.css">

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

            <h2>Garment Orders</h2>
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
                        // $sn = 1;
                        foreach ($data as $item) {
                            // show($item); 

                    ?>
                            <tr class="item">
                                <td class="ordId"><?php echo $item->order_id ?? '';  ?></td>
                                <td class="desc">Material : Wetlook <br>
                                    Sizes & Quantity : <br> S - 2 <br>
                                    <!-- S - 2 <br> -->
                                </td>
                                <td class="st">
                                    <div class="text-status"><?php echo $item->status ?></div>
                                </td>
                                <td class="cost"><?php echo $item->sew_dispatch_date ?? '';  ?></td>
                                <td class="cost"><?php echo $item->cut_dispatch_date ?? '';  ?></td>
                                
                                <td>
                                    <button type="submit" name="selectItem" class="view-order-btn" data-order='<?= json_encode($item); ?>' onclick="openView(this)">View Order</button>
                                </td>
                            </tr>
                    <?php
                            // $sn++;
                        }
                    } else {
                    } ?>
                </tbody>
            </table>
        </div>
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

    <!-- order update & cancel popup -->

    <div class="popup-view" id="popup-view">

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
                    <p class="text">Cutting</p>
                </li>
                <li>
                    <iconify-icon icon="tabler:truck-delivery"></iconify-icon>
                    <div class="progress three">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Cutting done</p>
                </li>
                <li>
                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                    <div class="progress four">

                        <!-- <i class="uil uil-check"></i> -->
                    </div>
                    <p class="text">Sewing</p>
                </li>
                <li>
                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                    <div class="progress four">

                        <!-- <i class="uil uil-check"></i> -->
                    </div>
                    <p class="text">Sewing done</p>
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

                        <span class="details">Sizes</span>

                        <input class="size" type="text" required onChange="" readonly value="S" />
                        <span class="details">Quantity</span>
                        <!-- <p>_</p> -->
                        <input class="size" type="text" required onChange="" readonly value="2" />
                    </div>
                    <div class="input-box">
                        <span class="details">cut dispatch date</span>
                        <input name="cut_dispatch_date" type="text" required onChange="" readonly value="2023/10/01" />
                    </div>
                    <div class="input-box">
                        <span class="details">sew dispatch date</span>
                        <input name="sew_dispatch_date" type="text" required onChange="" readonly value="2023/10/02" />
                    </div>
                    <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                        <input name="delivery_expected_on" type="text" required onChange="" readonly value="2023/10/01" />
                    </div>
                </div>
                <!-- hidden element -->
                <div class="input-box">
                    <!-- <span class="details">Order Id </span> -->
                    <input name="status" type="hidden" required onChange="" readonly value="cutting" />
                    <input name="garment_id" type="hidden" required onChange="" readonly value="0023456" />
                </div>

                <button type="submit" onclick="" class="cancel-btn pb">Cancel Order</button>
                <input type="submit" class="update-btn pb" name="updateGorder" value="Update Order" />
               


            </form>
        </div>
        <button type="button" class="ok-btn" onclick="closeView()">OK</button>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/garment/garment-order.js"></script>
</body>

</html>