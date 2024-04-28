<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manager</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/employeedetails.css">
    <!-- <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/employeepopup.css"> -->
    <!-- <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/quotation.css"> -->
    <!-- <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/profile.css"> -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->

    <!-- Navigation Bar -->
    <?php include 'navigationbar.php' ?>
    <!-- Navigation Bar -->

    <!-- New Table -->
    <!-- content  -->

    <section id="main" class="main">

        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <i class='bx bx-chevron-right'></i>
            <li>
                <a href="#" class="active">Employee Details</a>
            </li>

        </ul>

        <form>
            <div class="form">
                <form action="#">
                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </div>
                </form>
                <div class="add-btn">
                    <input class="new-btn" type="button" onclick="openNew(this)" value="Add Employee">
                </div>
            </div>

        </form>

        <div class="emp-table">
            <!-- <div class="table-header">
                <p>Order Details</p>
                <div>
                    <input placeholder="emp"/>
                    <button class="add_new">+ Add New</button>
                </div>
            </div> -->
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>E - mail</th>
                            <th>Contact No.</th>
                            <th>City</th>
                            <th>Position</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($data)) {
                            // show($data);
                            foreach ($data as $emp) :
                                if ($emp->emp_status != 'garment') {
                        ?>

                                    <tr>
                                        <td class="ordId"><?php echo $emp->emp_id ?></td>
                                        <!-- <td><?php echo $emp->emp_image ?></td> -->
                                        <td><img style="border-radius: 50px; border:none;" src="<?= ROOT ?>/uploads/profile_img/Employee/<?php echo $emp->emp_image ?>" ></td>

                                        <td><?php echo $emp->emp_name ?></td>
                                        <td><?php echo $emp->email ?></td>
                                        <td><?php echo $emp->contact_number ?> </td>
                                        <td><?php echo $emp->city ?> </td>
                                        <td><?php echo $emp->emp_status ?> </td>
                                        <!-- <td class="st">
                                <div class="text-status <?php echo $emp->status ?>"><?php echo $emp->status ?></div>
                                <div class="progress-bar"></div>
                                </td> -->

                                        <td style="word-break:normal;">
                                            <div class="view-remove-buttons">
                                                <button style="color: #000000e0;" type="submit" name="selectItem" class="edit" data-emp='<?= json_encode($emp); ?> 'data-dl='<?= json_encode($dl); ?>' onclick="openView(this)">View</button>
                                                <form method="POST">
                                                    <input type="hidden" name="emp_id" value="<?php echo $emp->emp_id ?>">
                                                    <button type="submit" name="empRemove" style="color: #ff0000de;">Remove</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>

                            <?php
                                }
                            endforeach;
                        } else {
                            ?>
                            <tr>
                                <td>No Availble Data</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </section>


    <!-- POPUP -->


    <div class="popup-view" id="popup-view">
        <!-- Popup content -->
        <h2>Employee Details</h2>

        <div class="popup-content">
            <form class="update-form" method="POST">

                <div class="user-details-title">
                    <h3>Edit Employee Details</h3>
                </div>

                <div class="profile-image">
                    <img src="" name="emp_image" alt="" width="200px" height="200px" style="border-radius: 50%;">
                </div>

                <div class="user-details">

                    <div class="input-box">
                        <span class="details">Employee Id </span>
                        <input type="text" id="" readonly name="emp_id" />
                    </div>

                    <div class="input-box">
                        <span class="details">Employee Name </span>
                        <input type="text" required onChange="" value="" name="emp_name" />
                    </div>

                    <div class="input-box">
                        <span class="details">NIC </span>
                        <input type="text" required onChange="" value="" name="nic" />
                    </div>


                    <div class="input-box">
                        <span class="details">Profession</span>
                        <input type="text" required onChange="" value="" name="emp_status" readonly>
                        <select class="upt-emp-details" name="emp_status">
                            <option value="manager">Manager</option>
                            <option value="merchandiser">Merchandiser</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">E-mail</span>
                        <input type="email" required onChange="" value="steve@jobs.apple" name="email" />
                    </div>

                    <div class="input-box">
                        <span class="details">City</span>
                        <input type="text" required onChange="" value="Padukka" name="city" />
                    </div>

                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" required onChange="" value="" name="address" />
                    </div>

                    <div class="input-box">
                        <span class="details" >Date of Birth</span>
                        <input type="date" required onChange="" value="" name="DOB" />
                    </div>

                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input type="text" required onChange="" value="" name="contact_number" />
                    </div>


                </div>

                <div class="user-details-button">
                    <button type="submit" name="empUpdate" class="update-btn pb">Update Details</button>
                    <button type="button" class="cancel-btn pb" onclick="closeView()">Cancel</button>

                </div>
            </form>
        </div>
        <!-- <button type="button" class="ok-btn" onclick="closeView()">OK</button> -->
    </div>
    <div id="overlay" class="overlay"></div>

    <!-- Popup for Adding New Employee -->
    <div class="popup-new">

        <div class="popup-content">
            <h2>Add new Employee</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="form">
                    <div class="input-box">
                        <span class="details">Employee Name</span>
                        <input class="new-emp-details" type="text" name="emp_name" placeholder="Enter name" required>
                        <!-- <label class="placeholder" for="input">Enter text here...</label> -->
                    </div>

                    <div class="input-box">
                        <span class="details">NIC</span><br>
                        <input class="new-emp-details" type="text" name="nic" placeholder="Enter NIC Number" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Profession</span><br>
                        <select class="new-emp-details" name="emp_status" onchange="showAdditionalFields(this)">
                            <option value="manager">Manager</option>
                            <option value="merchandiser">Merchandiser</option>
                            <option value="delivery">Delivery</option>
                            <option value="garment">Garment</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">E-mail</span><br>
                        <input class="new-emp-details" type="email" name="email" placeholder="Enter e-mail" required>
                    </div>

                    <div class="input-box">
                        <span class="details">City</span><br>
                        <input class="new-emp-details" type="text" name="city" placeholder="Enter City" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Address</span><br>
                        <input class="new-emp-details" type="text" name="address" placeholder="Enter Address" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input class="new-emp-details" type="text" name="contact_number" placeholder="Enter contact number" required>
                    </div>

                    <div class="input-box">
                        <span class="details" id="date">Date of Birth</span><br>
                        <input class="new-emp-details" type="date" name="DOB" placeholder="Enter Birthday" required>
                    </div>

                    <div class="input-box" id="cutting" style="display: none;">
                        <span class="details">Cutting Price</span><br>
                        <input disabled class="new-emp-details" type="text" name="cut_price" placeholder="Enter Cutting Price" required>
                    </div>

                    <div class="input-box" id="sewing" style="display: none;">
                        <span class="details">Sewing Price</span><br>
                        <input disabled class="new-emp-details" type="text" name="sewed_price" placeholder="Enter Sewing Price" required>
                    </div>

                    <div class="input-box" id="workers" style="display: none;">
                        <span class="details">Number of Workers</span><br>
                        <input disabled class="new-emp-details" type="text" name="no_workers" placeholder="Enter Sewing Price" required>
                    </div>

                    <div class="input-box" id="capacity" style="display: none;">
                        <span class="details">Day Capacity</span><br>
                        <input disabled class="new-emp-details" type="text" name="day_capacity" placeholder="Enter Day Capacity" required>
                    </div>

                 
                    <div class="input-box">
                        <span class="details">Vehicle Type</span><br>
                        <select id="vehicle" disabled class="new-emp-details" name="vehicle_type" >
                            <option value="van">Van</option>
                            <option value="lorry">Lorry</option>
                            <option value="three-wheel">Three Wheel</option>
                            <option value="bike">Bike</option>
                        </select>
                    </div>

                       <div class="input-box" id="vehicle-no" style="display: none;">
                        <span class="details">Vehicle Number</span><br>
                        <input disabled class="new-emp-details" type="text" name="vehicle_number" placeholder="Vehicle Number" required>
                    </div>




                    <div class="input-box" id="max-capacity" style="display: none;">
                        <span class="details">Max Capacity</span><br>
                        <input disabled class="new-emp-details" type="text" name="max_capacity" placeholder="Enter Max Capacity" required>
                    </div>


                    <div class="input-box">
                        <span class="details">Upload an Image</span><br>
                        <input class="new-emp-details emp-image" type="file" accept=".jpg, .png" name="emp_image"  required>
                    </div>

                </div>
                <div class="btns">
                    <button type="submit" class="update-btn pb" value="newEmployee" name="newEmployee">Submit</button>
                    <button type="button" class="cancel-btn pb" onclick="closeNew()">Cancel</button>
                </div>
            </form>
            <!-- Popup content -->
        </div>
    </div>
    <!-- New Table -->




    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/manager/employeedetails.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>