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
            background: url('/images/learn/lv1-2.svg') no-repeat center center fixed;
            background-size: cover;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .first .overlay {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100vw;
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
            background: #fff;
            width: 950px;
            z-index: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .first .pop {
            color: #333333;
            margin: 30px;
            padding: 30px;
            border-radius: 50px;
            border: 5px solid #333333;
        }

        .first .pop h1 {
            text-align: center;
            font-size: 26px;
            font-weight: bolder;
            margin-bottom: 5px;
        }

        .first .pop p {
            font-size: 16px;
        }

        .first .pop p.cen {
            text-align: center;
            margin-bottom: 20px;
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
            background-color: #222;
            color: #fff;
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
            background: #fff;
            width: 450px;
            height: 220px;
            z-index: 2;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .popup .pop {
            margin: 30px;
            padding: 30px 0;
            border-radius: 50px;
            border: 5px solid #333333;
        }

        .popup .pop h1 {
            font-size: 20px;
            font-weight: bolder;
            margin-bottom: 5px;
        }

        .popup .pop p {
            font-size: 16px;
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

        .question {
            background-color: #bcdf49;
            border-radius: 10px;
            margin: 10px;
            margin-top: 150px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 700px;
        }

        .quiz-header {
            padding: 4rem;
            /*內部*/
        }

        #questions {
            font-size: 24px;
            font-weight: bold;
            padding: 1rem;
            text-align: center;
            margin: 0;
        }

        .quiz-header ul {
            list-style-type: none;
            /*無標號*/
            padding: 0;
        }

        .quiz-header ul li {
            font-size: 20px;
            margin: 18px 0;
        }

        .quiz-header ul li label {
            cursor: pointer;
            /*改變滑鼠游標*/
        }

        #sub {
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

        #sub:focus {
            outline: solid;
            /*輪廓線，不占空間*/
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
    @yield('style')
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="first active" id="popup">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup1()">&times;</div>
            <div class="pop">
                <h1>遊戲說明</h1>
                <p class="cen">歡迎來到《綠野仙蹤》遊戲，在這個遊戲中，你將會經歷兩個大關卡：學習區和闖關區。</p>
                <p><strong>學習區</strong><br>
                    在學習區，你將會遇到四種不同的關卡類型：是非、選擇、重組和配對。</p>
                <p><strong>闖關區</strong><br>
                    在完成學習區的所有關卡後，你將進入闖關區。</p>
                <hr>
                <p><strong>獎勵</strong><br>
                    成功通過學習區後，你將獲得一包知識卡，這將幫助你更好地理解和運用相關知識，來決戰闖關區。</p>
                <p>準備好開始你的冒險了嗎？快來挑戰這個充滿知識與樂趣的遊戲，提升你的編程技能吧！</p>
            </div>
        </div>
    </div>

    <div class="popup" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <div class="pop">
                <a href="#" onclick="togglePopups()">知識卡</a>
            </div>
        </div>
    </div>

    @foreach ( $questions_cards as $item)
    <div class="popup" id="popup-2">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopups()">&times;</div>
            <div class="pop">
                <h1>{{ $item -> name }}</h1>
                <p>{{ $item -> content }}</p>
            </div>
        </div>
    </div>
    @endforeach

    <header class="header">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('welcome') }}" class="breadcrumbs__link">綠野仙蹤</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('country.index',['country_id' => $question -> country_id]) }}" class="breadcrumbs__link">遊玩等級</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('game.index', ['country_id' => $question -> country_id, 'levels' => $question -> levels])}}" class="breadcrumbs__link">遊戲種類</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link__active">選擇題</a>
            </li>
        </ul>

        <ul class="navbar">
            <li><a href="#" onclick="togglePopup()"> 知識卡</a></li>
            <li><a onclick="history.back()"> 回上一頁</a></li>
            <li class="time" id="timer">00:00:00</li>
        </ul>

        <div class="main">
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <div class="question" id="questionSection">
        <h1 id="cid" style="display: none;">{{ auth()->user()->id }}</h1>
        <div class="quiz-header">
            <p id="q-id" style="display: none;">{{ $question -> id }}</p>
            <h2 id="questions">{{ $question -> questions }}</h2>
            <ul>
                @foreach ($options as $option)
                <li>
                    <input type="radio" name="answer" id="ans" class="answer" value="{{ $option -> options}}">
                    <label for="ans" id="ans-text">{{ $option -> options}}</label>
                </li>
                @endforeach
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

        function togglePopup3() {
            document.getElementById("popup-2").classList.toggle("active");
        }

        // 接後端
        // 對答案 api
        document.getElementById('sub').addEventListener('click', function() {
            const answers = document.querySelectorAll('.answer');
            var question_id = question_id = document.getElementById('q-id').textContent;
            console.log(question_id);
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var cid = document.getElementById('cid').textContent;
            var timer = stopTimer();
            // console.log(answers);
            let selectedOption; // 用一個變數存我選取的選項(USER_ANS)
            // 用迴圈跑那些選項
            for (const answer of answers) {
                // 如果選項被選擇了，存進去，並且離開
                if (answer.checked) {
                    selectedOption = answer.value;
                    break;
                }
            }

            if (selectedOption) {
                alert('您選擇的答案是: ' + selectedOption);
                fetch('/api/correct_User_ANS?user_answer=' + encodeURIComponent(selectedOption) + '&question_id=' + question_id + '&cid=' + cid + '&timer=' + timer, {
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
                            setTimeout(function() {
                                // window.location.reload();
                            }, 1000);
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
                    });




            } else {
                alert('請選擇一個答案');
            }
        });
    </script>
</body>

</html>