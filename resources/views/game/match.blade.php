<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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

        a:hover{
            color: white;
            text-decoration: none;
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
            background: #4D613C;
            border-radius: 50px;
            width: 50%;
            z-index: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .first .pop {
            color: #F8F2ED;
            margin: 30px;
            padding: 30px;
            border-radius: 50px;
            border: 5px solid #F6B654;
        }

        .first .pop h1 {
            text-align: center;
            font-size: 30px;
            font-weight: bolder;
            margin-bottom: 30px;
        }

        .first .pop p {
            font-size: 16px;
        }

        .first .pop hr {
            margin: 10px 0;
        }

        .first .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #D6C9B6;
            color: #5B1718;
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
            background: linear-gradient(145deg, #91806E, #7B6D5A);
            border-radius: 20px;
            width: auto;
            height: auto;
            z-index: 2;
            text-align: center;
            padding: 10px;
            box-sizing: border-box;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2); /* 陰影效果 */
            transition: transform 0.3s ease-in-out;
        }

        .popup .pop a.cardname {
            display: inline-block;
            margin: 10px;
            padding: 20px 25px;
            text-align: center;
            background: #A9C2BC;
            color: #FFFFFF;
            font-size: 1.1em;
            border-radius: 15px;
            text-decoration: none;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .popup .pop a.cardname:hover {
            transform: translateY(-5px);
            background: #8AAE9F;
        }

        .popup .pop a.cardname::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: skewX(-45deg);
            transition: left 0.5s ease;
        }

        .popup .pop a.cardname:hover::before {
            left: 100%;
        }

        .popup .pop {
            color: #F8F2ED;
            height: 80%;
            margin: 60px;
            padding: 60px 80px;
            border-radius: 50px;
            border: 8px solid #A9C2BC;
            overflow-y: auto;
        }

        .popup .pop::-webkit-scrollbar {
            display: none; /* 隱藏滾動條 */
        }

        .title{
            color:#FFF5D7;
            font-size:32px;
            font-weight:800;
            margin: 0;
            padding: 0;
            text-align: center;
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
            color: #F8F2ED;
            font-size: 20px;
            font-weight: bold;
            background-color: #A9C2BC;
            border-radius: 10px;
            padding: 10px;
            margin: 10px;
            margin-top: 30px;
        }

        .popup .pop a:hover {
            color: #F8F2ED;
            background-color: #91806E;
        }

        .popup .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #A9C2BC;
            color: #F8F2ED;
            font-size: 25px;
            font-weight: 600;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
            transition: transform 0.2s ease-in-out;
        }

        .popup .close-btn:hover {
            transform: scale(1.2);
            color: #FF6B6B;
        }

        .popup.active .overlay {
            display: block;
        }

        .popup.active .content {
            transition: all 300ms ease-in-out;
            transform: translate(-50%, -50%) scale(1);
        }
        #popup-2 .content p {
            text-align: left;
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
            background: rgba(156,197,196, 0.8);
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
            color: #A34343;
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

        .pair-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 900px;
            margin-bottom: 20px;
        }

        .question {
            font-size: 20px;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 1300px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: #A34343 0.3s ease;
            text-align: center;
            padding: 0 10px;
            margin-right: 50px;
            box-sizing: border-box;
            background-color: #A34343;
        }

        .question:hover {
            background-color: #e06666;
        }

        .answer {
            font-size: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            min-width: 200px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: #E9C874 0.3s ease;
            text-align: center;
            padding: 0 10px;
            margin-left: 50px;
            box-sizing: border-box;
            background-color: #E9C874;
        }

        .answer:hover {
            background-color: #f1c232;
        }

        .selected {
            outline: 3px solid #394165;
        }

        .matched {
            background-color: #394165;
            color: #E38931;
            pointer-events: none; /*不會跳轉頁面*/
        }

        @media (max-width: 1300px) {
            .first .content {
                top: 60%;
            }

            .question {
                width: 100%;
                margin-right: 10px;
            }

            .answer {
                width: 100%;
                margin-left: 10px;
            }

            .pair-container {
                align-items: center;
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

            .question, .answer {
                font-size: 18px;
            }

            .container {
                padding: 0 20px;
            }
        }

        @media (max-width: 768px) {
            .tof{
                margin-top: 3%;
            }
        }

        @media (max-width: 630px) {
            .tof{
                margin-top: 15%;
            }

            .question, .answer {
                font-size: 16px;
                
            }

            .question{
                height: 100%;
            }

            .container {
                padding: 0 10px;
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
                <p><strong>配對題</strong><br>
                    判斷左方紅色框格中的敘述，配對右方黃框相對應的選項
                    需要先選擇紅色框格，再選黃框對應的選項</p>
            </div>
        </div>
    </div>

    <!-- 知識卡選擇 -->
    <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup2()">&times;</div>
            <div class="pop">
            <div class="title">知識卡資訊</div>
                @foreach ( $questions_cards as $item )
                    <a class="cardname" href="#" onclick="togglePopup3('{{ $item -> name }}')">{{ $item -> name }}</a>
                @endforeach       
            </div>
        </div>
    </div>

    <!-- 知識卡資訊 -->
    <div class="popup" id="popup-2">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup3()">&times;</div>
            <div class="pop">
                <h1></h1>
                <p></p>
            </div>
        </div>
    </div>

    <!-- 答題正確 -->
    <div class="end" id="popup-3">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup4()">&times;</div>
            <div class="pop">
                <h1>答案正確</h1>
                <a href="{{ route('game.index', ['country_id' => $questions[1] -> country_id, 'levels' => $questions[1] -> levels])}}">遊戲種類</a>
                <a href="{{ route('game.gameRD', ['country_id' => $questions[1] -> country_id, 'levels' => $questions[1] -> levels]) }}">繼續答題</a>
            </div>
        </div>
    </div>

    <header class="header">
        <ul class="breadcrumbs">
        <li class="breadcrumbs__item">
                <a href="{{ route('welcome') }}" class="breadcrumbs__link">綠野仙蹤</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('country.index',['country_id' => $questions[1] -> country_id]) }}" class="breadcrumbs__link">遊玩等級</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('game.index', ['country_id' => $questions[1] -> country_id, 'levels' => $questions[1] -> levels])}}" class="breadcrumbs__link">遊戲種類</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link__active">配對題</a>
            </li>
        </ul>

        <ul class="navbar">
            <li><a href="#" onclick="togglePopup2()"> 知識卡</a></li>
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
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
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

        // 要放知識卡資料進去
        function togglePopup3(cardName) {
            console.log(cardName)
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/api/show-card-detail?cardname=' + encodeURIComponent(cardName), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
            })
            .then(response => response.json())
            .then(data => {

                // data = JSON.parse(data)
                console.log(data)
                cardcontent = JSON.parse(data.cardcontent)
                // 抓取 popup-2 底下的 h1 和 p 元素
                const popup2 = document.getElementById('popup-2');
                const popupTitle = popup2.querySelector('h1');
                const popupContent = popup2.querySelector('p');
                // 你可以設定或取得 h1 和 p 的內容，例如
                popupTitle.textContent = cardcontent[0].name;
                popupContent.innerHTML = cardcontent[0].description.replace(/\n/g, '<br>');

                // 確認是否正確抓取到
                console.log("標題內容:", popupTitle.textContent);
                console.log("段落內容:", popupContent.textContent);

            })

            document.getElementById("popup-2").classList.toggle("active");
        }

        function togglePopup4() {
            document.getElementById("popup-3").classList.toggle("active");
        }

        // 遊戲
        // 儲存當前選中的題目、答案以及拿來對題目答案的陣列
        let selectedQuestion = null;
        let selectedAnswer = null;
        let questions = [];

        document.addEventListener('DOMContentLoaded', () => {
            const pairContainer = document.getElementById('pair-container');
            // 後端資料傳到前端
            questions = @json($questions);
            console.log(questions);
            // 存問題與答案
            const shuffledQuestions = questions.map(item => item.questions);
            const shuffledAnswers = shuffleArray(questions.map(item => item.answer));

            // 隨機打亂
            function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
            return array;
            }


            // 生成問題與答案
            shuffledQuestions.forEach((question, index) => {
                const pairDiv = document.createElement('div');
                pairDiv.className = 'pair-container';

                const questionDiv = createDiv(question, 'question', index);
                const answerDiv = createDiv(shuffledAnswers[index], 'answer', index);

                pairDiv.appendChild(questionDiv);
                pairDiv.appendChild(answerDiv);

                pairContainer.appendChild(pairDiv);
            });

            // 問題與答案的監聽器
            document.querySelectorAll('.question').forEach(el => {
                el.addEventListener('click', () => selectQuestion(el));
            });

            document.querySelectorAll('.answer').forEach(el => {
                el.addEventListener('click', () => selectAnswer(el));
            });
        });

        //
        function createDiv(htmlContent, className, index) {
            const div = document.createElement('div');
            div.className = className;
            div.innerHTML = htmlContent;
            div.dataset.index = index;
            return div;
        }



        // 點擊題目後的事件
        function selectQuestion(el) {
            if (selectedQuestion) {
                selectedQuestion.classList.remove('selected');
            }
            selectedQuestion = el;
            el.classList.add('selected');

        }

        // 點擊答案後的事件
        function selectAnswer(el) {
            if (!selectedQuestion) return;//沒選問題的話選答案沒用

            if (selectedAnswer) {
                selectedAnswer.classList.remove('selected');
            }
            selectedAnswer = el;
            el.classList.add('selected');

            checkAnswer();
        }

        // 定義計數器變數
        let correctCount = 0;

        function checkAnswer() {
            //將選中的題目、答案存入變數和用來確認的正確答案
            const questionIndex = selectedQuestion.dataset.index;
            const selectedOption = selectedAnswer.textContent.trim();
            const correctAnswer = questions[questionIndex].answer.trim();
            //需要傳到後端的題目id、使用者id、時間與答題狀態
            const question_id = questions[questionIndex].id;
            const cid = {!! json_encode(auth()->user()->id) !!};
            var timer = stopTimer();
            let status;
            //對答案
            if (selectedOption === correctAnswer) {
                selectedQuestion.classList.add('matched');
                selectedAnswer.classList.add('matched');
                status = 1;
                
                // 答對次數加一
                correctCount++;
                console.log(correctCount);

                // 如果答對次數達到4次，顯示答案正確的彈窗
                if (correctCount === 4) {
                    togglePopup4(); // 呼叫彈窗
                }
            } else
            {
                status = 0;
                alert('答錯');
            }


        // 構建 GET 請求的 URL
        const url = `/api/matchuserecord?question_id=${question_id}&cid=${cid}&status=${status}&timer=${timer}`;

        // 發送 GET 請求
        fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('API 請求失敗');
            }
        })
        .catch(error => {
            console.error('錯誤:', error);
        });

        // 清空當前存取的資料
        selectedQuestion.classList.remove('selected');
        selectedAnswer.classList.remove('selected');
        selectedQuestion = null;
        selectedAnswer = null;
        }

        // 彈出視窗
        function showPopup(message) {
            const popupMessage = document.getElementById('popup-message');
            popupMessage.textContent = message;
            togglePopup();
        }




    </script>
</body>

</html>
