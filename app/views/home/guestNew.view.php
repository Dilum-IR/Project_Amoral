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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">

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

            padding-top: 15px !important;
        }

        .main {

            border-radius: 25px !important;
            left: 40px !important;
            align-self: center;
            justify-content: center;
        }

        .wrapper {
            background-color: white;
            /* margin-top: 10px; */
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
            /* margin-bottom: 20px; */
        }

        .h3_2nd {
            margin-bottom: 10px;
            margin-top: 20px;
        }

        .pro_label {
            /* font-size: 15px; */
            display: flex;
        }

        .wrapper .right .manager_info {
            flex-wrap: nowrap !important;
            column-gap: 10px !important;
        }

        .wrapper .right .pro_button {
            margin-left: 0% !important;
            width: 100% !important;
            align-self: center !important;
            justify-content: center !important;
        }

        .wrapper .right .pro_button .save_btn {
            width: 230PX !important;
            font-size: 18px !important;
        }
    </style>
    <!-- Navigation bar -->
    <?php
    include 'navigationbar.php';
    include __DIR__ . '/../utils/toastMsg.php';

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
                                <label class="pro_label" for="pro_username"><i class='bx bx-user'></i>Garment Name
                                    &nbsp;<span class="data-error">

                                        <?php if (isset($errors['name'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['name']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_username" name="name"
                                    value="<?= !empty($current_data) ? $current_data['name'] : "" ?>"
                                    placeholder="Enter company name">
                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> City &nbsp;
                                    <span class="data-error">
                                        <?php if (isset($errors['city'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['city']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_city" name="city"
                                    value="<?= !empty($current_data) ? $current_data['city'] : "" ?>"
                                    placeholder="Enter the city">

                            </div>
                        </div>

                        <div class="info_data">
                            <div class="data">
                                <label class="pro_label" for="pro_address">Address &nbsp; <span class="data-error">
                                        <?php if (isset($errors['address'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['address']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_address" name="address"
                                    value="<?= !empty($current_data) ? $current_data['address'] : "" ?>"
                                    placeholder="Enter company address">

                            </div>

                            <div class="data">

                                <label class="pro_label" for="pro_email">Email &nbsp; <span class="data-error">
                                        <?php if (isset($errors['email'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['email']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_email" name="email"
                                    value="<?= !empty($current_data) ? $current_data['email'] : "" ?>"
                                    placeholder="Enter company email">

                            </div>

                        </div>
                        <div class="info_data">
                            <div class="data">
                                <label class="pro_label" for="pro_username"><i class='bx bx-user'></i>Number of Workers
                                    &nbsp;<span class="data-error">
                                        <?php if (isset($errors['no_workers'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['no_workers']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_no_workers" name="no_workers"
                                    value="<?= !empty($current_data) ? $current_data['no_workers'] : "" ?>"
                                    placeholder="Enter number of workers">

                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> Cutting
                                    Price(Rs) &nbsp;
                                    <span class="data-error">
                                        <?php if (isset($errors['cut_price'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['cut_price']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_cut_price" name="cut_price"
                                    value="<?= !empty($current_data) ? $current_data['cut_price'] : "" ?>"
                                    placeholder="Enter the cutting price">

                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> Daily Capacity
                                    &nbsp;
                                    <span class="data-error">
                                        <?php if (isset($errors['day_capacity'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['day_capacity']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_day_capacity" name="day_capacity"
                                    value="<?= !empty($current_data) ? $current_data['day_capacity'] : "" ?>"
                                    placeholder="Enter the daily capacity">

                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_city"><i class='bx bx-buildings'></i> Sewed Price(Rs)
                                    &nbsp;
                                    <span class="data-error">
                                        <?php if (isset($errors['sewed_price'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['sewed_price']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_sewed_price" name="sewed_price"
                                    value="<?= !empty($current_data) ? $current_data['sewed_price'] : "" ?>"
                                    placeholder="Enter the sewed price">

                            </div>
                        </div>

                        <h3 class="h3 h3_2nd">Manager Contact Details
                            <hr>
                        </h3>
                        <div class="info_data manager_info">

                            <div class="data">
                                <label class="pro_label" for="pro_number">Manager Name &nbsp; <span class="data-error">
                                        <?php if (isset($errors['manager_name'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['manager_name']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_manager_name" name="manager_name"
                                    value="<?= !empty($current_data) ? $current_data['manager_name'] : "" ?>"
                                    placeholder="Enter manager name">

                            </div>
                            <div class="data">
                                <label class="pro_label" for="pro_number">Contact Number &nbsp; <span
                                        class="data-error">
                                        <?php if (isset($errors['manager_contact'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['manager_contact']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_manager_contact" name="manager_contact"
                                    value="<?= !empty($current_data) ? $current_data['manager_contact'] : "" ?>"
                                    placeholder="Enter contact number">

                            </div>

                            <div class="data">
                                <label class="pro_label" for="pro_profession">Email Address &nbsp; <span
                                        class="data-error">
                                        <?php if (isset($errors['manager_email'])): ?>
                                            <div class="error"><?= htmlspecialchars($errors['manager_email']); ?></div>
                                        <?php endif; ?>

                                    </span></label>
                                <input class="pro_input" type="text" id="pro_manager_email" name="manager_email"
                                    value="<?= !empty($current_data) ? $current_data['manager_email'] : "" ?>"
                                    placeholder="Enter email address">

                            </div>


                        </div>

                        <div class="info_data" id="last-element">

                            <div class="pro_button">

                                <button type="submit" class="small_btn save_btn" name="guest_register"
                                    value="save"><span>

                                        Register
                                    </span></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <script>
            let successData = {
                'success_no': 4,
                'flag': 0,
                'success': "<?= $data['success_message'] ?>"
            }
            let dataValidate = {
                'success_no': 4,
                'flag': 0,
                'error_no': "<?= $data['success_message'] ?>"
            }

        </script>

        <script src="<?= ROOT ?>/assets/js/toast.js"> </script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
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