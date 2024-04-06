<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
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
                <input class="new-btn" type="button" onclick="openNew()" value="Add Garment">
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
                            <th>Id</th>
                            <th>Name</th>
                            <th>E - mail</th>
                            <th>Contact No.</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Manager Name</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // show($data);
                        foreach ($data as $gmnt) : ?>

                            <!-- <?php
                                    if (!$gmnt->is_quotation) : ?> -->
                            <tr>
                                <td class="ordId"><?php echo $gmnt->guest_garement_id ?></td>
                                <td><?php echo $gmnt->name ?></td>
                                <td><?php echo $gmnt->email ?></td>
                                <td><?php echo $gmnt->contact_number ?> </td>
                                <td><?php echo $gmnt->city ?> </td>
                                <td><?php echo $gmnt->garment_status ?> </td>
                                <td><?php echo $gmnt->manager_name ?> </td>
                                <!-- <td class="st">
                                <div class="text-status <?php echo $gmnt->status ?>"><?php echo $gmnt->status ?></div>
                                <div class="progress-bar"></div>
                                </td> -->


                                <td><button type="submit" name="selectItem" class="edit" data-gmnt='<?= json_encode($gmnt); ?>' onclick="openView(this)">View</button> <button style="color: white;">Update</button>
                                    <!-- <button type="button" class="pay" onclick=""><i class="fas fa-money-bill-wave" title="Pay"></i></button></td> -->
                            </tr>

                            <!-- <?php endif; ?> -->
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </section>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/manager/garmentdetails.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>