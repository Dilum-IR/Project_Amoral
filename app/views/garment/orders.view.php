<?php


// show($data);


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
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/loading.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">

</head>

<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <style>
        .loader-wrapper {
            z-index: 10;
        }
    </style>
    <!-- loading page  & toast msg content-->

    <?php
    include __DIR__ . '/../utils/loading.php';

    include __DIR__ . '/../utils/toastMsg.php';
    ?>

    <!-- Sidebar -->
    <?php

    // use function PHPSTORM_META\map;

    include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include 'navigationbar.php' ?>
    <!-- Scripts -->
    <script>

    </script>

    <!-- content  -->
    <section id="main" class="main">

        <div class="main-box">

            <ul class="breadcrumb">
                <li>
                    <a href="<?= ROOT ?>/garment/overview">Home</a>
                </li>
                <i class='bx bx-chevron-right'></i>
                <li>
                    <a href="<?= ROOT ?>/garment/orders" class="active">Garment Orders</a>
                </li>

            </ul>
            <form>
                <div class="form">

                    <div class="form-input">
                        <input type="search" placeholder="Search...">
                        <button type="button" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>

                    </div>
                    <input class="btn" type="button" onclick="open_report()" value="Report Problem">

                </div>

            </form>

            <div class="table">

                <div class="table-section">
                    <table>
                        <thead>
                            <tr>
                                <th class="ordId">Order Id <span class="icon-arrow"><i class='bx bxs-sort-alt'></i></span></th>
                                <th class="desc">Materials<span class="icon-arrow"><i class='bx bxs-sort-alt'></i></span></th>
                                <th class="qty">Total Qty <span class="icon-arrow"><i class='bx bxs-sort-alt'></i></span></th>
                                <th class="stth">Status <span class="icon-arrow"><i class='bx bxs-sort-alt'></i></span></th>
                                <th class="cost">Sew finish date <span class="icon-arrow"><i class='bx bxs-sort-alt'></i></span></th>
                                <th class="cost">Cut finish date <span class="icon-arrow"><i class='bx bxs-sort-alt'></i></span></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="table-body">

                            <?php

                            if (!empty($data)) {

                                rsort($data);
                                foreach ($data as $item) :
                            ?>
                                    <tr>
                                        <td class="ordId">ORD-<?= $item->order_id  ?></td>

                                        <td class="desc">

                                            <?php
                                            foreach ($item->material_array as $key => $value) {
                                            ?>
                                                <b>
                                                    <?= $value ?>
                                                </b>
                                            <?php
                                                echo "</br>";
                                            }
                                            ?>

                                        </td>
                                        <td class="desc">

                                            <?=
                                            $item->total_qty
                                            ?>

                                        </td>
                                        <td class="st">
                                            <div class="text-status <?= $item->status ?>">

                                                <?php if ($item->status == "pending") { ?>
                                                    <iconify-icon icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                                                <?php } else if ($item->status == "cutting") { ?>
                                                    <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                                                <?php } else if ($item->status == "cut") { ?>
                                                    <iconify-icon class="status-icon" icon="tabler:cut"></iconify-icon>
                                                <?php } else if ($item->status == "sent to company" || $item->status == "company process" || $item->status == "sent to garment" || $item->status == "returned") { ?>
                                                    <iconify-icon icon="mdi:company"></iconify-icon>
                                                <?php } else if ($item->status == "sewing") { ?>
                                                    <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                                                <?php } else if ($item->status == "sewed") { ?>
                                                    <iconify-icon icon="game-icons:sewing-string"></iconify-icon>
                                                <?php } else if ($item->status == "completed") { ?>
                                                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                                                <?php } ?>
                                                <?= ucfirst($item->status) ?>
                                            </div>
                                        </td>
                                        <td class="cost sew-date"><?= $item->sew_dispatch_date  ?></td>
                                        <td class="cost"><?= $item->cut_dispatch_date  ?></td>

                                        <td>
                                            <button type="submit" name="selectItem" class="view-g-order-btn" data-order='<?= json_encode($item); ?>' onclick="openView(this)">View</button>

                                            <?php
                                            if ($item->status != "completed" &&  $item->status != "sent to company" &&  $item->status != "company process") {
                                            ?>
                                                <button type="submit" name="selectItem" class="update-btn" id="table-status-btn<?= $item->order_id ?>" data-order='<?= json_encode($item); ?>' onclick="status_update_method(this)">Update Status</button>
                                            <?php
                                            } else if ($item->status != "sent to company" ||  $item->status != "company process") {
                                            ?>
                                                <button disabled type="submit" name="selectItem" class="update-btn" id="table-status-btn">Company Process</button>

                                            <?php
                                            } else {
                                            ?>
                                                <button disabled type="submit" name="selectItem" class="update-btn" data-order='<?= json_encode($item); ?>' onclick="updateStatus(this)">completed</button>

                                            <?php
                                            }
                                            ?>
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
                            <tr class="hide" id="no-data-search">

                                <td><i class='bx bx-loader-circle bx-spin bx-flip-horizontal bx-xs'></i>&nbsp; This Search order is not available ...</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <style>
        .g-poup-btn .cancel-btn.hide {
            display: none;

        }

        #no-data-search .hide {
            display: none;
        }

        tbody tr {
            --delay: 0.1s;
            transition: .5s ease-in-out var(--delay);
        }

        tbody {
            overflow: auto;
            overflow: overlay;
        }

        thead th span.icon-arrow {
            align-items: center;
            margin-left: 3px;
            text-align: center;
            font-size: 1rem;
            cursor: pointer;

        }

        thead th {
            transition: 0.3s ease-in-out;

        }

        thead th:hover {
            color: #6c00bd;

        }

        thead th.head-active {
            color: #6c00bd;
        }

        thead th.asc span.icon-arrow {

            transform: rotate(180deg);
        }
    </style>
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


        <div class="popup-header">
            <h2>Order Details</h2>
            <button onclick="closeView()">

                <i class='g-popup-close bx bx-x bx-flashing-hover bx-md'></i>
            </button>
        </div>

        <div class="status">

            <ul>
                <li id="pending">
                    <iconify-icon icon="streamline:interface-time-stop-watch-alternate-timer-countdown-clock"></iconify-icon>
                    <div class="progress one">

                    </div>
                    <p class="text">Pending</p>
                </li>
                <li id="cutting">
                    <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                    <div class="progress two">

                    </div>
                    <p class="text">Cutting</p>
                </li>
                <li id="cut">
                    <iconify-icon icon="tabler:cut"></iconify-icon>
                    <div class="progress three">

                    </div>
                    <p class="text">Cutting done</p>
                </li>
                <li id="company-process">
                    <iconify-icon icon="mdi:company"></iconify-icon>
                    <div class="progress middle">

                    </div>
                    <p class="text middle-text">Sent to company</p>
                </li>
                <li id="sewing">
                    <iconify-icon icon="fluent-mdl2:processing"></iconify-icon>
                    <div class="progress four">

                    </div>
                    <p class="text">Sewing</p>
                </li>
                <li id="sewed">
                    <iconify-icon icon="game-icons:sewing-string"></iconify-icon>
                    <div class="progress five">

                    </div>
                    <p class="text">Sewing done</p>
                </li>
                <li id="completed">
                    <iconify-icon icon="mdi:package-variant-closed-check"></iconify-icon>
                    <div class="progress six">
                    </div>
                    <p class="text">Completed</p>
                </li>

            </ul>

        </div>

        <div class="container1">
            <form class="update-form" method="POST">

                <div class="user-details more">
                    <div class="input-box">
                        <span class="details">Order Id </span>
                        <input name="order_id" type="text" readonly />
                    </div>

                    <div class="input-box">
                        <span class="details">cut dispatch date</span>
                        <input name="cut_dispatch_date" type="text" readonly />
                    </div>
                    <div class="input-box">
                        <span class="details">sew dispatch date</span>
                        <input name="sew_dispatch_date" type="text" readonly />
                    </div>
                </div>

                <hr class="dotted">

                <div id="cards-wrapper">
                    <div class="all-cards">


                        <div class="user-details material">

                            <div class="input-box">

                                <span class="details">Material </span>
                                <input class="g-type" name="material" type="text" readonly />

                                <span class="details">Sleeves </span>
                                <input class="g-type" name="sleeves" type="text" readonly />

                                <span class="details">Printing Type </span>
                                <input class="" name="printing-type" type="text" readonly />
                            </div>
                            <div>

                                <div class="s-q">

                                    <div class="sizes">

                                        <span class="details">Sizes</span>
                                        <input class="size" type="text" readonly value="X-Small" />
                                    </div>
                                    <div class="sizes">

                                        <span class="details">Quantity</span>
                                        <input class="size" type="text" readonly />

                                    </div>
                                </div>
                                <div class="s-q">
                                    <input class="size" type="text" readonly value="Small" />
                                    <input class="size" type="text" readonly />
                                </div>
                                <div class="s-q">
                                    <input class="size" type="text" readonly value="Medium" />
                                    <input class="size" type="text" readonly />
                                </div>

                                <div class="s-q">
                                    <input class="size" type="text" readonly value="Large" />
                                    <input class="size" type="text" readonly />
                                </div>
                                <div class="s-q">
                                    <input class="size" type="text" readonly value="X-Large" />
                                    <input class="size" type="text" readonly />
                                </div>
                                <div class="s-q">
                                    <input class="size" type="text" readonly value="XX-Large" />
                                    <input class="size" type="text" readonly />
                                </div>
                            </div>

                            <div></div>

                        </div>

                        <hr class="dotted">
                    </div>

                </div>
                <!-- <div class="user-details material">
                    <div></div>
                    <div>
                        
                        </div>
                        <div>
                        <p>Total Quantity &nbsp;<span>258</span></p>
                        

                    </div>
                    <div></div>
                    <hr class="dotted">
                </div> -->


                <!-- hidden element -->
                <div class="input-box">
                    <!-- <span class="details">Order Id </span> -->
                    <input name="status" type="hidden" readonly value="cutting" />
                    <input name="garment_id" type="hidden" readonly value="0023456" />
                </div>

                <div class="g-poup-btn">
                    <button type="button" disabled class="update-btn pb" id="popup-status-btn" name="updateGorder" onclick="change_order_status()">Update Status</button>
                    <button type="button" onclick="" class="cancel-btn pb" id="popup-status-cancel-btn" name="CancelGorder">Cancel Order</button>
                </div>

            </form>
        </div>
    </div>



    <div id="overlay" class="overlay"></div>

    <script>
        endpoint = "<?= ROOT ?>/garment/reports";
        change_status_endpoint = "<?= ROOT ?>/garment/update/status";
        cancel_endpoint = "<?= ROOT ?>/garment/cancel";
    </script>

    <!-- Import JQuary Library script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/garment/garment-order.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
    <script src="<?= ROOT ?>/assets/js/toast.js"> </script>
    <?php
    include 'status_confirm_popup.php'
    ?>
</body>

</html>