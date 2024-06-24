<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>JavaEducation - 劇情</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            background-image: url('/images/drama/lv1-1.svg');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: scroll;
            background-size: cover;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border-bottom: 2px solid #fff;
            height: 45px;
        }

        .header h3 {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 10px;
        }

        .container {
            max-width: 920px;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin: 0 auto;
            background-color: rgba(142, 142, 142, 0.8);
        }

        .chat-container {
            flex: 1;
        }

        .chat-box {
            display: flex;
            align-items: center;
            padding: 10px 15px;
        }

        #chat-log {
            margin-bottom: 10px;
            font-size: 14px;
            line-height: 1.6;
        }

        #chat-log i {
            margin-right: 10px;
            color: #fff;
            border-radius: 5px;
        }

        .bot, .user {
            display: flex;
            align-items: flex-start;
            color: #eee;
            background-color: #444654;
            width: 100%;
            padding: 15px 7px 15px 10px;
            border-radius: 6px;
        }

        #chat-log #user-icon i {
            background-color: #19c37d;
            padding: 10px 11px;
        }

        #chat-log #bot-icon i {
            background-color: #9859b7;
            padding: 10px 8px 11px;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container" id="click-area">
        <div class="header">
            <h3>綠野仙蹤－蠻金之國篇</h3>
        </div>

        <div class="chat-container">
            <div id="chat-log"></div>
        </div>
    </div>

    <!--js-->
    <script>
        const chatLog = document.getElementById('chat-log'),
            clickArea = document.getElementById('click-area');

        const dialogues = [
            { sender: 'bot', message: '歡迎來到綠野仙蹤!' },
            { sender: 'user', message: '你好，我是Jamie.' },
            { sender: 'bot', message: '很高興認識你，Jamie!' },
            { sender: 'bot', message: '準備好開始冒險了嗎?' }
        ];

        let currentDialogueIndex = 0;

        clickArea.addEventListener('click', displayNextMessage);

        function displayNextMessage() {
            if (currentDialogueIndex < dialogues.length) { // 修正這裡的lenth為length
                const { sender, message } = dialogues[currentDialogueIndex];
                appendMessage(sender, message);
                currentDialogueIndex++;
            } else {
                window.location.href = "test.html"; // 結束後跳轉頁面
            }
        }

        function appendMessage(sender, message) {
            const messageElement = document.createElement('div');
            const iconElement = document.createElement('div');
            const chatElement = document.createElement('div');
            const icon = document.createElement('i');

            chatElement.classList.add('chat-box');
            iconElement.classList.add('icon');
            messageElement.classList.add(sender);
            messageElement.innerText = message;

            // 根據誰傳送訊息，機器人或user增加icon
            if (sender === 'user') {
                icon.classList.add('fa-regular', 'fa-user');
                iconElement.setAttribute('id', 'user-icon');
            } else {
                icon.classList.add('fa-solid', 'fa-robot');
                iconElement.setAttribute('id', 'bot-icon');
            }

            iconElement.appendChild(icon);
            chatElement.appendChild(iconElement);
            chatElement.appendChild(messageElement);
            chatLog.appendChild(chatElement);
            chatLog.scrollTop = chatLog.scrollHeight;
        }

        // 初始化顯示第一句對話
        displayNextMessage();
    </script>
</body>

</html>
