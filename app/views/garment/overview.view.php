<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta http-equiv="refresh" content="2; url=<?= ROOT ?>/garment/overview"> -->

    <!-- hard refresh -->
    <!-- ctrl+ F5 -->

    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/garment/overview.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>
    <?php

    // include "loading.php";
    include __DIR__ . '/../utils/toastMsg.php';
    ?>

    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->

    <!-- Content -->
    <section id="main" class="main">

        <div class="content">

            <nav class="sub-nav">
                <a href="" class="nav-link">Garment</a>
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
                        <a href="" class="btn-download">
                            <i class='bx bxs-cloud-download'></i>
                            <span class="text">Download PDF</span>
                        </a>
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
                        <div class="orders">
                            <i class='bx bxs-calendar-check'></i>
                            <div class="middle">
                                <div class="left">
                                    <h3>Current Orders</h3>
                                    <h1><?= $overview['current'] ?></h1>

                                </div>
                                <div class="progress">
                                    <svg>
                                        <circle cx='38' cy='38' r='36'></circle>
                                    </svg>

                                    <div class="number">
                                        <p>61%</p>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>


                        <div class="sales">
                            <i class='bx bxs-calendar-check'></i>
                            <div class="middle">
                                <div class="left">
                                    <h3>Completed Orders</h3>
                                    <h1><?= $overview['completed'] ?></h1>

                                </div>
                                <div class="progress">
                                    <svg>
                                        <circle cx='38' cy='38' r='36'></circle>
                                    </svg>

                                    <div class="number">
                                        <p>73%</p>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                        <div class="sales">
                            <i class=' bx bxs-dollar-circle'></i>
                            <div class="middle">
                                <div class="left">
                                    <h3>Total Sales</h3>
                                    <h1>$ 2500,00</h1>

                                </div>
                                <div class="progress">
                                    <svg>
                                        <circle cx='38' cy='38' r='36'></circle>
                                    </svg>

                                    <div class="number">
                                        <p>68%</p>
                                    </div>
                                </div>
                            </div>
                            <small class="text-muted">Last 24 Hours</small>
                        </div>
                    </div>

                    <!-- Anlysis Containers -->

                    <div class="table-data">

                        <!-- left side container -->
                        <div class="order">
                            <div class="head">
                                <h3>Recent Orders</h3>
                                <a id="info-btn-1" class="info-btn" href="<?=ROOT?>/garment/orders">View</a>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Date Order</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (!empty($data['recent_orders'])) {

                                        foreach ($recent_orders as $key => $item) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <!-- <img src="img/people.png"> -->
                                                    <p><?= $item->order_id?></p>
                                                </td>
                                                <td>01-10-2021</td>
                                                <td><span class="text-status <?= $item->status?>"><?= $item->status?></span></td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- left side container -->


                        <style>
                            main .todo .orders {
                                /* width: 250px; */
                                background: white !important;
                                padding: 20px;
                                border-radius: 10px;
                                box-shadow: 0px 0px 5px 0px rgb(187, 184, 184);
                                transition: 0.5s ease-in-out;
                                /* border-right: 10px solid rgb(233, 229, 229); */
                                margin-bottom: 15px;

                            }

                            .todo {
                                height: max-content;
                            }

                            main .todo .orders:hover {
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

                            .info-btn {
                                background-color: rgba(0, 0, 0, 0.888);
                                color: white;
                                border: none;
                                padding: 5px 15px;
                                border-radius: 15px;
                                text-align: center;
                                text-decoration: none;
                                display: inline-block;
                                font-size: 16px;
                                margin: 4px 2px;
                                cursor: pointer;
                                float: right;
                                transition: 0.5s ease-in-out;

                            }

                            .info-btn:hover {

                                background-color: rgba(0, 0, 0, 1);
                                box-shadow: 0px 0px 10px 0px rgb(187, 184, 184);

                            }

                            button:disabled {
                                background-color: rgba(0, 0, 0, 0.6) !important;
                            }

                            input[type=number]::-webkit-inner-spin-button,
                            input[type=number]::-webkit-outer-spin-button {
                                -webkit-appearance: none;
                            }
                        </style>

                        <!-- right side container -->
                        <div class="todo">
                            <div class="head">
                                <h3>Garment information</h3>
                                <!--  <i class='bx bx-plus'></i>
                                <i class='bx bx-filter'></i> -->
                            </div>

                            <div class="orders">
                                <div class="middle">
                                    <div class="left">
                                        <i class='bx bx-objects-vertical-center'></i>
                                        <h3>Daily capacity</h3>

                                    </div>
                                    <div class="count">
                                        <i id="d-cap-up" class='bx bx-caret-up-circle up'></i>

                                        <input id="g-capacity" type="number" class="input-count" value="<?= $info->day_capacity ?>">
                                        <i id="d-cap-down" class='bx bx-caret-down-circle down'></i>

                                        <!-- <div class="number">
                                                <p>61%</p>
                                            </div> -->
                                    </div>
                                </div>
                                <!-- <small class="text-muted">Last 24 Hours</small> -->
                            </div>

                            <div class="orders">
                                <div class="middle">
                                    <div class="left">
                                        <i class='g-info bx bx-group'></i>
                                        <h3>No. of workers</h3>

                                    </div>
                                    <div class="count">
                                        <i id="n-work-up" class='bx bx-caret-up-circle up'></i>

                                        <input id="g-workers" type="number" class="input-count" value="<?= $info->no_workers ?>">
                                        <i id="n-work-down" class='bx bx-caret-down-circle down'></i>
                                    </div>
                                </div>
                                <!-- <small class="text-muted">Last 24 Hours</small> -->
                            </div>

                            <button id="info-btn" class="info-btn">Update</button>

                        </div>

                        <script>
                            endpoint = "<?= ROOT ?>/garment/update_info";

                            var capacity = 0;
                            var workers = 0;

                            g_capacity = document.getElementById('g-capacity');
                            g_workers = document.getElementById('g-workers');
                            info_btn = document.getElementById('info-btn');

                            capacity = parseInt(g_capacity.value);
                            workers = parseInt(g_workers.value);

                            // when use the input tag type with changes 
                            g_capacity.addEventListener('input', function(event) {

                                capacity = parseInt(event.target.value);
                                capacity = check_capacity(capacity)
                                g_capacity.value = capacity;
                            });

                            g_workers.addEventListener('input', function(event) {

                                workers = parseInt(event.target.value);
                                workers = check_workers(workers)
                                g_workers.value = workers;
                            });


                            // capacity up and down arrow
                            document.getElementById('d-cap-up').addEventListener('click', function() {

                                capacity += 1
                                capacity = check_capacity(capacity)
                                g_capacity.value = capacity;
                            });
                            document.getElementById('d-cap-down').addEventListener('click', function() {

                                capacity -= 1
                                capacity = check_capacity(capacity)
                                g_capacity.value = capacity;


                            });

                            // workers up and down arrow
                            document.getElementById('n-work-up').addEventListener('click', function() {

                                workers += 1
                                workers = check_workers(workers)
                                g_workers.value = workers;
                            });
                            document.getElementById('n-work-down').addEventListener('click', function() {

                                workers -= 1
                                workers = check_workers(workers)
                                g_workers.value = workers;
                            });


                            function check_capacity(cap) {

                                if (cap <= 10 || isNaN(cap)) {
                                    cap = 10;

                                } else if (cap > 100000) {
                                    cap = 100000;

                                }
                                return cap;
                            }

                            function check_workers(work) {

                                if (work <= 1 || isNaN(work)) {
                                    work = 1;

                                } else if (work > 20000) {
                                    work = 20000;

                                }
                                return work;
                            }

                            info_btn.addEventListener('click', function() {

                                if (capacity == 0 || isNaN(capacity))
                                    return;

                                if (workers == 0 || isNaN(workers))
                                    return;

                                info_btn.disabled = true;

                                data = {
                                    day_capacity: capacity,
                                    no_workers: workers
                                };

                                $.ajax({
                                    type: "POST",
                                    url: endpoint,
                                    data: data,
                                    cache: false,
                                    success: function(res) {
                                        try {
                                            // convet to the json type
                                            Jsondata = JSON.parse(res);
                                            // console.log(Jsondata.u);

                                            if (Jsondata.u == "no") {

                                                toastApply("Update Warning", "This information already updated...", 2);

                                            } else if (Jsondata.u == "yes") {
                                                toastApply("Update Success", "Company information updated...", 0);

                                            } else {
                                                toastApply("Update Failed", "Try again later...", 1);

                                            }
                                            setTimeout(() => {
                                                info_btn.disabled = false;
                                                // location.reload();
                                            }, 4000);

                                        } catch (error) {
                                            toastApply("Update Failed", "Try again later...", 1);
                                            info_btn.disabled = false;
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        toastApply("Update Failed", "Try again later...", 1);
                                        info_btn.disabled = false;
                                    },
                                });
                            });
                        </script>

                    </div>

                </main>

            </div>

        </div>
    </section>
    <!-- Import JQuary Library script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>

</body>

</html>