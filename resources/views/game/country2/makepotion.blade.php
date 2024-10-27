<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>調配藥水</title>
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
            height: 100%;

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
            background: rgba(255, 193, 7, 0.8);
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
            color: #3F3E3B;
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
            height: 100vh;
        }

        .row {
            height: 100%;
        }

        .left-container {
            background-color: #BFBDA0;
        }

        .question {
            width: 100%;
            height: auto;
            border-radius: 20px;
            padding: 20px;
            text-align: left;
            margin-top: 13%;
            margin-bottom: -10%;
            transition: max-height 0.3s ease;
        }

        .question h5 {
            font-weight: bold;
            color: white;
            font-size: 24px;
        }

        .team {
            padding: 2em 0 2em 2.5em;
            margin: 0;
            margin-top: -5%;
        }

        .member {
            width: 100%;
            margin: 1.5em 0 0.5em;
            padding: 0.73em;
            background: linear-gradient(83deg,
                    var(--yellow) 0 97%,
                    #fff0 calc(97% + 1px) 100%);
            position: relative;
            list-style: none;
            display: inline-block;
            transform: scale(0.85);
            transform: scale(1);
            filter: drop-shadow(0px 20px 10px #0008);
        }

        .thumb {
            width: 13vmin;
            height: 13vmin;
            float: left;
            margin-right: 1.25em;
            background: linear-gradient(var(--deg),
                    var(--dark) 0 70%,
                    var(--yellow) 0% 100%);
            transform: rotate(-4deg);
            border-radius: 0.25em;
            overflow: hidden;
            margin-left: -3em;
            padding: 0.5em;
            padding: 0.1em;
            transform: rotate(-1deg);
            --deg: -89deg;
        }

        .thumb img {
            width: 100%;
            height: 100%;
            border-radius: 0.25em;
            filter: grayscale(1);
            background: var(--dark);
            filter: none;
        }

        .description h3 {
            font-weight: bold;
        }

        .description p {
            font-size: 20px;
            padding: 0 2em;
            margin-bottom: 1em;
        }

        .container-code {
            width: 94%;
            background-color: #f4f4f4;
            border-radius: 8px;
            margin-left: 3%;
            margin-top: 8%;
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

        .btn-container {
            position: absolute;
            right: 60px;
            bottom: 40px;
        }

        .btn-submit {
            background-color: red;
            width: 80px;
            height: 35px;
            border: none;
            color: white;
            border-radius: 5px;

        }

        .right-container {
            background-color: #5F5F5F;
            display: flex;
            justify-content: center;
            align-items: center;
            height: auto;
            background-image: url('/images/potion/potionbg.svg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        #img-container {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #img-container #pot {
            position: relative;
            margin-top: 50%;
            margin-left: 25%;
            width: 500px;
            height: auto;
        }

        #img-container #stick {
            top: 46%;
            right: 20%;
            position: absolute;
            width: 300px;
            height: auto;
            animation: animate 6s linear infinite normal;
        }

        @keyframes animate {
            0% {
                transform: translate(20%, -5%);
                /* 開始於圓形的右邊 */
            }

            25% {
                transform: translate(0, 0);
                /* 圓形的下方 */
            }

            50% {
                transform: translate(-40%, -5%);
                /* 圓形的左邊 */
            }

            75% {
                transform: translate(0, -10%);
                /* 圓形的上方 */
            }

            100% {
                transform: translate(20%, -5%);
                /* 回到右邊 */
            }
        }

        #img-container #heal {
            top: 55%;
            right: 30%;
            opacity: 0;
            /* top從-100px => 50px，opacity透明(0) => 不透明(1)，動畫持續2秒，速度曲線 => ease-in-out */
            transition: top 2s ease-in-out, opacity 3s ease-in-out;
            height: 15%;
            position: absolute;
            z-index: 10;
            /*最上層*/
        }

        #img-container #heal.show {
            top: 25%;
            opacity: 1;
        }

        @media (max-width: 768px) {
            .code-container {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            img {
                width: 100%;
                height: auto;
            }

            #img-container #pot {
                width: 80%;
            }

            #img-container #stick {
                width: 200px;
                top: 30%;
                right: 2%;
            }
        }

        @media (min-width: 769px) and (max-width: 1440px) {
            .code-container {
                margin-left: 60%;
                width: 30%;
            }

            #img-container #pot {
                width: 80%;
                left: 5%;
            }

            #img-container #stick {
                width: 250px;
                top:42%;
                right: 11%;
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
                <p><strong>{{ $makepotionQuestion -> gamename }}</strong><br>
                    <hr>
                </p>
                <p>
                    {{ $makepotionQuestion -> pre_story }}
                </p>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="row">
            <ul class="col-ms-8 breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="{{ route('welcome') }}" class="breadcrumbs__link">綠野仙蹤</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="{{ route('country.index', ['country_id' => $makepotionQuestion->country_id]) }}" class="breadcrumbs__link">遊戲種類</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link__active">調配藥水</a>
                </li>
            </ul>

            <ul class="col-ms-6 navbar">
                <li><a href="#" onclick="togglePopup2()"> 知識卡</a></li>
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
            <div class="col-md-6 left-container">
                <div class="question" id="question">
                    <h5> {{ $makepotionQuestion -> game_explanation }}</h5>
                    <ul class="team">
                        <li class="member co-funder">
                            <div class="thumb"><img src="/images/potion/heal.svg"></div>
                            <div class="description">
                                <h3>配方表</h3>
                                <p>{{ $formula }}</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="container-code" id="code">
                    <pre>
{!! $templateCode !!}
</pre>
                    <div class="btn-container">
                        <button id="send-code" class="btn-submit">提交</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6 right-container">
                <div id="img-container">
                    <img id="pot" src="/images/potion/pot.svg" alt="pot">
                    <img id="stick" src="/images/potion/stick.svg" alt="stick">
                    <img class="img" id="heal" src="/images/potion/heal.svg" alt="">
                </div>
                <button onclick="play()">測試動畫</button>
            </div>
        </div>
    </div>
    </div>


    <!-- JavaScript -->
    <script>
        var parameter_id = parseInt('{{ $makepotionQuestion->id }}');
        console.log('parameterID:' + parameter_id);
        // 畫面載入後顯示彈跳視窗
        function togglePopup1() {
            document.getElementById("popup").classList.toggle("active");
        }

        // 產出治癒藥水動畫
        function play() {
            const healElement = document.getElementById('heal');

            // 開始動畫
            healElement.classList.add('show');
        }

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
                        alert('答對');
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