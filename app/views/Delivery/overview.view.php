<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sidebar</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?=ROOT ?>/assets/css/delivery/overview.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php'?>
    <!-- Sidebar -->

    <?php include 'navigationbar.php'?>
    <!-- Scripts -->

    <section class="main">
        <!-- <button class="quotation" onclick="">Request Quotation</button> -->
        <h1 class="title">Welcome!</h1>
        <hr>
        
        <div class="info-data">
            <div class="card">
                <div class="head">
                    <div>
                        <h2>10</h2>
                        <p>Ongoing Delivery</p>
                    </div>
          
                </div>
                <span class="progress" data-value="50%" style="--value: 50%;"></span>
                <span class="label">50%</span>
            </div>
            <div class="card">
                <div class="head">
                    <div>
                        <h2>4</h2>
                        <p>Successful Delivery</p>
                    </div>
              
                </div>
                <span class="progress" data-value="20%" style="--value: 20%;"></span>
                <span class="label">20%</span>
            </div>


            <div class="card">
                <div class="head">
                    <div>
                        <h2>6</h2>
                        <p>Pending Delivery</p>
                    </div>
              
                </div>
                <span class="progress" data-value="30%" style="--value: 30%;"></span>
                <span class="label">30%</span>
            </div>


        </div>
        <div class="data">
            <div class="content-data">
                <div class="head">
                    <h3>Delivery Routes</h3>
                </div>
                <div class="chart">
                    <div id="chart"></div>
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
            name: 'Total Cost',
            data: [10, 3, 9,3, 8, 5, 2],
        }, ],
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
            categories: Array.from({ length: 30 }, (_, i) => (i + 1).toString()).map(day => {
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
    <script src="<?=ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>