<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>魔法門衛</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/base16-dark.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/clike/clike.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
            /* 底線去除 */
            list-style: none;
            /* 去除清單前面的符號 */
        }

        a:hover {
            color: white;
            text-decoration: none;
        }

        :root {
            --bg-color: #222327;
            --text-color: #333333;
            --main-color: #6875F5;
        }

        body {
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 6%;
            background-color: #C4DAD2;
        }

        .first .overlay {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 10;
            display: none;
        }

        .first .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: #644a47;
            border-radius: 50px;
            width: 50%;
            z-index: 10;
            padding: 20px;
            box-sizing: border-box;
        }

        .first .pop {
            color: #fceede;
            margin: 30px;
            padding: 30px;
            height: 100%;
            border-radius: 50px;
            border: 5px solid #9bbec1;
        }

        .first .pop h1 {
            text-align: center;
            font-size: 50px;
            font-weight: bolder;
            margin-bottom: 30px;
        }

        .first .pop p strong {
            font-size: 24px;
        }

        .first .pop p hr {
            margin: 10px 0;
        }

        .first p {
            font-size: 20px;
        }

        .first .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #9bbec1;
            color: #644a47;
            font-size: 25px;
            font-weight: 600;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
        }

        .first.active .overlay {
            display: block;
        }

        .first.active .content {
            transition: all 300ms ease-in-out;
            transform: translate(-50%, -50%) scale(1);
        }

        .header {
            position: absolute;
            width: 100%;
            height:9%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 2% 0px;
            background: rgba(106, 156, 137, 0.8);
            /* 透明背景 */
            transition: all 0.50s ease;
        }

        .breadcrumbs {
            letter-spacing: 5px;
            /* 字元間距 */
            font-size: 24px;
            font-family: sans-serif;
        }

        /*@keyframes animate {
            from {
                transform: translateX(0); 起始位置
            }
            to {
                transform: translateX(50px); 結束位置
            }
        }*/

        .breadcrumbs__item {
            display: inline-block;
        }

        .breadcrumbs__item:not(:last-of-type)::after {
            content: '\203a';
            margin: 0 5px;
            color: #fff;
        }

        .breadcrumbs__link {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .breadcrumbs__link:hover {
            text-decoration: underline;
        }

        .breadcrumbs__link__active {
            text-decoration: none;
            color: #16423C;
            font-weight: bold;
        }

        .navbar {
            display: flex;
            align-items: center;
            /* 確保垂直方向對齊 */
            margin-left: auto;
            /* 讓 navbar 靠右對齊 */
        }

        .navbar .time {
            display: none;
            color: #fff;
            font-size: 20px;
            font-weight: bolder;
            letter-spacing: 5px;
            padding: 5px 15px;
            margin: 0px 30px;
            transition: all 0.50s ease;
        }

        .navbar a {
            color: #fff;
            font-size: 20px;
            font-weight: bolder;
            text-align: center;
            border: 2px solid #fff;
            border-radius: 5px;
            padding: 5px 15px;
            margin: 0px 30px;
            transition: all 0.50s ease;
        }

        .navbar a:hover {
            color: #999999;
            border: 2px solid #999999;
            background: #fff;
        }

        .main {
            display: flex;
            align-items: center;
        }

        .main a {
            margin-right: 25px;
            margin-left: 10px;
            color: var(--text-color);
            font-size: 20px;
            font-weight: 500;
            transition: all 0.50s ease;
        }

        .user {
            display: flex;
            align-items: center;
        }

        .main a:hover {
            color: var(--main-color);
        }

        #menu-icon {
            font-size: 35px;
            color: #fff;
            cursor: pointer;
            z-index: 10001;
            display: none;
        }

        .container-fluid {
            width: 100%;
            height: 100vh;
        }

        .question {
            margin-left: 10%;
            width: 80%;
            height: auto;
            background-color: #80d5a6;
            border: 5px dashed mediumseagreen;
            padding: 25px;
            box-shadow: 0 0 0 2.5px #226741, 0 0 0 12.5px #fff, inset 0 0 0 2.5px #226741, 0 5px 10px 15px rgba(0, 0, 0, 0.5), inset 0 0 0 6px #fff, inset 0 0 100vw 100vw beige;
            color: #006B3C;
            text-shadow: 0 2px #fff;
            text-align: left;
        }

        .question p {
            font-size: 20px;
            font-weight: bold;
        }

        .seal {
            top: -100px;
            /* 蓋章動畫起始位置在畫面上方 */
            opacity: 0;
            /* top從-100px => 50px，opacity透明(0) => 不透明(1)，動畫持續0.5秒，速度曲線 => ease-in-out */
            transition: top 0.5s ease-in-out, opacity 0.5s ease-in-out;
            width: 100%;
            height: 250px;
            position: absolute;
            z-index: 10;
            /*最上層*/
        }

        .seal.show {
            top: 10px;
            /* 蓋章飛入後的位置 */
            opacity: 1;
        }

        .message {
            top: 30%;
            left: 25%;
            opacity: 0;
            position: absolute;
            padding: 20px;
            background-color: white;
            border: 3px solid green;
            border-radius: 10px;
            font-size: 100px;
            font-weight: bold;
            z-index: 8;
            transform: rotate(-10deg);
        }

        .message.open {
            opacity: 1;
        }

        .card-container{
            margin-right: -5%; /* 調整間距 */
        }

        #idcard {
            display: flex;
            justify-content: left;
            align-items: left;
            max-width: 600px;
            width: 80%;
        }

        .idcardbg {
            padding-left:2%;
            padding-top:7%;
            background-image: url('/images/idcard/idcardbg.svg');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .card {
            margin-top:10%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: auto;
            padding: 15px;
            border: 1px solid blue;
            border-radius: 20px;
            background-color: #8bc8ff;
            min-width:250px;
        }

        .card img {
            object-fit: cover;
            padding: 0;
            margin: 0;
            border: 1px solid gray;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .card h1 {
            padding: 5px;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            background-color: #999999;
            border: 1px solid gray;
        }

        .card p {
            margin: 2px 0;
            padding: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .code-container {
            margin-left: 5%;
            background-color: #f4f4f4;
            border-radius: 8px;
            width: 90%;
            height: auto;
            padding: 0px 0px 0px 40px;
        }

        pre {
            font-size: 20px;
        }

        input {
            width: 80px;
            text-align: center;
            transition: width 0.2s ease;
        }

        .btn-submit {
            background-color: red;
            width: 80px;
            height: 35px;
            border: none;
            color: white;
            border-radius: 5px;

        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-container button {
            font-size: 18px;
            margin: 0 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            max-width: 90%;
            font-size: 30px;
            font-weight: bold;
            border-radius: 15px;
            color: #556989;
            background-color: #f8ede3;
            border: 2px solid #2f2f2f;
            padding: 20px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: none; /* 初始隱藏 */
            text-align: center;
        }

        .popup.jump {
            display: block;
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .popup .popup-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .popup .close-btn {
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
            width: 30px;
            height: 30px;
            background-color: #D38E43;
            color: #F8F0DC;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            line-height: 30px;
            border-radius: 50%;
            transition: background-color 0.3s;
        }

        .popup .close-btn:hover {
            background-color: #c2793c;
        }

        .popup .popup-content button {
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .popup .popup-content a {
            color: #000;
        }

        .popup .popup-content a:hover {
            color: #fff;
        }

        .popup .popup-content button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px)and (max-width: 1024px) {
            .card {
                flex: 1 1 45%;

            }
        }

        @media (max-width: 480px) {
            .card {
                flex: 1 1 100%;
            }
        }
    </style>
</head>

<body>
    <!-- 彈窗 -->
    <!-- 遊戲說明 -->
    <div class="first active" id="popup">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup1()">&times;</div>
            <div class="pop">
                <h1>遊戲說明</h1>
                <p><strong>{{ $idCardGameQuestion -> gamename }}</strong><br>
                    <hr>
                </p>
                <p>
                    {{ $idCardGameQuestion->pre_story }}
                </p>
            </div>
        </div>
    </div>

    <div id="success-popup" class="popup hide">
        <div class="close-btn" onclick="togglePopup2()">&times;</div>
        <div class="popup-content">
            <p>答題成功！</p>
            <div class="cardd"></div>
            <button><a href="{{ route('country.index', ['country_id' => $idCardGameQuestion->country_id]) }}">選擇遊戲關卡</a></button>
        </div>
    </div>

    <div class="header">
        <div class="row">
            <ul class="col-ms-8 breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="{{ route('welcome') }}" class="breadcrumbs__link">綠野仙蹤</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="{{ route('country.index', ['country_id' => $idCardGameQuestion->country_id]) }}" class="breadcrumbs__link">遊戲種類</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link__active">魔法門衛</a>
                </li>
            </ul>

            <ul class="col-ms-6 navbar">
                <li><a href="#" onclick="history.back()"> 回上一頁</a></li>
                <li class="time" id="timer">00:00:00</li>
            </ul>

            <div class="main">
                <div class="bx bx-menu" id="menu-icon"></div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- 左側容器 -->
            <div class="col-md-6 left-container">
                <div class="box">
                    <div class="question">
                        <p>{{ $idCardGameQuestion -> game_explanation }}</p>
                    </div>
                </div>

                <!-- 身分證卡片區域 -->
                <div class="idcardbg">
                    <div class="row">
                        @foreach($idCardsData as $item)
                        <div class="col-md-4 card-container">
                            <div class="card" id="idcard">
                                <img class="seal" id="seal-{{ $loop->index }}" src="/images/idcard/idcardseal.svg" alt="">
                                <div class="message" id="message-{{ $loop->index }}"></div> <!-- 動畫顯示文字 -->
                                <div class="row">
                                    <div class="col-md-6 left-container" id="idcards">
                                        <img id="idcard-img-{{ $loop->index }}" src="" alt="證件照">
                                    </div>
                                    <div class="col-md-6 left-container">
                                        <h1>身分證</h1>
                                        <p>身分：{{ $item['identity'] }}</p>
                                        <p>年齡：{{ $item['age'] }}</p>
                                        <p>性別：{{ $item['gender'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- 右側容器 -->
            <div class="col-md-6 right-container">
                <div class="code-container">
                    {!! $templateCode !!}
                </div>
                <div class="btn-container">
                    <button id="send-code" class="btn-submit">提交</button>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript -->
    <script>
        // 畫面載入後顯示彈跳視窗
        function togglePopup1() {
            document.getElementById("popup").classList.toggle("active");
        }

        // 關閉彈窗
        function togglePopup2() {
            document.getElementById("success-popup").classList.toggle("jump");
        }

        function autoResize(input) {
            const newWidth = input.scrollWidth;
            const minWidth = 80;

            // 字數0時回到最小寬度
            if (input.value === "") {
                input.style.width = minWidth + 'px';
            } else {
                // 隨著字數增加寬度不小於 minWidth
                input.style.width = Math.max(newWidth, minWidth) + 'px';
            }
        }
        var parameter_id = parseInt('{{ $idCardGameQuestion->id }}');
        // DOMContentLoaded事件在文件的HTML被完全載入和解析後觸發(不必等待樣式表、圖像和子框架的完成加載)
        document.addEventListener('DOMContentLoaded', function() {
            // 後端傳資料給前端
            var idCardsData = @json($idCardsData);
            console.log('parameter_id:' + parameter_id);
            console.log(idCardsData);

            // 遍歷，替換對應的圖片、文字、印章
            idCardsData.forEach(function(item, index) {
                const imgElement = document.getElementById(`idcard-img-${index}`); // 動態獲取每個卡片的 img 元素
                const messageElement = document.getElementById(`message-${index}`); // 動態獲取 message 元素
                const sealElement = document.getElementById(`seal-${index}`); // 動態獲取 seal
                let img = '';
                let messageData = {};

                // 根據性別和身分設置證件照
                if (item.gender === '女') {
                    switch (item.identity) {
                        case '商人':
                            img = '/images/idcard/businesswoman.svg';
                            break;
                        case '居民':
                            img = '/images/idcard/girlvillager.svg';
                            break;
                        case '怪物':
                            img = '/images/idcard/gmonster.svg';
                            break;
                        default:
                            img = '';
                    }
                } else {
                    switch (item.identity) {
                        case '商人':
                            img = '/images/idcard/businessman.svg';
                            break;
                        case '居民':
                            img = '/images/idcard/boyvillager.svg';
                            break;
                        case '怪物':
                            img = '/images/idcard/monster.svg';
                            break;
                        default:
                            img = '';
                    }
                }

                // 根據身分設置對應的 message
                if (item.identity === '怪物') {
                    messageData = {
                        text: '禁止進入',
                        color: 'red',
                        border: '5px solid red'
                    };
                } else {
                    messageData = {
                        text: '免費進入',
                        color: 'green',
                        border: '5px solid green'
                    };
                }

                // 更新圖片
                if (imgElement) {
                    imgElement.src = img;
                }

                // 更新 message
                if (messageElement) {
                    messageElement.textContent = messageData.text;
                    messageElement.style.color = messageData.color;
                    messageElement.style.border = messageData.border;
                }

                // 觸發蓋章動畫，答案正確放這個
                // playStamp(index);
            });
        });

        // 蓋章動畫，根據 index 觸發動畫
        function playStamp(index) {
            const sealElement = document.getElementById(`seal-${index}`);
            const messageElement = document.getElementById(`message-${index}`);

            // 如果找不到元素，直接返回
            if (!sealElement || !messageElement) {
                console.warn(`未找到印章或訊息元素，無法播放動畫 (seal-${index}, message-${index})`);
                return;
            }

            // 開始動畫
            sealElement.classList.add('show');

            // 完成動畫，新增文字，移除印章
            setTimeout(() => {
                messageElement.classList.add('open');
                sealElement.classList.remove('show');
            }, 500); // 預設動畫持續0.5秒
        }

        // 點擊送出按鈕時讀取input中的值，並存放置陣列中
        var submitBtn = document.getElementById('send-code');
        submitBtn.addEventListener('click', function() {
            let inputsArray = [];
            // 使用querySelectorAll選取所有type = "text"的input
            const inputs = document.querySelectorAll('input[type="text"]');
            let index = 0;
            let allFilled = true; // 用來檢查是否所有input都有填值
            // 迴圈遍歷每個input，將值加入陣列
            inputs.forEach(input => {
                index++;
                if (input.value.trim() === '') {
                    allFilled = false; // 如果有一個input的值是空的，將allFilled設為false
                }
                inputsArray.push({
                    order: index,
                    userAnswer: input.value
                });
                console.log('填寫的第' + index + '答案為' + input.value)
            });

            if (!allFilled) {
                alert('你還有空格未填入答案');
                return; // 如果有未填的答案，則不進入fetch
            }

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            userAnswer = inputsArray;
            console.log(userAnswer);
            url = '/api/checkUserAnswer';
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        userAnswer: userAnswer,
                        parameter_id: parameter_id,
                        currentUser: parseInt('{{ auth()->user()->id }}')
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message == 'correct') {
                        // 呼叫觸發蓋章動畫
                        const correctAnswerIndex = data.index; // 假設後端回傳了正確答案的 index
                        playStamp(correctAnswerIndex);  // 根據正確答案的 index 播放動畫

                        const popup = document.getElementById('success-popup');
                        // 延遲出現答題成功彈窗
                        setTimeout(() => {
                            popup.classList.add('jump');  // 顯示彈窗
                            const getcard = popup.querySelector('.cardd');
                            console.log(getcard);
                            console.log("您獲得" + data.getCard + "知識卡");
                            if(data.getCard){
                                getcard.textContent = "您獲得" + data.getCard + "知識卡";
                            }else{
                                getcard.textContent = '';
                            }    
                        }, 100); 
                    } else if (data.message == 'wrongAns') {
                        console.log(data.wrongIndex);
                    } else if (data.message == 'Null') {
                        alert('請填入答案');
                    } else {
                        alert('答錯');
                    }
                })

        });
        var userAnswersandOrder = <?php echo json_encode(!empty($userAnswers) ? $userAnswers : []); ?>;
        console.log('正確答案：', userAnswersandOrder);
        if (userAnswersandOrder.length > 0) {
            var userAnswers = userAnswersandOrder.map(function(answer) {
                return answer.userAnswer;
            });
            console.log(userAnswers);
            document.addEventListener('DOMContentLoaded', function() {
                // 尋找template_code的格子
                const inputs = document.querySelectorAll('input[type="text"]');
                //尋找提交的按鈕
                const submitButton = document.getElementById('send-code');
                //填入答案
                inputs.forEach((input, index) => {
                    if (userAnswers[index]) {
                        input.value = userAnswers[index];
                        autoResize(input);
                    }
                });
                // 有答案後隱藏按鈕
                if (userAnswers.length > 0) {
                    submitButton.style.display = 'none';
                }
            });
        }


        /*測試遮變數
        document.addEventListener('DOMContentLoaded', (event) => {
            let isCorrect = false; // 初始還沒答對

            // 監聽提交按鈕的點擊事件
            document.getElementById('send-code').addEventListener('click', function() {
                // 答題判斷，設置 isCorrect
                isCorrect = true;

                if (isCorrect) {
                    // 顯示隱藏的變數
                    const hiddenVariable = document.getElementById('hidden-variable');
                    hiddenVariable.style.display = 'inline'; // 使用 'inline' 對齊

                    // 移除括號
                    hiddenVariable.innerHTML = hiddenVariable.innerHTML.replace(/[{}]/g, '');
                }
            });
        });*/
    </script>
</body>

</html>