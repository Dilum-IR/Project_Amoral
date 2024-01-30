<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/customer/chat.css">

    <title>Popup Chat</title>
</head>

<body>
    <button class="chat-btn" id="toggle-chat-btn" onclick="toggleChat()">
        <!-- <i class='bx bx-chevron-up bx-flashing bx-rotate-180 chat-icon' id="arrow"></i> -->
        <i class="bx bx-message-rounded-dots bx-flashing-hover chat-icon" id="chat-msg"></i>
    </button>

    <div class="chat-popup" id="chat-popup">

        <div class="chat-container">

            <div class="chat-header">

                <!-- <span class="close-btn" onclick="toggleChat()">×</span> -->
                <!-- <h4>Chat With Amoral</h4> -->

                <div class="main-content">

                    <img class="userImg" src="<?= ROOT ?>/assets/images/manager/elon_musk.jpg" alt="">
                    <div class="user">
                        <p id="header-user">Chat With Amoral</p>
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
                <div class="chat-message">
                    <!-- <p class="msg">Today</p> -->
                    <!-- <p class="msg">🔐 Messages are end-to-end encrypted. No one outside of this chat, can read or listen to them. Learn more.</p> -->

                    <!-- <i class='bx bx-message-rounded-add bx-tada-hover no-chat' style='color:#ffffff'></i> -->

                </div>

            </div>
            <div class="chat-input">
                <input type="text" id="message-input" onkeyup='typing()' placeholder="Type a message..." required>
                <button id="sendbtn" onclick="emptycheck()" accesskey="enter"><span><i class='bx bxl-telegram bx-flashing-hover send_icon'></i> </span></button>
            </div>
            <!--                 
            <div class="chat-messages" id="chat-messages">
            </div>
            <div class="chat-input">
                <input type="text" id="message-input" placeholder="Type a message..." />
                <button onclick="sendMessage()">Send</button>
            </div> -->

        </div>
    </div>

    <script>
        let chatVisible = false;

        function toggleChat() {
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

        function sendMessage() {
            var messageInput = document.getElementById("message-input");
            var message = messageInput.value;

            if (message.trim() !== "") {
                var chatMessages = document.getElementById("chat-messages");
                var newMessage = document.createElement("div");
                newMessage.textContent = message;
                chatMessages.appendChild(newMessage);

                // You can also send the message to a server or perform other actions here

                messageInput.value = ""; // Clear the input field
            }
        }
    </script>
</body>

</html>