<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>塔中尋油</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/base16-dark.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/clike/clike.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
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
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 3%;
            max-height:100%;
            overflow:hidden;
        }

        .first .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 10;
            display: none;
        }

        .first .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: #323232;
            border-radius: 50px;
            width: 50%;
            z-index: 10;
            padding: 20px;
        }

        .first .pop {
            color: #f3bb66;
            margin: 30px;
            padding: 30px;
            border-radius: 50px;
            border: 5px solid #e28639;
        }

        .first .pop h1 {
            text-align: center;
            font-size: 50px;
            font-weight: bolder;
            margin-bottom: 30px;
        }

        .first .pop p {
            font-size: 20px;
        }

        .first .pop p strong {
            font-size: 24px;
        }

        .first .pop p hr {
            margin: 10px 0;
        }

        .first .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #e28639;
            color: #323232;
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

        .header {
            position: absolute;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 2% 0;
            background: rgb(150, 126, 118, 0.8);
            transition: all 0.5s ease;
        }

        .breadcrumbs {
            letter-spacing: 5px;
            font-size: 24px;
            font-family: sans-serif;
        }

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
            color: #3B3030;
            font-weight: bold;
        }

        .navbar {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .navbar .time {
            display: none;
            color: #fff;
            font-size: 20px;
            font-weight: bolder;
            letter-spacing: 5px;
            padding: 5px 15px;
            margin: 0 30px;
            transition: all 0.5s ease;
        }

        .navbar a {
            color: #fff;
            font-size: 20px;
            font-weight: bolder;
            text-align: center;
            border: 2px solid #fff;
            border-radius: 5px;
            padding: 5px 15px;
            margin: 0 30px;
            transition: all 0.5s ease;
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
            margin: 0 25px 0 10px;
            color: var(--text-color);
            font-size: 20px;
            font-weight: 500;
            transition: all 0.5s ease;
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
            width:100%;
            overflow: visible;
            margin-top: -3%;
            position: relative;
            transition: transform 0.5s ease-in-out;
            z-index: 1;
            height:auto;
            background-color:#D7C0AE;
        }

        .left-container{
            margin-top:5%;
        }

        .right-container{
            margin-top:5%;
        }

        .row {
            height:100%;
        }

        .question{
            margin-top:6%;
            display: flex;
            justify-content: center;
            margin-bottom:-3%;
        }

        .question-box{
            display:flex;
            justify-content: center;
            align-items: center;
            padding:1%;
            width: 90%;
            height: auto;
            background: repeating-linear-gradient(
                45deg,       
                #D8BFD8,    
                #D8BFD8 10px,
                #ffffff 10px,
                #ffffff 20px 
            );
        }

        .question-p{
            background-color:white;
            padding:1%;
        }

        .question p{
            font-size:20px;
            font-weight:bold;
        }

        .img-container{
            position: relative;
            margin-left:3%;
            width:auto;
            height:70%;
            background-image: url('/images/oil/oilbg.svg');
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
        }

        .health{
            position:absolute;
            left:20%;
            margin: 0px;
            padding: 0px;
            width: 100%;
            height: 100vh;
        }

        .health-container {
            width: 450px;
            height: 90px;
            overflow: hidden;
            position: relative;
        }

        .health-container::before {
            position: absolute;
            content: "";
            background-color: #007995;
            width: 10px;
            height: 40px;
            left: 0px;
            z-index: 10;
        }

        .health-container .health-bar {
            position: absolute;
            left: -20px;
            width: 350px;
            height: 45px;
            background-color: #b4e4ef;
            border: 10px solid #007995;
            transform: skewX(25deg);
        }

        .health-container .health-bar .health-percentage {
            position: absolute;
            height: 25px;
            background: #c0054c;
        }

        .health-container .health-bar .health-percentage.health-2 {
            width: 20%;
        }

        .health-container .health-status {
            display: flex;
            padding: 0px 10px;
            justify-content: flex-end;
            align-items: center;
            height: 30px;
            position: absolute;
            top: 35px;
            left: -20px;
            background: #007995;
            transform: skewX(-25deg);
        }

        .health-container .health-status span {
            margin-left: 20px;
            color: #b4e4ef;
            font-weight: bold;
            font-size: 18px;
            transform: skewX(25deg);
        }

        .man{
            position:absolute;
            width:20%;
            height:auto;
            background-color:#b4e4ef;
            border:2px solid #007995;
        }

        #oil{
            position: relative;
            top: 60%;
            left: 20%;
            width: 100%;
            height: 30%;
            opacity: 0;
            transition: opacity 0.5s ease; 
        }

        @keyframes animate {
            0% {
                top: 60%;
                left: 20%;
            }
            100% {
                top: 20%;
                right: 80%;
                width: 100%;
                height: 80%;
            }
        }

        #oil.show{
            animation: animate 1s ease-in-out forwards; /* 使用 forwards 確保動畫結束後保持最後狀態 */
            opacity: 1; 
        }
        
        .container-code {
            overflow-y:scroll;
            height:70%;
            width: 94%;
            background-color: #f4f4f4;
            border-radius: 8px;
            margin-left:3%;
            padding:0px 0px 0px 40px;
            
        }

        pre {
            font-size: 20px;
        }

        input {
            width: 80px;
            text-align: center;
            transition: width 0.2s ease;
        }

        .btn-container {
            position: absolute;
            right: 40px;
            top:75%;
        }

        .btn-submit{
            background-color:red;
            width:80px;
            height:35px;
            border:none;
            color:white;
            border-radius: 5px;

        }
        
    </style>
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
                <p><strong>{{ $oilQuestion -> gamename }}</strong><br><hr></p>
                <p>
                {{ $oilQuestion -> pre_story }}
                </p>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="row">
            <ul class="col-ms-8 breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link">綠野仙蹤</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link">遊戲種類</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link__active">塔中尋油</a>
                </li>
            </ul>

            <ul class="col-ms-6 navbar">
                <li><a href="#" onclick="togglePopup2()"> 知識卡</a></li>
                <li><a href="#" onclick="history.back()"> 回上一頁</a></li>
                <li class="time" id="timer">00:00:00</li>
            </ul>

            <div class="main">
                <div class="bx bx-menu" id="menu-icon"></div>
            </div>
        </div>
        
    </div>

    <div class="container-fluid">
        <div class="question">
            <div class="question-box">
                <div class="question-p">
                    <p>{{ $oilQuestion -> game_explanation }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 left-container" id="left-container">
                <div class="img-container" id="img-container">
                    <img class="man"id="man" src="/images/oil/sadman.svg" alt="man">
                    <div class="health">
                        <div class="health-container">
                            <div class="health-bar" id="healthBar">
                                <div class="health-percentage health-2"></div>
                            </div>
                            <div class="health-status"> <span id="healthStatus">HP: 20%</span></div>
                        </div>
                    </div>
                    <img id="oil" src="/images/oil/oil.svg" alt="oil">
                </div>
                    <button onclick="play()">測試動畫</button>
            </div>

                <div class="col-md-6 right-container" id="right-container">
                    <div  class="container-code" id="code">
<pre>
{!! $templateCode !!}
</pre>
                    <div class="btn-container">
                            <button id="send-code" class="btn-submit">提交</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <!-- JavaScript -->
    <script>
        // 畫面載入後顯示彈跳視窗
        function togglePopup1() {
            document.getElementById("popup").classList.toggle("active");
        }

        // 動畫
        function play() {
            // 假設血量恢復至 100%
            const healthPercentage = 100;
            const healthBar = document.querySelector('.health-percentage');
            const healthStatus = document.getElementById('healthStatus');

            // 更新血條的寬度
            healthBar.style.width = `${healthPercentage}%`;
            // 更新血條顏色為綠色
            healthBar.style.backgroundColor = '#4CAF50'; 
            // 更新血量狀態文字
            healthStatus.textContent = `HP: ${healthPercentage}%`;

            // 換臉
            const man = document.getElementById('man');
            man.src = '/images/oil/happyman.svg';

            // 油罐飛出
            const oilElement = document.getElementById('oil');
            oilElement.classList.add('show');
        }


        //input格子縮放
        function autoResize(input) {
            const newWidth = input.scrollWidth;
            const minWidth = 80;

            // 字數0時回到最小寬度
            if (input.value === "") {
                input.style.width = minWidth + 'px';
            } else {
                // 隨著字數增加寬度不小於 minWidth
                input.style.width = Math.max(newWidth, minWidth) + 'px';
            }
        }
    </script>
</body>

</html>