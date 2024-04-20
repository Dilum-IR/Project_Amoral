<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Circular Progress Bar </title>

  <!-- CSS -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <div class="container">
      <div class="circular-progress">
        <span class="progress-value">0%</span>
      </div>

    <!-- <span class="text">HTML & CSS</span> -->
  </div>

  <!-- JavaScript -->
  <script>
    let circularProgress = document.querySelector(".circular-progress"),
      progressValue = document.querySelector(".progress-value");

    let progressStartValue = 0,
      progressEndValue = 70,
      speed = 15;

    let progress = setInterval(() => {
      progressStartValue++;

      progressValue.textContent = `${progressStartValue}%`
      circularProgress.style.background = `conic-gradient(#7d2ae8 ${progressStartValue * 3.6}deg, #ededed 0deg)`

      if (progressStartValue == progressEndValue) {
        clearInterval(progress);
      }
    }, speed);
  </script>
  <style>
    /* Google Fonts - Poppins */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      /* background: #7d2ae8; */
    }

    .container {
      display: flex;
      width: 40px;
      padding: 50px 0;
      border-radius: 8px;
      background: #fff;
      row-gap: 30px;
      flex-direction: column;
      align-items: center;
    }

    .circular-progress {
      position: relative;
      height: 120px;
      width: 120px;
      border-radius: 50%;
      background: conic-gradient(#7d2ae8 3.6deg, #ededed 0deg);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .circular-progress::before {
      content: "";
      position: absolute;
      height: 100px;
      width: 100px;
      border-radius: 50%;
      background-color: #fff;
    }

    .progress-value {
      position: relative;
      font-size: 30px;
      font-weight: 600;
      color: #7d2ae8;
    }

    .text {
      font-size: 10px;
      font-weight: 500;
      color: #606060;
    }
  </style>
</body>


</html>