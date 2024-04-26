<!DOCTYPE html>
<html lang="en">

<head>
    <title>Manager</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/garmentdetails.css">
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
                <a href="#" class="active">Garment Details</a>
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
                    <input class="new-btn" type="button" onclick="openNew(this)" value="Add Garment">
                </div>
            </div>

        </form>

        <div class="gmnt-table">
            <!-- <div class="table-header">
                <p>Order Details</p>
                <div>
                    <input placeholder="gmnt"/>
                    <button class="add_new">+ Add New</button>
                </div>
            </div> -->
            <div class="table-section">
                <table>
                    <thead>
                        <tr>
                            <th>Garment Id</th>
                            <th>Name</th>
                            <th>E - mail</th>
                            <th>Contact No.</th>
                            <th>City</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // show($data);
                        if (!empty($data)) {


                            foreach ($data as $gmnt) :
                        ?>

                                <tr>
                                    <td class="ordId"><?php echo $gmnt->garment_id ?></td>
                                    <td><?php echo $gmnt->emp_name ?></td>
                                    <td><?php echo $gmnt->email ?></td>
                                    <td><?php echo $gmnt->contact_number ?> </td>
                                    <td><?php echo $gmnt->location ?> </td>
                                    <td><?php echo $gmnt->address ?> </td>



                                    <td>
                                        <div class="view-remove-buttons">
                                            <button type="submit" name="selectItem" class="edit" data-gmnt='<?= json_encode($gmnt); ?>' onclick="openView(this)">View Details</button>
                                            <form action="" method="POST">
                                                <input type="hidden" name="garment_id" value="<?php echo $gmnt->garment_id ?>">
                                                <button type="submit" name="empRemove" style="color: #ff0000de;">Remove</button>
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
        <h2>Garment Details</h2>

        <div class="popup-content">
            <form class="update-form" method="POST">

                <div class="user-details-title">
                    <h3>Edit Garment Details</h3>
                </div>

                <!-- <div class="profile-image">
                    <img src="<?= ROOT ?>/assets/images/home/4.jpg" alt="" width="200px" height="200px" style="border-radius: 50%;">
                </div> -->

                <div class="user-details">

                    <div class="input-box">
                        <span class="details">Garment Id </span>
                        <input type="text" id="" readonly name="garment_id" />
                    </div>

                    <div class="input-box">
                        <span class="details">Garment Name </span>
                        <input type="text" required onChange="" value="" name="emp_name" />
                    </div>

                    <!-- <div class="input-box">
                        <span class="details">Type</span>
                        <input type="text" required onChange="" value="" name="emp_status" readonly >
                        <select class="upt-emp-details" name="emp_status">
                            <option value="manager">Manager</option>
                            <option value="merchandiser">Merchandiser</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div> -->

                    <div class="input-box">
                        <span class="details">E-mail</span>
                        <input type="email" required onChange="" value="" name="email" />
                    </div>

                    <div class="input-box">
                        <span class="details">Location</span>
                        <input type="text" required onChange="" value="" name="location" />
                    </div>

                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" required onChange="" value="" name="address" />
                    </div>

                    <div class="input-box">
                        <span class="details">Date Joined</span>
                        <input type="date" required onChange="" value="" name="DOB" />
                    </div>

                    <div class="input-box">
                        <span class="details">Contact Number</span>
                        <input type="text" required onChange="" value="0766464639" name="contact_number" />
                    </div>

                    <div class="input-box">
                        <span class="details">Number of Workers</span>
                        <input type="text" required onChange="" value="" name="no_workers" />

                    </div>

                    <div class="input-box">
                        <span class="details">Day Capacity</span>
                        <input type="text" required onChange="" value="" name="day_capacity" />
                    </div>

                    <div class="input-box">
                        <span class="details">Cutting Price</span>
                        <input type="text" required onChange="" value="" name="cut_price" />
                    </div>

                    <div class="input-box">
                        <span class="details">Sewing Price</span>
                        <input type="text" required onChange="" value="" name="sewed_price" />
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
    <div id="overlay" class="overlay">

    </div>

    <!-- Popup for Adding New Garment -->
    <div class="popup-new">

        <div class="popup-content">
            <h2>Add new Garment</h2>
            <form method="POST">
                <div class="form">
                    <div class="input-box">
                        <span class="details">Garment Name</span>
                        <input class="new-emp-details" type="text" name="emp_name" placeholder="Enter name" required>
                        <!-- <label class="placeholder" for="input">Enter text here...</label> -->
                    </div>

                    <div class="input-box">
                        <span class="details">Type</span><br>
                        <select class="new-emp-details" name="emp_status">
                            <option value="garment">Garment</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <span class="details">E-mail</span><br>
                        <input class="new-emp-details" type="email" name="email" placeholder="Enter e-mail" required>
                    </div>

                    <div class="input-box">
                        <span class="details">Location</span><br>
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
                        <span class="details">Date Joined</span><br>
                        <input class="new-emp-details" type="date" name="DOB" placeholder="Enter Address" required>
                    </div>

                    <div class="input-box-outside">
                        <div class="input-box">
                            <span class="details">Number of Workers</span>
                            <input class="new-emp-details" type="text" required onChange="" value="" name="no_workers" placeholder="Enter the number of workers" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Day Capacity</span>
                            <input class="new-emp-details" type="text" required onChange="" value="" name="day_capacity" placeholder="Enter day capacity" required>
                        </div>
                    </div>

                    <div class="input-box-outside">
                        <div class="input-box">
                            <span class="details">Cutting Price</span>
                            <input class="new-emp-details" type="text" required onChange="" value="" name="cut_price" placeholder="Enter cutting price" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Sewing Price</span>
                            <input class="new-emp-details" type="text" required onChange="" value="" name="sewed_price" placeholder="Enter sewing price" required>
                        </div>
                    </div>

                    <!-- <div class="input-box">
                        <span class="details">Upload an Image</span><br>
                        <input class="new-emp-details emp-image" type="file" accept=".jpg, .png" name="emp_image" placeholder="Enter Address" required>
                    </div> -->

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
    <script src="<?= ROOT ?>/assets/js/manager/garmentdetails.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>