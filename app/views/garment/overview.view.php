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
                <a href="" class="nav-link">Garment</a>
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
                                    <h1>453</h1>

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
                                    <h1>2500</h1>

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
                                <i class='bx bx-search'></i>
                                <i class='bx bx-filter'></i>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Date Order</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="img/people.png">
                                            <p>John Doe</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td><span class="status completed">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/people.png">
                                            <p>John Doe</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td><span class="status pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/people.png">
                                            <p>John Doe</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td><span class="status process">Process</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/people.png">
                                            <p>John Doe</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td><span class="status pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <img src="img/people.png">
                                            <p>John Doe</p>
                                        </td>
                                        <td>01-10-2021</td>
                                        <td><span class="status completed">Completed</span></td>
                                    </tr>
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

                            .todo{
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
                            }


                            input[type=number]::-webkit-inner-spin-button,
                            input[type=number]::-webkit-outer-spin-button {
                                -webkit-appearance: none;
                            }
                        </style>
                        <!-- right side container -->
                        <div class="todo">
                            <div class="head">
                                <h3>Company information</h3>
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

                            <div class="orders">
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

                            <button class="info-btn">Update</button>

                        </div>

                    </div>

                </main>

            </div>

        </div>
    </section>

    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>