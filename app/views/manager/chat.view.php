<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/manager/chat.css">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="<?= ROOT ?>/assets/js/manager/chat.js"></script>
    <link rel="icon" href="<?= ROOT ?>/assets/images/amoral_1.ico">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/style-bar.css">

    <title>Amoral Chat</title>
</head>

<body>
    <!-- Sidebar -->
    <?php include 'sidebar.php' ?>
    <!-- Sidebar -->
    <?php include 'navigationbar.php';


    // show($data);
    ?>


    <div class="header">
        <div class="container">

            <div class="user_box">

                <div class="chat-all-users">
                    <p>Amoral Chat</p>
                </div>

                <div class="search-content">
                    <input type="text" id="search" placeholder="Search" required>
                    <button class="search-icon"><i class='bx bx-search bx-flashing-hover'></i></button>

                </div>

                <?php

                if (isset($data['chatedUsers'])) {

                    foreach ($data['chatedUsers'] as $value) {
                        // show($value);
                        $jsonData = json_encode($value);

                        if ($value->user_status == 'customer') {

                ?>
                            <!-- user is customer -->
                            <div class="user-content" onclick='selectChat(<?= $jsonData ?>)'>
                                <img class="userImg" src="<?= ROOT ?>/assets/images/manager/elon_musk.jpg" alt="">
                                <div class="user-data">
                                    <h4><?= $value->fullname ?></h4>
                                    <p><?= $value->chat_data->msg ?></p>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <!-- user is employee -->
                            <div class="user-content" onclick='selectChat(<?= $jsonData ?>)'>
                                <img class="userImg" src="<?= ROOT ?>/assets/images/manager/elon_musk.jpg" alt="">
                                <div class="user-data">
                                    <h4><?= $value->emp_name ?></h4>
                                    <p><?= $value->chat_data->msg ?></p>
                                </div>
                            </div>

                <?php
                        }
                    }
                }
                ?>

            </div>

            <div class="chat-container">
                <div class="chat-header">
                    <div class="main-content">

                        <img class="userImg" src="<?= ROOT ?>/assets/images/manager/elon_musk.jpg" alt="">
                        <div class="user">
                            <h2 id="header-user">Dilum Induwara</h2>
                            <div class="user-status">
                                <div class="status"></div>
                                <p class="user-online">Online</p>
                            </div>
                        </div>
                    </div>
                    <img class="logo" src="<?= ROOT ?>/assets/images/manager/amoral80.png" alt="">
                </div>
                <div class="chat-body" id="chat-body">
                    <div class="chat-message received">
                        <p>Hello! how can I help?</p>
                    </div>

                </div>
                <div class="chat-input">
                    <input type="text" id="message-input" placeholder="Type a message..." required>
                    <button onclick="emptycheck()" accesskey="enter">Send<span><i class='bx bx-send bx-flashing-hover send_icon'></i> </span></button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>

    <script>
        function selectChat(chatUserData) {

            header_user = document.getElementById("header-user");

            if (chatUserData.user_status == "customer") {

                header_user.innerHTML = chatUserData.fullname
            } else {
                header_user.innerHTML = chatUserData.emp_name

            }

            header_user.classList.add("fade-in");

            // After a delay, remove the class to trigger the fade-out effect
            // setTimeout(function() {
            //     header_user.innerText = "New Content";
            //     header_user.classList.remove("fade-out");
            //     header_user.classList.add("fade-in");
            // }, 1000);

            console.log(chatUserData);

        }
    </script>

</body>

</html>