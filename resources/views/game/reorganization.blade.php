<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEducation - 學習填充</title>
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
            overflow: hidden;
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

        #hints {
            font-size: 28px;
            font-weight: bold;
            margin-top: 70px;
            margin-bottom: 20px;
            background-color: #76a5af;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 805.6px;
            overflow: hidden;
        }

        #board {
            width: 805.6px;
            height: 209px;
            border: 5px solid #76a5af;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
        }

        #board img {
            width: 199px;
            height: 199px;
            border: 0.5px solid #76a5af;
        }

        #pieces {
            width: 805.6px;
            height: 209px;
            border: 5px solid #76a5af;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            margin: 10px auto;
            display: flex;
            flex-wrap: wrap;
        }

        #pieces img {
            width: 199px;
            height: 199px;
            border: 0.5px solid lightblue;
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

    <div id="container">
        <h2 id="hints"></h2>
        <div id="question-container">
            <div id="board"></div>
            <div id="question"></div>
        </div>
        <div id="pieces"></div>
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
        var currTile; // 正在拖動的圖片
        var otherTile; // 目標圖片

        // 題目
        window.onload = function() {
            let questions = [{
                    question: "___ years = 18;",
                    a: "String",
                    b: "int",
                    c: "float",
                    d: "char",
                    hint: "years是整數變數"
                },
                {
                    question: "___ roads = '中華路';",
                    answer: "String",
                    a: "String",
                    b: "int",
                    c: "float",
                    d: "char",
                    hint: "roads是字符串變數"
                },
                {
                    question: "___ miles = 3/1.6;",
                    answer: "float",
                    a: "String",
                    b: "int",
                    c: "float",
                    d: "char",
                    hint: "miles是浮點數變數"
                },
                {
                    question: "___ mine = false;",
                    answer: "boolean",
                    a: "String",
                    b: "int",
                    c: "float",
                    d: "boolean",
                    hint: "mine是布林值變數"
                },
                {
                    question: "___ yourself = true;",
                    answer: "boolean",
                    a: "String",
                    b: "int",
                    c: "float",
                    d: "boolean",
                    hint: "yourself是布林值變數"
                },
                {
                    question: "___ K = '王';",
                    answer: "char",
                    a: "String",
                    b: "int",
                    c: "float",
                    d: "char",
                    hint: "K是字符變數"
                }
            ];

            // 隨機題目
            let selected = questions[Math.floor(Math.random() * questions.length)];
            let parts = selected.question.split('___'); // 用空格將題目分開
            console.log(parts);

            // 生成拼圖片
            let pieces = generateImageFromText(part[0]);
            // 將題目加到頁面
            for (let i = 0; i < pieces.length; i++) {
                let tile = document.createElement('img');
                tile.src = pieces[i]; // 使用生成拚圖片

                // 拖放功能
                tile.addEventListener("dragstart", dragStart);
                tile.addEventListener("dragover", dragOver);
                tile.addEventListener("dragenter", dragEnter);
                tile.addEventListener("dragleave", dragLeave);
                tile.addEventListener("drop", dragDrop);
                tile.addEventListener("dragend", dragEnd);

                document.getElementById("board").append(tile);
            }

            // 將選項加到頁面
            let options = [selected.a, selected.b, selected.c, selected.d];
            for (let i = 0; i < options.length; i++) {
                let tile = document.createElement('img');
                tile.src = generateImageFromText(options[i]);
                tile.dataset.answer = options[i]; // 存儲選項的答案

                // 拖放功能
                tile.addEventListener("dragstart", dragStart);
                tile.addEventListener("dragover", dragOver);
                tile.addEventListener("dragenter", dragEnter);
                tile.addEventListener("dragleave", dragLeave);
                tile.addEventListener("drop", dragDrop);
                tile.addEventListener("dragend", dragEnd);

                document.getElementById("pieces").append(tile);
            }

            // 提示
            let hint = document.createElement('h2');
            hint.className = 'hint';
            hint.textContent = '提示：' + selected.hint; // 在提示前加上 "提示：" 字樣
            document.getElementById("hints").insertAdjacentElement('afterbegin', hint); // 將提示添加到 board 元素中 "提示：" 的後面

        }

        // 生成帶有文本的圖片
        function generateImageFromText(text) {
            let canvas = document.createElement('canvas');
            canvas.width = 199;
            canvas.height = 199;
            let context = canvas.getContext('2d');
            context.fillStyle = 'white'; // 背景白色
            context.fillRect(0, 0, canvas.width, canvas.height);
            context.fillStyle = 'black'; // 文字黑色
            context.font = '30px Helvetica';

            // 計算文字寬度，將文字置中
            let textWidth = context.measureText(text).width;
            let x = (canvas.width - textWidth) / 2;
            let y = (canvas.height / 2) + 10;

            context.fillText(text, x, y); // 文字、位置
            return canvas.toDataURL(); // 返回圖片
        }

        // 拖放功能
        function dragStart() {
            currTile = this; // 記錄當下正在拖放的圖片
        }

        function dragOver(e) {
            e.preventDefault(); // 同意拖放操作
        }

        function dragEnter(e) {
            e.preventDefault(); // 同意拖放操作
        }
        function dragLeave() {
            // 不需要處理
        }

        function dragDrop() {
            otherTile = this; // 紀錄目標圖片
        }

        function dragEnd() {
            if (currTile.src.includes("blank")) {
                return; // 如果是空白圖片，跳過
            }
            let currImg = currTile.src;
            let otherImg = otherTile.src;
            currTile.src = otherImg; // 交換圖片
            otherTile.src = currImg;
        }

        // 當使用者提交答案時執行
        function checkAnswer() {
            let boardTiles = document.getElementById("board").querySelectorAll("img");
            let piecesTiles = document.getElementById("pieces").querySelectorAll("img");
            let userAnswer = '';

            // 獲取使用者的拼圖順序
            boardTiles.forEach(tile => {
                userAnswer += tile.dataset.answer.charAt(0);
            });

            // 獲取問題的正確答案
            let correctAnswer = '';
            questions.forEach(question => {
                correctAnswer += question.answer.charAt(0);
            });

            // 比較使用者答案與正確答案
            if (userAnswer === correctAnswer) {
                // 答對的處理方式
                alert('答對了！');
                // 可以進行下一步操作，比如繼續遊戲或顯示其他內容
            } else {
                // 答錯的處理方式
                alert('答錯了，請再試一次。');
                // 可以重置遊戲或提供更多提示
            }
        }

    </script>
</body>

</html>