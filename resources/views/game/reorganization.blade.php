<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEducation - 學習重組</title>
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
            background: #fff;
            width: 450px;
            height: 220px;
            z-index: 2;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .popup .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #222;
            color: #fff;
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
            background: rgba(72, 170, 193, 0.8);

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

    <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <h1>Title</h1>
            <p>123456789</p>
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
                <a href="{{ route('welcome') }}" class="breadcrumbs__link__active">重組題</a>
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

    <div class="container">
        <h2 id="hints"></h2>
        <div id="board"></div>
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

        // 彈跳視窗
        function togglePopup() {
            document.getElementById("popup-1").classList.toggle("active");
        }

        // 遊戲
        var currTile; // 正在拖動的圖片
        var otherTile; // 目標圖片

        // 題目
        window.onload = function() {
            let questions = [{
                    question: "int years = 18;",
                    hint: "years是整數變數"
                },
                {
                    question: "String roads = '中華路';",
                    hint: "roads是字符串變數"
                },
                {
                    question: "float miles = 3/1.6;",
                    hint: "miles是浮點數變數"
                },
                {
                    question: "boolean mine = false;",
                    hint: "mine是布林值變數"
                },
                {
                    question: "boolean yourself = true;",
                    hint: "yourself是布林值變數"
                },
                {
                    question: "char K = '王';",
                    hint: "K是字符變數"
                }
            ];

            // 隨機題目
            let selected = questions[Math.floor(Math.random() * questions.length)];
            let parts = selected.question.split(' '); // 用空格將題目分開

            // 初始化圖片
            for (let i = 0; i < parts.length; i++) {
                let tile = document.createElement('img');
                tile.src = "{{asset('/images/blank.jpg')}}"; // 空白圖片佔位

                // 拖放功能
                tile.addEventListener("dragstart", dragStart);
                tile.addEventListener("dragover", dragOver);
                tile.addEventListener("dragenter", dragEnter);
                tile.addEventListener("dragleave", dragLeave);
                tile.addEventListener("drop", dragDrop);
                tile.addEventListener("dragend", dragEnd);

                document.getElementById("board").append(tile);
            }

            // 生成拼圖片
            let pieces = parts.map(part => generateImageFromText(part));

            // 隨機打亂拼圖
            for (let i = 0; i < pieces.length; i++) {
                let j = Math.floor(Math.random() * pieces.length);
                let tmp = pieces[i];
                pieces[i] = pieces[j];
                pieces[j] = tmp;
            }

            // 將拼圖片加到頁面
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
    </script>
</body>

</html>