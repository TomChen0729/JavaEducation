<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>通關密碼</title>
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
            background: rgba(186, 189, 205, 0.8);
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
            color: #3E5D53;
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

        .containers {
            overflow: visible;
            margin-top: 2%;
            position: relative;
            transition: transform 0.5s ease-in-out;
            z-index: 1;
        }

        .left-container {
            position: absolute;
            width: 50%;
            height: 100%;
            top: 0;
            transition: transform 0.5s ease-in-out;
            left: 0;
        }

        .right-container {
            position: absolute;
            width: 50%;
            height: 100%;
            top: 0;
            transition: transform 0.5s ease-in-out;
            right: 0;
        }

        .left-container button {
            position: absolute;
            top: 55%;   
            left: 22%;  
            transform: translate(-50%, -50%); 
        }

        .right-container button {
            position: absolute;
            top: 52%;   
            right: 23%; 
            transform: translate(50%, 50%); 
        }

        .move-left {
            transform: translateX(20%);
        }

        .move-right {
            transform: translateX(-50%);
        }

        .code-container {
            background-color: #f4f4f4;
            border-radius: 8px;
            top: 50%;
            right: 0;
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
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-container button {
            font-size: 18px;
            margin: 0 20px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .question {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #f3bb66;
            border-radius: 30px;
            font-size: 25px;
            font-weight: bold;
            padding: 20px;
            z-index: 3;
        }

        .right,
        .left {
            display: none; 
        }

        .paper{
            left: 0;
            border: 5px solid gray;
        }

        .row{
            width: 100%;
        }

        .images {
            position: relative;
            height: 100%;
        }

        img {
            height: 750px;
        }

        .left {
            position: absolute;
            left:100px;
        }

        .right {
            position: absolute;
            right:180px;
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
                <p><strong>{{ $passwordGameQuestion -> gamename }}</strong><br><hr></p>
                <p>
                    {{ $passwordGameQuestion -> game_explanation }}
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
                    <a href="#" class="breadcrumbs__link__active">通關密碼</a>
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

    <div class="left">
        <div class="paper">
            <h1>PASSWROD</h1>
            <p>密碼：{{ $variable }}</p>
        </div>
    </div>

    <div class="containers">
        <div class="question">
            <p>{{ $passwordGameQuestion -> questions }}</p>
        </div>
        <div class="row">
            <div class="col-md-12 images">
                <img src="/images/password/closedoor.svg" alt="緊閉的大門">
            </div>
            <div class="col-md-6 left-container">
                <button type="button" class="btn btn-success" id="passwordPaperBtn">密碼紙</button>
            </div>
            <div class="col-md-6 right-container">
                <button type="button" class="btn btn-info" id="codeLockBtn">程式密碼鎖</button>
            </div>
        </div>
    </div>

    <div class="right">
        <div class="code-container">
<pre>
{!! $templateCode !!}
</pre>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        // 畫面載入後顯示彈跳視窗
        function togglePopup1() {
            document.getElementById("popup").classList.toggle("active");
        }

        // 平移動畫
        document.getElementById('passwordPaperBtn').addEventListener('click', function() {
            const container = document.querySelector('.containers');
            const leftDiv = document.querySelector('.left');

            if (container.classList.contains('move-left')) {
                container.classList.remove('move-left');
                leftDiv.style.display = 'none'; 
            } else {
                container.classList.add('move-left');
                container.classList.remove('move-right');
                leftDiv.style.display = 'block'; 
            }
        });

        document.getElementById('codeLockBtn').addEventListener('click', function() {
            const container = document.querySelector('.containers');
            const rightDiv = document.querySelector('.right');

            if (container.classList.contains('move-right')) {
                container.classList.remove('move-right');
                rightDiv.style.display = 'none';
            } else {
                container.classList.add('move-right');
                container.classList.remove('move-left');
                rightDiv.style.display = 'block'; 
            }
        });



        /* 弄一個codeMirror出來，設定佈景、語言模式
        var editor = CodeMirror.fromTextArea(document.getElementById("code-editor"), {
            lineNumbers: true,
            mode: "text/x-java",
            theme: "base16-dark"
        });*/

        // 移除註解及移除後的空白段落
        function removeCommentsAndEmptyLines(code) {
            // 利用正規表達式移除註解
            let noComments = code.replace(/\/\/.*/g, '').trim();
            // 移除空行
            let noEmptyLines = noComments.split('\n').filter(line => line.trim() !== '').join('\n');
            return noEmptyLines;
        }

        var submitBtn = document.getElementById('send-code');
        // 框架code
        var templateCode = `for(){
            for(){
            }
            for(){
            }
        }`;
        submitBtn.addEventListener('click', () => {
            // 獲取編輯器內文字，在"// 程式撰寫區域"之後的值並將其分開，取目標code，並去空白
            var userCode = editor.getValue().split('// 程式撰寫區域')[1].trim();
            if (userCode) {
                // 執行剛剛移除註解的函式之後再將最外面的兩個大括號去除，就是我要判讀的code
                var cleanedCode = removeCommentsAndEmptyLines(userCode).replace('\n    }\n}', '').trim();
                if (cleanedCode && cleanedCode !== templateCode.trim()) {
                    // 測試用
                    // alert(templateCode.trim());
                    alert('您輸入的code為：\n' + cleanedCode);
                    // 將程式碼送入演算法，或是後端的判斷，如果success，顯現相應的效果，並執行通關
                    // 跑fetch進後端
                    fetch('/api/receive-usercode',{
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ 
                            userCode: cleanedCode 
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        if(data.message === 'OK'){
                            alert('答對');
                        }
                    })


                } else {
                    alert('請輸入程式碼');
                }
            } else {
                alert('請輸入程式碼');
            }
        });

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