<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>密碼解碼</title>
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
            height:100%;
            
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
            background: rgba(88, 69, 70, 0.8);
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
            color: #2B060A;
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
            background-color:#F2D5B5;
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

        .question {
            width: 100%;
            height: auto;
            border-radius: 20px;
            padding: 20px;
            text-align: left;
            margin-top:2%;
            transition: max-height 0.3s ease;
        }

        .question h5 {
            font-weight: bold;
            color:#4F4842;
        }

        .paper {
            position: relative;
            line-height: 25px;
            width: 550px;
            height: 150px;
            background-color: white;
            margin: 0 auto;
            box-shadow: 0px 0px 3px 1px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, margin 0.3s;
        }

        .paper:before {
            content: "";
            position: absolute;
            height: 100%;
            width: 2px;
            background: rgba(255, 0, 0, 0.3);
            margin-left: 48px;
            z-index: 2;
        }

        .lines {
            overflow-y:scroll;
            top: 50px;
            position: relative;
            box-sizing: content-box;
            height: 100px;
            padding-right: 8px;
            padding-left: 56px;
            background-image: repeating-linear-gradient(
                white 0px,
                white 23.5px,
                steelblue 25px
            );

            ul {
                margin: 0;
            }
        }

        .holes {
            position: absolute;
            height: 100%;
            width: 48px;
            margin-top: 1px;
            margin-bottom: 1px;
            top: 0;
            left: 0;
        }

        .holes .hole {
            position: absolute;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: gainsboro;
            left: 12.5px;
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.2) inset;
        }

        .holes .hole:nth-child(1) {
            top: 20px;
        }

        .holes .hole:nth-child(2) {
            top: 100px;
        }

        .control-buttons {
            text-align: right;
            padding: 5px;
            margin-bottom:-55px;
        }

        .minbtn{
            background-color:#ADD8E6;
            color:white;
            border-radius:8px;
            font-weight:bold;
            font-size:24px;
            border:none;
        }

        #img-container{
            margin-left:2%;
            margin-top:2%;
            margin-left:2%;
            height: 50%;
            width: 100%;
            background: url('/images/boom/boom.svg') no-repeat center;
            background-size: contain;
            transition: background 0.5s;
            position: relative;
            z-index: 1;
        }

        #img-container.open{
            background: url('/images/boom/bag.svg') no-repeat center;
            background-size: contain;
        }

        .star{
            position: absolute;
            z-index: 5;
            width: 100%;
            height: 30%;
            top: 20%;
            left: 30%;
            transform: translateX(-50%);
            background: url('/images/boom/star.svg') no-repeat center;
            background-size: contain;
            animation: bounce 1.5s ease-in-out forwards;
        }

        @keyframes bounce {
            0% {
                transform: translateX(-50%) translateY(0);
            }
            30% {
                transform: translateX(-50%) translateY(-50px);
            }
            50% {
                transform: translateX(-50%) translateY(0);
            }
            70% {
                transform: translateX(-50%) translateY(-30px);
            }
            100% {
                transform: translateX(-50%) translateY(0);
            }
        }


        .container-code {
            overflow-y:scroll;
            height:70%;
            width: 94%;
            background-color: #f4f4f4;
            border-radius: 8px;
            margin-left:3%;
            margin-top:8%;
            
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
            margin-top:-20%;
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
                <p><strong>密碼解碼</strong><br><hr></p>
                <p>
                桃樂絲一行人要從蘋果怪樹林前往村莊的路途中，遇到了傳說中的詛咒的神廟，其內部隱藏著改變命運的錦囊；想要進入這座神廟的唯一方法是解開一道古老的謎題。這個謎題必須將一串神秘的數字倒敘排列，才會開啟神廟大門。桃樂絲一行人想要進去探險考古，請幫助他們打開神廟大門吧!
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
                    <a href="#" class="breadcrumbs__link__active">密碼解碼</a>
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
        <div class="row">
            <div class="col-md-6 left-container" id="left-container">
                <div class="question" id="question">
                    <h5>桃樂絲一行人在詛咒的神廟前遇到了古老的謎題。隨機生成一個三位數，並使用 while 迴圈逐一提取數字位，根據以下規則進行解碼。解碼後的三個數字相加就是神廟的密碼，幫助他們打開大門進行探險！</h5>
                </div>
                <div class="paper" id="paper">
                    <div class="control-buttons">
                        <button class="minbtn" onclick="toggleMinimize()">－</button>
                    </div>
                    <div class="lines" id="lines">
                        <strong>解碼規則</strong>
                        <ul>
                            <li>百位數字：
                                <ul>
                                    <li>如果百位數字是奇數，則將百位數*2</li>
                                    <li>如果百位數字是偶數，則將百位數/2 </li>
                                </ul>
                            </li>
                            <li>十位數字：
                                <ul>
                                    <li>如果十位數字是奇數，則將十位數/2</li>
                                    <li>如果十位數字是偶數，則將十位數*3</li>
                                </ul>
                            </li>
                            <li>個位數字：
                                <ul>
                                    <li>如果個位數字>=5，則將個位數-3</li>
                                    <li>如果個位數 < 5將，則將個位數+3</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="holes" id="holes">
                        <div class="hole"></div>
                        <div class="hole"></div>
                    </div>
                </div>
                <div class="img-container" id="img-container">
                    <!-- <img id="pot" src="/images/boom/boom.svg" alt="pot"> -->
                </div>
                    <button onclick="play()">測試動畫</button>
            </div>

                <div class="col-md-6 right-container" id="right-container">
                    <div  class="container-code" id="code">
<pre>
    public class Main {
        public static void main(String[] args) {
            int number = 456;
            int position = 1;
            int result = 0; 

            // 使用 while 迴圈將數字的每一位提取出來並進行處理
            while (<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">) {
                int digit = number % 10;

                if (<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">) { // 個位數字
                    if (<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">) {
                        result += (<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">);
                    } else {
                        result += (<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">);
                    }
                }
            }

            System.out.println("解碼後的密碼: " + result);
        }
    }
</pre>
                        <div class="btn-container">
                            <button id="send-code" class="btn-submit">提交</button>
                        </div>
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

        //最小化
        function toggleMinimize() {
            const paper = document.getElementById('paper');
            const lines = document.getElementById('lines');
            const holes = document.getElementById('holes');
            
            if (lines.style.display === 'none') {
                lines.style.display = 'block';
                paper.style.height = '150px';
                holes.style.display ='block';
                
            } else {
                lines.style.display = 'none';
                paper.style.height = '40px';
                holes.style.display ='none';
            }
        }

        // 動畫
        function play() {
            const apple = document.getElementById('img-container');
            apple.classList.add('open');

            const star = document.createElement('div');
            star.classList.add('star');
            apple.appendChild(star); // 放到container裡面
        }
    </script>
</body>

</html>