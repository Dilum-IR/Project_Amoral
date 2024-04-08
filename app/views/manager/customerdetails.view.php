<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/customerdetails.css">
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
                <a href="#" class="active">Customer Details</a>
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
                    <input class="new-btn" type="button" onclick="openNew(this)" value="Add Customer">
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
                            <th >Id</th>
                            <th >Name</th>
                            <th >City</th>
                            <th >Address</th>
                            <th >Contact No.</th>
                            <th >E-mail</th>
                            <!-- <th>Position</th> -->
                            <th ></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // show($data);
                        foreach ($data as $cst) : ?>

                            <tr>
                                <td class="ordId"><?php echo $cst->id ?></td>
                                <td><?php echo $cst->fullname ?></td>
                                <td><?php echo $cst->city ?></td>
                                <td><?php echo $cst->address ?></td>
                                <td><?php echo $cst->phone ?> </td>
                                <td><?php echo $cst->email ?> </td>
                                <!-- <td class="st">
                                <div class="text-status <?php echo $cst->status ?>"><?php echo $cst->status ?></div>
                                <div class="progress-bar"></div>
                                </td> -->

                                <td><button style="color: #000000e0;" type="submit" name="selectItem" class="edit" data-cst='<?= json_encode($cst); ?>' onclick="openView(this)">View</button> <button style="color: #ff0000de;">Remove</button>
                                    <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                            </tr>

                    
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </section>


    <!-- POPUP -->


    <div class="popup-view" id="popup-view">
        <!-- Popup content -->
        <h2>Customer Details</h2>

        <div class="popup-content">
            <form class="update-form" method="POST">

                <div class="user-details-title">
                    <h3>Edit Customer Details</h3>
                </div>

                <div class="profile-image">
                    <img src="<?= ROOT ?>/assets/images/home/4.jpg" alt="" width="200px" height="200px" style="border-radius: 50%;">
                </div>

                <div class="user-details">

                    <div class="input-box">
                        <span class="details">Customer Id </span>
                        <input type="text" id="" readonly name="emp_id" />
                    </div>

                    <div class="input-box">
                        <span class="details">Customer Name </span>

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

    <!-- Popup for Adding New Customer -->
    <div class="popup-new">

        <div class="popup-content">
            <h2>Add new Customer</h2>
            <form method="POST">
                <div class="form">
                    <div class="input-box">
                        <span class="details">Customer Name</span>
                        <input class="new-emp-details" type="text" name="emp_name" placeholder="Enter name" required>
                        <!-- <label class="placeholder" for="input">Enter text here...</label> -->
                    </div>

                    <div class="input-box">
                        <span class="details">Profession</span><br>
                        <select class="new-emp-details" name="emp_status">
                            <option value="manager">Manager</option>
                            <option value="merchandiser">Merchandiser</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">E-mail</span><br>
                        <input class="new-emp-details" type="email" name="email" placeholder="Enter e-mail" required>
                    </div>

                    <div class="input-box">
                        <span class="details">City</span><br>
                        <input class="new-emp-details" type="text" name="city" placeholder="Enter Address" required>
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
                        <span class="details">Date of Birth</span><br>
                        <input class="new-emp-details" type="date" name="DOB" placeholder="Enter Address" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Upload an Image</span><br>
                        <input class="new-emp-details emp-image" type="file" accept=".jpg, .png" name="emp_image" placeholder="Enter Address" required>
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
    <script src="<?= ROOT ?>/assets/js/manager/customerdetails.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>