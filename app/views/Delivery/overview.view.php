<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral Distributor Overview</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/delivery/map.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/delivery/overview.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>

    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->

    <!-- Content -->
    <section id="main" class="main">

        <div class="content">

            <nav class="sub-nav">
                <!-- <a href="" class="nav-link">Delivery</a> -->
                <!-- <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form> -->
            </nav>

            <div class="left-right">


                <main>

                    <div class="head">
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
                            <div class="middle">
                                <div class="left">
                                    <div class="leftl">
                                        <h1>Completed Deliveries</h1>
                                        <?php
                                        $count = 0;
                                        if (!empty($data['delivered'])) {
                                            foreach ($data['delivered'] as $order):
                                                $count++;

                                            endforeach;
                                        }
                                        ?>
                                        <h1><?php echo $count ?></h1>
                                        <!-- <small class="text-muted">Last 24 Hours</small> -->

                                    </div>
                                </div>
                                <i class='bx bxs-check-circle'></i>
                                <!-- <div class="progress">
                                    <svg>
                                        <circle cx='38' cy='38' r='36'></circle>
                                    </svg>

                                    <div class="number">
                                        <p>73%</p>
                                    </div>
                                </div> -->
                            </div>

                            <div class="sales">
                                <div class="orders">
                                    <div class="middle">
                                        <div class="left">
                                            <h1> Upcoming Delivery Orders</h1>
                                            <?php
                                            $count = 0;
                                            if (!empty($data['delivering'])) {
                                                foreach ($data['delivering'] as $order):
                                                    $count++;

                                                endforeach;
                                            }
                                            ?>
                                            <h1><?php echo $count ?></h1>


                                        </div>
                                        <i class='bx bxs-time'></i>
                                        <!-- <div class="progress">
                                    <svg>
                                        <circle cx='38' cy='38' r='36'></circle>
                                    </svg>

                                    <div class="number">
                                        <p>61%</p>
                                    </div>
                                </div> -->
                                    </div>
                                    <!-- <small class="text-muted">Last 48 Hours</small> -->
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="bodyf">
                        <!-- Anlysis Containers -->

                        <div class="table-data">

                            <!-- left side container -->
                            <div class="order">
                                <div class="head">
                                    <h3>Delivery Locations</h3>
                                    <!-- <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i> -->
                                </div>
                                <!-- VIEW MAP -->

                                <div class="container2">
                                    <!-- <h3> Delivery locations</h3> -->

                                    <!-- <div id="map" style="height:400px; width:100%;"></div> -->

                                    <script>
                                        let map, userMarker, directionsService, directionsRenderer;
                                        var deliveries = <?= json_encode($data['delivering']) ?>;

                                        function initMap() {
                                            directionsService = new google.maps.DirectionsService();
                                            directionsRenderer = new google.maps.DirectionsRenderer();
                                            map = new google.maps.Map(document.getElementById("map"), {
                                                zoom: 7.7,
                                                center: { lat: 7.8731, lng: 80.7718 }
                                            });
                                            directionsRenderer.setMap(map);

                                            // Iterate over the deliveries array to add markers
                                            deliveries.forEach(delivery => {
                                                addMarker({ lat: parseFloat(delivery.latitude), lng: parseFloat(delivery.longitude) }, map);
                                            });
                                            // Track user's live location
                                            if (navigator.geolocation) {
                                                navigator.geolocation.watchPosition(position => {
                                                    const pos = {
                                                        lat: position.coords.latitude,
                                                        lng: position.coords.longitude
                                                    };
                                                    if (userMarker) {
                                                        userMarker.setPosition(pos);
                                                    } else {
                                                        userMarker = new google.maps.Marker({
                                                            position: pos,
                                                            map: map,
                                                            icon: '<?= ROOT ?>/assets/images/delivery/map3.png'
                                                        });
                                                    }
                                                    map.setCenter(pos);
                                                }, () => {
                                                    handleLocationError(true, map.getCenter());
                                                });
                                            } else {
                                                // Browser doesn't support Geolocation
                                                handleLocationError(false, map.getCenter());
                                            }
                                        }

                                        function addMarker(coords) {
                                            const marker = new google.maps.Marker({
                                                position: coords,
                                                map: map,
                                                icon: '<?= ROOT ?>/assets/images/delivery/map3.png'
                                            });
                                            marker.addListener('click', () => {
                                                calculateAndDisplayRoute(directionsService, directionsRenderer, marker.getPosition());
                                            });
                                        }

                                        function calculateAndDisplayRoute(directionsService, directionsRenderer, destination) {
                                            if (userMarker) {
                                                directionsService.route({
                                                    origin: userMarker.getPosition(),
                                                    destination: destination,
                                                    travelMode: google.maps.TravelMode.DRIVING
                                                }, (response, status) => {
                                                    if (status === google.maps.DirectionsStatus.OK) {
                                                        directionsRenderer.setDirections(response);
                                                    } else {
                                                        window.alert('Directions request failed due to ' + status);
                                                    }
                                                });
                                            }
                                        }

                                        function handleLocationError(browserHasGeolocation, pos) {
                                            alert(browserHasGeolocation ?
                                                'Error: The Geolocation service failed.' :
                                                'Error: Your browser doesn\'t support geolocation.');
                                            map.setCenter(pos);
                                        }
                                    </script>

                                    <!-- <script>
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
                                    </script> -->
                                    <script async defer async defer
                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Fo-CyT14-vq_yv62ZukPosT_ZjLglEk&callback=initMap"></script>
                                    <div id="map">
                                    </div>
                                </div>
                            </div>


                            <!-- right side container -->
                            <div class="right">
                                <div class="head">
                                    <h2>Upcoming Delivery Orders</h2>
                                </div>

                                <?php

                                if (!empty($data['delivering'])) {

                                    foreach ($data['delivering'] as $order) { ?>
                                        <div class="order">
                                            <div class="re-orders">
                                                <div class="middle">
                                                    <div class="left">
                                                        <div class="Upcoming">

                                                            <h3><i class='bx bx-hash'></i>Order-Id :</h3>
                                                            <p>ORD-<?php echo htmlspecialchars($order->order_id); ?></p>

                                                        </div>

                                                        <div class="Upcoming">
                                                            <h3><i class='bx bx-user'></i>Customer Name :</h3>
                                                            <p><?php echo ucfirst(explode(' ', $order->fullname)[0]) . " " . ucfirst(explode(' ', $order->fullname)[1]); ?>
                                                            </p>
                                                        </div>

                                                        <div class="Upcoming">
                                                            <h3><i class='bx bx-buildings'></i>City :</h3>
                                                            <p><?php echo htmlspecialchars($order->city); ?></p>

                                                        </div>
                                                        <div class="Upcoming">
                                                            <h3><i class='bx bx-calendar'></i>Delivery Expected On :</h3>
                                                            <p><?php echo htmlspecialchars($order->dispatch_date); ?></p>
                                                        </div>

                                                        <div class="Upcoming">
                                                            <h3><i class='bx bx-phone'></i></i> Phone :</h3>
                                                            <p><?php echo htmlspecialchars($order->phone); ?></p>

                                                        </div>



                                                    </div>
                                                </div>
                                                <!-- <small class="text-muted">Last 24 Hours</small> -->
                                            </div>

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
                                </div>

                            </div>

                        </div>
                    </div>

                </main>



            </div>



        </div>



        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

        <script>
            var options = {
                series: [{
                    name: 'Total Cost',
                    data: [10, 3, 9, 3, 8, 5, 2],
                },],
                chart: {
                    height: 350,
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth'
                },
                xaxis: {
                    type: 'category',
                    categories: Array.from({
                        length: 30
                    }, (_, i) => (i + 1).toString()).map(day => {
                        let currentDate = new Date();
                        currentDate.setDate(day);
                        return currentDate.toISOString().slice(0, 10);
                    })
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy HH:mm'
                    },
                },
            };



            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        </script>

        <?php
        // include "loading.php";
        include __DIR__ . '/../utils/logoutPopup.php';
        ?>


        <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>



<!-- <div class="count">
                    <i class='bx bx-caret-up-circle up'></i>
                    <h2>453</h2> 
                    <input type="number" class="input-count">
                    <i class='bx bx-caret-down-circle down'></i> -->

<!-- <div class="number">
                        <p>61%</p>
                    </div> -->