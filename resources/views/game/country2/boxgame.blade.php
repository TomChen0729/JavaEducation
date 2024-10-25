<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>boxgame</title>
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
            background-color: #F5DEB3;
        }

        .first .overlay {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
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
            z-index: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .first .pop {
            color: #f3bb66;
            margin: 30px;
            padding: 30px;
            height: 100%;
            border-radius: 50px;
            border: 5px solid #e28639;
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
            padding: 20px 2% 0px;
            background: rgba(121, 87, 87, 0.8);
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
            color: #3B3030;
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
            margin-top: 2%;
            padding-left: 2%;
            padding-right: 2%;
        }


        .question {
            width: 100%;
            height: auto;
            background: #fff;
            font-size: 20px;
            line-height: 30px;
            font-weight: bold;
            color: #8B4513;
            padding: 40px;
            box-shadow: inset #5D4037 0 0 0 5px,
                inset #6D4C41 0 0 0 1px,
                inset #795548 0 0 0 10px,
                inset #8D6E63 0 0 0 11px,
                inset #A1887F 0 0 0 16px,
                inset #BCAAA4 0 0 0 17px,
                inset #D7CCC8 0 0 0 21px,
                inset #EDE0D4 0 0 0 22px;
        }

        .question p {
            font-size: 25px;
            font-weight: bold;
        }

        .boxbg {
            position: relative;
            width: 100%;
            height: 100%;
            background-image: url('/images/boxes/boxbg.svg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-top: 3%;
        }

        #treasure-box {
            position: absolute;
            left: 15%;
            top: 35%;
            margin-top: 10px;
            width: 65%;
            height: 65%;
            background: url('/images/boxes/closebox1.svg') no-repeat center;
            transition: background 0.5s;
        }

        /* .star{
            white-space: pre; 
            font-family: monospace; 
            font-size: 20px;
            position: relative;
            top: 45%;
            left: 43%;
        }

        .star.open{
            text-shadow: 0 0 0.2em white, 0 0 0.2em white, 0 0 0.2em white;
            top: 48%;
            left: 40%;
        } */

        #triangle {
            position: absolute;
            left: 11%;
            top: 32%;
            width: 30%;
            height: auto;
            margin-top: 15%;
            margin-left: 20%;
        }

        #treasure-box.open {
            position: absolute;
            left: 30%;
            top: 35%;
            background: url('/images/boxes/openbox1.svg') no-repeat center;
            width: 40%;
            height: auto;
            background-size: contain;
        }

        .textarea-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .code-container {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            padding: 0px 0px 0px 40px;
        }

        pre {
            font-size: 1.25em;
        }

        input {
            width: 80px;
            text-align: center;
            transition: width 0.2s ease;
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

        @media (max-width: 1200px) {
            .container-fluid {
                padding-left: 1%;
                padding-right: 1%;
            }

            .question {
                padding: 20px;
                font-size: 18px;
            }

            .navbar a {
                font-size: 18px;
            }

            #treasure-box {
                width: 80%;
                height: auto;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar {
                margin-top: 10px;
            }

            .btn-container {
                flex-direction: column;
                align-items: center;
            }

            .boxbg {
                margin-top: 10%;
            }

            .first .pop {
                width: 90%;
            }

            input {
                width: 60px;
            }
        }

        @media (max-width: 480px) {
            .question p {
                font-size: 18px;
            }

            .close-btn {
                width: 25px;
                height: 25px;
                font-size: 20px;
            }

            .navbar a {
                font-size: 16px;
            }

            .navbar .time {
                font-size: 16px;
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
                <p><strong>{{ $boxGameQuestion -> gamename }}</strong><br>
                    <hr>
                </p>
                <p>
                    {{ $boxGameQuestion -> pre_story }}
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
                    <a href="{{ route('country.index', ['country_id' => $boxGameQuestion->country_id]) }}" class="breadcrumbs__link">遊戲種類</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link__active">解鎖寶箱</a>
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
                <div class="question">
                    <p>{{ $boxGameQuestion -> game_explanation }}</p>
                </div>
                <div class="boxbg">
                    <div id="treasure-box"></div>
                    <!-- <img class="img" id="randomImg" src="/images/boxes/triangle.png" alt=""> -->
                    <img id="triangle" src="/images/boxes/arrange3.svg" alt="">
                </div>
                <button onclick="openBox()">打開寶箱</button>
            </div>
            <div class="col-md-6 right-container">
                <div class="code-container">
                    <pre>
{!! $templateCode !!}
</pre>
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
        var shape = parseInt('{{ $boxGameQuestion -> id }}');
        var n = parseInt('{{ $variable }}');
        console.log('parameterID:' + shape);
        console.log('variable:' + n);


        // 倒序排列 arrange
        function triangle1(n) {
            const img = document.getElementById('triangle');
            switch (n) {
                case 3:
                    img.src = '/images/boxes/arrange3.svg';
                    break;
                case 5:
                    img.src = '/images/boxes/arrange5.svg';
                    break;
                case 7:
                    img.src = '/images/boxes/arrange7.svg';
                    break;
                default:
                    break;
            }
        }

        // 正序排列 sort
        function triangle2(n) {
            const img = document.getElementById('triangle');
            switch (n) {
                case 3:
                    img.src = '/images/boxes/sort3.svg';
                    break;
                case 5:
                    img.src = '/images/boxes/sort5.svg';
                    break;
                case 7:
                    img.src = '/images/boxes/sort7.svg';
                    break;
                default:
                    break;
            }
        }

        // 金字塔 pyramid
        function triangle3(n) {
            const img = document.getElementById('triangle');
            switch (n) {
                case 3:
                    img.src = '/images/boxes/pyramid3.svg';
                    break;
                case 5:
                    img.src = '/images/boxes/pyramid5.svg';
                    break;
                case 7:
                    img.src = '/images/boxes/pyramid7.svg';
                    break;
                default:
                    break;
            }
        }

        // 倒金字塔 inverted
        function triangle4(n) {
            const img = document.getElementById('triangle');
            switch (n) {
                case 3:
                    img.src = '/images/boxes/inverted3.svg';
                    break;
                case 5:
                    img.src = '/images/boxes/inverted5.svg';
                    break;
                case 7:
                    img.src = '/images/boxes/inverted7.svg';
                    break;
                default:
                    break;
            }
        }

        // 呼叫目前題目，判斷三角形種類，呼叫triangle1~4
        document.addEventListener('DOMContentLoaded', function() {
            switch (shape) {
                case 2:
                    triangle1(n);
                    break;
                case 3:
                    triangle2(n);
                    break;
                case 4:
                    triangle3(n);
                    break;
                case 5:
                    triangle4(n);
                    break;
                default:
                    break;
            }
        });

        // 點擊送出按鈕時讀取六個input中的值，並存放置陣列中
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
                        parameter_id: shape,
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

        // 開啟寶箱動畫
        function openBox() {
            const box = document.getElementById("treasure-box");
            box.classList.add("open");

            const img = document.getElementById("triangle");
            const light = img.src;
            // 用正規表達式，找出檔名位置
            // var fileNameRegex = /\/images\/boxes\/(.+)\.svg/;
            // 用split分割成陣列，再用pop取出陣列中最後的元素，將.svg替換成空字串
            var fileName = light.split('/').pop().replace('.svg', '');
            if (fileName) {
                // 檔名加入light
                var newFileName = 'light' + fileName;
                // 更新圖片連結
                img.src = '/images/boxes/' + newFileName + '.svg';
            } else {
                console.log('無法解析圖片檔名');
            }

            // const stars = document.getElementById("star");
            // stars.classList.add("open");

            // const imgElement = document.getElementById("randomImg");
            // imgElement.style.display = 'none';
        }

        function autoResize(input) {
            const newWidth = input.scrollWidth;
            const minWidth = 80;

            // 字數0時回到最小寬度
            if (input.value === "") {
                input.style.width = minWidth + 'px';
            } else {
                // 隨著字數增加寬度不小於 minWidth
                input.style.width = (Math.max(newWidth, minWidth) + 10) + 'px';
            }
        }
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