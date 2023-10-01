<!DOCTYPE html>
<html lang="en">
<head>
  <title>Sidebar</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
  <script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
  </script>

</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo_details">
      <div class="logo_name">Amoral</div>
      <i class="bx bx-menu" id="btn"></i>
    </div>
    <ul class="nav-list">
      <li>
        <a href="#">
          <i class="bx bxs-grid-alt"></i>
          <span class="link_name">Overview</span>
        </a>
        <span class="tooltip">Overview</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bxs-cart-alt"></i>
          <span class="link_name">Delivery Orders</span>
        </a>
        <span class="tooltip">Delivery Orders</span>
      </li>
      <li>
        <a href="#">
          <i class="bx bxs-user-circle"></i>
          <span class="link_name">Profile</span>
        </a>
        <span class="tooltip">Profile</span>
      </li>
      <li class="profile">
        <div class="profile_details">
          <img src="elon_musk.jpg" alt="profile image">
          <div class="profile_content">
            <div class="name">Elon Musk</div>
            <div class="designation">DeliveryMan</div>
          </div>
        </div>
        <i class="bx bx-log-out" id="log_out"></i>
      </li>
    </ul>
  </div>
  

  <!-- Sidebar -->

  <!-- Navigation Bar -->
  <section class="home-section" id="navbar">
    <nav>
      <div class="nav-icons">
				<a href="#" class="nav-link">
					<i class='bx bxs-bell-ring icon' ></i>
          <span class="bell-notification">5</span>
				</a>
				<a href="#" class="nav-link">
					<i class='bx bxs-chat icon'></i>
					 <span class="chat-notification">8</span>
				</a>

        <!-- <a href="#" class="nav-link-profile">
          <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
        </a> -->
      </div>
    </nav>
    <div>
    <table id="myTable" class="display">
    <thead>
        <tr>
            <th>Order Id</th>
            <th>name</th>
            <th>Description</th>
            <th>District</th>
            <th>Contact Number</th>
            <th>Delivery Charge</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>00001</td>
            <td>Sandun</td>
            <td>this is test order</td>
            <td>Matra</td>
            <td>0724356725</td>
            <td>550</td>
        </tr>
        <tr>
            <td>00001</td>
            <td>Sandun</td>
            <td>this is test order</td>
            <td>Matra</td>
            <td>0724356725</td>
            <td>550</td>
        </tr>
        <tr>
            <td>00001</td>
            <td>Sandun</td>
            <td>this is test order</td>
            <td>Matra</td>
            <td>0724356725</td>
            <td>550</td>
        <tr>
            <td>00001</td>
            <td>Sandun</td>
            <td>this is test order</td>
            <td>Matra</td>
            <td>0724356725</td>
            <td>550</td>
        </tr>
        <tr>
            <td>00001</td>
            <td>Sandun</td>
            <td>this is test order</td>
            <td>Matra</td>
            <td>0724356725</td>
            <td>550</td>
        </tr>
        <tr>
            <td>00001</td>
            <td>Sandun</td>
            <td>this is test order</td>
            <td>Matra</td>
            <td>0724356725</td>
            <td>550</td>
        </tr>
        <tr>
            <td>00001</td>
            <td>Sandun</td>
            <td>this is test order</td>
            <td>Matra</td>
            <td>0724356725</td>
            <td>550</td>
        </tr>
        <tr>
            <td>00001</td>
            <td>Sandun</td>
            <td>this is test order</td>
            <td>Matra</td>
            <td>0724356725</td>
            <td>550</td>
        </tr>
        <tr>
            <td>00001</td>
            <td>Sandun</td>
            <td>this is test order</td>
            <td>Matra</td>
            <td>0724356725</td>
            <td>550</td>
        </tr>
    </tbody>
</table>
</div>
  </section>



  <!-- Scripts -->
  <script src="/assets/js/script-bar.js"></script>
</body>
</html>