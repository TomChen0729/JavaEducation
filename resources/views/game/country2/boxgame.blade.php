<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>boxgame</title>
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
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 6%;
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
            background: #323232;
            border-radius: 50px;
            width: 50%;
            z-index: 1;
            padding: 20px;
            box-sizing: border-box;
        }

        .first .pop {
            color: #f3bb66;
            margin: 30px;
            padding: 30px;
            height: 100%;
            border-radius: 50px;
            border: 5px solid #e28639;
        }

        .first .pop h1 {
            text-align: center;
            font-size: 50px;
            font-weight: bolder;
            margin-bottom: 30px;
        }

        .first .pop p strong {
            font-size: 24px;
        }

        .first .pop p hr {
            margin: 10px 0;
        }

        .first p{
            font-size: 20px;
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
            padding: 20px 2% 0px;
            background: rgba(186,189,205, 0.8);
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
            color: #3E5D53;
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

        .container-fluid{
            margin-top: 2%;
        }

        .question {
            width: 100%;
            height: 120px;
            background-color: #FFFDD3;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
        }

        .question p {
            font-size: 25px;
            font-weight: bold;
        }

        #treasure-box {
            margin-top: 10px;
            width: 100%;
            height: 400px;
            background: url('/images/boxes/closebox1.svg') no-repeat center;
            transition: background 0.5s;
        }

        .star{
            white-space: pre; /* 保留空格和換行 */
            font-family: monospace; /* 使用等寬字體 */
            font-size: 14px;
            width: 150px;
            height: 200px;
            position: relative;
            top: 68%;  
            left: 52%;
            transform: translate(-45%, -40%);
        }

        .star.open{
            text-shadow: 0 0 0.2em white, 0 0 0.2em white, 0 0 0.2em white;
            transform: translate(-60%, -10%);
        }

        #treasure-box.open {
            background: url('/images/boxes/openbox1.svg') no-repeat center;
            width: 100%;
            height: 500px;
            background-size: contain;
        }

        .textarea-container {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .code-container {
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
        }

        pre{
            font-size: 20px;
        }

        input {
            width: 80px;
            text-align: center;
            transition: width 0.2s ease;
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-container button {
            font-size: 18px;
            margin: 0 20px;
            border-radius: 5px;
            margin-top:20px;
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
                <p><strong>{{ $boxGameQuestion -> gamename }}</strong><br><hr></p>
                <p>
                    {{ $boxGameQuestion -> game_explanation }}
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
                    <a href="#" class="breadcrumbs__link__active">解鎖寶箱</a>
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
            <div class="col-md-6 left-container">
                <div class="question">
                    <p>{{ $boxGameQuestion -> questions }}</p>
                </div>
                <div id="treasure-box">
                    <!-- <img class="img" id="randomImg" src="/images/boxes/triangle.png" alt=""> -->
                    <div id="star" class="star"></div>
                </div>
                <button onclick="openBox()">打開寶箱</button>
            </div>
            <div class="col-md-6 right-container">
                <div class="code-container">
<pre>
{!! $templateCode !!}
</pre>
                </div>
                <div class="btn-container">
                    <button id="send-code" class="btn-submit">提交</button>
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

        var shape = '{{ $boxGameQuestion -> shape }}';
        function triangle1() {
            let n = {{ $variable }};
            let result = ""; // 初始化 result

            for(let i = n;i >= 1;i--){
                let star = "";

                for(let j = 1;j <= 2 * i - 1; j++){
                    star += "*";
                }

                result += star + "\n"; // 將一行星號加到 result
            }
            // 使用result一次更新DOM直接展示，而不是分段更新展示
            document.getElementById('star').innerText = result;
        }

        function triangle2() {
            let n = {{ $variable }};
            let result = ""; // 初始化 result

            for(let i = 1;i <= n;i++){
                let star = "";

                for(let j = 1;j <= 2 * i - 1; j++){
                    star += "*";
                }

                result += star + "\n"; // 將一行星號加到 result
            }
            // 使用result一次更新DOM直接展示，而不是分段更新展示
            document.getElementById('star').innerText = result;
        }

        function triangle3() {
            let n = {{ $variable }};
            let result = ""; // 初始化 result

            for(let i = 1; i <= n; i++){
                let star = "";

                for(let j = 1; j <= n - i; j++){
                    star += " ";
                }

                for(let j = 1; j <= 2 * i - 1; j++){
                    star += "*";
                }

                result += star + "\n"; // 將一行星號加到 result
            }
            // 使用result一次更新DOM直接展示，而不是分段更新展示
            document.getElementById('star').innerText = result;
        }

        function triangle4() {
            let n = {{ $variable }};
            let result = ""; // 初始化 result

            for(let i = n; i >= 1; i--){
                let star = "";

                for(let j = 1; j <= n - i; j++){
                    star += " ";
                }

                for(let j = 1; j <= 2 * i - 1; j++){
                    star += "*";
                }

                result += star + "\n"; // 將一行星號加到 result
            }
            // 使用result一次更新DOM直接展示，而不是分段更新展示
            document.getElementById('star').innerText = result;
        }

        // 呼叫目前題目，判斷三角形種類，呼叫triangle1~4
        document.addEventListener('DOMContentLoaded', function () {
            switch ( shape ) {
                case '倒序排列':
                    triangle1();
                    break;
                case '正序排列':
                    triangle2();
                    break;
                case '金字塔':
                    triangle3();
                    break;
                case '倒金字塔':
                    triangle4();
                    break;
                default:
                    break;
            }
        });

        // 點擊送出按鈕時讀取六個input中的值，並存放置陣列中
        var submitBtn = document.getElementById('send-code');
        submitBtn.addEventListener('click', function() {
            let inputsArray = [];

            // 使用querySelectorAll選取所有type = "text"的input
            const inputs = document.querySelectorAll('input[type="text"]');

            // 迴圈遍歷每個input，將值加入陣列
            inputs.forEach(input => {
                inputsArray.push(input.value);
            });
            
        });

        // 開啟寶箱動畫
        function openBox() {
            const box = document.getElementById("treasure-box");
            box.classList.add("open");

            const stars = document.getElementById("star");
            stars.classList.add("open");

            // const imgElement = document.getElementById("randomImg");
            // imgElement.style.display = 'none'; 
        }

        function autoResize(input) {
            const currentWidth = input.offsetWidth;//現在的寬度
            const newWidth = input.scrollWidth;//新寬度

            if (newWidth > currentWidth) {
                input.style.width = newWidth + 'px';  // 新寬度>現在寬度就增加寬度
            }
            else{
                input.style.width = 80 + 'px' ;  
            }
        }
    </script>
</body>

</html>