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
            height: 100px;
            background-color: #FFFDD3;
            border-radius: 20px;
            padding: 20px;
            text-align: center;
        }

        .question p {
            font-size: 20px;
            font-weight: bold;
        }
        #treasure-box {
            margin: 0;
            padding: 0;
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
            transform: translate(-55%, -10%);
        }
        #treasure-box.open {
            background: url('/images/boxes/openbox1.svg') no-repeat center;
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
                    <p>要打開寶箱，必須讓 * 填滿三角形鎖頭<br>請在右方程式碼區，使用巢狀for迴圈來解鎖寶箱</p>
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
public class StarPatterns {
    public static void main(String[] args) {
        int n = 3; // 階層

        for (<input type="text" id="iInit" placeholder="____" oninput="autoResize(this)">;<input type="text" id="iScope" placeholder="____" oninput="autoResize(this)">;<input type="text" id="iUpdate" placeholder="____" oninput="autoResize(this)">) {
            for (<input type="text" id="jInit" placeholder="____" oninput="autoResize(this)">;<input type="text" id="jScope" placeholder="____" oninput="autoResize(this)">;<input type="text" id="jUpdate" placeholder="____" oninput="autoResize(this)">) {
                System.out.print("*");
            }
            System.out.println();
        }
    }
}
</pre>
                </div>
                <div class="btn-container">
                    <button id="send-code" class="btn-submit">提交</button>
                    
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script>
        // DOMContentLoaded事件在文件的HTML被完全載入和解析後觸發，而不必等待樣式表、圖像和子框架的完成加載
        // document.addEventListener('DOMContentLoaded', function() {
        //     const images = [
        //         '/images/boxes/triangle.png',
        //         '/images/boxes/left-triangle.png',
        //         '/images/boxes/right-triangle.png',
        //         '/images/boxes/shape.png'
        //     ];

        //     function getRandomImg() {
        //         返回0~4之間，不包含4的隨機數，Math.floor()向下取整數，image.length = 4
        //         const randomIndex = Math.floor(Math.random() * images.length);
        //         return images[randomIndex];
        //     }

        //     function changeImg() {
        //         const imgElement = document.getElementById('randomImg');
        //         imgElement.src = getRandomImg();
        //     }

        //     變換三角形
        //     changeImg();
        // });

        function triangle1() {
            let n = 7;
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

        function triangle2() {
            let n = 7;
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
            let n = 7;
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

        function triangle4() {
            let n = 7;
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

        // 隨機調用triangle1~4
        function randomTriangle() {
            const triangle = [triangle1, triangle2, triangle3, triangle4];
            const randomIndex = Math.floor(Math.random() * triangle.length);
            triangle[randomIndex]();
        }

        // 加載頁面後執行
        document.addEventListener('DOMContentLoaded', function () {
            randomTriangle();
        });

        function openBox() {
            const box = document.getElementById("treasure-box");
            box.classList.add("open");

            const stars = document.getElementById("star");
            stars.classList.add("open");

            // const imgElement = document.getElementById("randomImg");
            // imgElement.style.display = 'none'; 
        }

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
            input.style.width = input.scrollWidth + 'px'; // 方框隨著輸入的文字增加變大
        }
    </script>
</body>

</html>