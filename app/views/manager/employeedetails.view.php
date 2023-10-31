<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/employeedetails.css">
    <!-- <link rel="stylesheet" href="<?=ROOT ?>/assets/css/customer/quotation.css"> -->
    <!-- <link rel="stylesheet" href="<?=ROOT?>/assets/css/manager/profile.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->

    <!-- Navigation Bar -->
    <?php include 'navigationbar.php'?>
    <!-- Navigation Bar -->

        <!-- content  -->
        <section id="main" class="main">

<h2>Employee Details</h2>

<form>
    <div class="form">
        <input class="form-group" type="text" placeholder="Search...">
        <i class='bx bx-search icon'></i>
        <input class="new-btn" type="button" onclick="openNew()" value="+ New Employee">
       
    </div>

</form>

<table class="table">
    <thead>
        <tr>
            <th></th>
            <th class="ordId">ID</th>
            <th class="desc">Name</th>
            <th class="stth">Profession</th>
            <th class="cost">Email</th>
            <th class="cost">Address</th>
            <th class="cost">Contact No.</th>
            <th></th>
        </tr>
    </thead>
        <?php $count = 1; foreach($data as $emp): ?>
            <tr>
                <td><?php echo $count; $count++; ?></td>
                <td class="ordId"><?php echo $emp->emp_id ?></td>
                <td class="desc"><?php echo $emp->emp_name ?></td>
                <td class="prof"><?php echo $emp->emp_status ?>
                </td>
                <td class="cost"><?php echo $emp->email ?></td>
                <td class="add"><?php echo $emp->address ?></td>
                <td class="cont"><?php echo $emp->contact_number ?></td>
                <td><button type="submit" class="view-order-btn" data-order='<?= json_encode($emp); ?>' onclick="openView(this)">Update</button></td>
                <td><button type="submit" class="view-order-btn-remove" data-id="<?php echo $emp->emp_id; ?>" onclick="">Remove</button></td>
            </tr>
        <?php endforeach; ?>


    <!-- <tr>
        <td>1</td>
        <td class="ordId">002345</td>
        <td class="desc">Material : Wetlook <br>
            Sizes & Quantity : S - 2
        </td>
        <td class="st">
            <div class="text-status">Processing</div>
        </td>
        <td class="cost">Rs. 2400</td>
        <td><button type="submit" class="view-order-btn" onclick="openView()">View Order</button></td>
    </tr> -->
</table>

</section>


<!-- POPUP -->
       


<div class="popup-view" id="popup-view">
    <h2>Employee Details</h2>
    
    
    <div class="container1">
        <form class="update-form" method="POST">
        <button type="submit" name="empUpdate" class="update-btn pb">Update Details</button>
        <button type="button" class="cancel-btn pb">Cancel</button>
        <div class="user-details">
            <div class="input-box">
                <span class="details">Employee Id </span>
                <input type="text" id="" readonly  name="emp_id" />
            </div>

            <div class="input-box">
                <span class="details">Employee Name </span>
              
                <input type="text" required onChange=""  value="Steve Jobs" name="emp_name" />
            </div>

            <div class="input-box">
                <span class="details">Profession</span>
                <!-- <select name="emp_status">
                        <option name="employee1" value="Manager"></option>
                        <option name="employee2" value="Merchandiser"></option>
                        <option name="employee3" value="Deliveryman"></option>
                </select> -->
            </div>

            <div class="input-box">
                <span class="details">E-mail</span>
                <input type="email" required onChange=""  value="steve@jobs.apple" name="email" />
            </div>

            <div class="input-box">
                <span class="details">Address</span>
                <input type="text" required onChange=""  value="Padukka" name="address"/>
            </div>

            <div class="input-box">
                <span class="details">Contact Number</span>
                <input type="text" required onChange=""  value="0766464639" name="contact_number"/>
            </div>
        </div>
    </form>
</div>
<button type="button" class="ok-btn" onclick="closeView()">OK</button>
</div>
<div id="overlay" class="overlay"></div>


<!--  ----------------------------------------------------------------------
    Add new Employee
------------------------------------------------------------------------ --> 
<div class="popup-new">
        <h2>Add new Employee</h2>
        <form method="POST">
            <div class="form">
            <div class="input-box">
                    <span class="details">Employee Name</span>
                    <input type="text" name="emp_name" placeholder="Enter name" required>
                </div>
                
                <div class="input-box">
                    <span class="details">Profession</span><br>
                    <select name="emp_status">
                        <option value="manager">Manager</option>
                        <option value="merchandiser">Merchandiser</option>
                        <option value="delivery">Delivery</option>
                    </select>
                </div>
        
                <div class="input-box">
                    <span class="details">E-mail</span><br>
                    <input type="email" name="email" placeholder="Enter e-mail" required>
                </div>

                <div class="input-box">
                    <span class="details">Address</span><br>
                    <input type="text" name="address" placeholder="Enter Address" required>
                </div>
                <div class="input-box">
                    <span class="details">Contact Number</span>
                    <input type="text" name="contact_number" placeholder="Enter contact number" required>
                </div>
                <!-- <div class="input-box">
                    <span class="details">Date of Birth</span>
                    <input type="date" name="birthday">
                </div> -->
            </div>
            <div class="btns">
                <button type="submit" class="cancel-btn" value="newEmployee" name="newEmployee">Submit</button>
                <button type="button" class="close-btn"   onclick="closeNew()">Cancel</button>
            </div>
        </form>
    </div>



<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script src="<?= ROOT ?>/assets/js/manager/employeedetails.js"></script>
<script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>