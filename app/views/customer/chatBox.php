<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/chat.css">

    <title>Amoral</title>
</head>

<body>
    <button class="chat-btn" id="toggle-chat-btn" onclick="toggleChat('<?= $_SESSION['USER']->email ?>')">
        <i class="bx bx-message-rounded-dots bx-flashing-hover chat-icon" id="chat-msg"></i>
    </button>

    <div class="chat-popup" id="chat-popup">

        <div class="chat-container">

            <div class="chat-header">

                <!-- <span class="close-btn" onclick="toggleChat()">×</span> -->
                
                <!-- 👋 Hi, message us with any questions. We're happy to help! -->

                <div class="main-content">

                    <img class="userImg" src="<?= ROOT ?>/assets/images/manager/elon_musk.jpg" alt="">
                    <div class="user">
                        <p id="header-user">Chat with uc</p>
                        <div class="user-status hide">
                            <div class="status" id="status-c" style="background: rgb(0, 238, 0);"></div>
                            <p id='typing' class="user-online">Offline</p>
                            <div id="userOnline"></div>
                        </div>

                    </div>
                </div>
                <img class="logo" src="<?= ROOT ?>/assets/images/manager/amoral80.png" alt="">

            </div>
            <div class="chat-body" id="chat-body">

            </div>
            <div class="chat-input">
                <input type="text" id="message-input" onkeyup='typing()' placeholder="Type a message..." required>
                <button id="sendbtn" onclick="emptycheck()" accesskey="enter"><span><i class='bx bxl-telegram bx-flashing-hover send_icon'></i> </span></button>
            </div>

        </div>
    </div>

    <!-- Import JQuary Library script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <script>
        let chatVisible = false;

        var chatBoxData

        var userID 
        var socket = null;

        var chatInput = document.querySelector(".chat-input");
        var userStatus = document.querySelector(".user-status");
        var userImge = document.querySelector(".userImg");

        let selectChatId = 0;

        var onlineUser;

        var chatBody = document.getElementById('chat-body');

        chatBody.scrollTop = chatBody.scrollHeight + 100;

        chatBody.scrollTo({
            bottom: chatBody.scrollHeight,
            behavior: 'smooth'
        });


        function toggleChat(email) {
            const chatPopup = document.getElementById("chat-popup");
            const toggleChatBtn = document.getElementById("toggle-chat-btn");
            const chat_msg = document.getElementById("chat-msg");

            if (!chatVisible) {
                // If chat is not visible, show it
                chatPopup.style.display = "block";
                chatPopup.classList.add("slide-in");
                chat_msg.classList.remove(
                    "bx-message-rounded-dots",
                    "bx-flashing-hover"
                );
                chat_msg.classList.add(
                    "bx-chevron-up",
                    "bx-flashing",
                    "bx-rotate-180"
                );

                getUserChat(email);


            } else {
                // If chat is visible, hide it with animation
                chatPopup.classList.remove("slide-in");
                chatPopup.classList.add("slide-out");

                chat_msg.classList.remove(
                    "bx-chevron-up",
                    "bx-flashing",
                    "bx-rotate-180"
                );
                chat_msg.classList.add(
                    "bx-message-rounded-dots",
                    "bx-flashing-hover"
                );

                // Set a timeout to remove the chat after the animation completes
                setTimeout(() => {
                    chatPopup.style.display = "none";
                    chatPopup.classList.remove("slide-out");
                }, 400); // Adjust the timeout to match the animation duration
            }

            chatVisible = !chatVisible;

        }

        function getUserChat(email) {

            data = {
                email: email
            }

            $.ajax({
                type: "POST",
                url: "<?= ROOT ?>/customer/chatbox",
                data: data,
                cache: false,
                success: function(res) {
                    try {

                        Jsondata = JSON.parse(res)

                        // get that data using local variable when to use futures
                        chatBoxData = Jsondata
                        selectChatId = Jsondata.chat[0].chat_id

                        document.getElementById("chat-body").textContent = ''

                        // console.log(Jsondata)

                        Jsondata.chatMsgs.forEach(element => {

                            loadMessage(element, Jsondata.log_user);
                        });

                        userID = Jsondata.log_user

                        // messages load time socket opend
                        socket.onopen = function(e) {
                            console.log('Connection established!');
                        };

                        // isOnlineUser();

                    } catch (error) {

                    }
                },
                error: function(xhr, status, error) {
                    // return xhr;
                }
            })



        }

        socket = new WebSocket(`ws://localhost:8080?userId=${userID}`);

        try {

            // socket.send(JSON.stringify({
            //     // 'newRoute': `${chatBoxData.chat_box.chat_id}`,
            //     'onlineStatus': 'online',
            //     'user_id': userID,
            //     'chat_id': selectChatId,
            // }));

        } catch (error) {
            // console.error(error);
        }


        loadWithTime = 0;

        function loadMessage(chatMsg, userId) {

            var dateTime = new Date(chatMsg.time);

            var div = document.createElement("div");
            var p = document.createElement("p");

            p.style.padding = "10px";
            p.style.marginBottom = "10px";
            p.style.borderRadius = "5px";
            p.style.display = "inline-block";
            p.style.fontSize = "13px";
            p.style.lineHeight = "20px";
            p.style.maxWidth = "70%";
            p.innerHTML = chatMsg.msg + "<br> <small> <em>" + formatTime(dateTime)  + "</em></small>";

            div.style.color = "white";
            div.style.fontSize = "14px";

            if (loadWithTime != formatDate(dateTime) ) {

                loadWithTime = formatDate(dateTime) ;

                div.innerHTML = loadWithTime;
                div.style.maxWidth = "100%";
                div.style.textAlign = "center";
            }

            if (reciveTimedisplay && sendTimedisplay) {

                div.innerHTML = formatDate(dateTime) ;
                div.style.maxWidth = "100%";
                div.style.textAlign = "center";

                sendTimedisplay = false;
            }

            if (userId === chatMsg.user_id) {

                p.style.background = "black";
                p.style.color = "white";
                p.style.alignSelf = "flex-end";

            } else {
                p.style.alignSelf = "flex-start";
                p.style.flexDirection = "column";
                p.style.background = "white";
                p.style.color = "black";
            }

            p.style.transition = "opacity 1s ease-in-out, transform 1s ease-in-out";

            document.getElementById("chat-body").appendChild(div);
            document.getElementById("chat-body").appendChild(p);

            // messages trantion
            var delay = chatMsg.log_user ? 0 : 30000;

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
                document.getElementById("message-input").value = "";
                send(text);
                // console.log();
            }
        }

        // send the msg using web sockets
        function send(query) {

            var currentDate = new Date();

            socket.send(JSON.stringify({
                'chat_id': chatBoxData.chat[0].chat_id,
                'msg': query,
                'user_id': chatBoxData.log_user,
                'date': formatDate(currentDate),
                'time': formatTime(currentDate) 
            }));

            sendMessage(query, formatDate(currentDate), formatTime(currentDate) );
        }


        sendTimedisplay = true;

        function sendMessage(query, formattedDate, formattedTime) {

            var div = document.createElement("div");
            var p = document.createElement("p");
            p.style.background = "black";
            p.style.color = "white";
            p.style.padding = "10px";
            p.style.marginBottom = "10px";
            p.style.borderRadius = "5px";
            p.style.display = "inline-block";
            p.style.maxWidth = "70%";
            p.style.fontSize = "13px";
            p.style.lineHeight = "20px";
            p.innerHTML = query + "<br> <small> <em>" + formattedTime + "</em></small>";

            div.style.color = "white";
            div.style.fontSize = "14px";


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
                'chat_id': chatBoxData.chat[0].chat_id,
                'user_id': chatBoxData.log_user,
            };

            $.ajax({
                type: "POST",
                url: "<?= ROOT ?>/customer/saveMsg",
                data: data,
                cache: false,
                success: function(res) {
                    
                },
                error: function(xhr, status, error) {
                    // return xhr;
                }
            });
            

        }

        reciveTimedisplay = true;

        // pass the typing status using web socket
        function typing() {

            socket.send(JSON.stringify({
                'typing': 'y',
                'user_id': chatBoxData.log_user,
                'chat_id': chatBoxData.chat[0].chat_id,
            }));
        }

        // get the all web socket with pass data
        socket.onmessage = function(e) {

            try {

                let data = JSON.parse(e.data);

                // console.log(data);

                if ( data.chat_id == selectChatId) {

                    // if ( data.typing == null || data.msg == null ) {
                    //     return;
                    // }

                    if (typeof data.msg !== 'undefined') {

                        var div = document.createElement("div");
                        var p = document.createElement("p");
                        p.style.background = "white";
                        p.style.color = "black";
                        p.style.padding = "10px";
                        p.style.marginBottom = "10px";
                        p.style.borderRadius = "5px";
                        p.style.display = "inline-block";
                        p.style.maxWidth = "60%";
                        p.innerHTML = data.msg + "<br> <small> <em>" + data.time + "</em></small>";


                        div.style.color = "white";
                        div.style.fontSize = "14px";


                        if (reciveTimedisplay && sendTimedisplay) {

                            div.innerHTML = data.date;

                            div.style.maxWidth = "100%";
                            div.style.textAlign = "center";

                            reciveTimedisplay = false;
                        }
                        chatBody.appendChild(div);
                        chatBody.appendChild(p);

                        // isOnlineUser()


                    } else if (typeof data.typing !== 'undefined') {

                        usertyping = document.getElementById('typing');

                        usertyping.innerHTML = " typing...";
                        usertyping.style.color = "white";

                        timeoutHandle = window.setTimeout(function() {

                            userStatus.classList.remove("hide");
                            usertyping.innerHTML = "Online";
                            // isOnlineUser()


                        }, 2000);

                    }

                }

                if (typeof data.type !== 'undefined') {

                    onlineUser = data
                }

                if (typeof data.typing == 'undefined') {
                    // isOnlineUser()
                }

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
                            status = document.getElementById('status-c');

                            userOnline.innerHTML = "Offline";
                            userOnline.style.color = "white";
                            status.style.background = "red";
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

        function formatDate(currentDate) {
            //formatted date ("Jan 28, 2024")
            var formattedDate = currentDate.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
            return formattedDate;
        }

        function formatTime(currentDate) {
            //formatted time ("12:06:34 PM")
            var formattedTime = currentDate.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: true
            });
            return formattedTime;
        }
    </script>


</body>

</html>