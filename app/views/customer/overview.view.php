<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/customer/overview.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php'?>
    <!-- Sidebar -->

    <?php include 'navigationbar.php'?>

    <section class="main">
        <div class="main-container">
            <div class="fr one">
                <div class="title">
                    <h2>Good Morning, Elon</h2>
                    <p>Welcome back, nice to see you again</p>
                    <img src="<?= ROOT ?>/assets/images/manager/elon_musk.jpg" alt="profile image">
                </div>
                <div class="graph">
                    <h3>Expenses Statistics</h3>
                    <div id="graph"></div>
                </div>
                <div class="orders">
                    <div class="card-header">
                        <h3>Recent Orders</h3>
                        <button>View All <i class="fas fa-arrow-right"></i></button>
                    </div>

                    <div class="card-body">
                        <table width="100%">
                            <thead>
                                <tr>
                                    <td>Order ID</td>
                                    <td>Product</td>
                                    <td>Quantity</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#123</td>
                                    <td>Wetlook</td>
                                    <td>2</td>
                                    <td><span class="status delivered">Delivered</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="fr two">
                <div class="stats">
                    <h4>Statistics</h4>
                    <div class="card">
                        <div class="head stat">
                            <div class="circle">
                                <i class="fas fa-star icon"></i>
                            </div>
                            <div class="content">
                                <h4>1</h4><br>
                                <p>Current Orders</p>
                            </div>

                        </div>

                    </div>
                    <div class="card">
                        <div class="head stat">
                            <div class="circle">
                                <i class="fas fa-star icon"></i>
                            </div>
                            <div class="content">
                                <h4>1</h4><br>
                                <p>Quotation Requests</p>
                            </div>

                        </div>

                    </div>
                    <div class="card">
                        <div class="head stat">
                            <div class="circle">
                                <i class="fas fa-star icon"></i>
                            </div>
                            <div class="content">
                                <h4>Rs. 2000</h4><br>
                                <p>Total amount spent</p>
                            </div>

                        </div>

                    </div>

                    <div class="card">
                        <div class="head stat">
                            <div class="circle">
                                <i class="fas fa-star icon"></i>
                            </div>
                            <div class="content">
                                <h4>Rs. 1200</h4><br>
                                <p>Average order value</p>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <script>
        var chartData = {
            type: 'line',
            series: [
                { values: [35, 43, 70, 65] }
            ],
            plot: {
                animation: {
                    effect: 'ANIMATION_EXPAND_BOTTOM',
                    method: 'ANIMATION_STRONG_EASE_OUT',
                    speed: 5
                },
                barWidth: 16,
                borderRadius: '5px',
                barSpace: '0px',
                backgroundColor: '#000',
                borderWidth: '2px',
                borderColor: '#fff',
                hoverState: {
                    // TransitionEvent: 'linear: 7',
                    backgroundColor: '#404040',
                }
            },
            scaleX: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr']
            },
            scaleY: {
                label: {
                    text: 'Expenses'
                }
            },
            tooltip: {
                text: '$%v'
            }
        };
        zingchart.render({
            id: 'graph',
            data: chartData,
            height: 400,
            width: '100%'
        });
    </script>

    <!-- Scripts -->
    <script src="<?=ROOT ?>/assets/js/script-bar.js"></script>

    <!-- content  -->
    
</body>

</html>