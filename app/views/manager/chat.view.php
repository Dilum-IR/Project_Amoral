<?php
// show($_SESSION['USER']);

?>

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

    <style>
        .all-chat .hide {
            display: none;
        }

        #no-data-search .hide {
            display: none;
        }

        .all-chat.user-content {
            --delay: 0.1s;
            transition: .5s ease-in-out var(--delay);
        }

        .all-chat {
            overflow: auto;
            overflow: overlay;
        }

        .name-time{
            gap: 57px;
        }
    </style>

    <div class="header">
        <div class="container">

            <div class="user_box">

                <div class="chat-all-users">
                    <div class="chat-head">
                        <p class="chatname">&nbsp; Chats</p>

                        <div class="dropdown" style="float:right;">
                            <!-- <button class="dropbtn">Type</button>
                            <div class="dropdown-content">
                                <a href="#" onclick="">All Users</a>
                                <a href="#">Customers</a>
                                <a href="#">Delivary man</a>
                            </div> -->

                            <img class="logo" src="<?= ROOT ?>/assets/images/logo.JPG" alt="">
                        </div>

                    </div>

                </div>

                <div class="search-content">
                    <input type="text" id="search" placeholder="Search" required>
                    <button class="search-icon"><i class='bx bx-search bx-flashing-hover'></i></button>

                </div>

                <div class="all-chat">

                    <?php

                    if (!empty(($data['chatedUsers']))) {


                        foreach ($data['chatedUsers'] as $value) {
                            // show($value);
                            $jsonData = json_encode($value);

                            if ($value->user_status == 'customer') {
                    ?>
                                <!-- user is customer -->
                                <div class="user-content" onclick='selectChat(<?= $jsonData ?>)'>
                                    <img class="userImg" src="<?= ROOT ?>/uploads/profile_img/<?= $value->user_image ?>" alt="user profile">
                                    <div class="user-data">
                                        <div class="name-time">
                                            <h4><?= ucfirst($value->fullname) ?></h4>
                                            <p id="new-time<?= $value->id ?>"><?= $value->last_msg->time ?></p>
                                        </div>

                                        <p id="new-msg<?= $value->id ?>"><?= $value->last_msg->msg ?></p>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <!-- user is employee -->
                                <div class="user-content" onclick='selectChat(<?= $jsonData ?>)'>
                                    <img class="userImg" src="<?= ROOT ?>/uploads/profile_img/<?= $value->emp_image ?>" alt="user profile">
                                    <div class="user-data">
                                        <div class="name-time">
                                            <h4><?= ucfirst($value->emp_name) ?></h4>
                                            <p><?= $value->last_msg->time ?></p>

                                        </div>
                                        <p><?= $value->last_msg->msg ?></p>
                                    </div>
                                </div>

                        <?php
                            }
                        }
                    } else {
                        ?>

                        <h5 class="no-chats">No Chat Messages Yet</h5>

                    <?php
                    }
                    ?>

                    <h3 class="no-chats hide" id="no-data-search">No Search Results</h3>
                </div>
            </div>

            <div class="chat-container">
                <div class="chat-header">
                    <div class="main-content">

                        <img class="userImg user-img" src="<?= ROOT ?>/uploads/profile_img/<?= $_SESSION['USER']->emp_image ?>" alt="">
                        <div class="user">
                            <h2 id="header-user">Hi, <?= $_SESSION['USER']->emp_name ?></h2>
                            <div class="user-status hide">
                                <!-- <div class="status" id="status-c" style="background: rgb(0, 238, 0);"></div> -->
                                <p id='typing' class="user-online">Offline</p>
                                <div id="userOnline"></div>
                            </div>

                        </div>
                    </div>
                    <img class="logo" src="<?= ROOT ?>/assets/images/manager/amoral80.png" alt="">
                </div>
                <div class="chat-body" id="chat-body">
                    <div class="chat-message">
                        <!-- <p class="msg">Today</p> -->
                        <p class="msg">🔐 Messages are end-to-end encrypted. No one outside of this chat, can read or listen to them. Learn more.</p>

                        <i class='bx bx-message-rounded-add bx-tada-hover no-chat' style='color:#ffffff'></i>
                    </div>

                </div>
                <div class="chat-input hide">
                    <input type="text" id="message-input" onkeyup='typing()' placeholder="Type a message..." required>
                    <button onclick="emptycheck()" accesskey="enter">Send<span><i class='bx bxl-telegram bx-flashing-hover send_icon'></i> </span></button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= ROOT ?>/assets/js/script-bar.js"></script>

    <!-- Import JQuary Library script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .loader-circle {
            align-items: center;
            display: flex;
            gap: 10px;
            justify-self: center;
        }

        .invalid-msg {
            border: 1px solid red !important;
        }

        .each-msg {
            overflow-wrap: anywhere;

        }

        .log-user {
            /* display: inline; */
            /* float: right; */
        }

        .other-user {
            /* display: inline; */
            /* float: left; */
        }
    </style>
    <script>
        var userID = "<?= $data['chatedUsers'][0]->log_user ?>"
        var socket = null;

        var chatInput = document.querySelector(".chat-input");
        var userStatus = document.querySelector(".user-status");
        var userImge = document.querySelector(".userImg");
        var user_Imge = document.querySelector(".user-img");

        var chatBoxData
        var selectChatBox = false;
        let selectChatId = 0;

        var onlineUser;

        var chatBody = document.getElementById('chat-body');

        chatBody.scrollTop = chatBody.scrollHeight + 100;

        chatBody.scrollTo({
            bottom: chatBody.scrollHeight,
            behavior: 'smooth'
        });

        function capitalizeFirstLetter(inputString) {
            return inputString.charAt(0).toUpperCase() + inputString.slice(1);
        }

        function selectChat(chatUserData) {


            // get that data using local variable when to use futures
            chatBoxData = chatUserData

            // console.log(chatBoxData)

            selectChatBox = true;
            selectChatId = chatUserData.chat_box.chat_id;

            header_user = document.getElementById("header-user");
            var chatBody = document.getElementById("chat-body");

            chatInput.classList.remove("hide");
            userStatus.classList.remove("hide");
            userImge.classList.remove("hide");

            // Clear existing messages in the chat body
            chatBody.innerHTML = "";
            chatBody.innerHTML = "<span class='loader-circle'><i class='bx bx-loader-circle bx-spin bx-flip-horizontal bx-sm'></i> Please Wait ...</span>";
            // remove invalid msg for given input tag class
            document.getElementById('message-input').classList.remove('invalid-msg');
            document.getElementById('message-input').value = "";


            if (chatUserData.user_status == "customer") {

                header_user.innerHTML = capitalizeFirstLetter(chatUserData.fullname)
                imageUrl = `<?= ROOT ?>/uploads/profile_img/${chatUserData.user_image}`;
                user_Imge.setAttribute("src", imageUrl);

            } else {
                header_user.innerHTML = capitalizeFirstLetter(chatUserData.emp_name)
                imageUrl = `<?= ROOT ?>/uploads/profile_img/${chatUserData.emp_image}`;
                user_Imge.setAttribute("src", imageUrl);
            }

            data = {
                chat_id: chatUserData.chat_box.chat_id
            }

            $.ajax({
                type: "POST",
                url: "<?= ROOT ?>/manager/chatbox",
                data: data,
                cache: false,
                success: function(res) {
                    // convet to the json type
                    try {

                        chatBody.innerHTML = "";

                        Jsondata = JSON.parse(res)
                        // console.log(Jsondata)

                        Jsondata.forEach(element => {

                            loadMessage(element, chatUserData);
                        });
                        // console.log(Jsondata)
                        // console.log(chatUserData)

                    } catch (error) {

                    }
                },
                error: function(xhr, status, error) {
                    // return xhr;
                }
            })

            try {

                // messages load time socket opend
                socket.onopen = function(e) {
                    console.log('Connection established!');
                };

                // socket.send(JSON.stringify({
                //     'newRoute': `${chatBoxData.chat_box.chat_id}`,
                //     'onlineStatus': 'online',
                //     'user_id': userID,
                //     'chat_id': selectChatId,

                // }));


                isOnlineUser();


            } catch (error) {
                console.error(error);
            }
        }

        socket = new WebSocket(`ws://localhost:8080`);

        try {

            // while (true) {

            // socket.send(JSON.stringify({
            //     // 'newRoute': `${chatBoxData.chat_box.chat_id}`,
            //     'onlineStatus': 'online',
            //     'user_id': userID,
            //     'chat_id': selectChatId,
            // }));

            // }


        } catch (error) {
            // console.error(error);
        }


        loadWithTime = 0;

        function loadMessage(chatMsg, chatUserData) {

            var dateTime = new Date(chatMsg.time);

            //formatted date ("Jan 28, 2024")
            var formattedDate = dateTime.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });

            // formatted time ("12:06:34 PM")
            var ampmTime = dateTime.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });

            var div = document.createElement("div");
            var p = document.createElement("p");
            p.classList.add('each-msg');

            p.style.padding = "10px";
            p.style.marginBottom = "10px";
            p.style.borderRadius = "5px";
            p.style.display = "inline-block";
            p.style.maxWidth = "70%";
            p.style.lineHeight = "20px";
            p.innerHTML = chatMsg.msg + "<br> <small> <em>" + ampmTime + "</em></small>";

            if (loadWithTime != formattedDate) {

                loadWithTime = formattedDate;

                div.innerHTML = loadWithTime;
                div.style.maxWidth = "100%";
                div.style.textAlign = "center";
            }

            if (reciveTimedisplay && sendTimedisplay) {

                div.innerHTML = formattedDate;
                div.style.maxWidth = "100%";
                div.style.textAlign = "center";

                sendTimedisplay = false;
            }

            if (chatUserData.log_user === chatMsg.user_id) {

                p.style.background = "black";
                p.style.color = "white";
                p.style.alignSelf = "flex-end";
                p.classList.add('log-user');


            } else {
                p.style.alignSelf = "flex-start";
                p.style.flexDirection = "column";
                p.style.background = "white";
                p.style.color = "black";
                p.classList.add('other-user');

            }

            p.style.transition = "opacity 1s ease-in-out, transform 1s ease-in-out";

            document.getElementById("chat-body").appendChild(div);
            document.getElementById("chat-body").appendChild(p);
            var delay = chatMsg.log_user ? 0 : 30000;

            chatBody.scrollTop = chatBody.scrollHeight;

            setTimeout(function() {
                p.style.opacity = "1";
                p.style.transform = "translateY(0)";
            }, delay);


        }


        document.onkeyup = enter;

        function enter(e) {
            if (e.which == 13) emptycheck();
        }

        function emptycheck() {
            var text = document.getElementById("message-input").value;

            if (text == "") {
                return;
            } else {

                // Regular expression pattern to match valid chat messages
                const messagePattern = /^[a-zA-Z0-9\s.,!?'"(){}[\]-]*$/;

                // validate a chat message using regex
                if (!messagePattern.test(text)) {
                    document.getElementById('message-input').classList.add('invalid-msg');
                    return;
                } else {
                    document.getElementById('message-input').classList.remove('invalid-msg');
                }

                var chat_id = chatBoxData.id;
                send(text);
                document.getElementById("message-input").value = "";
                document.getElementById(`new-msg${chat_id}`).innerHTML = text;

                //formatted time ("12:06")
                const currentDate = new Date();
                const hours = String(currentDate.getHours()).padStart(2, '0');
                const minutes = String(currentDate.getMinutes()).padStart(2, '0');
                const formattedTime = `${hours}:${minutes}`;

                document.getElementById(`new-time${chat_id}`).innerHTML = formattedTime;
                chatBody.scrollTop = chatBody.scrollHeight;

            }
        }

        // send the msg using web sockets
        function send(query) {

            var currentDate = new Date();

            //formatted date ("Jan 28, 2024")
            var formattedDate = currentDate.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });

            //formatted time ("12:06:34 PM")
            var formattedTime = currentDate.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });

            socket.send(JSON.stringify({
                'chat_id': chatBoxData.chat_box.chat_id,
                'msg': query,
                'user_id': chatBoxData.log_user,
                'date': formattedDate,
                'time': formattedTime
            }));

            sendMessage(query, formattedDate, formattedTime);
        }


        sendTimedisplay = true;

        function sendMessage(query, formattedDate, formattedTime) {

            var div = document.createElement("div");
            var p = document.createElement("p");
            p.classList.add('each-msg');
            p.classList.add('log-user');

            p.style.background = "black";
            p.style.color = "white";
            p.style.padding = "10px";
            p.style.marginBottom = "10px";
            p.style.borderRadius = "5px";
            p.style.display = "inline-block";
            p.style.maxWidth = "70%";
            p.style.lineHeight = "20px";
            p.innerHTML = query + "<br> <small> <em>" + formattedTime + "</em></small>";

            if (reciveTimedisplay && sendTimedisplay) {

                div.innerHTML = formattedDate;
                div.style.maxWidth = "100%";
                div.style.textAlign = "center";

                sendTimedisplay = false;
            }


            document.getElementById("chat-body").appendChild(div);
            document.getElementById("chat-body").appendChild(p);


            let data = {
                'msg': query,
                'chat_id': chatBoxData.chat_box.chat_id,
                'user_id': chatBoxData.log_user,
            };

            $.ajax({
                type: "POST",
                url: "<?= ROOT ?>/manager/saveMsg",
                data: data,
                cache: false,
                success: function(res) {},
                error: function(xhr, status, error) {
                    // return xhr;
                }
            })

        }

        reciveTimedisplay = true;

        // pass the typing status using web socket
        function typing() {

            socket.send(JSON.stringify({
                'typing': 'y',
                'user_id': chatBoxData.log_user,
                'chat_id': chatBoxData.chat_box.chat_id,
            }));
        }

        // get the all web socket with pass data
        socket.onmessage = function(e) {

            try {

                let data = JSON.parse(e.data);

                console.log(data);


                if (selectChatBox && data.chat_id == selectChatId) {

                    // if ( data.typing == null || data.msg == null ) {
                    //     return;
                    // }

                    if (typeof data.msg !== 'undefined') {

                        var div = document.createElement("div");
                        var p = document.createElement("p");
                        p.classList.add('each-msg');
                        p.classList.add('other-user');

                        p.style.background = "white";
                        p.style.color = "black";
                        p.style.padding = "10px";
                        p.style.marginBottom = "10px";
                        p.style.borderRadius = "5px";
                        p.style.display = "inline-block";
                        p.style.maxWidth = "60%";
                        p.innerHTML = data.msg + "<br> <small> <em>" + data.time + "</em></small>";

                        if (reciveTimedisplay && sendTimedisplay) {

                            div.innerHTML = data.date;

                            div.style.maxWidth = "100%";
                            div.style.textAlign = "center";

                            reciveTimedisplay = false;
                        }
                        chatBody.appendChild(div);
                        chatBody.appendChild(p);

                        isOnlineUser()


                    } else if (typeof data.typing !== 'undefined') {

                        usertyping = document.getElementById('typing');

                        usertyping.innerHTML = " typing...";
                        usertyping.style.color = "white";

                        timeoutHandle = window.setTimeout(function() {

                            userStatus.classList.remove("hide");
                            usertyping.innerHTML = "Online";
                            isOnlineUser()


                        }, 2000);

                    }

                }

                if (typeof data.type !== 'undefined') {

                    onlineUser = data
                }

                if (typeof data.typing == 'undefined') {
                    isOnlineUser()
                }

                chatBody.scrollTop = chatBody.scrollHeight;

            } catch (error) {

                console.error(error);

            }

        };

        // defaultUser = true

        function isOnlineUser() {
            try {

                if (typeof onlineUser.type !== "undefined") {


                    if (chatBoxData != null) {


                        if ((onlineUser.user_id == chatBoxData.chat_box.from_id ||
                                onlineUser.user_id == chatBoxData.chat_box.to_id &&
                                onlineUser.online)) {

                            console.log(chatBoxData.chat_box.from_id)
                            console.log(chatBoxData.chat_box.to_id)
                            console.log(onlineUser.user_id)
                            console.log("Online")
                            // defaultUser =true

                            userOnline = document.getElementById('typing');

                            userOnline.innerHTML = "Online";
                            userOnline.style.color = "white";

                            timeoutHandle = window.setTimeout(function() {

                                isOnlineUser()

                                // userStatus.classList.remove("hide");
                                // userOnline.innerHTML = "";

                            }, 5000);

                        } else if (onlineUser.user_id == chatBoxData.chat_box.from_id ||
                            onlineUser.user_id == chatBoxData.chat_box.to_id &&
                            onlineUser.online == false) {

                            userOnline = document.getElementById('typing');
                            // status = document.getElementById('status-c');

                            userOnline.innerHTML = "Offline";
                            userOnline.style.color = "white";
                            // status.style.background = "red";
                            // defaultUser =false


                            timeoutHandle = window.setTimeout(function() {

                                isOnlineUser()

                                userStatus.classList.remove("hide");
                                userOnline.innerHTML = "";

                            }, 1000);

                        } else {
                            userOnline.innerHTML = "";

                        }
                    }

                }

            } catch (error) {

            }

        }

        setInterval(5000, isOnlineUser());
    </script>

</body>

</html>