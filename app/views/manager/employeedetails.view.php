<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sidebar</title>
  <!-- Link Styles -->
  <link rel="stylesheet" href="<?=ROOT ?>/assets/css/manager/employeedetails.css">
  <link rel="stylesheet" href="<?=ROOT ?>/assets/css/manager/managersidenav.css">
  <link rel="stylesheet" href="<?=ROOT ?>/assets/css/manager/boxicons.min.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <!-- Sidebar -->
  <?php include 'sidebar.php'?>
  <!-- Sidebar -->

  <!-- Navigation Bar -->
  <?php include 'navigationbar.php'?>
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
                        <button id="save-button" onclick="saveEmployee()">Save</button>
                        <button id="cancel-button" onclick="cancelAdd()">Cancel</button>
                    </div>
                    <div class="remove-cancel">
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
                        <tr onclick="toggleRemoveButton()">
                            <td>1</td>
                            <td>John Doe</td>
                            <td>Manager</td>
                            <td>hello@world.com</td>
                            <td>123 Main St</td>
                            <td>555-123-4567</td>
                        </tr>
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
  <script src="script.js"></script>
  <script src="empdetails.js"></script>
</body>

</html>