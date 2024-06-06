<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEducation - 學習選擇</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none; /* 底線去除 */
            list-style: none; /* 去除清單前面的符號 */
        }

        :root {
            --bg-color: #222327;
            --text-color: #333333;
            --main-color: #6875F5;
        }

        body {
            background: url('/images/learn/lv1-2.svg') no-repeat center center fixed;
            background-size: cover;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .popup .overlay{
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
            display: none;
        }

        .popup .content{
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

        .popup .close-btn{
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

        .popup.active .overlay{
            display: block;
        }

        .popup.active .content{
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
            padding: 28px 12%;
            background: rgba(167,170,184, 0.8); /* 透明背景 */
            transition: all 0.50s ease;
        }

        .light {
            position: relative;
            font-size: 7em;
            letter-spacing: 15px; /* 字元間距 */
            color: #0e3742;
            text-transform: uppercase; /* 所有字母皆為大寫 */
            width: 200px;
            text-align: center;
            -webkit-box-reflect: below 1px linear-gradient(transparent, #0e3742); /* 鏡像效果：反射方向 反射距離 線性漸變 */
            line-height: 0.1em; /* 設置行高 */
            outline: none; /* 輪廓線 */
            animation: animate 5s linear infinite;
        }

        @keyframes animate {
            from {
                transform: translateX(0); /* 起始位置 */
            }
            to {
                transform: translateX(50px); /* 結束位置 */
            }
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo span {
            color: #fff;
            font-size: 30px;
            font-weight: bolder;
        }

        .navbar {
            display: flex;
            align-items: center; /* 確保垂直方向對齊 */
            margin-left: auto; /* 讓 navbar 靠右對齊 */
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
            color: var(--text-color);
            cursor: pointer;
            z-index: 10001;
            display: none;
        }
        
        .question{
            margin: 1em;
            background-color: #bcdf49;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 600px;
            overflow: hidden;
        }

        .quiz-header{
            padding: 4rem;  /*內部*/
        }

        #questions{
            font-size: 28px;
            font-weight: bold;
            padding: 1rem;
            text-align: center;
            margin: 0;
        }

        .quiz-header ul{
            list-style-type: none; /*無標號*/
            padding: 0;
        }

        .quiz-header ul li{
            font-size: 20px;
            margin: 18px 0;
        }

        .quiz-header ul li label{
            cursor: pointer; /*改變滑鼠游標*/
        }

        #sub{
            color: #333;
            font-weight: bold;
            display: block;
            width: 100%;
            font-size: 18px;
            padding: 10px;
        }

        #sub:hover {
            color: var(--text-color);
            background-color: rgb(136, 136, 136);
        }

        #sub:focus{
            outline: solid; /*輪廓線，不占空間*/
            background-color: rgb(99, 99, 99);
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
                top: 100%;
                right: -100%;
                width: 270px;
                background: #fce5cd;
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
        <div class="light"><a href="{{ route('welcome') }}" class="logo"><span>綠野仙蹤</span></a></div>

        <ul class="navbar">
            <li><a href="#" onclick="togglePopup()"> 知識卡</a></li>
            <li><a href="{{ route('showallcardtypes') }}"> 回上一頁</a></li>
            <li class="time" id="timer">00:00</li>
        </ul>

        <div class="main">
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <div class="question" id="questionSection">
        <div class="quiz-header">
            <h2 id="questions">{{ $question -> questions }}</h2>
            <ul>
                @foreach ($options as $option)
                    <li>
                        <input type="radio" name="answer" id="a" class="answer">
                        <label for="a" id="a-text">{{ $option -> options}}</label>
                    </li>
                @endforeach
                
                <!-- <li>
                    <input type="radio" name="answer" id="b" class="answer">
                    <label for="b" id="b-text"></label>
                </li>
                <li>
                    <input type="radio" name="answer" id="c" class="answer">
                    <label for="c" id="c-text"></label>
                </li>
                <li>
                    <input type="radio" name="answer" id="d" class="answer">
                    <label for="d" id="d-text"></label>
                </li> -->
            </ul>
        </div>
        <button id="sub">送出</button>
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
        const quiz = document.getElementById('questionSection')//獲取題目容器
        const answerEls = document.querySelectorAll('.answer')//獲取答案選項
        const questionEl = document.getElementById('questions')// 這裡的 ID 是 'questions'
        const a_text = document.getElementById('a-text')// 這裡的 ID 是 'a-text'
        const b_text = document.getElementById('b-text')
        const c_text = document.getElementById('c-text')
        const d_text = document.getElementById('d-text')
        const submitBtn = document.getElementById('sub')//提交
        let randomQuiz; //聲明randomQuiz為全局變量

        // 接後端
        //題目
        // const quizData = [
        //     {
        //         question:"在 Java 中，下列哪個資料型態用於表示整數？",
        //         a:"int",
        //         b:"double",
        //         c:"float",
        //         d:"char",
        //         correct:"a",
        //     },
        //     {
        //         question:"下列哪個是正確的？",
        //         a:"int x = 10;",
        //         b:"int y;",
        //         c:"double z;",
        //         d:"char name = 'John';",
        //         correct:"a",
        //     },
        //     {
        //         question:"下列哪個資料型態用於表示字串？",
        //         a:"int",
        //         b:"double",
        //         c:"char",
        //         d:"String",
        //         correct:"d",
        //     },
        //     {
        //         question:"下列哪個資料型態用於表示雙精度浮點數？",
        //         a:"int",
        //         b:"double",
        //         c:"boolean",
        //         d:"char",
        //         correct:"b",
        //     },
        // ];

        // //產生隨機數
        // function getRandomInt(min, max) {
        //     // 彈性產生介於min、max之間，包括min，但不包括max的隨機整數
        //     return Math.floor(Math.random() * (max - min)) + min;
        // }

        // // 選擇隨機題目
        // function selectRandomQuestion(quizData) {
        //     return quizData[getRandomInt(0, quizData.length)];
        // }

        // // 預設要顯示的第一道題目，按照陣列長度的index為零
        // let currentQuiz = 0

        // 清除選項
        function clearSelections() {
            answerEls.forEach(answerEl => answerEl.checked = false);
        }

        //渲染題目和選項
        function renderQuestion(quizData) {
            questionEl.textContent = quizData.question;
            a_text.textContent = quizData.a;
            b_text.textContent = quizData.b;
            c_text.textContent = quizData.c;
            d_text.textContent = quizData.d;
        }

        // //獲取下一道題目
        // function getNextQuestion() {
        //     clearSelections();//清除選項狀態
        //     currentQuiz++;//當前題目索引加1
        //     if (currentQuiz < quizData.length) {
        //         renderQuestion(quizData, currentQuiz); //渲染下一道題目
        //     } else {
        //         //最後一道題目，重新開始
        //         quiz.innerHTML = `<button onclick="location.reload()">重新开始</button>`;
        //     }
        // }

        //獲取使用者選擇答案的函數
        function getSelectedAnswer() {
            for (const answerEl of answerEls) {
                if (answerEl.checked) {
                    return answerEl.id; //返回被選中的ID
                }
            }
            return null; // 無答案 = null
        }

        //頁面加載時隨機選染題目
        window.onload = () => {
            randomQuiz =selectRandomQuestion(quizData);
            renderQuestion(randomQuiz);
        };

        //提交
        submitBtn.addEventListener('click', () => {
            const selectedAnswer = getSelectedAnswer(); //獲取用戶選擇答案
            if (selectedAnswer !== null) { //如果用戶選擇了答案
                // 檢查是否選擇答案
                if (selectedAnswer === randomQuiz.correct) {
                    // 正確
                    window.location.href = "{{ route('game.gameTypeChoose', ['GameType_id' => 3]) }}/";
                } else {
                    // 錯誤
                    clearSelections();
                    alert("答錯了！");
                }
                getNextQuestion();
            } else {
                // 如果沒選擇答案就彈跳視窗
                alert("請選擇一個答案！");
            }
        });

    </script>
</body>
</html>
