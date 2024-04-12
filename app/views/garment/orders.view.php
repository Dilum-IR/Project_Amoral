<?php
// show($data);
// die(); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Amoral</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/customer-orders.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/garment/order.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/toast.css">


    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>
    <!-- loading page  & toast msg content-->

    <?php
    // include "loading.php";
    include __DIR__ . '/../utils/toastMsg.php';
    ?>

    <!-- Sidebar -->
    <?php

    // use function PHPSTORM_META\map;

    include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->


    <!-- content  -->
    <section id="main" class="main">

        <div class="main-box">

            <ul class="breadcrumb">
                <li>
                    <a href="#">Home</a>
                </li>
                <i class='bx bx-chevron-right'></i>
                <li>
                    <a href="#" class="active">Garment Orders</a>
                </li>

            </ul>
            <form>
                <div class="form">
                    <form>
                        <div class="form-input">
                            <input type="search" placeholder="Search...">
                            <button type="submit" class="search-btn">
                                <i class='bx bx-search'></i>
                            </button>
                        </div>
                    </form>
                    <input class="btn" type="button" onclick="open_report()" value="Report Problem">
                </div>

            </form>

            <div class="table">

                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th class="ordId">Order Id</th>
                                <th class="desc">Description</th>
                                <th class="stth">Status</th>
                                <th class="cost">sew dispatch date</th>
                                <th class="cost">cut dispatch date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">

                            <?php

                            if (isset($data)) {

                                foreach ($data as $item) :
                            ?>
                                    <tr>
                                        <td class="ordId"><?= $item->order_id  ?></td>
                                        <td class="desc">

                                            <b>

                                                <?= $item->material_type ?>
                                            </b>
                                            <br>

                                            <?=
                                            $item->xs != 0 ? "XS -" . $item->xs : ''
                                            ?>

                                            <?=
                                            $item->small != 0 ? ", S -" . $item->small : ''
                                            ?>
                                            <br>
                                            <?=
                                            $item->medium != 0 ? " M -" . $item->medium : ''
                                            ?>

                                            <?=
                                            $item->large != 0 ? ", L -" . $item->large : ''
                                            ?>
                                            <br>
                                            <?=
                                            $item->xl != 0 ? " XL -" . $item->xl : ''
                                            ?>

                                            <?=
                                            $item->xxl != 0 ? ", XXL -" . $item->xxl : ''
                                            ?>

                                        </td>
                                        <td class="st">
                                            <div class="text-status <?= $item->status ?>"><?= $item->status ?></div>
                                        </td>
                                        <td class="cost"><?= $item->sew_dispatch_date  ?></td>
                                        <td class="cost"><?= $item->cut_dispatch_date  ?></td>

                                        <td>
                                            <button type="submit" name="selectItem" class="view-g-order-btn" data-order='<?= json_encode($item); ?>' onclick="openView(this)">View</button>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            } else {
                                ?>
                                <tr>

                                    <td>
                                        Garment orders currently not available
                                    </td>
                                    <td></td>
                                    <td>

                                    </td>
                                    <td></td>
                                    <td></td>

                                    <td>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Dark report_overlay -->
    <div id="report-overlay"></div>

    <!-- POPUP -->
    <div class="gar-popup-report" id="gar-popup-report">


        <span class="close" onclick="hide_report()">&times;</span>
        <h2>Report Your Orders Problem</h2>
        <form>

            <input type="hidden" name="garment_id" id="id" value="<?= $_SESSION['USER']->emp_id ?>">
            <h4>Title : <span class="error e-title"></span> </h4>
            <input class="title" name="title" type="text" placeholder="Enter your title">

            <h4>Your email : <span class="error email"></span></h4>
            <input disabled id="email" name="email" type="text" placeholder="Enter your email" value="<?= $_SESSION['USER']->email ?>">

            <h4>Problem : <span class="error e-description"></span></h4>
            <textarea name="description" id="problem" cols="30" rows="7" placeholder="Enter your problem"></textarea>

            <button type="button" class="close-btn pb" id="report-submit" name="report" value="Submit">Submit</button>
            <button type="button" class="cancelR-btn pb" onclick="hide_report()">Cancel</button>

        </form>

    </div>

    <!-- order update & cancel popup -->

    <div class="popup-view" id="popup-view">


        <h2>Order Details<span class="g-popup-close" onclick="closeView()">&times;</span></h2>
        <div class="status">

            <ul>
                <li>
                    <iconify-icon icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                    <div class="progress one">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Pending</p>
                </li>
                <li>
                    <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                    <div class="progress two">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Cutting</p>
                </li>
                <li>
                    <iconify-icon icon="tabler:truck-delivery"></iconify-icon>
                    <div class="progress three">

                        <i class="uil uil-check"></i>
                    </div>
                    <p class="text">Cutting done</p>
                </li>
                <li>
                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                    <div class="progress four">

                        <!-- <i class="uil uil-check"></i> -->
                    </div>
                    <p class="text">Sewing</p>
                </li>
                <li>
                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                    <div class="progress four">

                        <!-- <i class="uil uil-check"></i> -->
                    </div>
                    <p class="text">Sewing done</p>
                </li>

            </ul>

        </div>

        <div class="container1">
            <form class="update-form" method="POST">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Order Id </span>
                        <input name="order_id" type="text" required onChange="" readonly value="" />
                    </div>

                    <div class="input-box">
                        <span class="details">Material </span>
                        <input name="material" type="text" required onChange="" readonly value="" />
                    </div>

                    <div class="input-box sizes">

                        <span class="details">Sizes</span>

                        <input class="size" type="text" required onChange="" readonly value="S" />
                        <!-- <p>_</p> -->
                    </div>
                    <div class="input-box sizes">


                        <span class="details">Quantity</span>
                        <input class="size" type="text" required onChange="" readonly value="" />
                        <!-- <p>_</p> -->
                    </div>
                    <div class="input-box">
                        <span class="details">cut dispatch date</span>
                        <input name="cut_dispatch_date" type="text" required onChange="" readonly value="2023/10/01" />
                    </div>
                    <div class="input-box">
                        <span class="details">sew dispatch date</span>
                        <input name="sew_dispatch_date" type="text" required onChange="" readonly value="2023/10/02" />
                    </div>
                    <!-- <div class="input-box">
                        <span class="details">Delivery Expected On</span>
                        <input name="delivery_expected_on" type="text" required onChange="" readonly value="2023/10/01" />
                    </div> -->

                </div>
                <!-- hidden element -->
                <div class="input-box">
                    <!-- <span class="details">Order Id </span> -->
                    <input name="status" type="hidden" required onChange="" readonly value="cutting" />
                    <input name="garment_id" type="hidden" required onChange="" readonly value="0023456" />
                </div>

                <button type="submit" onclick="" class="cancel-btn pb" name="CancelGorder">Cancel Order</button>
                <input type="submit" class="update-btn pb" name="updateGorder" value="Update Order" />



            </form>
        </div>
    </div>

    <div id="overlay" class="overlay"></div>

    <script>
        endpoint = "<?= ROOT ?>/garment/reports";
    </script>

    <!-- Import JQuary Library script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/garment/garment-order.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>
</body>

</html>