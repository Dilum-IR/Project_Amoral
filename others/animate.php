<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sidebar</title>
  <!-- Link Styles -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>

  <!-- Content -->
  <section id="main" class="main">

    <div class="chart"></div>

    <button onclick="changeToDaily()">Daily</button>
    <style>
      .chart {
        width: 50%;
      }
    </style>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <script>
      var chart;

      function changeToDaily() {
        var options = {
          series: [{
              name: 'Total Cost',
              data: [0, 0, 0, 3, 8, 5, 2],
              color: '#008FFB', // Adjust color for Total Cost
              fill: {
                type: 'solid',
                opacity: 1,
              }
            },
            {
              name: 'Total Revenue',
              data: [0, 2, 1, 5, 6, 3, 5],
              color: '#00E396', // Adjust color for Total Revenue
              fill: {
                type: 'solid',
                opacity: 1,
              }
            }
          ],
          chart: {
            height: 350,
            type: 'area'
          },
          dataLabels: {
            enabled: false
          },
          stroke: {
            curve: 'smooth',
            width: 2,
          },
          xaxis: {
            type: 'category',
            categories: Array.from({
              length: 30
            }, (_, i) => {
              let currentDate = new Date();

              // alert(currentDate);
              currentDate.setDate(currentDate.getDate() - (30 - i));
              return currentDate.toLocaleDateString('en-US', {
                month: 'short',
                day: '2-digit'
              });
            }),
            axisTicks: {
              show: true,
              borderType: 'solid',
              color: '#E0E0E0',
              height: 6,
              offsetX: 0,
              offsetY: 0
            },
            axisBorder: {
              show: true,
              color: '#E0E0E0',
              height: 1,
              width: '100%',
              offsetX: 0,
              offsetY: 0
            }
          },
          tooltip: {
            x: {
              format: 'dd/MM/yy HH:mm'
            },
          },
          grid: {
            show: false,
          }
        };

        if (chart) {
          chart.destroy();
        }

        chart = new ApexCharts(document.querySelector(".chart"), options);
        chart.render();
      }

      changeToDaily();
    </script>
  </section>
</body>

</html>


<!-- Array.from({
      length: 30
    }, (_, i) => (i + 1).toString()).map(day => {
      let currentDate = new Date();
      currentDate.setDate(day);
      return currentDate.toISOString().slice(0, 10);
    })
     -->