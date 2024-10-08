<?php

// show($data['data1'][0]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral Distributor Orders</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/delivery/delivery-orders.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>


    <!-- Sidebar -->

    <?php include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <?php
    // include "loading.php";
    include __DIR__ . '/../utils/logoutPopup.php';
    ?>

    <style>
        /* .logout-modal{
            top: 50%;
            left: 50%;
        } */
        .modal-content {
            top: 0%;
            left: 0%;
        }
    </style>

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
                <!-- <input class="btn" type="button" onclick="openReport()" value="Report Problem"> -->
            </div>

        </form>
        <div class="table">
            <!-- Add buttons for the two types -->
            <div class="filters">
                <button id="delivering" class="active" onclick="filterTable(1)">Delivery Orders</button>
                <button id="delivered" class="active" onclick="filterTable(2)">Delivered Orders</button>
            </div>
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th class="ordId">OrderId</th>
                            <th class="Name">Customer Name</th>
                            <th class="Distric">City</th>
                            <th class="payed">Paid</th>
                            <th class="remianing">Remaining<br>Payment</th>
                            <th class="stth">Status</th>
                            <th></th>
                        </tr>
                    <tbody>
                        <?php
                        if (!empty($data)) {

                            foreach ($data as $key => $value) {

                                ?>
                                <tr class='<?= $value->order_status ?>'>
                                    <td>
                                        ORD-<?php echo $value->order_id; ?>
                                    </td>
                                    <td>
                                        <?php echo ucfirst($value->fullname); ?>
                                    </td>
                                    <td>
                                        <?php echo ucfirst($value->city); ?>
                                    </td>
                                    <td>
                                        <b <?php if ($value->pay_type == 'no') {
                                            ?> style="color: red;" <?php
                                        } else if ($value->pay_type == 'half') {
                                            ?> style="color: #ff8f00;" <?php
                                        }

                                        ?>><?php echo ucfirst($value->pay_type); ?></b>
                                    </td>
                                    <td>
                                        <?php

                                        if ($value->pay_type == "no")
                                            echo "<b style='color: red;'>" . number_format($value->total_price, 2, '.', ',') . "</b>";
                                        else if ($value->pay_type == "half")
                                            echo "<b style='color:  #ff8f00;'> " . number_format($value->remaining_payment, 2, '.', ',') . "</b>";
                                        else
                                            echo number_format("0", 2, '.', ',');
                                        ?>
                                    </td>
                                    <td class="st" id="status-<?= htmlspecialchars($value->order_id); ?>">

                                        <div class="text-status <?= $value->order_status ?>">

                                            <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                                            <?php echo htmlspecialchars($value->order_status); ?>
                                        </div>

                                    </td>
                                    <!-- <td><button type="submit" name="selectItem" class="view-order-btn" onclick="openView()">Delivered</button>
                                </td> -->
                                    <td>
                                        <?php if ($value->order_status != 'delivered'): ?>
                                            <button type="submit" class="view-order-btn" style="background-color: green;"
                                                id="status-<?= $value->order_id; ?>"
                                                onclick="confirmPopup(<?= $value->order_id; ?>,'<?= $value->pay_type; ?>')">Mark as
                                                Delivered</button>


                                            <!-- Button 1 -->
                                            <!-- <button onclick="showPopup('popup1')">Open Popup 1</button> -->
                                        <?php endif; ?>



                                        <button type="submit" name="selectItem" data-order='<?= json_encode($value); ?>'
                                            class="view-order-btn" onclick="openView(this)">View
                                            Order</button>
                                    </td>
                                </tr>

                                <?php

                            }
                        } else {
                            ?>
                            <tr>
                                <td></td>


                                <td>
                                    No Available Orders


                                </td>
                                <td></td>
                            </tr>

                            <?php
                        }
                        ?>


                    </tbody>
                    </thead>

                </table>

            </div>

        </div>



    </section>

    <style>
        .st {
            text-align: -webkit-center !important;
        }

        .text-status {
            padding: 6px 16px !important;
            border-radius: 30px;
            gap: 3px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            width: max-content;
            color: white;
        }

        .st .delivering {
            background-color: #5d52ff;
        }

        .st .delivered {
            background-color: green;
        }

        .table-section tbody tr {
            display: none;

        }

        .delivering.delivering-row-active {
            display: table-row !important;

        }

        .delivered.delivered-row-active {
            display: table-row !important;

        }
    </style>




    <!-- <script>
        function searchOrders() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("orderSearch");
            filter = input.value.toUpperCase();
            table = document.getElementById("yourTableId"); // Make sure your table has an ID
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those that don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Choose the index according to your needs, e.g., 1 for Customer Name
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

    </script> -->

    <!-- delivered confirm pop-up -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span><i class="bx bx-x close" style="color: #ff0000"></i></span>
            <div class="bxbx">
                <i class='bx bxs-error-circle bx-tada icon-warn' style='color:#ffd900'></i>
            </div>
            <div class="H2">
                <div class="recived-checker">
                    <input type="checkbox" class="payed-check" id="payedCheckbox" name="payed">
                    <label for="payedCheckbox" class="checker-label">Order Payments Received!</label>
                </div>
                <h2>Are you sure ?</h2>
            </div>
            <!-- payedCheckbox -->
            <div class="modalbtn">
                <button type="submit" class="button" id="cancel" onclick="closeReport()">No</button>
                <!-- <button class="button" id="confirm">Yes</button> -->
                <button class="button" type="button" id="confirm" disabled>Yes</button>
            </div>

        </div>
    </div>

    <!--   Deliverd confirm pop up js with ajax -->

    <script>
        var modal1 = document.getElementById('myModal');
        var confirmButton = document.getElementById('confirm');
        var cancelButton = document.getElementById('cancel');
        var closeButton = document.querySelector('.modal .close');

        const confirm_checkboxs = document.getElementById("payedCheckbox");

        // document.addEventListener('DOMContentLoaded', function() {

        // Make sure this function is declared globally
        function confirmPopup(orderId, pay_type) {

            // if (pay_type == 'full') {
            //     document.querySelector('.recived-checker').innerHTML = "";
            //     document.getElementById('confirm').disabled = false; 
            // } 
            // else {
            //     document.querySelector('.recived-checker').innerHTML = '<input type="checkbox" id="payedCheckbox" name="payed"> <label for="payedCheckbox" class="checker-label">Order Payments Received!</label>';
            //     document.getElementById('confirm').disabled = true;

            // }    
            modal1.style.display = 'block'; // Check if this line executes correctly


            confirmButton.onclick = function () {


                updateStatus(orderId);
                modal1.style.display = 'none';

            };
        };


        closeButton.onclick = cancelButton.onclick = function () {
            modal1.style.display = 'none';
        };

        // });


        // table checkbox

        console.log(confirm_checkboxs);

        // confirm_checkboxs.addEventListener('change', function(check) {
        //     console.log(check);


        //     if (confirm_checkboxs.checked) {

        //         document.getElementById("confirm").disabled = false;
        //     } else {
        //         document.getElementById("confirm").disabled = true;
        //     }
        // });
    </script>



    <!-- POPUP -->
    <!-- <div class="popup-report">
        <div class="popup-content">
            <span class="close">&times;</span>
            <h2>Report Your Problem</h2>
            <form class="form" method="POST">

                <h4>Title : <span class="error title"></span> </h4>
                <input name="title" type="text" placeholder="Enter your title">
                <h4>Your email : <span class="error email"></span></h4>
                <input name="email" type="text" placeholder="Enter your email">
                <h4>Problem : <span class="error description"></span></h4>
                <textarea name="description" id="problem" cols="30" rows="5"
                    placeholder="Enter your problem"></textarea>

                <button type="submit" class="close-btn pb" name="report" value="Submit">Submit</button>
                <button type="button" class="cancelR-btn pb" onclick="closeReport()">Cancel</button>


            </form>
        </div>
    </div> -->

    <!-- POPUP VIEW -->

    <div class="popup-view" id="popup-view">
        <div class="popup-content">
            <div class="h1">
                <h1>Order Details</h1>
            </div>
            <!-- <div class="status">
            <ul>
                <li>
                    <iconify-icon
                        icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                    <div class="progress one">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Package Pending</p>
                </li>

                <li>
                    <iconify-icon icon="game-icons:card-pickup"></iconify-icon>
                    <div class="progress two">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Package Received</p>
                </li>
                <li>
                    <iconify-icon icon="tabler:truck-delivery"></iconify-icon>
                    <div class="progress three">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Package On the Way</p>
                </li>
                <li>
                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                    <div class="progress four">

                         <i class="uil uil-check"></i> 
                    </div>
                    <p class="text">Package Delivered</p>
                </li>

            </ul>
        </div> -->

            <div class="detail_content">
                <div class="container1">
                    <form>
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Order Id </span>
                                <input id="order-id" type="text" required onChange="" readonly value=" " />
                            </div>

                            <div class="input-box">
                                <span class="details">Customer Name </span>
                                <input id="customer-name" type="text" required onChange="" readonly value=" " />
                            </div>

                            <div class="input-box">
                                <span class="details">City</span>
                                <input id="delivery-city" type="text" required onChange="" readonly value=" " />
                            </div>

                            <div class="input-box">
                                <span class="details">Contact Number</span>
                                <input id="contact-num" type="text" required onChange="" readonly value=" " />
                            </div>

                            <div class="input-box">
                                <span class="details">Delivery Expected On</span>
                                <input id="expected-on" type="text" required onChange="" readonly value=" " />
                            </div>
                            <!-- <div class="input-box" id="remain">
                                <span class="details">Remaining Payment</span>
                                <input id="remaining-on" type="text" required onChange="" readonly value=" " />
                            </div> -->

                            <!-- <div class="recived-checker popup-checker">
                                <input type="checkbox" id="myCheckbox_1" name="payed">
                                <label for="myCheckbox_1" class="checker-label">Order Payments Received!</label>
                            </div> -->
                        </div>

                    </form>
                </div>

                <style>
                    .btns {
                        margin-bottom: 0%;
                    }

                    .popup-checker {

                        margin: 20px 20px;
                        margin-right: 0;

                    }

                    .checker-label {
                        font-size: 15px;
                        color: red;
                        font-weight: bold;
                    }
                </style>

                <!-- VIEW MAP -->

                <div class="container2">
                    <!-- <h3> Delivery locations</h3> -->

                    <!-- <div id="map" style="height:400px; width:100%;"></div> -->


                    <script>
                        // popup checkbox
                        // var checkbox_popup = document.getElementById('myCheckbox_1');

                        // checkbox_popup.addEventListener('change', function() {
                        //     if (this.checked) {

                        //         // console.log("xdgxfgf")

                        //         document.getElementById('popup-confirm-btn').disabled = false;
                        //     } else {
                        //         document.getElementById('popup-confirm-btn').disabled = true;
                        //     }
                        // });


                        let map;
                        let directionsService;
                        let directionsRenderer;

                        function initMap(order_id, latitude, longitude) {
                            directionsService = new google.maps.DirectionsService();
                            directionsRenderer = new google.maps.DirectionsRenderer();
                            map = new google.maps.Map(document.getElementById("map"), {
                                zoom: 7.7,
                                center: {
                                    lat: 34.0522,
                                    lng: -118.2437
                                } // Default center, adjust as needed
                            });
                            directionsRenderer.setMap(map);

                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function (position) {
                                    const currentPosition = {
                                        lat: position.coords.latitude,
                                        lng: position.coords.longitude
                                    };
                                    addMarker(currentPosition, '<?= ROOT ?>/assets/images/delivery/map3.png', 'Your Location');
                                    // addMarker(currentPosition);
                                    // You need to fetch or define `order` here correctly
                                    if (order_id && latitude && longitude) {
                                        const orderLocation = {
                                            lat: parseFloat(latitude),
                                            lng: parseFloat(longitude)
                                        };
                                        addMarker(location, '<?= ROOT ?>/assets/images/delivery/map3.png', 'Delivery Location');
                                        // addMarker(orderLocation);
                                        calculateAndDisplayRoute(currentPosition, orderLocation);
                                    }
                                }, function (error) {
                                    console.error("Geolocation error: " + error.message);
                                });
                            } else {
                                console.error("Geolocation is not supported by this browser.");
                            }
                        }


                        function calculateAndDisplayRoute(start, end) {
                            directionsService.route({
                                origin: start,
                                destination: end,
                                travelMode: google.maps.TravelMode.DRIVING,
                            }, (response, status) => {
                                if (status === google.maps.DirectionsStatus.OK) {
                                    directionsRenderer.setDirections(response);
                                } else {
                                    window.alert('Directions request failed due to ' + status);
                                }
                            });
                        }



                        /*Add marker
                        var marker = new google.map.Marker({
                            position:{lat:6.927079,lng:79.861244},
                            map:map, 
                            icon:'map-pin-icon.png'
                        });
                         /*Add marker function*/

                        // addMarker(currentPosition);

                        // addMarker(location);

                        /*Add marker function*/
                        function addMarker(coords, iconUrl, label) {
                            const marker = new google.maps.Marker({
                                position: coords,
                                map: map,
                                icon: iconUrl,
                                label: label
                            });

                            // Optionally, add an infowindow to each marker
                            const infowindow = new google.maps.InfoWindow({
                                content: label
                            });


                            infowindow.open(map, marker);

                        }
                    </script>
                    <script async defer async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Fo-CyT14-vq_yv62ZukPosT_ZjLglEk&callback=initMap"></script>
                    <div id="map">

                    </div>
                </div>
            </div>

            <div class="btns">
                <button type="button" class="ok-btn" onclick="closeView()">Back to orders</button>
                <button type="button" class="update-btn" id="popup-confirm-btn" onclick="confirmWithPopup()">Mark as
                    Delivered</button>
            </div>
        </div>

    </div>





    <!-- <div id="overlay" class="overlay"></div> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/delivery/delivery-orders.js"></script>


    <script>

        function updateStatus(orderId) {

            // document.querySelector('.view-order-btn').innerHTML = "";
            // document.querySelector('.view-order-btn').disabled = true;
            console.log("asfasfa");

            $.ajax({
                url: "<?= ROOT ?>/delivery/updateOrderStatus",
                type: 'POST',
                data: {
                    order_id: orderId,
                    status: 'delivered'
                },
                success: function (response) {
                    $('#status-' + orderId).text('Delivered');
                    location.reload();
                },
                error: function (xhr, status, error) {
                    //  handle errors
                    console.error("Error: " + error);
                    console.error("Status: " + status);
                    console.dir(xhr);
                }
            });
        }
    </script>

</body>

</html>