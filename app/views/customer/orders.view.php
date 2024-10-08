<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/customer-orders.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- loading css -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/loading.css">

</head>

<body>

    <?php
    include __DIR__ . '/../utils/loading.php';
    include __DIR__ . '/../utils/toastMsg.php';

    ?>

    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include_once 'navigationbar.php' ?>
    <!-- Scripts -->

    <div class="page-content">

        <!-- content  -->
        <section id="main" class="main">
            <div class="success-msg"> </div>


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
                    <input class="new-btn" type="button" onclick="openNew()" value="+New Order">
                    <input class="btn" type="button" onclick="openReport()" value="Report Problem">
                </div>

            </form>

            <div class="table">

                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <label class="custom-checkbox">
                                        <input type="checkbox" id="selectAll" onclick="selectAllRows()">
                                        <span class="checkmark head"></span>
                                    </label>
                                </th>
                                <th>Order Id</th>
                                <th>Placed Date</th>
                                <th>Material</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Amount due (Rs.)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">

                            <?php if (!empty($data['order'])) : ?>
                                <?php foreach ($data['order'] as $order) :

                                    $material = array();
                                    $sleeve = array();
                                    $pType = array();

                                    //show($data['order']);
                                ?>
                                    <tr>
                                        <td>
                                            <?php if ($order->pay_type != "full" && $order->order_status != "canceled") { ?>
                                                <label class="custom-checkbox">
                                                    <!-- <input type="checkbox" /> -->
                                                    <input type="checkbox" onclick="selectRow(this,<?= $order->order_id ?>,<?= $order->total_price ?>,<?= $order->remaining_payment ?>,'<?= $order->pay_type ?>')">
                                                    <span class="checkmark"></span>

                                                </label>
                                            <?php } ?>
                                        </td>
                                        <td>ORD-<?php echo $order->order_id ?></td>
                                        <td><?php echo $order->order_placed_on ?></td>
                                        <td>
                                            <?php foreach ($data['material_sizes'] as $sizes) : ?>
                                                <?php if ($sizes->order_id == $order->order_id) : ?>
                                                    <?php $material[] = $sizes ?>

                                                    <?php echo $sizes->material_type ?><br>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td class="desc">
                                            <?php foreach ($data['material_sizes'] as $sizes) : ?>
                                                <?php if ($sizes->order_id == $order->order_id) : ?>
                                                    <?php echo $sizes->xs + $sizes->small + $sizes->medium + $sizes->large + $sizes->xl + $sizes->xxl ?> <br>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td class="st">
                                            <div class="text-status <?php echo $order->order_status ?>">
                                                <?php if ($order->order_status == "pending") { ?>
                                                    <iconify-icon icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                                                <?php } else if (
                                                    $order->order_status == "cutting" ||
                                                    $order->order_status == "sewing" ||
                                                    $order->order_status == "cut" ||
                                                    $order->order_status == "sewed" ||
                                                    $order->order_status == 'sent to garment'

                                                ) { ?>
                                                    <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                                                <?php } else if ($order->order_status == "delivering") { ?>
                                                    <iconify-icon icon="tabler:truck-delivery"></iconify-icon>
                                                <?php } else if ($order->order_status == "delivered") { ?>
                                                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                                                <?php } ?>



                                                <?php if (
                                                    $order->order_status == 'cutting' ||
                                                    $order->order_status == 'printing' ||
                                                    $order->order_status == 'printed' ||
                                                    $order->order_status == 'sent to garment' ||
                                                    $order->order_status == 'sewing' ||
                                                    $order->order_status == 'cut' ||
                                                    $order->order_status == 'sewed'
                                                ) : ?>
                                                    <?php echo "Processing" ?>
                                                <?php elseif ($order->order_status == 'canceled') : ?>
                                                    <?php echo "Cancelled" ?>
                                                <?php else : ?>
                                                    <?php echo ucfirst($order->order_status) ?>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="price">
                                            <?php

                                            if ($order->pay_type == "full") {
                                            ?>
                                                <h4 style='color:green'>Paid</h4>
                                            <?php

                                            } else if ($order->remaining_payment != 0) {
                                            ?>
                                                <span style='color:red'>remain</span>
                                            <?php

                                                echo  number_format($order->remaining_payment, 2, '.', ',');
                                            } else {

                                                echo  number_format($order->total_price, 2, '.', ',');
                                            }
                                            ?>
                                        </td>

                                        <td class="btns">
                                            <button type="submit" name="selectItem" class="edit-btn" data-order='<?= json_encode($order); ?>' data-material='<?= json_encode($material); ?>' onclick="openView(this)"><i class="fas fa-edit"></i> View</button>
                                            <?php if ($order->total_price != 0) {
                                            ?>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>

            <style>
                .text-status {
                    gap: 5px;
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

                .table-body tr .st .text-status {
                    font-size: 15px !important;
                    padding: 6px 16px !important;
                    color: white;
                    border-radius: 20px !important;
                    font-weight: 500 !important;

                }
            </style>


            <div class="amount-container">

                <h4 class="hint">
                    You have to make the payment to proceed with the order. <br>
                    You can select the orders and then pay for selected orders. <br>
                    ** If your orders' total price is grater than Rs. 100,000.00 then you can pay the half payment. And after you must pay the remain payment.

                </h4>

                <div id="amount-box-content" class="amount-box disable">
                    <div id="amount-left-content">

                        <p class="title">Your total payment will be</p>
                        <div class="choose-orders">

                            <div>
                                <p>Select Order ID's</p>
                                <p id="select-element"></p>
                            </div>
                        </div>
                    </div>
                    <div id="amount-center-content">

                        <div class="center-content">

                            <h1 class="amount_last">Rs.&nbsp;</h1><br>
                            <h1 id="select-orders-amount"> </h1>

                        </div>
                        <div id="half-payment" class="disable">

                            <br>
                            <hr class="dotted">

                            <p>&nbsp;Half Payment</p>
                            <div class="center-content">

                                <h1 class="amount_last">Rs.&nbsp;</h1><br>
                                <h1 id="select-orders-halfamount"> </h1>


                            </div>
                        </div>

                    </div>
                    <div id="amount-right-content">

                        <div class="right">

                            <div id="half-checker" class="right disable">

                                <label class="custom-checkbox">

                                    <input type="checkbox" id="checkbox" onclick="selectHalfPay()">
                                    <span class="checkmark"></span>

                                </label>
                                <p>Tick, If half payment </p>

                            </div>

                            <button type="button" class="pay" id="pay" onclick="paymentGateway('<?= $order->order_id ?>','<?= $_SESSION['USER']->id ?>')"> Pay now
                                &nbsp;
                                <span>Rs.</span>
                                <span id="btn-price"></span>

                            </button>

                        </div>
                        <img src="https://www.payhere.lk/downloads/images/payhere_square_banner.png" width="230px" alt="">
                    </div>

                </div>

            </div>



            <script>
                select_orders_amount = document.getElementById("select-orders-amount");
                select_orders_halfamount = document.getElementById("select-orders-halfamount");
                select_element = document.getElementById("select-element");

                btn_price = document.getElementById("btn-price");
                amount_box = document.getElementById("amount-box-content");
                checkbox = document.getElementById("checkbox");


                half_payment = document.getElementById("half-payment");
                half_checker = document.getElementById("half-checker");

                var amount = 0
                var id_list = []
                var half = false;


                if (amount != 0) {

                    amount_box.classList.remove("disable");
                    amount_box.classList.add("active");

                } else {
                    amount_box.classList.remove("active");
                    amount_box.classList.add("disable");
                    // amount_box.disabled = false;
                }


                var all_orders = <?= json_encode($data['order']); ?>

                // Function to handle row selection
                function selectRow(checkbox, id, price, remain, pay_type) {


                    // console.log(id, price, remain, pay_type);

                    // if select all checkbox is checked when go to the another function

                    if (select_all) {

                        selectedRowsFromAllSelect(id, price, remain, pay_type);
                        return;
                    }

                    // get the selected index ids
                    let index = id_list.indexOf(id);

                    let pay_amount = 0;


                    if (pay_type == 'no') {
                        pay_amount = price
                    } else if (pay_type == 'half') {
                        pay_amount = remain

                    }

                    if (index !== -1) {
                        id_list.splice(index, 1);
                        amount = amount - pay_amount
                    } else {

                        amount = amount + pay_amount
                        id_list.push(id)
                    }

                    var order_id_str = "";
                    id_list.forEach(element => {
                        if (order_id_str != "") {

                            order_id_str = order_id_str + ", " + element
                        } else {
                            order_id_str = element

                        }
                    });

                    if (order_id_str != "") {
                        order_id_str = "[ " + order_id_str + " ]"
                    }
                    select_orders_amount.innerHTML = amount.toFixed(2);

                    // btn_price.innerHTML = amount;
                    selectHalfPay();

                    select_element.innerHTML = order_id_str;
                    // payment is grater than 100,000.00 when can pay the half
                    if (amount == 0) {

                        // select_orders_amount.innerHTML = "Please Select Yours orders";
                        half_payment.classList.remove("active");
                        half_payment.classList.add("disable");

                        half_checker.classList.remove("active");
                        half_checker.classList.add("disable");

                    } else if (amount >= 100000) {

                        half_payment.classList.remove("disable");
                        half_payment.classList.add("active");

                        half_checker.classList.remove("disable");
                        half_checker.classList.add("active");


                        select_orders_halfamount.innerHTML = (amount / 2).toFixed(2);
                    } else {
                        half_payment.classList.remove("active");
                        half_payment.classList.add("disable");

                        half_checker.classList.remove("active");
                        half_checker.classList.add("disable");
                    }


                    if (amount != 0) {

                        amount_box.classList.remove("disable");
                        amount_box.classList.add("active");

                    } else {
                        amount_box.classList.remove("active");
                        amount_box.classList.add("disable");
                        // amount_box.disabled = false;
                    }


                    var row = checkbox.parentNode.parentNode;
                    row.classList.toggle("selected");

                }

                function selectHalfPay() {
                    if (checkbox.checked) {

                        btn_price.innerHTML = (amount / 2).toFixed(2);
                        half = true;
                    } else {

                        btn_price.innerHTML = amount.toFixed(2);
                        half = false;
                    }

                }

                // Function to select all rows
                function selectAllRows() {
                    var checkboxes = document.querySelectorAll("tbody input[type='checkbox']");
                    var selectAllCheckbox = document.getElementById("selectAll");

                    checkboxes.forEach(function(checkbox) {
                        checkbox.checked = selectAllCheckbox.checked;
                        var row = checkbox.parentNode.parentNode;

                        if (selectAllCheckbox.checked) {

                            select_all = true;

                            row.classList.add("selected");
                        } else {
                            amount = 0;
                            id_list = [];
                            select_all = false;
                            row.classList.remove("selected");
                        }


                    });

                    if (selectAllCheckbox.checked) {

                        amount = 0;
                        selectedRowsFromAllSelect(0, 0, 0, "null");
                    } else {
                        console.log(id_list);
                        amount_box.classList.remove("active");
                        amount_box.classList.add("disable");
                    }

                }

                var select_all = false;

                function selectedRowsFromAllSelect(id, price, remain, pay_type) {


                    if (id == 0) {

                        all_orders.forEach(function(element) {
                            if (element.order_status != "canceled" && element.pay_type != "full") {

                                id_list.push(element.order_id);

                                if (element.pay_type == "half") {

                                    amount += element.remaining_payment
                                } else {

                                    amount += element.total_price
                                }

                            }

                        });
                    }


                    // get the selected index ids
                    let index = id_list.indexOf(id);


                    let pay_amount = 0;

                    if (pay_type == 'no') {
                        pay_amount = price
                    } else if (pay_type == 'half') {
                        pay_amount = remain

                    }

                    if (index != -1) {

                        id_list.splice(index, 1);
                        amount = amount - pay_amount

                    } else if (id != 0) {

                        amount = amount + pay_amount
                        id_list.push(id)
                    }


                    id_list = [...new Set(id_list)];

                    var order_id_str = "";
                    id_list.forEach(element => {
                        if (order_id_str != "") {

                            order_id_str = order_id_str + ", " + element
                        } else {
                            order_id_str = element

                        }
                    });

                    if (order_id_str != "") {
                        order_id_str = "[ " + order_id_str + " ]"
                    }
                    select_orders_amount.innerHTML = amount.toFixed(2);

                    // btn_price.innerHTML = amount;
                    selectHalfPay();


                    select_element.innerHTML = order_id_str;
                    // payment is grater than 100,000.00 when can pay the half
                    if (amount == 0) {

                        // select_orders_amount.innerHTML = "Please Select Yours orders";
                        half_payment.classList.remove("active");
                        half_payment.classList.add("disable");

                        half_checker.classList.remove("active");
                        half_checker.classList.add("disable");

                    } else if (amount >= 100000) {

                        half_payment.classList.remove("disable");
                        half_payment.classList.add("active");

                        half_checker.classList.remove("disable");
                        half_checker.classList.add("active");


                        select_orders_halfamount.innerHTML = (amount / 2).toFixed(2);
                    } else {
                        half_payment.classList.remove("active");
                        half_payment.classList.add("disable");

                        half_checker.classList.remove("active");
                        half_checker.classList.add("disable");
                    }


                    if (amount != 0) {

                        amount_box.classList.remove("disable");
                        amount_box.classList.add("active");

                    } else {
                        amount_box.classList.remove("active");
                        amount_box.classList.add("disable");
                        // amount_box.disabled = false;
                    }

                    // console.log(amount);
                    // console.log(id_list);

                }
            </script>

            <!-- POPUP -->

            <script>
                var paybtn = document.getElementById('pay');

                function paymentGateway(order_id, user) {

                    paybtn.disabled = true
                    paybtn.innerHTML = "<i class='bx bx-loader-circle bx-spin bx-flip-horizontal bx-xs'></i>";
                    // var paymentData = JSON.parse(dataString);

                    $(document).ready(function() {

                        data = {
                            user: user,
                            id: id_list,
                            total: amount,
                            ishalf: half
                        };

                        $.ajax({
                            type: "POST",
                            url: "<?= ROOT ?>/customer/p",
                            data: data,
                            cache: false,
                            success: function(res) {
                                try {

                                    var obj = JSON.parse(res);

                                    // Payment completed. It can be a successful failure.
                                    payhere.onCompleted = function onCompleted(orderId) {
                                        // validate the payment and show success or failure page to the customer

                                        PayedOrdersUpdate(orderId, obj.ishalf, user);

                                    };

                                    // Payment window closed
                                    payhere.onDismissed = function onDismissed() {
                                        //  Prompt user to pay again or show an error page
                                        console.log("Payment dismissed");
                                        location.reload();

                                    };

                                    // Error occurred
                                    payhere.onError = function onError(error) {
                                        // show an error page
                                        console.log("Error:" + error);
                                        location.reload();

                                    };

                                    // Put the payment variables here
                                    var payment = {
                                        sandbox: true,
                                        merchant_id: obj["merchant_id"], // Replace your Merchant ID
                                        hash: obj["hash"], // *Replace with generated hash retrieved from backend
                                        return_url: "http://localhost/project_Amoral/others/checkout.php", // Important
                                        cancel_url: "http://localhost/project_Amoral/others/checkout.php", // Important
                                        notify_url: "http://localhost/project_Amoral/others/successPay.php",
                                        order_id: obj["order_id"],
                                        items: obj["items"],
                                        amount: obj["amount"],
                                        currency: obj["currency"],
                                        first_name: obj["first_name"],
                                        last_name: obj["last_name"],
                                        email: obj["email"],
                                        phone: obj["phone"],
                                        address: obj["address"],
                                        city: obj["city"],
                                        country: obj["country"],
                                        delivery_address: obj["address"],
                                        delivery_city: "Kalutara",
                                        delivery_country: "Sri Lanka",
                                        custom_1: "",
                                        custom_2: "",
                                    };


                                    payhere.startPayment(payment);

                                } catch (error) {
                                    location.reload();

                                    paybtn.disabled = false

                                }
                            },
                            error: function(xhr, status, error) {
                                location.reload();

                                paybtn.disabled = false

                            },
                        });

                    });
                }

                function PayedOrdersUpdate(id, ishalf, user) {

                    // Split the string by comma and trim spaces
                    var idsArray = id.split(",").map(function(item) {
                        return parseInt(item.trim(), 10);
                    });

                    data = {

                        id: idsArray,
                        ishalf: ishalf,
                        user: user

                    };

                    $.ajax({
                        type: "POST",
                        url: "<?= ROOT ?>/customer/p_success",
                        data: data,
                        cache: false,
                        success: function(res) {
                            try {

                                paybtn.disabled = false


                                toastApply(
                                    "Successfull",
                                    "Your payment is added...",
                                    0
                                );

                                setTimeout(function() {
                                    location.reload();
                                    paybtn.disabled = false
                                }, 3000);

                            } catch (error) {

                                console.log(error);
                                location.reload();

                            }
                        },
                        error: function(xhr, status, error) {},
                    });


                }
            </script>


            <div class="popup-report">
                <div class="popup-content">
                    <span class="close">&times;</span>
                    <h2>Report Your Problem</h2>
                    <form method="POST">

                        <h4>Title : <span class="error title"></span> </h4>
                        <input name="title" type="text" placeholder="Enter your title">
                        <h4>Your email : <span class="error email"></span></h4>
                        <input disabled name="email" type="text" placeholder="Enter your email" value="<?= $_SESSION['USER']->email ?>">
                        <h4>Problem : <span class="error description"></span></h4>
                        <textarea name="description" id="problem" cols="30" rows="7" placeholder="Enter your problem"></textarea>

                        <button type="submit" class="close-btn pb" name="report" value="Submit">Submit</button>
                        <button type="button" class="cancelR-btn pb" onclick="closeReport()">Cancel</button>


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
                                <p class="text">Completed</p>
                            </li>

                        </ul>

                    </div>


                    <form class="update-form" method="POST">
                        <div class="user-details">
                            <div class="input-box design">
                                <button type="button" class="download">Download</button>

                                <embed name="design" type="application/pdf" style="display: none; width: 250px; height: 249px; left: 13%; position: relative; margin-bottom:0.8rem; background-color:white; border-radius:10px;">

                                <div class="carousel">
                                    <button class="carousel-left-btn" id="prevBtn">
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <div id="carouselImages" style="width: 50%; position: relative;">
                                        <!-- Carousel images will be populated here -->
                                        <img src="" class="img1" style="width: 100%; height: 100%; object-fit: cover;">
                                        <img src="" class="img2" style="width: 100%; height: 100%; object-fit: cover;">
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

                                <input type="date" name="dispatch_date_pickup">

                            </div>
                        </div>

                        <div class="user-details delivery">

                            <div class="input-box">
                                <span class="details">Delivery Expected On</span>

                                <input type="date" name="dispatch_date_delivery">
                            </div>
                            <div class="input-box">
                                <span class="details addr">City</span>

                                <input name="city" type="text">


                            </div>

                            <div class="input-box location">
                                <span class="details">Location</span>
                                <div class="googlemap" id="view-order-map" style="height: 400px; width: 100%;"></div>
                            </div>

                            <!-- hidden element -->
                            <div class="input-box">
                                <input name="latitude" type="hidden" required />
                                <input name="longitude" type="hidden" required />
                            </div>


                        </div>

                        <script>
                            //toggle delivery options
                            let delivery = document.getElementById("delivery");
                            let pickUp = document.getElementById("pickup");


                            pickUp.addEventListener('click', togglePickUp);
                            delivery.addEventListener('click', toggleDelivery);

                            function togglePickUp() {

                                document.querySelector(".user-details.pickup").classList.add("is-checked");
                                document.querySelector(".user-details.delivery").classList.remove("is-checked");

                            }

                            // view order delivary map
                            function toggleDelivery() {
                                document.querySelector(".user-details.delivery").classList.add("is-checked");
                                document.querySelector(".user-details.pickup").classList.remove("is-checked");
                            }
                        </script>

                        <style>
                            .googlemap {
                                /* background-color: red; */
                            }
                        </style>

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

                                <tr class="discount" style="display: hidden;">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>Discount(%)</td>
                                    <td class="discountPrice">0</td>
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


                        <!-- <div class="user-details">
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
                        <button class="pay">Pay</button>
                    </div>

                </div> -->




                        <input type="button" class="update-btn pb" value="Update Order" />
                        <button type="button" class="cancel-btn pb">Cancel Order</button>

                </div>

                </form>
            </div>


            <script>
                // call the ajax function for updating the order when update order button is clicked
                document.querySelector(".popup-view .update-btn").addEventListener('click', function() {
                    let updateOrderForm = document.querySelector(".popup-view .update-form");
                    let formData = new FormData(updateOrderForm);
                    var data = {};
                    for (var pair of formData.entries()) {
                        data[pair[0]] = pair[1];
                    }
                    this.setAttribute('data-order', JSON.stringify(data));
                    update_method(this);
                });

                // call the ajax function for cancelling the order when cancel order button is clicked
                document.querySelector(".popup-view .cancel-btn").addEventListener('click', function() {
                    let updateOrderForm = document.querySelector(".popup-view .update-form");
                    let orderId = document.querySelector(".update-form input[name='order_id']").value;
                    cancel_method(orderId);
                });
            </script>




            <!-- Pop up new -->
            <div class="popup-new">
                <div class="popup-content">
                    <span class="close">&times;</span>
                    <h2>New Order</h2>

                    <form class="new-form" method="POST" enctype="multipart/form-data">

                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Material </span>
                                <select required name="material[]">
                                    <option value="" selected hidden style="color: grey;">Select</option>
                                    <?php foreach ($data['materials'] as $material) : ?>
                                        <option value="<?php echo $material->stock_id ?>"><?php echo $material->material_type ?></option>
                                        <!-- <input type="hidden" name="material_id[]" value="<?php echo $material->stock_id ?>"> -->
                                    <?php endforeach; ?>

                                </select>

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
                                <div class="radio-btns">
                                    <input type="radio" id="pdf" name="fileType" value="PDF">
                                    <label for="pdf">PDF</label>

                                    <input type="radio" id="imagesUpload" name="fileType" value="Images">
                                    <label for="imagesUpload">Images</label>
                                </div>
                                <input type="file" name="pdf" id="pdfFileToUpload" accept=".pdf" style="display: none;">
                                <button class="removeButton pdf" data-input-id="pdfFileToUpload">Remove</button><br>

                                <input type="file" name="image1" id="imageFileToUpload1" accept="image/*" style="display: none;">
                                <button class="removeButton img1" data-input-id="imageFileToUpload1">Remove</button><br>

                                <input type="file" name="image2" id="imageFileToUpload2" accept="image/*" style="display: none;">
                                <button class="removeButton img2" data-input-id="imageFileToUpload2">Remove</button><br>
                            </div>

                            <script>
                                //toggle upload options
                                let pdf = document.querySelector(".design #pdf");
                                let images = document.querySelector(".design #imagesUpload");
                                let pdfUpload = document.querySelector("#pdfFileToUpload");
                                let imagesUpload1 = document.querySelector("#imageFileToUpload1");
                                let imagesUpload2 = document.querySelector("#imageFileToUpload2");
                                let removePdfButton = document.querySelector(".removeButton.pdf");
                                let removeImg1Button = document.querySelector(".removeButton.img1");
                                let removeImg2Button = document.querySelector(".removeButton.img2");



                                pdf.addEventListener('click', function() {
                                    pdfUpload.style.display = "block";
                                    imagesUpload1.style.display = "none";
                                    imagesUpload2.style.display = "none";
                                    removeImg1Button.style.display = "none";
                                    removeImg2Button.style.display = "none";
                                    if (pdfUpload.files.length > 0) {
                                        removePdfButton.style.display = "block";
                                    }

                                });

                                images.addEventListener('click', function() {
                                    imagesUpload1.style.display = "block";
                                    imagesUpload2.style.display = "block";
                                    pdfUpload.style.display = "none";
                                    removePdfButton.style.display = "none";
                                    if (imagesUpload1.files.length > 0) {
                                        removeImg1Button.style.display = "block";
                                    }
                                    if (imagesUpload2.files.length > 0) {
                                        removeImg2Button.style.display = "block";
                                    }
                                });

                                pdfUpload.addEventListener('change', function() {
                                    if (pdfUpload.files.length > 0) {
                                        removePdfButton.style.display = "block";
                                        imagesUpload1.value = '';
                                        imagesUpload2.value = '';
                                    }
                                });

                                imagesUpload1.addEventListener('change', function() {
                                    if (imagesUpload1.files.length > 0) {
                                        removeImg1Button.style.display = "block";
                                        pdfUpload.value = '';
                                    }
                                });

                                imagesUpload2.addEventListener('change', function() {
                                    if (imagesUpload2.files.length > 0) {
                                        removeImg2Button.style.display = "block";
                                        pdfUpload.value = '';
                                    }
                                });

                                removePdfButton.addEventListener('click', function(event) {
                                    event.preventDefault();
                                    clearInputAndHideButton(pdfUpload, removePdfButton);
                                });

                                removeImg1Button.addEventListener('click', function(event) {
                                    event.preventDefault();
                                    clearInputAndHideButton(imagesUpload1, removeImg1Button);
                                });

                                removeImg2Button.addEventListener('click', function(event) {
                                    event.preventDefault();
                                    clearInputAndHideButton(imagesUpload2, removeImg2Button);
                                });

                                function clearInputAndHideButton(input, button) {
                                    input.value = '';
                                    button.style.display = "none";
                                }
                            </script>

                        </div>
                        <hr class="first">

                        <h4 style="font-weight: 100; margin: 10px; color: red;">with different materials</h4>

                        <div class="add card">

                            <div class="left">
                                <i class='bx bxs-plus-circle'></i>
                                <h4>Add a material</h4>
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
                                <span class="details"> Delivery Location</span> <span class="error delmap"></span>
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
        newOrderForm.addEventListener('submit', function(event) {
            event.preventDefault();
            let noerrors = validateNewOrder();
            console.log(noerrors);
            if (noerrors) {
                let formData = new FormData(newOrderForm);
                let xhr = new XMLHttpRequest();
                console.log(formData);
                xhr.open("POST", "<?php echo ROOT ?>/customer/newOrder", true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        console.log('response' + this.responseText);
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



                        } else {
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
        let material = document.querySelector(".popup-new .user-details select[name='material[]']");
        let sleeve = document.querySelector(".popup-new .user-details select[name='sleeve[]']");
        let printingType = document.querySelector(".popup-new .user-details select[name='printingType[]']");
        let quantity = document.querySelector(".popup-new .sizes");
        // let addMaterial = document.querySelector(".add.card");
        let data = document.querySelector(".popup-new .price-details-container");
        let materialPrice = 0,
            sleevePrice = 0,
            printingTypePrice = 0;

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


        // console.log(total);

        let allMaterials = <?php echo json_encode($data['material_prices']) ?>;
        let allSleeves = <?php echo json_encode($data['sleeveType']) ?>;
        let allPrintingTypes = <?php echo json_encode($data['material_printingType']) ?>;
        // console.log(allMaterials);

        function updatePrice(doc, materialPrice, sleevePrice, printingTypePrice) {
            let unitPrice = parseInt(materialPrice) + parseInt(sleevePrice) + parseInt(printingTypePrice);

            doc.querySelector(".unitPrice").innerHTML = unitPrice;


            doc.querySelector("input[name='unit_price[]']").value = unitPrice;
            // console.log("efdsf" + doc.querySelector("input[name='unit_price[]']").value);
            generateTotalPrice();
            // document.querySelector(".totalPrice").innerHTML = currentTotal + (unitPrice * total);
        }

        function generateTotalPrice() {
            let total = 0;
            document.querySelectorAll(".units").forEach(function(unit) {
                total += parseInt(unit.querySelector(".unitPrice").innerHTML) * parseInt(unit.querySelector(".quantityAll").innerHTML);
            });
            document.querySelector(".popup-new .totalPrice").innerHTML = total;

            document.querySelector(".popup-new input[name='total_price']").value = total;
            //  console.log("tot" + document.querySelector(".popup-new input[name='total_price']").value);
        }

        material.addEventListener('change', function() {

            let materialId = material.value;
            let materialType = material.options[material.selectedIndex].text;
            let noOptions = true;
            let printingTypeOptions = '<option value="" selected hidden style="color: grey;">Select</option>';
            let materialPrintingType = <?php echo json_encode($data['material_printingType']) ?>;
            materialPrintingType.forEach(function(item) {
                if (item.stock_id == materialId) {
                    printingTypeOptions += `<option value="${item.printing_type}">${item.printing_type}</option>`;
                    noOptions = false;
                }
            });
            if (noOptions) {
                printingTypeOptions = '<option value="" selected hidden style="color: grey;">No options available</option>';
            }

            printingType.innerHTML = printingTypeOptions;
            //console.log(printingType);

            // console.log(material.value);
            allMaterials.forEach(function(item) {
                if (item.stock_id == material.value) {
                    data.querySelector(".materialType").innerHTML = item.material_type;
                    materialPrice = item.unit_price;
                }
            });

            updatePrice(document, materialPrice, sleevePrice, printingTypePrice);
        });

        sleeve.addEventListener('change', function() {
            // console.log(sleeve.value);
            allSleeves.forEach(function(item) {
                if (item.type == sleeve.value) {
                    data.querySelector(".sleeveType").innerHTML = item.type;
                    sleevePrice = item.price;
                }
            });

            updatePrice(document, materialPrice, sleevePrice, printingTypePrice);
        });

        printingType.addEventListener('change', function() {
            // console.log(printingType.value);
            allPrintingTypes.forEach(function(item) {
                if (item.printing_type == printingType.value) {
                    data.querySelector(".printingType").innerHTML = item.printing_type;
                    printingTypePrice = item.price;
                }
            });

            updatePrice(document, materialPrice, sleevePrice, printingTypePrice);
        });



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

    <script>
        let addMaterial = document.querySelector(".popup-new .add.card");
        let count = 0;


        function addMaterialCard() {
            var newCard = document.createElement("div");
            newCard.className = "user-details";
            newCard.classList.add("new-card");

            newCard.innerHTML = `
                            <i class="fas fa-minus remove"></i>
                            
                                <div class="input-box">
                                    <span class="details">Material </span>
                                    <select name="material[]">
                                        <option value="" selected hidden style="color: grey;">Select</option>
                                        <?php foreach ($data['materials'] as $material) : ?>
                                            <option value="<?php echo $material->stock_id ?>"><?php echo $material->material_type ?></option>
                                            <!-- <input type="hidden" name="material_id[]" value="<?php echo $material->stock_id ?>"> -->
                                        <?php endforeach; ?>
                                        
                                    </select>
                                    
                                </div>



                                <div class="input-box">
                                    <span class="details">Sleeves</span>
                                    <select name="sleeve[]">
                                        <option value="" selected hidden style="color: grey;">Select</option>
                                        <?php foreach ($data['sleeveType'] as $sleeve) : ?>
                                            <option value="<?php echo $sleeve->type ?>"><?php echo $sleeve->type ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="input-box" style="margin-left: 30px;">
                                    <span class="details">Printing Type</span>
                                    <select name="printingType[]">
                                        
                                    </select>
                                </div>

                                <div class="input-box sizes">
                                    <span class="details">Sizes & Quantity</span>
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
                            `;


            newCard.style.transition = "all 0.5s ease-in-out";
            addMaterial.before(newCard);

            let newPriceRow = document.createElement("tr");
            newPriceRow.className = "units";

            newPriceRow.innerHTML = `

                                <td class="materialType"></td>
                                <td class="sleeveType"></td>
                                <td class="printingType"></td>
                                <td class="quantityAll">0</td>
                                <td class="unitPrice">0</td>

                                <input type="hidden" name="unit_price[]">   

                            `;


            document.querySelector(".popup-new .price-details-container .total").before(newPriceRow);


            let sizeArr = ['xs', 'small', 'medium', 'large', 'xl', 'xxl'];

            sizeArr.forEach(function(size) {
                let input = newCard.querySelector(`input[name='${size}[]']`);
                input.addEventListener('change', function() {
                    let total = 0;
                    sizeArr.forEach(function(size) {
                        total += parseInt(newCard.querySelector(`input[name='${size}[]']`).value);
                    });
                    newPriceRow.querySelector(".quantityAll").innerHTML = total;
                    generateTotalPrice();
                });
            });

            let material1 = newCard.querySelector("select[name='material[]']");
            let sleeve1 = newCard.querySelector("select[name='sleeve[]']");
            let printingType1 = newCard.querySelector("select[name='printingType[]']");
            let quantity1 = newCard.querySelector(".sizes");
            let data1 = newPriceRow;
            let materialPrice1 = 0,
                sleevePrice1 = 0,
                printingTypePrice1 = 0;

            material1.addEventListener('change', function() {
                let materialId = material1.value;
                let materialType = material1.options[material1.selectedIndex].text;
                let noOptions = true;
                let printingTypeOptions = '<option value="" selected hidden style="color: grey;">Select</option>';
                let materialPrintingType = <?php echo json_encode($data['material_printingType']) ?>;
                materialPrintingType.forEach(function(item) {
                    if (item.stock_id == materialId) {
                        printingTypeOptions += `<option value="${item.printing_type}">${item.printing_type}</option>`;
                        noOptions = false;
                    }
                });
                if (noOptions) {
                    printingTypeOptions = '<option value="" selected hidden style="color: grey;">No options available</option>';
                }

                printingType1.innerHTML = printingTypeOptions;
                //  console.log(printingType1);


                allMaterials.forEach(function(item) {
                    if (item.stock_id == material1.value) {
                        data1.querySelector(".materialType").innerHTML = item.material_type;
                        materialPrice1 = item.unit_price;
                    }
                });

                updatePrice(data1, materialPrice1, sleevePrice1, printingTypePrice1);
            });

            sleeve1.addEventListener('change', function() {
                allSleeves.forEach(function(item) {
                    if (item.type == sleeve1.value) {
                        data1.querySelector(".sleeveType").innerHTML = item.type;
                        sleevePrice1 = item.price;
                    }
                });

                updatePrice(data1, materialPrice1, sleevePrice1, printingTypePrice1);
            });

            printingType1.addEventListener('change', function() {
                allPrintingTypes.forEach(function(item) {
                    if (item.printing_type == printingType1.value) {
                        data1.querySelector(".printingType").innerHTML = item.printing_type;
                        printingTypePrice1 = item.price;
                    }
                });


                updatePrice(data1, materialPrice1, sleevePrice1, printingTypePrice1);
            });


            let removeCard = newCard.querySelector("i");
            removeCard.addEventListener('click', function() {
                newCard.remove();
                newPriceRow.remove();
                count--;
            });

            // let material = newCard.querySelector("select[name='material[]']");
            // let printingType = newCard.querySelector("select[name='printingType[]']");
            // console.log(material);
            // console.log(printingType);



            // material1.addEventListener('change', function(){
            //     let materialId = material.value;
            //     let materialType = material.options[material.selectedIndex].text;
            //     let noOptions = true;
            //     let printingTypeOptions = '<option value="" selected hidden style="color: grey;">Select</option>';
            //     let materialPrintingType = <?php echo json_encode($data['material_printingType']) ?>;
            //     materialPrintingType.forEach(function(item){
            //         if(item.stock_id == materialId) {
            //             printingTypeOptions += `<option value="${item.printing_type}">${item.printing_type}</option>`;
            //             noOptions = false;
            //         }
            //     });
            //     if(noOptions) {
            //         printingTypeOptions = '<option value="" selected hidden style="color: grey;">No options available</option>';
            //     }

            //     printingType.innerHTML = printingTypeOptions;
            //     console.log(printingType);
            // });

        }

        //restrict the no of additional orders that can be made inside the same order
        var materialCount = <?php echo count($data['materials']) * count($data['printingType']) * count($data['sleeveType']) - 1 ?>;
        //console.log(materialCount);
        addMaterial.addEventListener('click', function() {
            if (count < materialCount - 1) {
                addMaterialCard();
                count++;
            } else {
                alert("You can only add " + materialCount + " materials");
            }
        });
    </script>


    <script>
        let update_order_endpoint = "<?php echo ROOT ?>/customer/updateOrder";
        let cancel_endpoint = "<?php echo ROOT ?>/customer/cancelOrder";
    </script>

    <script src="<?= ROOT ?>/assets/js/customer/customer-orders.js"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Fo-CyT14-vq_yv62ZukPosT_ZjLglEk&loading=async&callback=initMap"></script>

    <script src="<?= ROOT ?>/assets/js/nav-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <?php
    include 'status_confirm_popup.php';
    include 'delete_confirm_popup.php';
    ?>

</body>

</html>