<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sidebar</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/employeedetails.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/managersidenav.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/boxicons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->

    <!-- Navigation Bar -->
    <!-- Navigation Bar -->

    <section class="main-section" id="main-section">
        <main id="middle">
            <div class="empTable">
                <div class="empDetails">
                    <div class="emp-top">
                        <div class="search-emp">
                            <input type="text" id="search-bar" placeholder="Search...">
                            <div class="search-btn-icon">
                                <a href="#">
                                    <i class="bx bx-search" id="search-btn"></i>
                                </a>
                            </div>
                        </div>
                        <div class="empButtons">
                            <div class="add-save-cancel">

                                <button id="add-employee-button" onclick="addEmployee()">Add Employee</button>
                                <form method="POST">
                                    <input type="hidden" name="emp_name" readonly value="Thiran">
                                    <input type="hidden" name="emp_status" readonly value="customer">
                                    <input type="hidden" name="email" readonly value="abc@gmail.com">
                                    <input type="hidden" name="address" readonly value="kaluthara">
                                    <input type="hidden" name="contact_number" readonly value="0087623456">
                                    <button type="submit" id="save-button" onclick="saveEmployee()">Save</button>

                                </form>
                                <button id="cancel-button" onclick="cancelAdd()">Cancel</button>
                            </div>
                            <div class="remove-cancel">
                                <button id="update-employee-button" onclick="updateEmployee()">Update Employee</button>
                                <button id="remove-employee-button" onclick="removeEmployee()">Remove Employee</button>
                                <button id="remove-cancel-button" onclick="removeCancel()">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="details-row">
                        <table id="employee-table" class="employee-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>E-mail</th>
                                    <th>Address</th>
                                    <th>Contact No</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (is_array($data)) {

                                    foreach ($data as $item) {
                                ?>
                                        <tr data-order="<?=json_decode($item); ?>" onclick="toggleRemoveButton()">
                                            <td><?php echo $item->emp_id?></td>
                                            <td><?php echo $item->emp_name?></td>
                                            <td><?php echo $item->emp_status?></td>
                                            <td><?php echo $item->email?></td>
                                            <td><?php echo $item->address?></td>
                                            <td><?php echo $item->contact_number?></td>
                                        </tr>
                                <?php
                                }
                                } else {
                                }
                                ?>
                                <tr onclick="toggleRemoveButton()">
                                    <td>2</td>
                                    <td>Jane Smith</td>
                                    <td>Developer</td>
                                    <td>hello@world.com</td>
                                    <td>456 Elm St</td>
                                    <td>555-987-6543</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                                <tr onclick="toggleRemoveButton()">
                                    <td>3</td>
                                    <td>Mary Johnson</td>
                                    <td>Designer</td>
                                    <td>hello@world.com</td>
                                    <td>789 Oak St</td>
                                    <td>555-789-1234</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </section>

    <!-- Scripts -->

    <script src="<?= ROOT ?>/assets/js/manager/employeedetails.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>