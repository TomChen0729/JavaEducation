<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <title>檢查並移除敵方間諜</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            /* 底線去除 */
            text-decoration: none;
            /* 去除清單前面的符號 */
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
            background-color: #c5d0c2;
            /* background: url('/images/learn/lv1-4.svg') no-repeat center center fixed;
            background-size: cover; */
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

        header {
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 2% 0;
            /* 透明背景 */
            background: rgba(120, 164, 100, 0.8);
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
            color: #00493A;
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

        .container-fluid {
            margin-top: 3%;
            display: flex;
            width: 100%;
            height: 80vh;
        }

        .left-container {
            width: 100vh;
            margin-right: 1%;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .left-container .game {
            margin-bottom: 2%;
        }

        .left-container .game {
            flex: 7;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #999;
            background-color: #e3e3e3;
        }

        .left-container .description {
            flex: 3;
            display: flex;
            justify-content: center;
            align-items: center;
            /* border: 1px solid #999; */
            background-color: #e3e3e3;

            --b: 10px;
            /* border thickness */
            --s: 30px;
            /* size of the dashes */
            --c1: #215A6D;
            --c2: #92C7A3;

            position: relative;
        }

        .left-container .description::before {
            content: "";
            position: absolute;
            inset: 0;
            padding: var(--b);
            background:
                repeating-conic-gradient(var(--c1) 0 25%, var(--c2) 0 50%) 0 0/var(--s) var(--s) round;
            -webkit-mask:
                linear-gradient(#000 0 0) content-box,
                linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .right-container {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .right-container .code {
            margin-bottom: 2%;
            flex: 7;
            flex-direction: column;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #999;
            background-color: #d3d3d3;
        }

        .right-container .material {
            flex: 3;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px solid #999;
            background-color: #C3C3C3;
        }

        /* 設定容器樣式 */
        #code-container {
            background-color: #ddb759;
            color: #74461b;
            /* border: 5px solid #442a0f; */
            border-radius: 30px;
            padding: 20px;
            text-align: center;
            padding-top: 35%;
            overflow: auto;
        }

        #material-container {
            background-color: #b8d4b6;
            color: #476f45;
            /* border: 5px solid #442a0f; */
            border-radius: 30px;
            padding: 20px;
            text-align: center;
        }

        #game-container {
            height: 70%;
            width: 100%;
            background: url('/images/treasure/treasurebg.svg') no-repeat center;
            background-size: cover;
            /* border: 5px solid #442a0f; */
            border-radius: 30px;
            position: relative;
        }

        .marker {
            width: 60px;
            height: 60px;
            /* background-color: red; */
            border-radius: 50%;
            position: absolute;
            cursor: pointer;
        }

        #marker-1 {
            top: 55%;
            left: 9%;
        }

        #marker-2 {
            top: 55%;
            left: 25%;
        }

        #marker-3 {
            top: 55%;
            left: 40%;
        }

        #marker-4 {
            top: 55%;
            left: 56%;
        }

        #marker-5 {
            top: 55%;
            left: 72%;
        }

        #shovel,#treasure {
            width: 200px;
            position: absolute;
            transition: all 1s ease-in-out;
        }

        #shovel {
            transform-origin: bottom center; /* 旋轉基點設為底部中央，模擬手柄 */
            animation: dig 2s ease-in-out; /* 挖掘動作*/
        }

        @keyframes dig {
            0% {
                transform: rotate(0deg) translateY(0);
            }
            25% {
                transform: rotate(-30deg) translateY(-10px); /* 向下挖掘 */
            }
            75% {
                transform: rotate(30deg) translateY(10px); /* 模擬揚起動作 */
            }
        }

        #description-container {
            font-size: 26px;
            font-weight: bold;
            background-color: #b7d0f9;
            color: #4a71b0;
            padding: 20px;
            text-align: center;
        }

        #question-container pre {
            margin-top: 30%;
            font-size: 20px;
            font-weight: bold;
            text-align: left;
        }

        /* 設定選項容器樣式 */
        #pieces {
            display: wrap;
            justify-content: center;
            gap: 10px;
            font-size: 16px;
        }

        /* 設定選項的樣式 */
        /* .piece {
            display: inline-block;
            padding: 10px;
            border: 1px solid #000;
            cursor: pointer;
            user-select: none;
        } */

        /* 設定選項按鈕的樣式 */
        .optionBtn {
            display: inline-block;
            width: 200px;
            height: 50px;
            margin: 5px;
            border: 5px solid #faf1e4;
            border-radius: 20px;
            cursor: pointer;
            text-align: center;
            line-height: 40px;
            /* 垂直置中 */
        }


        /* 設定拖放區域的樣式 */
        .dropZone {
            display: inline-block;
            min-width: 200px; /*設定最小長度，太長可以動態調整寬度*/
            height: 50px;
            border: 5px solid #faf1e4;
            border-radius: 20px;
            margin-right: 10px;
            text-align: center;
            line-height: 40px;
            /* 垂直置中 */
            text-align: center;
        }

        #submit-btn {
            background-color: #f0cdca;
            border: 3px solid #442a0f;
            border-radius: 10px;
            color: #442a0f;
            padding: 5px;
        }

        #submit-btn:hover {
            background-color: #d4807c;
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

        /* RWD */
        @media (max-width: 1900px) {
            #question-container pre {
                margin-top: 40%;
            }
        }

        @media (max-width: 1300px) {
            .first .content {
                top: 60%;
            }
        }

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

        @media (max-width: 1090px) {
            #menu-icon {
                display: block;
            }

            .navbar {
                position: absolute;
                top: 100%;
                right: -100%;
                width: 270px;
                background: #91aabf;
                font-style: none;
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
                border: none;
                color: var(--text-color);
                transform: translateY(5px);
            }

            .navbar.open {
                right: 2%;
            }
        }

        @media (max-width: 900px) {

            .first .content {
                width: 90%;
                height: auto;
                max-height: 80vh;
            }

            .first .pop h1 {
                font-size: 28px;
            }

            .first .pop p {
                font-size: 18px;
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

        @media (max-width: 500px) {

            .first .pop h1 {
                font-size: 18px;
            }

            .first .pop p {
                font-size: 12px;
            }

            .first .close-btn {
                right: 25px;
                top: 25px;
                width: 25px;
                height: 25px;
                font-size: 20px;
                line-height: 25px;
            }
        }
    </style>
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

    <div id="success-popup" class="popup hide">
        <div class="close-btn" onclick="togglePopup2()">&times;</div>
        <div class="popup-content">
            <p>答題成功！</p>
            <div class="card"></div>
            <button><a href="{{ $question->gamename }}">選擇遊戲關卡</a></button>
        </div>
    </div>

    <header class="header">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('welcome') }}" class="breadcrumbs__link">綠野仙蹤</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link">選擇遊戲</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link__active">{{ $question->gamename }}</a>
            </li>
        </ul>

        <ul class="navbar">
            <li onclick="history.go(-1)"><a href="#"> 回上一頁</a></li>
            <li class="time" id="timer">00:00</li>
        </ul>

        <div class="main">
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <!-- 版面內容 -->
    <div class="container-fluid">
        <div class="left-container">
            <div class="game" id="game-container">
                <!-- 五個標記點 -->
                <div class="marker" id="marker-1" data-position="10"></div>
                <div class="marker" id="marker-2" data-position="7"></div>
                <div class="marker" id="marker-3" data-position="42"></div>
                <div class="marker" id="marker-4" data-position="65"></div>
                <div class="marker" id="marker-5" data-position="99"></div>
                <!-- 動畫素材 -->
                <img id="shovel" src="/images/treasure/shovel.svg" style="display:none;">
                <img id="treasure" src="/images/treasure/treasure.svg" style="display:none;">
            </div>
            <button onclick="play()">測試按鈕</button>
            <div class="description" id="description-container">
                <p>{{ $question->pre_story }}</p>
            </div>
        </div>
        <div class="right-container">
            <div class="code" id="code-container">
                <!-- 顯示題目的容器 -->
                <div id="question-container">
                    <!-- 預設顯示第一題 -->
                    <div id="board"></div>
                </div>
                <!-- 提交按鈕 -->
                <button id="submit-btn" onclick="checkAnswers()">Submit</button>
            </div>
            <div class="material" id="material-container">
                <!-- 顯示選項的容器 -->
                <div id="pieces"></div>
            </div>
        </div>
    </div>


    <script>
        // 漢堡
        let menu = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');
        var shape = parseInt('{{ $question->id }}');
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

        // 畫面載入後顯示彈跳視窗
        function togglePopup1() {
            document.getElementById("popup").classList.toggle("active");
        }

        // 關閉彈窗
        function togglePopup2() {
            document.getElementById("success-popup").classList.toggle("jump");
        }

        // 動畫
        function play() {
            // 標記
            const markers = document.querySelectorAll('.marker');
            // 鏟子
            const shovel = document.getElementById('shovel');
            // 寶箱
            const treasure = document.getElementById('treasure');

            const sortedPositions = [7, 10, 42, 65, 99]; // 排序後的座標(五個點)
            const randomIndex = Math.floor(Math.random() * sortedPositions.length); // 隨機選擇一個座標
            const targetMarker = markers[randomIndex]; // 選取對應的 marker

            console.log('寶藏座標：', sortedPositions[randomIndex]);

            // 移動鏟子到隨機座標
            shovel.style.left = targetMarker.offsetLeft + 'px';
            shovel.style.top = targetMarker.offsetTop + 'px';
            shovel.style.display = 'block';

            // 顯示寶藏
            setTimeout(() => {
                shovel.style.display = 'none';
                treasure.style.left = targetMarker.offsetLeft + 'px';
                treasure.style.top = targetMarker.offsetTop + 'px';
                treasure.style.display = 'block';
            }, 2000); // 延遲顯示寶藏，增加視覺效果
        }

        // 題目
        // 初始化題目
        window.onload = function() {
            // 定義題目和答案的數組
            // const questions = $question_data;
            // console.log(questions);
            const questions = {!! json_encode($question_data) !!};

            // 顯示當前題目
            displayQuestion(questions);

            // 顯示整個作答區
            function displayQuestion(questions) {
                // 獲取題目的div
                const questionElement = document.getElementById('question-container');

                // 將題目中的 '___' 替換為缺空處
                let formattedQuestion = questions.question.replace(/___/g, generateDropZone());
                questionElement.innerHTML = `<p>${formattedQuestion}</p>`;


                // 獲取放置選項的div
                const piecesElement = document.getElementById('pieces');
                // 設定選項按鈕，透過map函數遍歷整個options陣列，將每個值讀出來，然後動態生成選項
                piecesElement.innerHTML = questions.options.map(options => {
                    return `<div class="optionBtn" draggable="true">${options.ans_patterns}</div>`;
                }).join('');

                // 初始化所有可拖曳的元素
                initializeDragAndDrop();
            }


            // 提交按鈕的點擊事件，即為觸發對答案的函數
            document.getElementById('submit-btn').onclick = function() {
                checkAnswers();
            }

            // 檢查答案是否正確
            function checkAnswers() {
                let allFilled = true;
                var userAnswer = [];
                
                // 獲取玩家已填入缺空處的值
                const dropZone = document.querySelectorAll('.dropZone');
                console.log(dropZone.length);
                dropZone.forEach(function(item, index) {
                    if (item.textContent.trim() === '') {
                        allFilled = false;
                    }
                    userAnswer.push({
                        order: index + 1,
                        ans_patterns: item.textContent
                    });
                });

                console.log(userAnswer);

                if (!allFilled) {
                    alert('你還有空格未填入答案');
                    return;
                }

                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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
                            // 標記
                            const markers = document.querySelectorAll('.marker');
                            // 鏟子
                            const shovel = document.getElementById('shovel');
                            // 寶箱
                            const treasure = document.getElementById('treasure');

                            const sortedPositions = [7, 10, 42, 65, 99]; // 排序後的座標(五個點)
                            const randomIndex = Math.floor(Math.random() * sortedPositions.length); // 隨機選擇一個座標
                            const targetMarker = markers[randomIndex]; // 選取對應的 marker

                            console.log('寶藏座標：', sortedPositions[randomIndex]);

                            // 移動鏟子到隨機座標
                            shovel.style.left = targetMarker.offsetLeft + 'px';
                            shovel.style.top = targetMarker.offsetTop + 'px';
                            shovel.style.display = 'block';

                            // 顯示寶藏
                            setTimeout(() => {
                                treasure.style.left = targetMarker.offsetLeft + 'px';
                                treasure.style.top = targetMarker.offsetTop + 'px';
                                treasure.style.display = 'block';
                            }, 2000); // 延遲顯示寶藏，增加視覺效果

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
                            }, 100);

                        } else if (data.message == 'wrongAns') {
                            console.log(data.wrongIndex);
                        } else if (data.message == 'Null') {
                            alert('請填入答案');
                        } else {
                            alert('答錯');
                        }
                    });
            };
        };

        let draggedElement = null; // 用於追蹤正在拖曳的元素

        function initializeDragAndDrop() {
            // 初始化所有可拖曳的元素
            document.querySelectorAll('.optionBtn, .dropZone').forEach(el => {
                // 當開始拖曳時，儲存被拖曳元素的參考
                el.addEventListener('dragstart', (e) => {
                    draggedElement = e.target;
                    e.dataTransfer.setData('text', e.target.textContent);
                });

                // 當拖曳結束時，清除儲存的元素參考
                el.addEventListener('dragend', () => {
                    draggedElement = null;
                });

                // 允許拖曳元素放置在此處
                el.addEventListener('dragover', (e) => {
                    e.preventDefault();
                });

                // 當拖曳元素被放置時，處理內容
                el.addEventListener('drop', (e) => {
                    e.preventDefault();
                    if (draggedElement) {
                        if (draggedElement.classList.contains('optionBtn') && e.target.classList.contains(
                                'dropZone') && e.target.textContent == '') {
                            console.log('將選項放入作答區，並從素材區移除')
                            // 將選項放入作答區，並從素材區移除
                            // if (!isDuplicateIndropZones(draggedElement.textContent)) {
                            e.target.textContent = draggedElement.textContent; // 將選項文字放入
                            draggedElement.remove(); // 從素材區刪除選項
                            // }
                        } else if (draggedElement.classList.contains('dropZone') && e.target.classList
                            .contains('dropZone') && draggedElement !== e.target) {
                            console.log('交換兩個作答區的選項')
                            // 交換兩個作答區的選項
                            const temp = draggedElement.textContent;
                            draggedElement.textContent = e.target.textContent;
                            e.target.textContent = temp;
                        } else if (draggedElement.classList.contains('optionBtn') && e.target.classList
                            .contains('dropZone') && e.target.textContent !== '') {
                            console.log('當將素材區的選項拖到已經有值的格子時，原有值移回素材區');
                            // 當將素材區的選項拖到已經有值的格子時，原有值移回素材區
                            const originalValue = e.target.textContent; // 獲取原有值
                            e.target.textContent = draggedElement.textContent; // 將新選項放入

                            // 創建一個新的選項元素並放回素材區
                            const newoptionBtn = document.createElement('div'); // 創建新的選項元素
                            newoptionBtn.className = 'optionBtn'; // 設定類別為 optionBtn
                            newoptionBtn.textContent = originalValue; // 設定選項內容
                            newoptionBtn.draggable = true; // 設定為可拖曳

                            // 確保素材區不會有重複的選項
                            if (!isoptionBtnDuplicate(newoptionBtn.textContent)) {
                                document.getElementById('pieces').appendChild(newoptionBtn); // 添加回素材區
                            }

                            // 從素材區刪除原來的選項
                            draggedElement.remove(); // 刪除被拖曳的選項

                            // 重新添加拖曳事件
                            newoptionBtn.addEventListener('dragstart', (e) => {
                                draggedElement = e.target;
                                e.dataTransfer.setData('text', e.target.textContent);
                            });
                        }

                    }
                });
            });
        }

        // 檢查素材區是否有重複選項
        function isoptionBtnDuplicate(optionBtnText) {
            const optionBtns = document.querySelectorAll('#pieces .optionBtn');
            for (let optionBtn of optionBtns) {
                if (optionBtn.textContent === optionBtnText) {
                    return true; // 如果有重複選項，返回 true
                }
            }
            return false; // 如果沒有重複選項，返回 false
        }

        // 檢查作答區是否有重複選項
        function isDuplicateIndropZones(optionBtnText) {
            const dropZones = document.querySelectorAll('.dropZone');
            for (let dropZone of dropZones) {
                if (dropZone.textContent === optionBtnText) {
                    return true; // 如果有重複選項，返回 true
                }
            }
            return false; // 如果沒有重複選項，返回 false
        }


        // 產生缺空處的函數
        function generateDropZone() {
            return `<div class="dropZone" draggable="true"></div>`;
        }
        // 選取 #pieces 中的所有 div 元素
        const pieces = document.querySelectorAll('optionBtn');

        // 每四個 <div> 後插入一個換行
        pieces.forEach((div, index) => {
            if ((index + 1) % 4 === 0) {
                const br = document.createElement('br');
                div.after(br);
            }
        });
    </script>
</body>

</html>
