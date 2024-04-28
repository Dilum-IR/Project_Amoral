<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manager</title>
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
                            <th>Id</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Contact No.</th>
                            <th>E-mail</th>
                            <!-- <th>Position</th> -->
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($data)) {
                            // show($data);
                            foreach ($data as $cst) :

                            ?>
                                <tr>
                                    <td class="ordId"><?php echo $cst->id ?></td>
                                    <td><?php echo $cst->fullname ?></td>
                                    <td><?php echo $cst->city ?></td>
                                    <td><?php echo $cst->address ?></td>
                                    <td><?php echo $cst->phone ?> </td>
                                    <td><?php echo $cst->email ?> </td>


                                    <td style="word-break:normal;">
                                        <div class="view-remove-buttons">
                                            <button style="color: #000000e0;" type="submit" name="selectItem" class="edit" data-cst='<?= json_encode($cst); ?>' onclick="openView(this)">View</button>
                                            <form method="POST">
                                                <button name="cstRemove" style="color: #ff0000de;">Remove</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php

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
                        <input type="text" id="" readonly name="id" />
                    </div>

                    <div class="input-box">
                        <span class="details">Customer Name </span>

                        <input type="text" required onChange="" value="" name="fullname" />
                    </div>

                    <div class="input-box">
                        <span class="details">E-mail</span>
                        <input type="email" required onChange="" value="" name="email" />
                    </div>

                    <div class="input-box">
                        <span class="details">City</span>
                        <input type="text" required onChange="" value="" name="city" />
                    </div>

                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" required onChange="" value="" name="address" />
                    </div>

                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input type="text" required onChange="" value="" name="phone" />
                    </div>
                </div>

                <div class="user-details-button">
                    <button type="submit" name="cstUpdate" class="update-btn pb">Update Details</button>
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
                        <input class="new-emp-details" type="text" name="fullname" placeholder="Enter full name" required>
                        <!-- <label class="placeholder" for="input">Enter text here...</label> -->
                    </div>

                    <!-- <div class="input-box">
                        <span class="details">User Status</span><br>
                        <select class="new-emp-details" name="user_status">
                            <option value="customer">Customer</option>
                        </select>
                    </div> -->

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
                        <input class="new-emp-details" type="text" name="phone" placeholder="Enter contact number" required>
                    </div>

                </div>
                <div class="btns">
                    <button type="submit" class="update-btn pb" value="newCustomer" name="newCustomer">Submit</button>
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