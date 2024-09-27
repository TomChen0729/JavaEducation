<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>魔林解密</title>
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
            background: rgb(82, 109, 130, 0.8);
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
            color: #001F3F;
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
            background-color:#9DB2BF;
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

        .box {
            background-color: rgba(221, 230, 237, 0.5);
            width: 80%;
            padding: 5px;
            border: 2px solid rgba(0, 0, 0, 0.5);
        }

        .box:before, 
        .box:after {
            content: "•";
            position: absolute;
            width: 14px;
            height: 14px;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(0, 0, 0, 0.5);
            line-height: 12px;
            top: 5px;
            text-align: center;
        }

        .box:before {
            left: 11%;
            top:11.3%;
        }

        .box:after {
            right: 11%;
            top:11.3%;
        }

        .box .box-inner {
            position: relative;
            border: 2px solid rgba(0, 0, 0, 0.5);
            padding: 40px;
        }

        .box .box-inner:before, 
        .box .box-inner:after {
            content: "•";
            position: absolute;
            width: 14px;
            height: 14px;
            font-size: 14px;
            color: rgba(0, 0, 0, 0.5);
            border: 2px solid rgba(0, 0, 0, 0.5);
            line-height: 12px;
            bottom: -2px;
            text-align: center;
        }

        .box .box-inner:before {
            left: -2px;
        }

        .box .box-inner:after {
            right: -2px;
        }

        .box p{
            font-size:20px;
            font-weight:bold;
        }

        
        .img-container{
            margin-left:2%;
            border: 1px solid black;
        }

        .container-code {
            overflow-y:scroll;
            height:70%;
            width: 94%;
            background-color: #f4f4f4;
            border-radius: 8px;
            margin-left:3%;
            
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
                <p><strong>魔林解密</strong><br><hr></p>
                <p>
                繼續往前，桃樂絲一行人迎面遇上了一位神秘的南國魔法師，擋在蘋果怪樹林的入口處。魔法師告訴他們：“在林中，有一段路徑被一群蘋果怪所守護。這些怪物並不會輕易讓路，除非你能找到一個規律。只有當你們找到這些數字，怪物才會允許你們通過。” 請幫助桃樂絲完成任務，讓他們能安全通過蘋果怪樹林！
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
                    <a href="#" class="breadcrumbs__link__active">魔林解密</a>
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
            <div class="box">
                <div class="box-inner">
                    <p>在蘋果怪樹林深處，魔法師施展了一個神秘的咒語，隨機選出了一個基準數字作為通行的關鍵。接著，又產生了一個特殊數字，作為森林守護者的試煉。你必須在這兩個數字之間，找出符合特定範圍的質數，才能破解魔林的謎題，幫助桃樂絲一行人繼續前進！</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 left-container" id="left-container">
                <div class="img-container" id="img-container">
                    <img id="apple" src="/images/apple/badapple.svg" alt="apple">
                </div>
                    <button onclick="play()">測試動畫</button>
            </div>

                <div class="col-md-6 right-container" id="right-container">
                    <div  class="container-code" id="code">
<pre>
    public class Main {
        public static void main(String[] args) {
            int n = 83;
            int a = 37;

            for(<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">;<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">;<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">) {
                boolean isPrime = true; // 假設 i 是質數

                for(<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">;<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">;<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">)
                {
                    if(<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">)
                    {
                        // 如果可以被整除，i 不是質數
                        isPrime = false;
                        break; // 不需要繼續檢查
                    }
                }
                // 如果是質數並且小於 a，則印出
                if(<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">) {
                    System.out.printf("%d\t", i);
                }
            }
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
    </script>
</body>

</html>