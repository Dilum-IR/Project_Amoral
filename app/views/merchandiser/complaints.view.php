<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaints</title>
    <!-- Link Styles -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">
    <!-- <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/quotations.css"> -->
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/merchandiser/complaints.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Navigation bar -->

    <?php include_once 'navigationbar.php' ?>
    <!-- Scripts -->
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>


    <section id="main" class="main">

        <ul class="breadcrumb">
            <li>
                <a href="#">Home</a>
            </li>
            <i class='bx bx-chevron-right'></i>
            <li>
                <a href="#" class="active">Complaints & Messages</a>
            </li>

        </ul>

        <div class="form">
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn">
                        <i class='bx bx-search'></i>
                    </button>
                </div>
            </form>
            <div class="mydict">
                <form action="" method="POST">
                    <div>
                        <label>
                            <input type="radio" name="rptType" checked="ckecked" value="all">
                            <span>All</span>
                        </label>
                        <label>
                            <input type="radio" name="rptType" value="unread">
                            <span>Unread</span>
                        </label>
                        <label>
                            <input type="radio" name="rptType" value="read">
                            <span>Read</span>
                        </label>                  
                    </div>
                </form>
            </div>
        </div>



        <div class="container">
            <div class="report-box">
                <div class="report-input-box">
                    <?php
                    if (!empty($data)) {
                        // show($data);
                        foreach ($data as $rpt):

                            ?>

                            <div class="text-box">
                                <div class="report-info">
                                    <div class="report-info-email">
                                        <?php echo htmlspecialchars($rpt->email) ?>
                                    </div>
                                    <div class="report-info-date">
                                        <?php echo htmlspecialchars(date('Y-m-d', strtotime($rpt->report_date))) ?>
                                    </div>
                                </div>
                                <div class="report-description-title"> </div>
                                <div class="report-description">
                                    <p> <?php echo htmlspecialchars($rpt->description) ?></p>
                                </div>
                                <div class="report-btns">
                                    <button class="view-btn rpt" type="" name="selectItem" class="edit"
                                        data-report-id='<?= $rpt->report_id; ?>' data-rpt='<?= json_encode($rpt); ?>'
                                        onclick="showPopup(this)" value="">View Details</button>
                                </div>
                            </div>
                            <?php


                        endforeach;
                    } else {
                        ?>
                        <div class="text-box">
                            <div class="no-rpts">
                                No Complaints or Messages

                            </div>

                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>

    <!-- popup -->

    <div class="popup-report">
        <form action="" class="update-form" method="POST">
            <input type="hidden" name="garOrCus" id="garOrCus" value="" />
            <input type="hidden" name="report_id" value="">
            <div class="sender-info">
                <div class="information">
                    <div class="email info" name="email">Email - </div>
                    <div class="sent-date info">Sent Date - </div>
                </div>
                <div class="information">
                    <div class="title info">Title - </div>
                    <div class="sender-id info">Garment ID - </div>
                </div>
            </div>
            <div class="popup-input">

            </div>
            <div class="popup-buttons">

                <!-- <button class="popup-read-btn rd" onclick="closePopup()">Delete</button> -->
                <button class="popup-close-btn rd" type="submit" name="markAsRead" onclick="closePopup()">Mark as
                    Read</button>
                <button class="popup-close-btn-back" style="border: 0.3px solid #000000;
    color: #000000; background-color: transparent;  padding: 8px 35px; border-radius: 9px;cursor: pointer;
  transition: background-color 0.5s ease;--hover-color:red;" type="submit" name="markAsRead"
                    onclick="closePopup()">Back</button>
            </div>
        </form>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('input[type="search"]');
            const reportBoxes = document.querySelectorAll('.text-box');

            searchInput.addEventListener('input', function () {
                const searchTerm = searchInput.value.toLowerCase();

                reportBoxes.forEach(box => {
                    const email = box.querySelector('.report-info-email').textContent.toLowerCase();
                    const description = box.querySelector('.report-description').textContent.toLowerCase();
                    const date = box.querySelector('.report-info-date').textContent;

                    // Extend with other fields as necessary

                    if (email.includes(searchTerm) || description.includes(searchTerm) || date.includes(searchTerm)) {
                        box.style.display = '';
                    } else {
                        box.style.display = 'none';
                    }
                });
            });
        });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <script src="<?= ROOT ?>/assets/js/merchandiser/complaints.js"></script>
    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>
</body>

</html>