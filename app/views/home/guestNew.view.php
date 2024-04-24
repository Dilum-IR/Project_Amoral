<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/garment/profile.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/button.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/boxicons.min.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/boxicons.min.css">

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/home/nav.css">

    <link rel="stylesheet" href="boxicons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>
    <style>
        nav .nav-icons {

            padding-top: 25px !important;
        }

        .main {

            border-radius: 25px !important;
            left: 40px !important;
            align-self: center;
            justify-content: center;
        }

        .wrapper {
            background-color: white;
            margin-top: 10px;
        }

        .wrapper .right {
            width: 100%;
            font-size: 0.8rem;
            background: transparent !important;
        }

        .save_btn {
            transform: scale(1.0);
            transition: 0.5s ease-in-out;
        }

        .save_btn:hover {
            transform: scale(1.05);

        }

        .wrapper .left img {
            width: max-content;
        }

        .h1 {
            font-size: 28px;
            text-align: center;
            margin-bottom: 20px;
        }

        .h3_2nd {
            margin-bottom: 10px;
            margin-top: 20px;
        }

        .pro_label {
            font-size: 15px;
        }

        .wrapper .right .manager_info{
            flex-wrap: nowrap !important;
            column-gap: 10px !important;
        }

    </style>
    <!-- Navigation bar -->
    <?php
    include 'navigationbar.php'
    ?>
    <!-- Navigation Bar -->

    <section class="main" id="main">
        <div class="wrapper">

            <!-- Right Section -->
            <div class="right">
                <!-- Information Section -->
                <div class="info">
                    <h2 class="h1">Guest Garment Registration

                    </h2>

                    <h3 class="h3">Garment factory Details
                        <hr>
                    </h3>
                    <form method="POST">

                        <span class="no-change">
                            <?php
                            //  (!empty($error) && isset($error['notchange']) && $error['flag'] == 1) ? $error['notchange'] : '';

                            ?>
                            &nbsp;

                        </span>

                        <div class="info_data">
                            <div class="data">
                                <label class="pro_label" for="pro_username"><i class='bx bx-user'></i>Garment Name &nbsp;<span class="data-error">
                                        <?php
                                        //                        (!empty($error) && isset($error['name']) && $error['flag'] == 1) ? "* " . $error['name'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_username" name="emp_name" value="">
                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> City &nbsp; <span class="data-error">
                                        <?php
                                        //          (!empty($error) && isset($error['city']) && $error['flag'] == 1) ? "* " . $error['city'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_city" name="city" value="">
                            </div>
                        </div>

                        <div class="info_data">
                            <div class="data">
                                <label class="pro_label" for="pro_address">Address &nbsp; <span class="data-error">
                                        <?php
                                        // (!empty($error) && isset($error['address']) && $error['flag'] == 1) ? "* " . $error['address'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_address" name="address" value="">
                            </div>

                            <div class="data">

                                <label class="pro_label" for="pro_email">Email &nbsp; <span class="data-error">
                                        <?php
                                        // (!empty($error) && isset($error['email']) && $error['flag'] == 1) ? "* " . $error['email'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_email" name="email" value="">
                            </div>
                            
                        </div>
                        <div class="info_data manager_info">
                            <div class="data">
                                <label class="pro_label" for="pro_username"><i class='bx bx-user'></i>Garment Name &nbsp;<span class="data-error">
                                        <?php
                                        //                        (!empty($error) && isset($error['name']) && $error['flag'] == 1) ? "* " . $error['name'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_username" name="emp_name" value="">
                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> City &nbsp; <span class="data-error">
                                        <?php
                                        //          (!empty($error) && isset($error['city']) && $error['flag'] == 1) ? "* " . $error['city'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_city" name="city" value="">
                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> City &nbsp; <span class="data-error">
                                        <?php
                                        //          (!empty($error) && isset($error['city']) && $error['flag'] == 1) ? "* " . $error['city'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_city" name="city" value="">
                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> City &nbsp; <span class="data-error">
                                        <?php
                                        //          (!empty($error) && isset($error['city']) && $error['flag'] == 1) ? "* " . $error['city'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_city" name="city" value="">
                            </div>
                        </div>

                        <h3 class="h3 h3_2nd">Manager Contact Details
                            <hr>
                        </h3>
                        <div class="info_data manager_info">

                            <div class="data">
                                <label class="pro_label" for="pro_number">Full Name &nbsp; <span class="data-error">
                                        <?php
                                        // (!empty($error) && isset($error['contact_number']) && $error['flag'] == 1) ? "* " . $error['contact_number'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_number" name="contact_number" value="">
                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_number">Contact Number &nbsp; <span class="data-error">
                                        <?php
                                        // (!empty($error) && isset($error['contact_number']) && $error['flag'] == 1) ? "* " . $error['contact_number'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_number" name="contact_number" value="">
                            </div>

                            <div class="data">
                                <label class="pro_label" for="pro_profession">Email &nbsp; <span class="data-error">
                                        <?php
                                        // (!e`mpty($error) && isset($error['emp_status']) && $error['flag'] == 1) ? "* " . $error['emp_status'] : '';
                                        ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_profession" name="emp_status" value="">
                            </div>


                        </div>

                        <div class="info_data" id="last-element">

                            <div class="pro_button">

                                <button type="submit" class="small_btn save_btn" name="save" value="save"><span>

                                        Register
                                    </span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const form = document.querySelector('form');
                const saveButton = form.querySelector('.save_btn');
                const initialData = <?= json_encode($data) ?>;

                // Function to check if any changes are made
                function hasChanges() {
                    const formData = new FormData(form);
                    const currentData = {};

                    formData.forEach((value, key) => {
                        currentData[key] = value;
                    });
                    console.log(JSON.stringify(initialData) == JSON.stringify(currentData));

                    return JSON.stringify(initialData) !== JSON.stringify(currentData);
                }

                // Enable or disable the "Save Changes" button based on changes
                function updateSaveButtonState() {
                    saveButton.disabled = !hasChanges();

                }

                // Attach change event listeners to input fields
                form.querySelectorAll('input, select, textarea').forEach(input => {
                    input.addEventListener('change', updateSaveButtonState);
                });

                // Initial check
                updateSaveButtonState();
            });
        </script>
        <!-- Scripts -->
        <script src="<?= ROOT ?>/assets/js/profile.js"></script>
        <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>