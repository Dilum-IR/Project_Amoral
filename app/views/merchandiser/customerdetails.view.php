<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/merchandiser/customerdetails.css">
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
    <!-- search js  -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('input[type="search"]');
            const reportBoxes = document.querySelectorAll('.emp-table tbody tr');

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();

                reportBoxes.forEach(box => {
                    const email = box.querySelector('.email').textContent.toLowerCase();
                    // const description = box.querySelector('.report-description').textContent.toLowerCase();
                    // const date = box.querySelector('.report-info-date').textContent;

                    // Extend with other fields as necessary

                    if (email.includes(searchTerm)) {
                        box.style.display = '';
                    } else {
                        box.style.display = 'none';
                    }
                });
            });
        });
    </script>

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
                            foreach ($data as $cst):

                                ?>


                                <tr>
                                    <div class="text_box">
                                        <td class="ordId"><?php echo $cst->id ?></td>
                                        <td class="fullname"><?php echo $cst->fullname ?></td>
                                        <td class="city"><?php echo $cst->city ?></td>
                                        <td class="address"><?php echo $cst->address ?></td>
                                        <td class="phone"><?php echo $cst->phone ?> </td>
                                        <td class="email"><?php echo $cst->email ?> </td>
                                    </div>

                                    <td style="word-break:normal;">
                                        <div class="view-remove-buttons">
                                            <button style="color: #000000e0;" type="submit" name="selectItem" class="edit"
                                                data-cst='<?= json_encode($cst); ?>' onclick="openView(this)">View</button>

                                            <button type="button" class="rem-btn" data-customer-id='<?= $cst->id; ?>'
                                                 style="color: #ff0000de;">Remove</button>


                                            <!-- </form> -->
                                        </div>
                                    </td>
                    </div>
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
    <!-- Remove popup -->
    <div id="cancel-popup" class="cancel-modal">
        <div class="modal-content">
            <span><i class="bx bx-x log-close-icon" style="color: #ff0000"></i></span>
            <div>
                <i class='bx bxs-error-circle bx-tada icon-warn' style='color:#7d2ae8'></i>
            </div>
            <h3>Are You Sure ?</h3>
            <div class="logout-btn-component">

                <button name="cstRemove" type="submit" class="button" id="confirmDelete">Yes</button>
                <button class="button"  id="cancelDelete">No</button>
            </div>
        </div>
    </div>



    <style>
        .cancel-modal {
            display: none;
            position: fixed;
            z-index: 100;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            border-radius: 10px;
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 25%;
            text-align: center;
        }

        .log-close-icon {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            /* position: absolute !important; */
        }

        .log-close-icon:hover,
        .log-close-icon:focus {
            color: rgb(172, 0, 0);
            text-decoration: none;
            cursor: pointer;
        }

        .icon-warn {
            margin-left: 27px;
            font-size: 7rem;
            /* display: flexbox; */
            justify-content: center;
            align-items: center;
        }

        .button {
            text-decoration: none;
            width: 110px;
            font-size: 16px;
            display: inline-block;
            padding: 8px;
            border-radius: 10px;
            cursor: pointer;
            border: none;
            outline: none;
            color: #fff;
            transition: 0.3s ease-in;
            text-align: center;
            transform: scale(1);

        }

        #confirmDelete {
            margin-right: 10px;
            background-color: #000000;
        }

        #cancelDelete {
            background-color: #f44336;
        }

        #confirmDelete:hover {
            transform: scale(1.05);
            /* background-color: rgb(16, 187, 0); */
        }

        #cancelDelete:hover {
            transform: scale(1.05);
            background-color: rgb(255, 0, 0);
        }

        .logout-btn-component {
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>


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
                    <img src="<?= ROOT ?>/assets/images/home/4.jpg" alt="" width="200px" height="200px"
                        style="border-radius: 50%;">
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
    <!-- <div class="popup-new"> -->
    <div id="addCustomerPopup" class="popup-new">
        <div class="popup-content">
            <h2>Add new Customer</h2>
            <form id="addCustomerForm" method="POST">
                <div class="form">
                    <div class="input-box">
                        <span class="details">Customer Name &nbsp; <small class="error-message" id="name_error"
                                style="color:red; display: ;"></small></span>
                        <input id="fullname" class="new-emp-details" type="text" name="fullname"
                            placeholder="Enter full name">
                        <!-- <label class="placeholder" for="input">Enter text here...</label> -->
                    </div>

                    <!-- <div class="input-box">
                        <span class="details">User Status</span><br>
                        <select class="new-emp-details" name="user_status">
                            <option value="customer">Customer</option>
                        </select>
                    </div> -->

                    <div class="input-box">
                        <span class="details">E-mail &nbsp; <small class="error-message" id="email_error"
                                style="color:red;"></small></span><br>
                        <input id="email" class="new-emp-details" type="email" name="email" placeholder="Enter e-mail">

                    </div>

                    <div class="input-box">
                        <span class="details">City &nbsp; <small class="error-message" id="city_error"
                                style="color:red;"></small></span><br>
                        <input id="city" class="new-emp-details" type="text" name="city" placeholder="Enter Address">

                    </div>

                    <div class="input-box">
                        <span class="details">Address &nbsp; <small class="error-message" id="address_error"
                                style="color:red;"></small></span><br>
                        <input id="address" class="new-emp-details" type="text" name="address"
                            placeholder="Enter Address">


                    </div>
                    <div class="input-box">
                        <span class="details">Contact Number&nbsp; <small class="error-message" id="phone_error"
                                style="color:red;"></small></span>
                        <input id="phone" class="new-emp-details" type="text" name="phone"
                            placeholder="Enter contact number">

                    </div>

                </div>
                <div class="btns">
                    <input type="hidden" value="newCustomer" name="newCustomer">
                    <button type="submit" class="update-btn pb" value="newCustomer" name="newCustomer">Submit</button>
                    <button type="button" class="cancel-btn pb" onclick="closeNew()">Cancel</button>
                </div>
            </form>
            <!-- Popup content -->
        </div>
    </div>



    <!-- Add customer validation using  -->

    <script>
        // Function to show the Add Customer Popup
        function openNew(button) {
            document.getElementById('addCustomerPopup').style.display = 'block';
            popupNew.classList.add("is-visible");
            document.body.style.overflow = "hidden";
            sidebar.style.pointerEvents = "none";
            nav.style.pointerEvents = "none";
        }

        // Function to close the Add Customer Popup
        function closeNew(button) {
            document.getElementById('addCustomerPopup').style.display = 'none';
        }
    </script>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.getElementById('addCustomerForm');
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                var isValid = true; // Track if form is valid

                var fullname = document.getElementById('fullname').value;
                var email = document.getElementById('email').value;
                var city = document.getElementById('city').value;
                var address = document.getElementById('address').value;
                var phone = document.getElementById('phone').value;


                var fullnameError = document.getElementById('name_error');
                var addressError = document.getElementById('address_error');
                var emailError = document.getElementById('email_error');
                var cityError = document.getElementById('city_error');
                // var addressError = address.nextElementSibling;
                var phoneError = document.getElementById('phone_error');

                // Clear previous errors
                [fullnameError, emailError, cityError, addressError, phoneError].forEach((error) => {
                    error.style.display = 'none';
                });

                // Regex Patterns
                if (!/^[a-zA-Z\s]+$/.test(fullname)) {
                    fullnameError.textContent = 'Invalid name. Only letters and spaces allowed.';
                    fullnameError.style.display = 'table-row';
                    isValid = false;
                }
                if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(email)) {
                    emailError.textContent = 'Invalid email format.';
                    emailError.style.display = 'table-row';
                    isValid = false;
                }
                if (!/^[a-zA-Z\s]+$/.test(city)) {
                    cityError.textContent = 'Invalid city. Only letters and spaces allowed.';
                    cityError.style.display = 'table-row';
                    isValid = false;
                }
                if (!/^[a-zA-Z0-9\s,.'-]{3,}$/.test(address)) {
                    addressError.textContent = 'Invalid address.';
                    addressError.style.display = 'table-row';
                    isValid = false;
                }
                if (!/^\+?\d{10,15}$/.test(phone)) {
                    phoneError.textContent = 'Invalid phone number. Enter 10-15 digits.';
                    phoneError.style.display = 'table-row';
                    isValid = false;
                }

                if (isValid) {
                    form.submit(); // Form is valid, submit it
                }
            });
        });

    </script>




    <script>
       
       document.addEventListener('DOMContentLoaded', function () {
    const removeButtons = document.querySelectorAll('.rem-btn');

    removeButtons.forEach(button => {
        button.addEventListener('click', function () {
            const customerId = this.getAttribute('data-customer-id');  // Fetch the customer ID directly
            console.log("Removing customer with ID:", customerId);  // Debug output to check ID

            // Confirm removal with modal popup
            showModal(customerId);
        });
    });

    function showModal(customerId) {
        const modal = document.getElementById("cancel-popup");
        modal.style.display = "block";  // Show the modal

        // Set up confirm action within the modal
        document.getElementById("confirmDelete").onclick = function () {
            removeCustomer(customerId);  // Call remove function on confirmation
        };
        document.getElementById("cancelDelete").onclick=function(){
            modal.style.display = "none";
        }
    }


    function removeCustomer(customerId) {
        console.log("Sending AJAX request to remove customer ID:", customerId);
        $.ajax({
            url: "<?= ROOT ?>/merchandiser/RemoveCustomer",
            type: 'POST',
            data: { customer_id: customerId },
            success: function (response) {
                console.log("Response from server:", response);
                // alert('Customer removed successfully');
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error("Failed to remove customer:", error);
                alert('Failed to remove customer. Error: ' + error);
            }
        });
    }
});



    
    </script>






<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/merchandiser/customerdetails.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>