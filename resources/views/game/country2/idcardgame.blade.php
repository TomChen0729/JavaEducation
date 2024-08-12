<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>idcardgame</title>
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

        #seal{
            top: -100px; /* 蓋章動畫起始位置在畫面上方 */
            opacity: 0;
            /* top從-100px => 50px，opacity透明(0) => 不透明(1)，動畫持續0.5秒，速度曲線 => ease-in-out */
            transition: top 0.5s ease-in-out, opacity 0.5s ease-in-out;
            width: 100%;
            height: 250px;
            position: absolute;
            z-index: 10; /*最上層*/
        }

        #seal.show{
            top: 50px; /* 蓋章飛入後的位置 */
            opacity: 1;
        }

        #message{
            top: 40%;
            left: 30%;
            opacity: 0;
            position: absolute;
            padding: 20px;
            background-color: white;
            border: 3px solid green;
            border-radius: 10px;
            font-size: 72px;
            font-weight: bold;
            z-index: 8;
            transform: rotate(-10deg);
        }

        #message.open{
            opacity: 1;
        }
        
        #idcards{
            padding: 20px;
            position: relative;
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
                    <a href="#" class="breadcrumbs__link__active">魔法門衛</a>
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
                    <p>用 if...else 判斷是否允許進入村莊，並且印出:<br>怪物:禁止進入；其他:免費進入。</p>
                </div>
                <div id="idcard">
                    <img class="img" id="seal" src="/images/idcard/idcardseal.svg" alt="">
                    <div id="message"></div> <!-- 動畫顯示文字 -->
                    <img class="img" id="idcards" src="/images/idcard/villageridcard.svg" alt="">
                </div>
                <button onclick="playStamp()">測試蓋章動畫</button>
            </div>
            <div class="col-md-6 right-container">
                <div class="code-container">
<pre>
public class StarPatterns {
    public static void main(String[] args) {

        String x = "?"; // 身分


        if (x == "<input type="text" id="vInit" placeholder="____" oninput="autoResize(this)">") {
            System.out.print("<input type="text" id="fInit" placeholder="____" oninput="autoResize(this)">");
        }

        else {
            System.out.print("<input type="text" id="nInit" placeholder="____" oninput="autoResize(this)">");
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

        // DOMContentLoaded事件在文件的HTML被完全載入和解析後觸發(不必等待樣式表、圖像和子框架的完成加載)
        document.addEventListener('DOMContentLoaded', function(){
            // 隨機更換身分證
            const img = [
                '/images/idcard/monsteridcard.svg',
                '/images/idcard/outsideridcard.svg',
                '/images/idcard/villageridcard.svg'
            ];

            // 依據隨機身分證顯示文字
            const messages = {
                '/images/idcard/monsteridcard.svg': { text: '禁止進入', color: 'red' , border: '5px solid red'},
                '/images/idcard/outsideridcard.svg': { text: '免費進入', color: 'green' , border: '5px solid green'},
                '/images/idcard/villageridcard.svg': { text: '免費進入', color: 'green' , border: '5px solid green'}
            };

            function getRandom() {
                const randomIndex = Math.floor(Math.random() * img.length);
                // [randomIndex]返回數字，不是返回函數，返回函數的寫法 => img[randomIndex]();
                return img[randomIndex];
            }

            function change() {
                const imgElement = document.getElementById('idcards');
                const messageElement = document.getElementById('message');
                // 隨機身分證 => [0][1][2]
                const selectedImg = getRandom();
                // 更改身分證圖片
                imgElement.src = selectedImg;
                // 用身分證圖片顯示對應文字顏色邊框
                const messageData = messages[selectedImg];
                messageElement.textContent = messageData.text;
                messageElement.style.color = messageData.color;
                messageElement.style.border = messageData.border;
            }

            // 變換身分證
            change();

        });

        // 蓋章動畫
        function playStamp() {
            const sealElement = document.getElementById('seal');
            const messageElement = document.getElementById('message');

            // 開始動畫
            sealElement.classList.add('show');

            // 完成動畫，新增文字，移除印章
            setTimeout(() => {

                messageElement.classList.add('open');
                sealElement.classList.remove('show');
                
            }, 500); // 預設動畫持續1秒
        }

    </script>
</body>

</html>