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
                    minutes ++;
                    if(minutes === 60){
                        minutes = 0;
                        hours ++;
                    }
                }
                const formattedHours = String(hours).padStart(2,'0');
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

        // 彈跳視窗
        function togglePopup() {
            document.getElementById("popup-1").classList.toggle("active");
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
                if (data.message == 'correct'){
                    alert('答對');
                    setTimeout(function() {
                        // window.location.reload();
                    }, 1000);
                }
                else if(data.message == 'wrongAnswer'){
                    alert('答錯');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
                else{
                    alert('伺服器錯誤');
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            });




        } 
        else {
            alert('請選擇一個答案');
        }
    });





    </script>
</body>
</html>
