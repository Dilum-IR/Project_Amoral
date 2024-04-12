<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sidebar</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/delivery/map.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/delivery/overview.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
                <a href="" class="nav-link">Delivery</a>
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
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
                                    <h1>Completed Deliveries</h1>
                                    <h1>5</h1>
                                    <small class="text-muted">Last 24 Hours</small>

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
                                            <h1> Recent Deliveries</h1>
                                            <h1>8</h1>

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
                                    <i class='bx bx-search'></i>
                                    <i class='bx bx-filter'></i>
                                </div>
                                <!-- VIEW MAP -->

                                <div class="container2">
                                    <!-- <h3> Delivery locations</h3> -->

                                    <!-- <div id="map" style="height:400px; width:100%;"></div> -->



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
                                    <script async defer async defer
                                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7Fo-CyT14-vq_yv62ZukPosT_ZjLglEk&callback=initMap"></script>
                                    <div id="map">
                                    </div>
                                </div>
                            </div>
                            <!-- left side container -->

                            <style>
                                main .re-orders {
                                    /* width: 250px; */
                                    background-color: rgb(187, 184, 184) !important;
                                    padding: 20px;
                                    border-radius: 10px;
                                    box-shadow: 0px 0px 5px 0px rgb(187, 184, 184);
                                    transition: 0.5s ease-in-out;
                                    /* border-right: 10px solid rgb(233, 229, 229); */
                                    margin-bottom: 15px;

                                }

                                main .re-orders:hover {
                                    transform: scale(1.025);
                                }

                                .middle {
                                    width: 100%;
                                    align-items: center;
                                    justify-content: space-between;
                                    display: flex;

                                    .left,
                                    .count {
                                        display: flex;
                                        align-items: center;
                                        gap: 10px;

                                        .bx {
                                            font-size: 20px;
                                            transition: 0.5s ease-in-out;

                                        }

                                        .down:hover {
                                            color: red;
                                        }

                                        .up:hover {
                                            color: #1c7012cc;
                                        }
                                    }

                                }

                                .g-info {
                                    font-size: 20px;
                                }

                                .input-count {
                                    width: 100px;
                                    height: 30px;
                                    outline: none;
                                    border: none;
                                    box-shadow: 0px 0px 5px 0px rgb(187, 184, 184);
                                    text-align: center;
                                    border-radius: 10px;
                                    font-weight: bold;
                                    font-size: 20px;
                                }
                            </style>
                            <!-- right side container -->
                            <div class="order">
                                <div class="head">
                                    <h2>Recent Orders</h2>
                                </div>

                                <div class="re-orders">
                                    <div class="middle">
                                        <div class="left">
                                            <i class='g-info bx bx-group'></i>
                                            <h3>No. of workers</h3>

                                        </div>
                                        <div class="count">
                                            <i class='bx bx-caret-up-circle up'></i>
                                            <!-- <h2>453</h2> -->
                                            <input type="number" class="input-count">
                                            <i class='bx bx-caret-down-circle down'></i>

                                            <!-- <div class="number">
                                                <p>61%</p>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- <small class="text-muted">Last 24 Hours</small> -->
                                </div>
                                <div class="re-orders">
                                    <div class="middle">
                                        <div class="left">
                                            <i class='g-info bx bx-group'></i>
                                            <h3>No. of workers</h3>

                                        </div>
                                        <div class="count">
                                            <i class='bx bx-caret-up-circle up'></i>
                                            <!-- <h2>453</h2> -->
                                            <input type="number" class="input-count">
                                            <i class='bx bx-caret-down-circle down'></i>

                                            <!-- <div class="number">
                                                <p>61%</p>
                                            </div> -->
                                        </div>
                                    </div>
                                    <!-- <small class="text-muted">Last 24 Hours</small> -->
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

        <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>