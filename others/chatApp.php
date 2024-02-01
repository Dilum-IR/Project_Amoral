<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <title>Popup Chat</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
    }

    .chat-btn {
      position: fixed;
      width: 70px;
      height: 70px;
      z-index: 10;
      bottom: 10px;
      right: 10px;
      padding: 10px;
      background-color: black;
      color: white;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .chat-btn:hover {
      background-color: rgba(0, 0, 0, 0.774);
    }

    .chat-popup {
      z-index: 5;
      height: 80vh;
      width: 350px;
      display: none;
      position: fixed;
      bottom: 37px;
      right: 40px;
      border: 1px solid #ccc;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      max-width: 300px;
      background-color: rgb(49, 49, 49);
      border-radius: 10px;
    }

    @keyframes slideIn {
      from {
        transform: translateY(15%);
        opacity: 0;
      }

      to {
        transform: translateY(0%);
        opacity: 1;
      }
    }

    @keyframes slideOut {
      from {
        transform: translateY(0);
        opacity: 1;
      }

      to {
        transform: translateY(100%);
        opacity: 0;
      }
    }

    .slide-in {
      animation: slideIn 0.5s ease-in-out;
    }

    .slide-out {
      animation: slideOut 0.5s ease-in-out;
    }

    .chat-container {
      padding: 10px;
    }

    .chat-header {
      background-color: #f1f1f1;
      padding: 10px;
      display: flex;
      justify-content: space-between;
    }

    .close-btn {
      cursor: pointer;
    }

    .chat-messages {
      max-height: 200px;
      overflow-y: auto;
    }

    .chat-input {
      display: flex;
      margin-top: 10px;
    }

    .chat-input input {
      flex-grow: 1;
      padding: 5px;
    }

    .chat-input button {
      padding: 5px 10px;
    }

    .chat-icon {
      font-size: 35px;
      transition: 0.5s ease-in-out;
    }
  </style>
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
        <h2>Amoral Chat</h2>

      </div>
      <div class="chat-messages" id="chat-messages">
      </div>
      <div class="chat-input">
        <input type="text" id="message-input" placeholder="Type a message..." />
        <button onclick="sendMessage()">Send</button>
      </div>

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