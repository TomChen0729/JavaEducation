<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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
            background: rgba(199, 168, 132, 0.8);

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
            width: 110px;
            height: 60px;
            padding: 10px;
            margin: 5px;
            border: 5px solid #faf1e4;
            border-radius: 20px;
            cursor: pointer;
        }

        /* 設定拖放區域的樣式 */
        .drop-zone {
            display: inline-block;
            width: 110px;
            height: 60px;
            border: 5px dashed #faf1e4;
            border-radius: 20px;
            margin-right: 10px;
        }

        #submit-btn {
            margin-top: 50px;
        }

        #submit-btn:hover {
            text-decoration: underline;
        }

        /* RWD */
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
            .tof{
                margin-top: 3%;
            }

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

        @media (max-width: 630px) {
            .tof{
                margin-top: 15%;
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

            /* #board,
            #pieces {
                flex-direction: column;
                width: auto;
                height: auto;
            }

            #board img,
            #pieces img {
                width: 80px;
                height: 80px;
            } */
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
                <a href="{{ route('game.index', ['country_id' => $currentCountry, 'levels' => $question_data['levels']])}}">遊戲種類</a>
                <a href="{{ route('game.gameRD', ['country_id' => $currentCountry, 'levels' => $question_data['levels']]) }}">繼續答題</a>
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
        <h1 id="cid" style="display: none;">{{ auth()->user()->id }}</h1>
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

        // 題目
        // 初始化題目
        window.onload = function() {
            // 定義題目和答案的數組
            const questions = @json($question_data);
            console.log(questions);
            // 顯示當前題目
            displayQuestion(questions);

            // 顯示整個作答區
            function displayQuestion(questions) {
                // 獲取題目的div
                const questionElement = document.getElementById('question-container');

                // 將題目中的 '___' 替換為缺空處
                let formattedQuestion = questions.question.replace(/___/g, generateDropZone(questions.id));
                questionElement.innerHTML = `<p>${formattedQuestion}</p>`;


                // 獲取放置選項的div
                const piecesElement = document.getElementById('pieces');
                // 設定選項按鈕，透過map函數遍歷整個options陣列，將每個值讀出來，然後動態生成選項
                piecesElement.innerHTML = questions.options.map(options => {
                    return `<button class="option-btn" data-useranswer="${options.option}" draggable="true" ondragstart="drag(event)">${options.option}</button>`;
                }).join('');

                // 獲取提示文字的div，並將值放進去
                const hintElement = document.getElementById('hints');
                hintElement.textContent = "提示：" + questions.hint;
            }

            // 提交按鈕的點擊事件，即為觸發對答案的函數
            document.getElementById('submit-btn').onclick = function() {
                checkAnswers();
            }

            // 檢查答案是否正確
            function checkAnswers() {
                // 獲取玩家已填入缺空處的值
                const dropZone = document.getElementById(`drop-zone-${questions['id']}`);
                // 獲取當前使用者id
                var cid = document.getElementById('cid').textContent;
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var timer = stopTimer();
                const selectedAnswer = dropZone.textContent.trim();
                console.log(selectedAnswer);
                // console.log(csrfToken); // 測試用
                console.log(cid);
                if (selectedAnswer != null) {
                    fetch('/api/correct_User_ANS?user_answer=' + encodeURIComponent(selectedAnswer) + '&question_id=' + questions['id'] + '&cid=' + cid + '&timer=' + timer, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            // body: JSON.stringify({
                            //     user_answer: answerValue,
                            //     question:  question,
                            //     game_type: '是非'
                            // })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.message == 'correct') {
                                togglePopup4();
                            } else if (data.message == 'wrongAnswer') {
                                alert('答錯');
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                alert('伺服器錯誤');
                                setTimeout(function() {
                                    window.location.reload();
                                }, 1000);
                            }
                        })
                } else {
                    alert('請選擇一個答案~');
                }
            }
        };

        // 允許拖放的函數，參數是event
        function allowDrop(event) {
            // 允許值被放上去
            event.preventDefault();
        }

        // 拖動開始的函數，參數是event
        function drag(event) {
            // 設定拖動數據
            event.dataTransfer.setData("text", event.target.dataset.useranswer);
        }

        // 把值放上去時的函數
        function drop(event) {
            // 允許值被放上去
            // 因為在拖放操作(該元素)中，這個事件是不被允許的(瀏覽器不允許拖放元素)，也就是說，默認事件是不允許拖放元素的，達成的效果就是當使用者在拖放選項的時候，是被瀏覽器允許的，所以值可以成功的被放進去。
            event.preventDefault();
            // 獲取使用者放上去的資料
            const data = event.dataTransfer.getData("text");
            // 將放上去的文字設為使用者自己拖上去的
            event.target.textContent = data;
        }

        // 產生缺空處的函數
        function generateDropZone(id) {
            return `<span id="drop-zone-${id}" class="drop-zone" ondrop="drop(event)" ondragover="allowDrop(event)"></span>`;
        }
    </script>
</body>

</html>