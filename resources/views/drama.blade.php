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

        .chat-container p{
            color: #fff;
            position: fixed;
            padding: 10px;
            bottom: 0;
            left: 45%;
            letter-spacing: 10px;
            font-weight: bolder;
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

        #chat-log .icon {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            background-size: cover;
            border-radius: 50%;
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


    </style>
</head>

<body>
    <div class="container" id="click-area">
        <div class="header">
            <h3>綠野仙蹤－蠻金之國篇</h3>
        </div>

        <div class="chat-container">
            <div id="chat-log"></div>
            <div><p>請點擊空白處</p></div>
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
            if (currentDialogueIndex < dialogues.length) {
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

            chatElement.classList.add('chat-box');
            iconElement.classList.add('icon');
            messageElement.classList.add(sender);
            messageElement.innerText = message;

            // 根據誰傳送訊息，機器人或user增加icon
            if (sender === 'user') {
                iconElement.style.backgroundImage = 'url("/images/drama/tls.svg")';
            } else {
                iconElement.style.backgroundImage = 'url("/images/drama/scarecrow.svg")';
            }

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
