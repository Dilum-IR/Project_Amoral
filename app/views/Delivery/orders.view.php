<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sidebar</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/delivery/delivery-orders.css">

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
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th class="ordId">OrderId</th>
                            <th class="Name">Customer Name</th>
                            <th class="Distric">District</th>
                            <th class="stth">Status</th>
                            <th></th>
                        </tr>
                    <tbody>
                        <tr>
                            <td>101</td>
                            <td>John Doe</td>
                            <td>New York</td>
                            <td>Shipped</td>
                            <td><button type="submit" name="selectItem" class="view-order-btn" onclick="openView()">View
                                    Order</button>
                            </td>
                        </tr>


                    </tbody>
                    </thead>





                    <!-- <?php
                    if (isset($data)) {
                        // show($data);
                        $sn = 1;
                        foreach ($data as $item) {
                            if ($item->order_status == 'Package_OnWay') {
                                // echo $item->order_status;
                    
                                ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td class="ordId"><?php echo $item->order_id ?></td>
                        <td class="Name">thiran</td>
                        <td class="Distric"><?php echo $item->district ?></td>
                        <td class="stth"><?php echo $item->order_status ?></td>
                        <!-- <td><button type="submit" name="selectItem"  class="view-order-btn" data-order='<?= json_encode($item); ?>' onclick="openView(this)">View Order</button></td> -->
                                <td><button type="submit" name="selectItem" class="view-order-btn" onclick="openView()">View
                                        Order</button></td>
                                </tr>


                                <?php
                            }
                        }
                    }

                    ?> -->

                </table>
            </div>
        </div>

    </section>


    <!-- POPUP REPORT -->
    <div class="popup-report">
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
    </div>

    <!-- POPUP VIEW -->

    <div class="popup-view" id="popup-view">
        <h2>Order Details</h2>
        <div class="status">
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

                        <!-- <i class="uil uil-check"></i> -->
                    </div>
                    <p class="text">Package Delivered</p>
                </li>

            </ul>
        </div>

        <div class="detail_content">
            <div class="container1">
                <form>
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">Order Id </span>
                            <input type="text" required onChange="" readonly value="1" />
                        </div>

                        <div class="input-box">
                            <span class="details">Customer Name </span>
                            <input type="text" required onChange="" readonly value="thiran" />
                        </div>

                        <div class="input-box">
                            <span class="details">Delivery Address</span>
                            <input type="text" required onChange="" readonly value="matara" />
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

            <!-- VIEW MAP -->

            <div class="container2">
                <!-- <h3> Delivery locations</h3> -->
                <div id="map">
                </div>
            </div>

        </div>

        <div class="btns">
            <button type="submit" class="update-btn">Update Order</button>
            <button type="button" class="ok-btn" onclick="closeView()">OK</button>

        </div>
    </div>



    <div id="overlay" class="overlay"></div>


    <script>
        function initMap() {
            var location = { lat: 7.873054, lng: 80.771797 }
            var map = new google.maps.Map(document.getElementById("map"), {
                zoom: 7.7,
                center: { lat: 7.8731, lng: 80.7718 }
            });


            /*Add marker
            var marker = new google.map.Marker({
                position:{lat:6.927079,lng:79.861244},
                map:map, 
                icon:'map-pin-icon.png'
            });
             /*Add marker function*/

            addMarker({ lat: 6.927079, lng: 79.861244 });
            addMarker({ lat: 7.291418, lng: 80.636696 });
            addMarker({ lat: 5.9496, lng: 80.5469 });


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
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key= AIzaSyDRuOIwM93jm3D-_IrEKZCFShSzp-Idgwo&callback=initMap"></script>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/delivery/delivery-orders.js"></script>
</body>

</html>