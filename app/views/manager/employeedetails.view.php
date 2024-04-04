<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/employeedetails2.css">
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
                    <input class="new-btn" type="button" data-emp='<?= json_encode($emp); ?>' onclick="openNew(this)" value="Add Employee">
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
                        // show($data);
                        foreach ($data as $emp) : ?>

                            <!-- <?php
                                    if (!$emp->is_quotation) : ?> -->
                            <tr>
                                <td class="ordId"><?php echo $emp->emp_id ?></td>
                                <td><?php echo $emp->emp_image ?></td>
                                <td><?php echo $emp->emp_name ?></td>
                                <td><?php echo $emp->email ?></td>
                                <td><?php echo $emp->contact_number ?> </td>
                                <td><?php echo $emp->city ?> </td>
                                <td><?php echo $emp->emp_status ?> </td>
                                <!-- <td class="st">
                                <div class="text-status <?php echo $emp->status ?>"><?php echo $emp->status ?></div>
                                <div class="progress-bar"></div>
                                </td> -->

                                <td><button style="color: #000000e0;" type="submit" name="selectItem" class="edit" data-emp='<?= json_encode($emp); ?>' onclick="openView(this)">View</button> <button style="color: #ff0000de;">Remove</button>
                                    <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                            </tr>

                            <!-- <?php endif; ?> -->
                        <?php endforeach; ?>
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
                    <img src="<?= ROOT ?>/assets/images/home/4.jpg" alt="" width="200px" height="200px" style="border-radius: 50%;">
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
                        <span class="details">Profession</span>
                        <input type="text" required onChange="" value="" name="emp_status" />
                        <!-- <select name="emp_status">
                        <option name="employee1" value="Manager"></option>
                        <option name="employee2" value="Merchandiser"></option>
                        <option name="employee3" value="Deliveryman"></option>
                </select> -->
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
                        <span class="details">Date of Birth</span>
                        <input type="date" required onChange="" value="" name="DOB" />
                    </div>

                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input type="text" required onChange="" value="0766464639" name="contact_number" />
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
                <button type="button" class="close-btn" onclick="closeNew()">Cancel</button>
            </div>
        </form>
        <!-- Popup content -->
    </div>
    <!-- New Table -->




    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/manager/employeedetails.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>