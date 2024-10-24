<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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
            /* background-image: url('/images/drama/country1/background/lv1.svg'); */
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

        .lion,
        .monster,
        .creeptree,
        .greendwarf,
        .tinman,
        .tls,
        .badwitch,
        .goodwitch,
        .narration,
        .scarecrow {
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

        .skip {
            font-size: 20px;
            font-weight: bold;
            border: 2px solid #fff;
            border-radius: 10px;
            padding: 2px;
            margin-left: 20px;
        }

        .skip a:hover {
            color: white;
        }
    </style>
</head>


<body>
    <p id='cid' style="display: none;">{{ $currentCountry }}</p>
    <div class="container" id="click-area">
        <div class="header">
            <h3>綠野仙蹤－{{ $countryName }}篇</h3>
        </div>

        <div class="chat-container" id="chat-container">
            <div id="chat-log"></div>
        </div>

        <div class="footer">
            <p>請點擊空白處</p>
            <div>
                <button class="skip"><a href="{{ route('country.index', ['country_id' => $currentCountry]) }}">跳過劇情</a></button>
            </div>
        </div>
    </div>

    <!--js-->
    <script>
        const chatLog = document.getElementById('chat-log'),
            clickArea = document.getElementById('click-area'),
            chatContainer = document.getElementById('chat-container');

        var dialogues = @json($dramas);
        const backgroundImageUrl = "{{ $backgroundImg }}";
        console.log(backgroundImageUrl);
        document.body.style.backgroundImage = `url('/images/drama/country{{ $currentCountry }}/background/${backgroundImageUrl}')`;
        console.log(dialogues);

        let currentDialogueIndex = 0;
        
        clickArea.addEventListener('click', displayNextMessage);

        function displayNextMessage() {
            if (currentDialogueIndex < dialogues.length) {
                const {
                    sender,
                    message
                } = dialogues[currentDialogueIndex];
                appendMessage(sender, message);
                currentDialogueIndex++;
            } else {
                window.location.href = `/country/{{ $currentCountry }}`; // 結束後跳轉過去country.index，這是他的路徑
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
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/tls.svg")';
                    break;
                case 'scarecrow':
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/scarecrow.svg")';
                    break;
                case 'narration':
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/narration.svg")';
                    break;
                case 'badwitch':
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/badwitch.svg")';
                    break;
                case 'goodwitch':
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/goodwitch.svg")';
                    break;
                case 'creeptree':
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/creeptree.svg")';
                    break;
                case 'greendwarf':
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/greendwarf.svg")';
                    break;
                case 'tinman':
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/tinman.svg")';
                    break;
                case 'lion':
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/lion.svg")';
                    break;
                case 'monster':
                    iconElement.style.backgroundImage = 'url("/images/drama/country{{ $currentCountry }}/role/monster.svg")';
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

        // function skipdrama(){
        //     window.location.href = `/country/${c_id}`;
        // }
    </script>
</body>

</html>