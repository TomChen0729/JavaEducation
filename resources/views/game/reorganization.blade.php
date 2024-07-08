<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEducation - 學習填空</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            /* 底線去除 */
            text-decoration: none;
            /* 去除清單前面的符號 */
            list-style: none;

        }

        :root {
            --bg-color: #222327;
            --text-color: #333333;
            --main-color: #6875F5;
        }

        body {
            background: url('/images/learn/lv1-4.svg') no-repeat center center fixed;
            background-size: cover;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
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
            background: #3e3641;
            border-radius: 50px;
            width: 50%;
            z-index: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .first .pop {
            color: #ede2d1;
            margin: 30px;
            padding: 30px;
            border-radius: 50px;
            border: 5px solid #a58391;
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

        .first .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #a58391;
            color: #ede2d1;
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
            background: #303a40;
            border-radius: 50px;
            width: 40%;
            height: 50%;
            z-index: 2;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .popup .pop {
            color: #efefef;
            height: 80%;
            margin: 30px;
            padding: 30px 0;
            border-radius: 50px;
            border: 5px solid #7aa5d1;
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
            background-color: #7aa5d1;
            color: #efefef;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            margin-top: 30px;
        }

        .popup .pop a:hover {
            color: #efefef;
            background-color: #303a40;
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
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px 2%;
            /* 透明背景 */
            background: rgba(199,168,132, 0.8);

            transition: all 0.50s ease;
        }

        .breadcrumbs {
            /* 字元間距 */
            letter-spacing: 5px;

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
            /* 確保垂直方向對齊 */
            align-items: center;
            /* 讓 navbar 靠右對齊 */
            margin-left: auto;

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

        /* 設定容器樣式 */
        #container {
            background-color: #504647;
            color: #faf1e4;
            border: 5px solid #cc9252;
            padding: 20px;
            text-align: center;
        }

        /* 設定提示的樣式 */
        h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 50px;
        }

        /* 設定題目容器樣式 */
        #question-container {
            font-size: 24px;
            margin-bottom: 40px;
        }

        /* 設定選項容器樣式 */
        #pieces {
            display: flex;
            justify-content: center;
            gap: 10px;
            font-size: 20px;
        }

        /* 設定選項的樣式 */
        .piece {
            display: inline-block;
            padding: 10px;
            border: 1px solid #000;
            cursor: pointer;
            user-select: none;
        }

        /* 設定選項按鈕的樣式 */
        .option-btn {
            display: inline-block;
            padding: 10px;
            margin: 5px;
            border: 1px solid #ccc;
            cursor: pointer;
        }

        /* 設定拖放區域的樣式 */
        .drop-zone {
            display: inline-block;
            width: 100px;
            height: 30px;
            border: 2px dashed #ccc;
            margin-left: 10px;
        }

        /* RWD */
        @media (max-width: 1200px) {

            #board,
            #pieces {
                width: auto;
                height: auto;
            }

            #board img,
            #pieces img {
                width: 150px;
                height: 150px;
            }
        }

        @media (max-width: 768px) {

            #board,
            #pieces {
                width: auto;
                height: auto;
            }

            #board img,
            #pieces img {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 480px) {

            #board,
            #pieces {
                flex-direction: column;
                width: auto;
                height: auto;
            }

            #board img,
            #pieces img {
                width: 80px;
                height: 80px;
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
                background: #b49977;
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
    @yield('style')
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
                <p><strong>填充題</strong><br>
                    判斷題目敘述，選擇正確選項並拖曳至上方空白處</p>
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
                <a href="{{ route('game.gameRD', ['country_id' => $question -> country_id, 'levels' => $question -> levels]) }}">繼續答題</a>
            </div>
        </div>
    </div>

    <header class="header">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('welcome') }}" class="breadcrumbs__link">綠野仙蹤</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('welcome') }}" class="breadcrumbs__link">遊玩等級</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('welcome') }}" class="breadcrumbs__link">遊戲種類</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('welcome') }}" class="breadcrumbs__link__active">填充題</a>
            </li>
        </ul>

        <ul class="navbar">
            <li><a href="#" onclick="togglePopup()"> 知識卡</a></li>
            <li onclick="history.go(-1)"><a href="#"> 回上一頁</a></li>
            <li class="time" id="timer">00:00</li>
        </ul>

        <div class="main">
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <!-- 題目和選項的容器 -->
    <div id="container">
        <!-- 顯示提示的元素 -->
        <h2 id="hints"></h2>
        <!-- 顯示題目的容器 -->
        <div id="question-container">
            <!-- 預設顯示第一題 -->
            <div id="board"></div>
        </div>
        <!-- 顯示選項的容器 -->
        <div id="pieces"></div>
        <!-- 提交按鈕 -->
        <button id="submit-btn" onclick="checkAnswers()">Submit</button>
    </div>

    <!--js-->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    @yield('script')
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
            const timerElement = document.getElementById('timer');

            function updateTimer() {
                seconds++;
                if (seconds === 60) {
                    seconds = 0;
                    minutes++;
                }

                const formattedMinutes = String(minutes).padStart(2, '0');
                const formattedSeconds = String(seconds).padStart(2, '0');
                timerElement.textContent = `${formattedMinutes}:${formattedSeconds}`;
            }

            setInterval(updateTimer, 1000);
        }

        window.onload = startTimer;

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

        // 遊戲
        // 題目
        // 初始化題目
        window.onload = function() {
            // 設定當前題目的索引
            let currentQuestion = 0;
            // 定義題目和答案的數組
            const questions = [{
                    question: "___ years = 18;",
                    answer: "int",
                    options: ["String", "int", "float", "char"],
                    hint: "提示：years是整數變數"
                },
                {
                    question: "___ roads = '中華路';",
                    answer: "String",
                    options: ["String", "int", "float", "char"],
                    hint: "提示：roads是字符串變數"
                },
                {
                    question: "___ miles = 3/1.6;",
                    answer: "float",
                    options: ["String", "int", "float", "char"],
                    hint: "提示：miles是浮點數變數"
                },
                {
                    question: "___ mine = false;",
                    answer: "boolean",
                    options: ["String", "int", "float", "boolean"],
                    hint: "提示：mine是布林值變數"
                },
                {
                    question: "___ yourself = true;",
                    answer: "boolean",
                    options: ["String", "int", "float", "boolean"],
                    hint: "提示：yourself是布林值變數"
                },
                {
                    question: "___ K = '王';",
                    answer: "char",
                    options: ["String", "int", "float", "char"],
                    hint: "提示：K是字符變數"
                }
            ];

            // 打亂題目順序的函數
            function shuffle(array) {
                // 從數組的最後一個元素開始迭代
                for (let i = array.length - 1; i > 0; i--) {
                    // 生成一個隨機索引
                    const j = Math.floor(Math.random() * (i + 1));
                    // 交換當前元素和隨機索引處的元素
                    [array[i], array[j]] = [array[j], array[i]];
                }
            }

            // 打亂題目順序
            shuffle(questions);
            // 顯示當前題目
            displayQuestion(currentQuestion);

            // 顯示指定索引的題目
            function displayQuestion(index) {
                // 獲取題目容器元素
                const questionElement = document.getElementById('question-container');
                // 設定題目內容和拖放區域
                questionElement.innerHTML = `
                    <p><span id="drop-zone-${index}" class="drop-zone" ondrop="drop(event)" ondragover="allowDrop(event)"></span> ${questions[index].question.slice(3)}</p>
                `;

                // 獲取選項容器元素
                const piecesElement = document.getElementById('pieces');
                // 設定選項按鈕
                piecesElement.innerHTML = questions[index].options.map(option => {
                    return `<button class="option-btn" data-answer="${option}" draggable="true" ondragstart="drag(event)">${option}</button>`;
                }).join('');

                // 獲取提示元素並設定提示內容
                const hintElement = document.getElementById('hints');
                hintElement.textContent = questions[index].hint;
            }

            // 提交按鈕的點擊事件
            document.getElementById('submit-btn').onclick = function() {
                checkAnswers(currentQuestion);
            }

            // 檢查答案是否正確
            function checkAnswers(index) {
                // 獲取拖放區域元素
                const dropZone = document.getElementById(`drop-zone-${index}`);
                // 獲取用戶選擇的答案
                const selectedAnswer = dropZone.textContent.trim();
                // 比較用戶選擇的答案和正確答案
                if (selectedAnswer === questions[index].answer) {
                    alert('答案正確');
                    // 移動到下一個題目
                    currentQuestion++;
                    // 如果還有題目，顯示下一個題目
                    if (currentQuestion < questions.length) {
                        displayQuestion(currentQuestion);
                    } else {
                        // 所有題目完成後顯示提示
                        alert('你已完成所有題目');
                    }
                } else {
                    // 答案錯誤時顯示提示
                    alert('答案錯誤，請再試一次');
                }
            }
        };

        // 允許拖放的函數
        function allowDrop(event) {
            event.preventDefault();
        }

        // 拖動開始的函數
        function drag(event) {
            // 設定拖動數據
            event.dataTransfer.setData("text", event.target.dataset.answer);
        }

        // 拖放完成的函數
        function drop(event) {
            event.preventDefault();
            // 獲取拖動數據
            const data = event.dataTransfer.getData("text");
            // 設定拖放區域的文本內容
            event.target.textContent = data;
        }
    </script>
</body>

</html>