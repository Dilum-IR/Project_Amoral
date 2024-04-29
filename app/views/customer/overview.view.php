<!DOCTYPE html>
<html lang="en">

<head>

    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/overview.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/collection/collection.css">
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
                                        $count = 0; ?>
                                        <?php if (!empty($data['order'])):
                                            // show($data);
                                            foreach($data['order'] as $order) :

                                                $count++;

                                            endforeach;

                                        endif; ?>
                                        <h2><?php echo $count; ?></h2>

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
                                        if (!empty($data['order'])) :

                                            foreach ($data['order'] as $order) :
                                                if (!empty($data['material_sizes'])) {
                                                    foreach ($data['material_sizes'] as $sizes) :
                                                        if ($order->order_id == $sizes->order_id) :
                                                            $total += ($order->total_price);
                                                        endif;
                                                    endforeach;
                                                }
                                            endforeach;
                                        endif; ?>
                                        <h2>Rs. <?= number_format($total, 2, '.', ',')  ?></h2>
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
                                        if (!empty($data['order'])):

                                            foreach ($data['order'] as $order) :
                                                $rem += $order->remaining_payment;
                                            endforeach;
                                        endif; ?>
                                        <h2>Rs. <?= number_format($rem, 2, '.', ',')  ?></h2>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <!-- Anlysis Containers -->
                        <div class="table-data">

                            <div class="slider-main">
                                <?php include 'collection.view.php'; ?>
                            </div>
                        </div>

                        <style>
                            .slider-main{
                                height: 680px;
                                width:100%;
                                padding: 0 10px !important;
                            }
                        </style>

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
                                                            ORD-<?php echo $order->order_id ?>
                                                        </td>
                                                        <td><?php echo $order->order_placed_on ?></td>
                                                        <td>
                                                            <?php foreach ($data['material_sizes'] as $sizes) : ?>
                                                                <?php if ($sizes->order_id == $order->order_id) : ?>

                                                                    <?php echo $sizes->material_type ?><br>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </td>

                                                        <td class="st"><span class="text-status <?= $order->order_status ?>">
                                                                <?php if ($order->order_status == "pending") { ?>
                                                                    <iconify-icon icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                                                                <?php } else if (
                                                                    $order->order_status == "cutting" ||
                                                                    $order->order_status == "sewing" ||
                                                                    $order->order_status == "cut" ||
                                                                    $order->order_status == "sewed"
                                                                ) { ?>
                                                                    <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                                                                <?php } else if ($order->order_status == "delivering") { ?>
                                                                    <iconify-icon icon="tabler:truck-delivery"></iconify-icon>
                                                                <?php } else if ($order->order_status == "delivered") { ?>
                                                                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                                                                <?php } ?>


                                                                <?php

                                                                // echo ucfirst($order->order_status) 
                                                                if (
                                                                    $order->order_status == "sewing" ||
                                                                    $order->order_status == "cutting" ||
                                                                    $order->order_status == "sewed" ||
                                                                    $order->order_status == "cut"
                                                                ) {
                                                                    echo "Processing";
                                                                } else {
                                                                    echo ucfirst($order->order_status);
                                                                }

                                                                ?></span>
                                                        </td>
                                                        <td><?php echo $order->dispatch_date ?></td>
                                                    </tr>

                                            <?php endforeach;
                                            } ?>
                                        </tbody>
                                    <?php } else { ?>
                                        No RecentOrders Avaliable...
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>

                            <style>
                                .order tbody tr {
                                    /* background-color: gainsboro; */
                                    transition: 0.5s ease-in-out;
                                    transform: scale(1.0);

                                }

                                .order tbody tr:hover {
                                    background-color: #f3f3f3 !important;
                                    transform: scale(1.01);
                                }

                                .text-status {
                                    gap: 3px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: space-around;
                                    width: max-content;
                                }

                                .table-data .order table tr td .text-status {
                                    font-size: 15px;
                                    padding: 6px 16px;
                                    color: white;
                                    border-radius: 20px;
                                    font-weight: 500;

                                }

                                .st {
                                    text-align: -webkit-center !important;
                                }

                                .table-data .order table td {
                                    padding: 12px 0;
                                }
                            </style>
                            <!-- left side container -->

                            <!-- right side container -->

                            <!-- right side container -->
                        </div>

                    </main>

                </div>

            </div>

            <!-- Pop up new -->
            <div class="popup-new">
                <div class="popup-content">
                    <span class="close">&times;</span>
                    <h2>New Order</h2>

                    <form class="new-form" method="POST" enctype="multipart/form-data">

                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Material </span>
                                <input required name="material" type="text" readOnly />

                            </div>



                            <div class="input-box">
                                <span class="details">Sleeves</span>
                                <select required name="sleeve[]">
                                    <option value="" selected hidden style="color: grey;">Select</option>
                                    <?php foreach ($data['sleeveType'] as $sleeve) : ?>
                                        <option value="<?php echo $sleeve->type ?>"><?php echo $sleeve->type ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="input-box">
                                <span class="details">Printing Type</span>
                                <select required name="printingType[]">
                                    <option value="" selected hidden style="color: grey;">Select a material first</option>
                                </select>
                            </div>

                            <div class="input-box sizes">
                                <span class="details">Sizes & Quantity <span class="error sizes0"></span></span>
                                <div class="sizeChart">
                                    <span class="size">XS</span>
                                    <input class="st" type="number" id="quantity" name="xs[]" min="0" value="0">
                                    <br>
                                    <span class="size">S</span>
                                    <input class="st" type="number" id="quantity" name="small[]" min="0" value="0">
                                    <br>
                                    <span class="size">M</span>
                                    <input class="st" type="number" id="quantity" name="medium[]" min="0" value="0">
                                    <br>
                                    <span class="size">L</span>
                                    <input class="st" type="number" id="quantity" name="large[]" min="0" value="0">
                                    <br>
                                    <span class="size">XL</span>
                                    <input class="st" type="number" id="quantity" name="xl[]" min="0" value="0">
                                    <br>
                                    <span class="size">2XL</span>
                                    <input class="st" type="number" id="quantity" name="xxl[]" min="0" value="0">
                                    <br>
                                </div>
                            </div>

                            <div class="input-box design">
                                <span class="details">Design<span class="error files"></span></span>

                                <input type="file" name="image" id="imageFileToUpload" accept="image/*">

                            </div>


                        </div>

                        <img src="<?php echo ROOT ?>/assets/images/customer/sizeChart.jpg" width="80%" style="margin: 7%;">

                        <hr>
                        <div class="radio-btns">
                            <input type="radio" id="pickupN" name="deliveryOption" value="Pick Up">
                            <label for="pickup">Pick Up</label>

                            <input type="radio" id="deliveryN" name="deliveryOption" value="Delivery">
                            <label for="delivery">Delivery</label>
                            <span class="error dates"></span>
                        </div>

                        <div class="user-details pickupN is-checked">
                            <div class="input-box">
                                <span class="details">Pick Up Date</span>

                                <input type="date" name="dispatch_date_pickup">
                            </div>
                        </div>

                        <div class="user-details deliveryN">
                            <div class="input-box">
                                <span class="details">Delivery Expected On</span>

                                <input type="date" name="dispatch_date_delivery">
                            </div>

                            <div class="input-box location">
                                <span class="details"> Delivery Location</span>
                                <div class="googlemap" id="new-order-map" style="height: 300px; width: 100%;"></div>
                            </div>

                            <div class="input-box city">
                                <span class="details addr">City</span>

                                <input type="text" name="city">

                            </div>


                        </div>

                        <hr class="second">

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
                                <tr class="units">
                                    <td class="materialType"></td>
                                    <td class="sleeveType"></td>
                                    <td class="printingType"></td>
                                    <td class="quantityAll">0</td>
                                    <td class="unitPrice">0</td>

                                    <input type="hidden" name="unit_price[]">

                                </tr>
                                <tr class="total">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Total</td>
                                    <td class="totalPrice">0</td>
                            </table>
                        </div>

                        <input type="hidden" name="total_price" />


                        <!-- <p>You will be notified about possible discounts later</p> -->



                        <input name="latitude" type="hidden" required />
                        <input name="longitude" type="hidden" required />


                        <button type="submit" class="close-btn pb" name="newOrder">Submit</button>
                        <button type="button" class="cancel-btn pb" onclick="closeNew()">Cancel</button>





                    </form>
                </div>
            </div>

        </section>

    </div>

    <script>
        // ajax for adding a new order
        let newOrderForm = document.querySelector(".popup-new .new-form");
        newOrderForm.addEventListener('submit', function(event){
            event.preventDefault();
            let noerrors = validateNewOrder();
            console.log(noerrors);
            if(noerrors){
                let formData = new FormData(newOrderForm);
                let xhr = new XMLHttpRequest();
                console.log(formData);
                xhr.open("POST", "<?php echo ROOT ?>/customer/newOrder", true);
                xhr.onload = function() {
                    if(this.status == 200) {
                        console.log('response'+this.responseText);
                        let response = JSON.parse(this.responseText);
                        if (response == false) {
                            // delay(10000);


                            var successMsgElement = document.querySelector('.success-msg');
                            successMsgElement.innerHTML = "Order placed successfully";
                            successMsgElement.style.display = 'block';
                            // delay(2000);
                            setTimeout(function() {
                                successMsgElement.style.display = 'none';
                                location.reload();
                            }, 2000);



                        }else{
                            var successMsgElement = document.querySelector('.success-msg');

                            successMsgElement.innerHTML = "There was an error placing the order";

                            // successMsgElement.style.transition = 'all 1s ease-in-out';

                            successMsgElement.style.display = 'block';
                            successMsgElement.style.backgroundColor = 'red';
                            setTimeout(function() {
                                successMsgElement.style.display = 'none';
                                location.reload();
                            }, 2000);
                        }
                    }
                }

                xhr.send(formData);
            }
        });
    
    </script>


    <script>
        //add price data dynamically in new order popup

        let quantity = document.querySelector(".popup-new .sizes");
        // let addMaterial = document.querySelector(".add.card");
        let data = document.querySelector(".popup-new .price-details-container");


        let sizesArr = ['xs', 'small', 'medium', 'large', 'xl', 'xxl'];
        let quantityAll = document.querySelector(".quantityAll");

        let total = 0;
        sizesArr.forEach(function(size) {
            let input = document.querySelector(`input[name='${size}[]']`);
            input.addEventListener('change', function() {
                total = 0;
                sizesArr.forEach(function(size) {
                    total += parseInt(document.querySelector(`input[name='${size}[]']`).value);
                });
                quantityAll.innerHTML = total;
                generateTotalPrice();
            });
        });



        function generateTotalPrice() {
            let total = 0;
            document.querySelectorAll(".units").forEach(function(unit) {
                total += parseInt(unit.querySelector(".unitPrice").innerHTML) * parseInt(unit.querySelector(".quantityAll").innerHTML);
            });
            document.querySelector(".popup-new .totalPrice").innerHTML = total;

            document.querySelector(".popup-new input[name='total_price']").value = total;
            //  console.log("tot" + document.querySelector(".popup-new input[name='total_price']").value);
        }




        //add price data dynamically in new order popup
        let qunatityView = document.querySelector(".popup-view .sizes");
    </script>

    <script>
        // clear the other option when one is selected
        document.querySelectorAll("input[name='dispatch_date_pickup']").forEach(pickupDate => {
            pickupDate.addEventListener('change', function() {
                document.querySelectorAll("input[name='dispatch_date_delivery']").forEach(deliveryDate => {
                    deliveryDate.value = "";
                });

            });
        });

        document.querySelectorAll("input[name='dispatch_date_delivery']").forEach(deliveryDate => {
            deliveryDate.addEventListener('change', function() {
                document.querySelectorAll("input[name='dispatch_date_pickup']").forEach(pickupDate => {
                    pickupDate.value = "";
                });

            });
        });
    </script>



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


    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
</body>

</html>