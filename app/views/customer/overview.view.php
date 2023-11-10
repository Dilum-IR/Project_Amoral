<!DOCTYPE html>
<html lang="en">

<head>
    <title>Customer</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/customer/overview.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php'?>
    <!-- Sidebar -->

    <?php include 'navigationbar.php'?>

    <section class="main">
        <div class="main-container">
            <div class="info-data">
                <div class="card">
                    <div class="head">
                        <div>
                            <h2>Welcome, Elon!</h2>
                            <p>Start designing your t-shirt</p>
                        </div>
                        <input type="button" value="Design"
                            style="position:absolute; padding: 2px 10px; background-color: black; color: white; border-radius: 5px; margin-top: 82px; left: 38px; cursor: pointer;">
                    </div>

                </div>
            </div>
            <div class=" stats">
                <h4>Statistics</h4>
                <div class="card">
                    <div class="head stat">
                        <div class="circle">
                            <i class="bx bx-trending-up icon"></i>
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
                            <i class="bx bx-trending-up icon"></i>
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
                            <i class="bx bx-trending-up icon"></i>
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
                            <i class="bx bx-trending-up icon"></i>
                        </div>
                        <div class="content">
                            <h4>Rs. 1200</h4><br>
                            <p>Average order value</p>
                        </div>

                    </div>

                </div>

            </div>
        </div>

        <div class="recent-grid">
            <div class="orders">
                <div class="card">
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


            <div class="data">
                <div class="content-data">
                    <div class="head">
                        <h3>Payment History</h3>
                    </div>
                    <div class="chart">
                        <div id="chart"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <script>
   var options = {
            series: [{
                name: 'Payment',
                data: [0, 20, 0, 0, 0, 0, 0, 50],
            }],
            chart: {
                height: 350,
                type: 'bar'
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                type: 'category',
                categories: Array.from({ length: new Date().getDate()  }, (_, i) => (i + 1).toString()).map(day => {
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

    <!-- Scripts -->
    <script src="<?=ROOT ?>/assets/js/script-bar.js"></script>

    <!-- content  -->
    
</body>

</html>