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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include 'navigationbar.php' ?>
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
                <!-- <input class="btn" type="button" onclick="openReport()" value="Report Problem"> -->
            </div>

        </form>
        <div class="table">
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th class="ordId">OrderId</th>
                            <th class="Name">Customer Name</th>
                            <th class="Distric">City</th>
                            <th class="stth">Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    <tbody>
                        <?php
                        if (!empty($data['data1'])) {


                            foreach ($data['data1'] as $key => $value) {

                                ?>
                                <tr>
                                    <td>
                                        <?php echo $value->order_id; ?>
                                    </td>
                                    <td>
                                        <?php echo $value->fullname; ?>
                                    </td>
                                    <td>
                                        <?php echo $value->city; ?>
                                    </td>
                                    <td id="status-<?= htmlspecialchars($value->order_id); ?>">
                                        <?php echo htmlspecialchars($value->order_status); ?>
                                    </td>
                                    <!-- <td><button type="submit" name="selectItem" class="view-order-btn" onclick="openView()">Delivered</button>
                                </td> -->
                                    <td>
                                        <?php if ($value->order_status != 'delivered'): ?>
                                            <button type="submit" class="view-order-btn" style="background-color: red;"
                                                id="status-<?= $value->order_id; ?>"
                                                onclick="confirmPopup(<?= $value->order_id; ?>)">Delivered</button>


                                            <!-- Button 1 -->
                                            <!-- <button onclick="showPopup('popup1')">Open Popup 1</button> -->
                                        <?php endif; ?>

                                    </td>

                                    <td><button type="submit" name="selectItem" data-order='<?= json_encode($value); ?>'
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



    <script>

    </script>

    <!-- delivered confirm pop-up -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span><i class="bx bx-x close" style="color: #ff0000"></i></span>
            <div class="bxbx">
                <i class='bx bxs-error-circle bx-tada icon-warn' style='color:#ffd900'></i>
            </div>
            <div class="H2">
                <h2>Are you sure ?</h2>
            </div>

            <div class="modalbtn">
                <button type="submit" class="button" id="cancel" onclick="closeReport()">No</button>
                <!-- <button class="button" id="confirm">Yes</button> -->
                <button class="button" type="button" id="confirm">Yes</button>
            </div>

        </div>
    </div>


    <!--   Deliverd confirm pop up js with ajax -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById('myModal');
            var confirmButton = document.getElementById('confirm');
            var cancelButton = document.getElementById('cancel');
            var closeButton = document.querySelector('.modal .close');

            closeButton.onclick = cancelButton.onclick = function () {
                modal.style.display = 'none';
            };

            // Make sure this function is declared globally
            window.confirmPopup = function (orderId) {
                modal.style.display = 'block'; // Check if this line executes correctly
                confirmButton.onclick = function () {
                    updateStatus(orderId);
                    modal.style.display = 'none';

                };
            };
        });


        function updateStatus(orderId) {
            $.ajax({
                url: "<?= ROOT ?>/delivery/updateOrderStatus",
                type: 'POST',
                data: { order_id: orderId, status: 'delivered' },
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
                            <span class="details">Delivery Address</span>
                            <input id="delivery-address" type="text" required onChange="" readonly value=" " />
                        </div>

                        <div class="input-box">
                            <span class="details">Order Placed On</span>
                            <input id="placed-on" type="text" required onChange="" readonly value=" " />
                        </div>

                        <div class="input-box">
                            <span class="details">Delivery Expected On</span>
                            <input id="expected-on"type="text" required onChange="" readonly value=" " />
                        </div>
                    </div>

                </form>
            </div>

            <!-- VIEW MAP -->

            <div class="container2">
                <!-- <h3> Delivery locations</h3> -->

                <!-- <div id="map" style="height:400px; width:100%;"></div> -->


                <script>
                    function initMap(orderid,lat,lng) {
                        var location = { lat: parseFloat(lat), lng: parseFloat(lng) };

                        var map = new google.maps.Map(document.getElementById("map"), {
                            zoom: 7.7,
                            center:location
                        });


                        /*Add marker
                        var marker = new google.map.Marker({
                            position:{lat:6.927079,lng:79.861244},
                            map:map, 
                            icon:'map-pin-icon.png'
                        });
                         /*Add marker function*/

                         addMarker(location);


                        /*Add marker function*/

                        function addMarker(coords) {
                            var marker = new google.maps.Marker({
                                position: coords,
                                map: map,
                                icon: '<?= ROOT ?>/assets/images/delivery/map3.png'
                            });

                        }


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
            <button type="button" class="update-btn" onclick="confirmWithPopup()">Update Order</button>
        </div>

    </div>



    <div id="overlay" class="overlay"></div>




    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/delivery/delivery-orders.js"></script>
</body>

</html>