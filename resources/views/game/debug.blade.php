<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>JavaEducation - 闖關Debug</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
            /* 底線去除 */
            list-style: none;
            /* 去除清單前面的符號 */
        }

        :root {
            --bg-color: #222327;
            --text-color: #333333;
            --main-color: #6875F5;
        }

        body {
            background: url('/images/learn/lv1-5.svg') no-repeat top center fixed;
            background-size: cover;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;

            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
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
            background: #2B4D42;
            border-radius: 50px;
            width: 50%;
            z-index: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .first .pop {
            color: #F7EFD2;
            margin: 30px;
            padding: 30px;
            border-radius: 50px;
            border: 5px solid #81745F;
        }

        .first .pop h1 {
            text-align: center;
            font-size: 30px;
            font-weight: bolder;
            margin-bottom: 30px;
        }

        .first .pop p {
            font-size: 20px;
        }

        .first .pop p.cen {
            text-align: center;
            margin-bottom: 20px;
        }

        .first .pop hr {
            margin: 10px 0;
            border: 1px solid #81745F;
        }

        .first .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #81745F;
            color: #F7EFD2;
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

        .popup .overlay {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
            display: none;
        }

        .popup .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: #434B5C;
            border-radius: 50px;
            width: 40%;
            height: 50%;
            z-index: 2;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .popup .pop {
            color: #EBE2D1;
            height: 80%;
            margin: 30px;
            padding: 30px 0;
            border-radius: 50px;
            border: 5px solid #736356;
        }

        .popup .pop h1 {
            font-size: 20px;
            font-weight: bolder;
            margin-bottom: 30px;
        }

        .popup .pop p {
            font-size: 16px;
        }

        .popup .pop a {
            font-size: 20px;
            font-weight: bold;
            background-color: #736356;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            margin-top: 30px;
        }

        .popup .pop a:hover {
            color: #736356;
            background-color: #EBE2D1;
        }

        .popup .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #876E51;
            color: #F7E9DC;
            font-size: 25px;
            font-weight: 600;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
        }

        .popup.active .overlay {
            display: block;
        }

        .popup.active .content {
            transition: all 300ms ease-in-out;
            transform: translate(-50%, -50%) scale(1);
        }

        .end .overlay {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
            display: none;
        }

        .end .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: #452E34;
            border-radius: 30px;
            width: 40%;
            z-index: 2;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .end .pop {
            color: #E7E9DC;
            margin: 30px;
            padding: 30px 0;
            border-radius: 50px;
            border: 5px solid #876E51;
            height: 50%;
        }

        .end .pop h1 {
            font-size: 30px;
            font-weight: bolder;
            margin-bottom: 30px;
        }

        .end .pop a {
            font-size: 20px;
            font-weight: bold;
            background-color: #876E51;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            margin-top: 30px;
        }

        .end .pop a:hover {
            color: #876E51;
            background-color: #F7E9DC;
        }

        .end .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #876E51;
            color: #F7E9DC;
            font-size: 25px;
            font-weight: 600;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
        }

        .end.active .overlay {
            display: block;
        }

        .end.active .content {
            transition: all 300ms ease-in-out;
            transform: translate(-50%, -50%) scale(1);
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px 2%;
            background: rgba(121, 165, 177, 0.8);
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
            color: #009578;
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

        .container {
            width: 90%;
            margin-top: 100px;
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        .container .left {
            background-color: #333333;
            border-radius: 50px;
            color: #fff;
            width: 30%;
            margin: 10px;
            padding: 50px;
        }

        .container .right {
            background-color: #333333;
            color: #fff;
            border-radius: 50px;
            width: 70%;
            margin: 10px;
            padding: 50px;
            border: 2px solid #444;
        }

        h1 {
            font-size: 20px;
            font-weight: bolder;
        }

        input {
            color: #333333;
        }

        .container .left .content {
            padding: 20px;
            border: 2px solid #444;
        }

        .container .right .code {
            padding: 20px;
            border: 2px solid #444;
        }

        .container .right .box {
            margin-top: 30px;
        }

        .container .right .box .inputs {
            width: 100%;
            max-width: 550px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 10px;
        }
        .container .right .box .inputs input{
            width: 100%;
        }
        .container .right .box button {
            margin-top: 10px;
            padding: 5px;
            border: 1px solid #fff;
        }

        .container .right .box button:hover {
            background-color: #fff;
            color: #333333;
            padding: 5px;
            border: 1px solid #333333;
        }

        @media (max-width: 1600px) {
            .container .right .code {
                padding: 20px;
                height: 250px;
                overflow-y: auto;
                border: 2px solid #444;
            }
        }

        @media (max-width: 1280px) {
            header {
                padding: 14px 2%;
                transition: 0.2s;
            }

            .navbar a {
                padding: 5px 0;
                margin: 0px 20px;
            }
        }

        @media (max-width: 1090px) {
            #menu-icon {
                display: block;
            }

            .navbar {
                position: absolute;
                top: 90%;
                right: -100%;
                width: 270px;
                background: #a7aab8;
                font-style: none;
                border: 2px solid #5b5b5b;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                border-radius: 10px;
                transition: all 0.50s ease;
            }

            .navbar a {
                border: none;
                display: block;
                margin: 12px 0;
                padding: 0px 25px;
                transition: all 0.50s ease;
            }

            .navbar a:hover {
                color: var(--text-color);
                transform: translateY(5px);
            }

            .navbar.open {
                right: 2%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
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
                <p><strong>是非題</strong><br>
                    判斷題目敘述，正確答案選擇True，錯誤答案選擇False</p>
            </div>
        </div>
    </div>

    <!-- 知識卡選擇 -->
    <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup2()">&times;</div>
            <div class="pop">
                <a href="#" onclick="togglePopup3()">知識卡</a>
            </div>
        </div>
    </div>

    <!-- 知識卡資訊 -->


    <!-- 答題正確 -->
    <div class="end" id="popup-3">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup4()">&times;</div>
            <div class="pop">
                <h1>答案正確</h1>
                <a href="#" onclick="history.go(-1)">遊戲種類</a>
                <a href="#">繼續答題</a>
            </div>
        </div>
    </div>


    <header class="header">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link">綠野仙蹤</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link">闖關區</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link__active">Debug題</a>
            </li>
        </ul>

        <ul class="navbar">
            <li><a href="#" onclick="togglePopup2()"> 知識卡</a></li>
            <li><a href="#" onclick="history.go(-1)"> 回上一頁</a></li>
            <li class="time" id="timer">00:00:00</li>
        </ul>

        <div class="main">
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <div class="container">
        <p id="cid" style="display: none">{{ auth()->user()->id }}</p>
        <div class="left">
            <div class="content" id="question-content">
                <!-- 題目內容動態生成 -->
                <!-- <h1>題目說明：</h1>
                <p>請印出「The Wonderful Wizard of Oz」並換行</p>
                <br>
                <h1>結果輸出：</h1>
                <p>The Wonderful Wizard of Oz</p> -->
            </div>
        </div>
        <div class="right">
            <div class="code">
                <h1>程式碼：</h1>
                <pre id="code-block">
                    <!-- 程式碼內容動態生成 -->
                    <!-- 1. public class Ex01 {
                    2.     public static void main(String[] args) {
                    3.         System.out.println("The Wonderful Wizard of Oz");
                    4.     }
                    5. } -->
                </pre>
            </div>
            <div class="box">
                <div class="inputs">
                    <div>
                        <p>錯誤行數：</p>
                        <input type="text" id="errorLine">
                    </div>
                    <div>
                        <p>正確程式碼：</p>
                        <input type="text" id="correctCode">
                    </div>
                </div>
                <div class="buttons">
                    <button class="check-word" onclick="checkAnswer()">檢查答案</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 漢堡
        let menu = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');

        menu.onclick = () => {
            menu.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        }

        // 計時器
        function startTimer() {
            let minutes = 0;
            let seconds = 0;
            let hours = 0;
            const timerElement = document.getElementById('timer');

            function updateTimer() {
                seconds++;
                if (seconds === 60) {
                    seconds = 0;
                    minutes++;
                    if (minutes === 60) {
                        minutes = 0;
                        hours++;
                    }
                }
                const formattedHours = String(hours).padStart(2, '0');
                const formattedMinutes = String(minutes).padStart(2, '0');
                const formattedSeconds = String(seconds).padStart(2, '0');
                timerElement.textContent = `${formattedHours}:${formattedMinutes}:${formattedSeconds}`;
            }

            setInterval(updateTimer, 1000);
        }

        function stopTimer() {
            clearInterval(timer);
            const timerElement = document.getElementById('timer').textContent;
            return timerElement;
        }
        window.onload = startTimer();

        // 知識卡
        // 畫面載入後顯示彈跳視窗
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("popup").classList.add("active");
        });

        function togglePopup1() {
            document.getElementById("popup").classList.toggle("active");
        }

        function togglePopup2() {
            document.getElementById("popup-1").classList.toggle("active");
        }

        function togglePopup3() {
            document.getElementById("popup-2").classList.toggle("active");
        }

        function togglePopup4() {
            document.getElementById("popup-3").classList.toggle("active");
        }


        // 題目(description)、程式碼(code)、正確行數(correctLine)、正確程式碼(correctCode)
        const questions = @json($question);
        console.log(questions);
        
        // 加載問題索引，接受參數'index'
        function loadQuestion(item) {
            // 獲取問題(從questions數組中根據索引獲取題目)
            let question = questions;
            // 顯示問題描述(獲取id為'question-content'的元素)
            const questionContent = document.getElementById('question-content');
            // 顯示程式碼(獲取id為'code-block'的元素)
            const codeBlock = document.getElementById('code-block');
            // 丟數組中的description進去'question-content'，replace()函數用於替換字符串為新的字符串，這裡將所有\n替換為<br>以便在HTML中正確顯示段落
            questionContent.innerHTML = `<h1>題目說明：</h1><p>${question.description.replace(/\n/g, '<br>')}</p>`;
            // 丟數組中的code進去'code-block'，將程式碼以\n分割成行(用來組成陣列)，用map()函數對陣列每一行加行數(從1開始)，回呼函式有兩個參數(line, idx)，最後用join('\n')連接成字串
            codeBlock.textContent = question.code.split('\n').map((line, idx) => `${idx + 1}. ${line}`).join('\n');
        }


        // 檢查答案
        function checkAnswer() {
            // trim()用於刪除字串的頭尾空白、tab、換行符號
            let errorLine = parseInt(document.getElementById('errorLine').value.trim());
            let correctCode = document.getElementById('correctCode').value.trim();
            let watchtime = stopTimer();
            let debug_id = parseInt(questions['debug_id']);
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let cid = parseInt(document.getElementById('cid').textContent);
            // console.log(errorLine);
            // console.log(correctCode);
            // console.log(cid);
            // console.log(csrfToken);
            // console.log(debug_id);
            // console.log(watchtime);
            if (errorLine != '' && correctCode != '') {
                fetch('/api/correctDebug?user_answer=' + encodeURIComponent(correctCode) + '&debug_id=' + encodeURIComponent(debug_id) + '&wrongLine=' + encodeURIComponent(errorLine) + '&watchtime=' + encodeURIComponent(watchtime) + '&cid=' + encodeURIComponent(cid), {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if (data.message == 'correct') {
                            alert('答對');
                        } else if (data.message == 'wrongline') {
                            alert('不是錯這行喔~');
                        } else if ('wrongAns') {
                            alert('答案不對喔~');
                        } else {
                            alert('伺服器錯誤');
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    })
            }else{
                alert('不能交白卷喔!!')
            }
        }

        // 顯示題目
        window.onload = function() {
            loadQuestion(questions);
        };
    </script>
</body>

</html>