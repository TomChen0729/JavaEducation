<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEducation - 學習配對</title>
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
            background: url('/images/learn/lv1-3.svg') no-repeat center center fixed;
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
            background: rgba(72, 170, 193, 0.8);
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
            margin-top: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 10px;
        }

        /* 每一對題目、答案橫向對齊，保持間距 */
        .pair-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 800px;
            margin-bottom: 20px;
        }

        .question {
            font-size: 20px;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 300px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: #A34343 0.3s ease;
            text-align: center;
            /* 確保文字置中 */
            padding: 0 10px;
            margin-right: 50px;
            box-sizing: border-box;
            /* 確保padding不會影響寬度 */
            background-color: #A34343;
        }

        .question:hover {
            background-color: #e06666;
        }

        .answer {
            font-size: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: #E9C874 0.3s ease;
            text-align: center;
            /* 確保文字置中 */
            padding: 0 10px;
            margin-left: 50px;
            box-sizing: border-box;
            /* 確保padding不會影響寬度 */
            background-color: #E9C874;
        }

        .answer:hover {
            background-color: #f1c232;
        }

        .selected {
            /* 選中項目有邊框顯示 */
            outline: 3px solid #0000ff;
        }

        .matched {
            /* 配對成功後的樣式 */
            background-color: #00ff00;
            pointer-events: none;
            /* 禁用已配對元素的點擊事件 */
        }

        @media (max-width: 768px) {
            .pair-container {
                align-items: center;
                /* 垂直排列时居中对齐 */
            }

            .question,
            .answer {
                margin: 10px;
                /* 垂直排列时保持间距 */
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
                background: #9ec7c6;
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
                <a href="{{ route('welcome') }}" class="breadcrumbs__link__active">配對題</a>
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
        <!-- 動態生成問題和答案 -->
        <div id="pair-container"></div>
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

        // 儲存當前選中的題目和答案
        let selectedQuestion = null;
        let selectedAnswer = null;

        document.addEventListener('DOMContentLoaded', () => {
        const pairContainer = document.getElementById('pair-container');

        // 從Blade模板傳遞過來的數據
        const questions = [
            @foreach ($questions as $question)
                {
                    question: `{!! $question->questions !!}`,
                    answer: `{!! $question->answer !!}`
                } @if (!$loop->last) , @endif
            @endforeach
        ];

            // 將問題和答案分別存入兩個數組
            const shuffledQuestions = shuffleArray(questions.map(item => item.question));
            const shuffledAnswers = shuffleArray(questions.map(item => item.answer));

            // 動態生成問題和答案的HTML結構
            shuffledQuestions.forEach((question, index) => {
                const pairDiv = document.createElement('div');
                pairDiv.className = 'pair-container';

                const questionDiv = createDiv(question, 'question', index);
                const answerDiv = createDiv(shuffledAnswers[index], 'answer', index); // 使用對應的打亂後答案

                pairDiv.appendChild(questionDiv);
                pairDiv.appendChild(answerDiv);

                pairContainer.appendChild(pairDiv);
            });

            // 為每個題目和答案添加點擊事件監聽器
            document.querySelectorAll('.question').forEach(el => {
                el.addEventListener('click', () => selectQuestion(el));
            });

            document.querySelectorAll('.answer').forEach(el => {
                el.addEventListener('click', () => selectAnswer(el));
            });
        });

        // 創建一個帶有HTML內容、類名和索引的 div 元素
        function createDiv(htmlContent, className, index) {
            const div = document.createElement('div');
            div.className = className;
            div.innerHTML = htmlContent; // 設置HTML內容
            div.dataset.index = index; // 存儲題目或答案的索引
            return div;
        }

        // 隨機打亂數組的順序
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
        }

        // 處理題目點擊事件的函數
        function selectQuestion(el) {
            console.log(`Question selected: ${el.innerHTML}`);
            if (selectedQuestion) {
                selectedQuestion.classList.remove('selected'); // 取消之前選中的題目高亮顯示
            }
            selectedQuestion = el; // 設置當前選中的題目
            el.classList.add('selected'); // 高亮顯示當前選中的題目
        }

        // 處理答案點擊事件的函數
        function selectAnswer(el) {
            console.log(`Answer selected: ${el.innerHTML}`);
            if (selectedAnswer) {
                selectedAnswer.classList.remove('selected'); // 取消之前選中的答案高亮顯示
            }
            selectedAnswer = el; // 設置當前選中的答案
            el.classList.add('selected'); // 高亮顯示當前選中的答案
        }


    </script>
</body>

</html>