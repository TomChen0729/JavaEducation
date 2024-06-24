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
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-image: url('/images/drama/lv1-1.svg');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: scroll;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 920px;
            height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: rgba(142, 142, 142, 0.8);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border-bottom: 2px solid #fff;
            height: 45px;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .header h3 {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 10px;
            margin: 0;
        }

        .chat-container {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .chat-box {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        #chat-log {
            font-size: 14px;
            line-height: 1.6;
        }

        #chat-log .icon {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            border-radius: 50%;
        }

        .tls, .badwitch, .goodwitch, .narration, .scarecrow {
            display: flex;
            align-items: flex-start;
            color: #eee;
            background-color: #444654;
            width: 100%;
            padding: 15px;
            border-radius: 6px;
        }

        .footer {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            border-bottom: 2px solid #fff;
            height: 45px;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .footer p {
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 10px;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container" id="click-area">
        <div class="header">
            <h3>綠野仙蹤－蠻金之國篇</h3>
        </div>

        <div class="chat-container" id="chat-container">
            <div id="chat-log"></div>
        </div>

        <div class="footer">
            <p>請點擊空白處</p>
        </div>
    </div>

    <!--js-->
    <script>
        const chatLog = document.getElementById('chat-log'),
            clickArea = document.getElementById('click-area'),
            chatContainer = document.getElementById('chat-container');

        const dialogues = [
            { sender: 'narration', message: '有一天，桃樂絲和她的狗托托住的房子被一場龍捲風吹走，掉到了蠻支金國土，房子砸在了東方壞女巫的身上，意外地救了這片土地上的居民。正當大家慶祝時，西方壞女巫出現了。' },
            { sender: 'badwitch', message: '你們這些小矮人！居然敢慶祝我的姐姐被消滅！' },
            { sender: 'narration', message: '南國女巫葛琳達出現，給了桃樂絲護身符。' },
            { sender: 'goodwitch', message: '這個護身符會幫助你通過接下來的關卡，但要小心壞女巫，她一定會想辦法搶走它們，你現在必須要去翡翠城找歐茲法師幫忙，只要沿著這條黃磚路走你就能通往翡翠城。' },
            { sender: 'badwitch', message: '我們走著瞧！' },
            { sender: 'narration', message: '在蠻之金國土中，桃樂絲決定去翡翠城尋求歐茲法師的幫助。沿著黃磚路，桃樂絲來到一片金黃色的稻田，遇到了被綁住的稻草人。' },
            { sender: 'scarecrow', message: '你好，請幫幫我，我被困在這裡好久了。' },
            { sender: 'narration', message: '桃樂絲爬進藍色柵欄，幫稻草人解開了繩子，並詢問稻草人是否願意跟她一起尋找歐茲法師。' },
            { sender: 'scarecrow', message: '謝謝你！我願意陪你一起去找歐茲法師。' },
            { sender: 'tls', message: '太好了，有你陪我，我會安心很多。' }
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
            switch (sender) {
                case 'tls':
                    iconElement.style.backgroundImage = 'url("/images/drama/tls.svg")';
                    break;
                case 'scarecrow':
                    iconElement.style.backgroundImage = 'url("/images/drama/scarecrow.svg")';
                    break;
                case 'narration':
                    iconElement.style.backgroundImage = 'url("/images/drama/narration.svg")';
                    break;
                case 'badwitch':
                    iconElement.style.backgroundImage = 'url("/images/drama/badwitch.svg")';
                    break;
                case 'goodwitch':
                    iconElement.style.backgroundImage = 'url("/images/drama/goodwitch.svg")';
                    break;
            }

            chatElement.appendChild(iconElement);
            chatElement.appendChild(messageElement);
            chatLog.appendChild(chatElement);
            
            // 確保頁面滾動到最新消息
            setTimeout(() => {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            });
        }

        // 初始化顯示第一句對話
        displayNextMessage();
    </script>
</body>

</html>
