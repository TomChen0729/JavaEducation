<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>塔中尋油</title>
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
            list-style: none;
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
            padding-top: 3%;
            height:100%;
            background-color: #D7C0AE;
        }

        .first .overlay {
            position: fixed;
            top: 0;
            left: 0;
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
            background: #323232;
            border-radius: 50px;
            width: 50%;
            z-index: 10;
            padding: 20px;
        }

        .first .pop {
            color: #f3bb66;
            margin: 30px;
            padding: 30px;
            border-radius: 50px;
            border: 5px solid #e28639;
        }

        .first .pop h1 {
            text-align: center;
            font-size: 50px;
            font-weight: bolder;
            margin-bottom: 30px;
        }

        .first .pop p {
            font-size: 20px;
        }

        .first .pop p strong {
            font-size: 24px;
        }

        .first .pop p hr {
            margin: 10px 0;
        }

        .first .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #e28639;
            color: #323232;
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
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 2% 0;
            background: rgb(150, 126, 118, 0.8);
            transition: all 0.5s ease;
        }

        .breadcrumbs {
            letter-spacing: 5px;
            font-size: 24px;
            font-family: sans-serif;
        }

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
            color: #3B3030;
            font-weight: bold;
        }

        .navbar {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .navbar .time {
            display: none;
            color: #fff;
            font-size: 20px;
            font-weight: bolder;
            letter-spacing: 5px;
            padding: 5px 15px;
            margin: 0 30px;
            transition: all 0.5s ease;
        }

        .navbar a {
            color: #fff;
            font-size: 20px;
            font-weight: bolder;
            text-align: center;
            border: 2px solid #fff;
            border-radius: 5px;
            padding: 5px 15px;
            margin: 0 30px;
            transition: all 0.5s ease;
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
            margin: 0 25px 0 10px;
            color: var(--text-color);
            font-size: 20px;
            font-weight: 500;
            transition: all 0.5s ease;
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
            overflow: visible;
            margin-top: -3%;
            position: relative;
            transition: transform 0.5s ease-in-out;
            z-index: 1;
            height: auto;
        }

        .left-container {
            margin-top: 5%;
        }

        .right-container {
            margin-top: 5%;
        }

        .row {
            height: 100%;
        }

        .question {
            margin-top: 6%;
            display: flex;
            justify-content: center;
            margin-bottom: -3%;
        }

        .question-box {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1%;
            width: 90%;
            height: auto;
            background: repeating-linear-gradient(45deg,
                    #D8BFD8,
                    #D8BFD8 10px,
                    #ffffff 10px,
                    #ffffff 20px);
        }

        .question-p {
            background-color: white;
            padding: 1%;
        }

        .question p {
            font-size: 20px;
            font-weight: bold;
        }

        .img-container {
            position: relative;
            margin-left: 3%;
            width: auto;
            height: 70%;
            background-image: url('/images/oil/oilbg.svg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .health {
            position: absolute;
            left: 20%;
            margin: 0px;
            padding: 0px;
            width: 100%;
            height: 100vh;
        }

        .health-container {
            width: 450px;
            height: 90px;
            overflow: hidden;
            position: relative;
        }

        .health-container::before {
            position: absolute;
            content: "";
            background-color: #007995;
            width: 10px;
            height: 40px;
            left: 0px;
            z-index: 10;
        }

        .health-container .health-bar {
            position: absolute;
            left: -20px;
            width: 350px;
            height: 45px;
            background-color: #b4e4ef;
            border: 10px solid #007995;
            transform: skewX(25deg);
        }

        .health-container .health-bar .health-percentage {
            position: absolute;
            height: 25px;
            background: #c0054c;
        }

        .health-container .health-bar .health-percentage.health-2 {
            width: 20%;
        }

        .health-container .health-status {
            display: flex;
            padding: 0px 10px;
            justify-content: flex-end;
            align-items: center;
            height: 30px;
            position: absolute;
            top: 35px;
            left: -20px;
            background: #007995;
            transform: skewX(-25deg);
        }

        .health-container .health-status span {
            margin-left: 20px;
            color: #b4e4ef;
            font-weight: bold;
            font-size: 18px;
            transform: skewX(25deg);
        }

        .man {
            position: absolute;
            width: 20%;
            height: auto;
            background-color: #b4e4ef;
            border: 2px solid #007995;
        }

        #oil {
            position: relative;
            top: 60%;
            left: 30%;
            width: 100%;
            height: 30%;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        @keyframes animate {
            0% {
                top: 60%;
                left: 30%;
            }

            100% {
                top: 20%;
                left: -20%;
                width: 100%;
                height: 80%;
            }
        }

        #oil.show {
            animation: animate 1s ease-in-out forwards;
            /* 使用 forwards 確保動畫結束後保持最後狀態 */
            opacity: 1;
        }

        .container-code {
            overflow-y: scroll;
            height: 70%;
            width: 94%;
            background-color: #f4f4f4;
            border-radius: 8px;
            margin-left: 3%;
            padding: 0px 0px 0px 40px;
            overflow-x: auto;

        }

        pre {
            font-size: 1.25em;
            display: inline-block;
            white-space: pre;
            margin: 0;
            padding: 10px;
        }

        input {
            width: 80px;
            text-align: center;
            transition: width 0.2s ease;
        }

        .btn-container {
            position: absolute;
            right: 40px;
            top: 75%;
        }

        .btn-submit {
            background-color: red;
            width: 80px;
            height: 35px;
            border: none;
            color: white;
            border-radius: 5px;

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

        @media (max-width: 768px) {
            body {
                padding-top: 10%;
                flex-direction: column;
            }

            .first .content {
                width: 90%;
                padding: 15px;
            }

            .navbar a {
                font-size: 16px;
                padding: 5px 10px;
                margin: 0 10px;
            }

            .question-box {
                width: 100%;
                padding: 2%;
            }

            .health-container {
                width: 100%;
                height: auto;
            }

            .man {
                width: 40%;
            }

            .img-container {
                margin-left: 0;
                width: 100%;
                height: auto;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            body {
                padding-top: 5%;
            }

            .first .content {
                width: 70%;
            }

            .navbar a {
                font-size: 18px;
                padding: 5px 12px;
                margin: 0 20px;
            }

            .question-box {
                width: 95%;
                padding: 1.5%;
            }

            .health-container {
                width: 80%;
            }

            .man {
                width: 30%;
            }

            .img-container {
                margin-left: 2%;
                width: 80%;
            }
        }

        @media (min-width: 1025px) {
            body {
                padding-top: 3%;
            }

            .first .content {
                width: 50%;
            }

            .navbar a {
                font-size: 20px;
                padding: 5px 15px;
                margin: 0 30px;
            }

            .question-box {
                width: 90%;
                padding: 1%;
            }

            .health-container {
                width: 450px;
            }

            .man {
                width: 20%;
            }

            .img-container {
                margin-left: 3%;
                width: auto;
                height: 70%;
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
                <p><strong>{{ $oilQuestion -> gamename }}</strong><br>
                    <hr>
                </p>
                <p>
                    {{ $oilQuestion -> pre_story }}
                </p>
            </div>
        </div>
    </div>

    <div id="success-popup" class="popup hide">
        <div class="close-btn" onclick="togglePopup2()">&times;</div>
        <div class="popup-content">
            <p>答題成功！</p>
            <div class="card"></div>
            <button><a href="{{ route('country.index', ['country_id' => $oilQuestion->country_id]) }}">選擇遊戲關卡</a></button>
        </div>
    </div>

    <div class="header">
        <div class="row">
            <ul class="col-ms-8 breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="{{ route('welcome') }}" class="breadcrumbs__link">綠野仙蹤</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="{{ route('country.index', ['country_id' => $oilQuestion->country_id]) }}" class="breadcrumbs__link">遊戲種類</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link__active">塔中尋油</a>
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
        <div class="question">
            <div class="question-box">
                <div class="question-p">
                    <p>{{ $oilQuestion -> game_explanation }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 left-container" id="left-container">
                <div class="img-container" id="img-container">
                    <img class="man" id="man" src="/images/oil/sadman.svg" alt="man">
                    <div class="health">
                        <div class="health-container">
                            <div class="health-bar" id="healthBar">
                                <div class="health-percentage health-2"></div>
                            </div>
                            <div class="health-status"> <span id="healthStatus">HP: 20%</span></div>
                        </div>
                    </div>
                    <img id="oil" src="/images/oil/oil.svg" alt="oil">
                </div>
                <!-- <button onclick="play()">測試動畫</button> -->
            </div>

            <div class="col-md-6 right-container" id="right-container">
                <div class="container-code" id="code">
                    
{!! $templateCode !!}

                    <div class="btn-container">
                        <button id="send-code" class="btn-submit">提交</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- JavaScript -->
    <script>
        var parameter_id = parseInt('{{ $oilQuestion->id }}');
        console.log('parameter_id:' + parameter_id);
        // 畫面載入後顯示彈跳視窗
        function togglePopup1() {
            document.getElementById("popup").classList.toggle("active");
        }

        // 關閉彈窗
        function togglePopup2() {
            document.getElementById("success-popup").classList.toggle("jump");
        }

        // 動畫
        // function play() {
        //     // 假設血量恢復至 100%
        //     const healthPercentage = 100;
        //     const healthBar = document.querySelector('.health-percentage');
        //     const healthStatus = document.getElementById('healthStatus');

        //     // 更新血條的寬度
        //     healthBar.style.width = `${healthPercentage}%`;
        //     // 更新血條顏色為綠色
        //     healthBar.style.backgroundColor = '#4CAF50';
        //     // 更新血量狀態文字
        //     healthStatus.textContent = `HP: ${healthPercentage}%`;

        //     // 換臉
        //     const man = document.getElementById('man');
        //     man.src = '/images/oil/happyman.svg';

        //     // 油罐飛出
        //     const oilElement = document.getElementById('oil');
        //     oilElement.classList.add('show');
        // }


        //input格子縮放
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
                        // 假設血量恢復至 100%
                        const healthPercentage = 100;
                        const healthBar = document.querySelector('.health-percentage');
                        const healthStatus = document.getElementById('healthStatus');

                        // 更新血條的寬度
                        healthBar.style.width = `${healthPercentage}%`;
                        // 更新血條顏色為綠色
                        healthBar.style.backgroundColor = '#4CAF50';
                        // 更新血量狀態文字
                        healthStatus.textContent = `HP: ${healthPercentage}%`;
                        // 5秒動畫
                        healthBar.style.transition = 'width 2s ease, background-color 2s ease';

                        // 換臉
                        const man = document.getElementById('man');
                        setTimeout(() => {
                            man.src = '/images/oil/happyman.svg';
                        }, 2000);

                        // 油罐飛出
                        const oilElement = document.getElementById('oil');
                        oilElement.classList.add('show');

                        const popup = document.getElementById('success-popup');
                        // 延遲出現答題成功彈窗
                        setTimeout(() => {
                            popup.classList.add('jump');  // 顯示彈窗
                            const getcard = popup.querySelector('.card');
                            console.log(getcard);
                            console.log("您獲得" + data.getCard + "知識卡");
                            if(data.getCard){
                                getcard.textContent = "您獲得" + data.getCard + "知識卡";
                            }else{
                                getcard.textContent = '';
                            }    
                        }, 2000); 
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
    </script>
</body>

</html>