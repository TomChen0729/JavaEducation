<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>通關密碼</title>
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
            background-image: url('/images/password/doorbg.svg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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
            background: rgba(218, 131, 89, 0.8);
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
            color: #705C53;
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

        .containers {
            overflow: visible;
            margin-top: 2%;
            position: relative;
            transition: transform 0.5s ease-in-out;
            z-index: 1;
        }

        .left-container {
            position: absolute;
            width: 50%;
            height: 100%;
            top: 0;
            transition: transform 0.5s ease-in-out;
            left: 0;
        }

        .right-container {
            position: absolute;
            width: 50%;
            height: 100%;
            top: 0;
            transition: transform 0.5s ease-in-out;
            right: 0;
        }

        .left-container button {
            position: absolute;
            top: 55%;
            left: 22%;
            transform: translate(-50%, -50%);
        }

        .right-container button {
            position: absolute;
            top: 52%;
            right: 23%;
            transform: translate(50%, 50%);
        }

        .move-right {
            transform: translateX(-30%);
        }

        .code-container {
            background-color: #f4f4f4;
            border-radius: 8px;
            top: 50%;
            right: 0;
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

        .question {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f3bb66;
            border-radius: 30px;
            font-size: 25px;
            font-weight: bold;
            padding: 20px;
            z-index: 3;
        }

        .hide {
            display: none;
        }

        .right,
        .left {
            display: none;
        }

        .row {
            width: 100%;
        }

        .images {
            position: relative;
            height: 100%;
        }

        img {
            height: 750px;
        }

        .left {
            position: absolute;
            right: 14%;
            top: 25%;
        }

        .right {
            position: absolute;
            right: 2%;
            top: 50%;
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

        .paper ul {
            list-style: none;
            font-size: 24px;
            color: midnightblue;
        }

        .paper {
            margin-left: 25%;
            width: 100%;
            font-size: 36px;
            min-height: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #D1BB9E;
            background-image: linear-gradient(to bottom right, rgba(255, 255, 255, 0.3), rgba(0, 0, 0, 0.3));
        }

        .paper h1 {
            color: saddlebrown;
            position: relative;
            display: flex;
            align-items: center;
            font-size: 36px;
        }

        .paper h1::before,
        .paper h1::after {
            content: '';
            display: block;
            width: 5rem;
            height: 2px;
            background-color: currentColor;
            margin: 0 1rem;
        }

        .big {
            background-color: lightgreen;
            padding: 1.6rem 2rem;
            padding-bottom: 3rem;
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
                <p><strong>{{ $passwordGameQuestion -> gamename }}</strong><br>
                    <hr>
                </p>
                <p>
                    {{ $passwordGameQuestion -> pre_story }}
                </p>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="row">
            <ul class="col-ms-8 breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link">綠野仙蹤</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link">遊戲種類</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link__active">通關密碼</a>
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

    <div class="containers">
        <div class="question" id="question">
            <p>{{ $passwordGameQuestion -> game_explanation }}</p>
        </div>
        <div class="row">
            <div class="col-md-12 images">
                <img src="/images/password/closedoor.svg" id="close" alt="緊閉的大門">
            </div>
            <div class="col-md-6 left-container">
                <button type="button" class="btn btn-success" id="OpenBtn">打開大門</button>
            </div>
            <div class="col-md-6 right-container">
                <button type="button" class="btn btn-info" id="codeLockBtn">程式密碼鎖</button>
            </div>
        </div>
    </div>

    <div class="left">
        <div class="paper">
            <h1>PASSWROD</h1>
            <ul>
                <li class="big">{{ $variable }}</li>
                <ul>
        </div>
    </div>

    <div class="right">
        <div class="code-container">
            <pre>
{!! $templateCode !!}
</pre>
        </div>
        <div class="btn-container">
            <button id="send-code" class="btn-submit">提交</button>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        var parameter_id = parseInt('{{ $passwordGameQuestion->id }}');
        console.log('parameter_id:' + parameter_id);
        // 畫面載入後顯示彈跳視窗
        function togglePopup1() {
            document.getElementById("popup").classList.toggle("active");
        }

        // 平移動畫
        document.getElementById('codeLockBtn').addEventListener('click', function() {
            const container = document.querySelector('.containers');
            const rightDiv = document.querySelector('.right');
            const leftDiv = document.querySelector('.left');

            if (container.classList.contains('move-right')) {
                container.classList.remove('move-right');
                rightDiv.style.display = 'none';
                leftDiv.style.display = 'none';
            } else {
                container.classList.add('move-right');
                container.classList.remove('move-left');
                rightDiv.style.display = 'block';
                leftDiv.style.display = 'block';
            }
        });

        // 大門動畫
        document.getElementById('OpenBtn').addEventListener('click', function() {
            const img = document.getElementById('close');
            const question = document.getElementById('question');

            img.src = "/images/password/opendoor.svg";
            question.classList.add('hide');
        });

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
    </script>
</body>

</html>