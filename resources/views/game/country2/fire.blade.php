<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>滅火任務</title>
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
            background-color:#F4D9D0;
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
            background: rgba(199,91,122, 0.8);
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
            color: #921A40;
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

        .container-fluid {
            margin-top: 2%;
            padding-left: 2%;
            padding-right: 2%;
        }


        .question {
            width: 100%;
            height: auto;
            font-size: 20px;
            line-height: 30px;
            font-weight: bold;
            border: 4px solid #921A40;
            padding: 15px;
            border-radius: 10px;
            background-color: #D9ABAB;
            position: relative;
            box-shadow: inset 0px 0px 0px 3px #C75B7A;
            color: black;
        }

        .question p {
            font-size: 25px;
            font-weight: bold;
        }

        .firebg{
            background-image: url('/images/fire/firebg.svg');
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
            margin-top:3%;
            position: relative;
        }

        .fireman{
            margin-bottom:-2%;
        }

        .control-buttons {
            text-align: right;
            padding: 5px;
            margin-bottom:-55px;
        }

        .minbtn{
            background-color:red;
            color:white;
            border-radius:8px;
            font-weight:bold;
            font-size:24px;
            border:none;
        }

        .excode-container {
            width:100%;
            height:25%;
            margin-bottom:5%;
            overflow-y:scroll;
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            padding:5px 0px 0px 40px;
        }

        .code-container {
            width:100%;
            height:35%;
            overflow-y:scroll;
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            padding:0px 0px 0px 40px;
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
            margin: 0 20px;
            border-radius: 5px;
            margin-top:20px;
            background-color:red;
            color:white;
            border-radius:8px;
            font-weight:bold;
            font-size:24px;
            border:none;
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
                <p><strong>滅火任務</strong><br><hr></p>
                <p>
                壞女巫逃走後，火勢卻沒有熄滅，錫人自告奮用要幫忙滅火，但他忘記他是用油灌澆注的燃燒體，他直接被火燒了好久；請冒險者幫忙錫人滅火，並順勢撲滅錫人身上的火!!
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
                    <a href="#" class="breadcrumbs__link__active">滅火任務</a>
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
                    <p>壞女巫逃走後，火勢仍然肆虐，錫人因為身上充滿油而燒得更加猛烈，這讓他們無法繼續前進，請幫助錫人撲滅火焰。目前while 迴圈使用的是水屬性滅火器，但這只能在條件成立(water>0)時才執行。如果一開始條件不滿足，可能無法啟動滅火過程。然而，do…while迴圈的乾粉滅火器必須至少執行一次才能有效對付油引起的火勢。因此，你需要將 while 迴圈改為 do…while 迴圈，這樣即便條件不滿足，也能確保滅火操作先執行一次，從而徹底撲滅火焰，拯救錫人!</p>
                </div>
                <div class="firebg">
                    <div class="fire"></div>
                        <img class="fireman" src="/images/fire/fireman.svg" alt="">
                    </div>
                <button onclick="play()">測試按鈕</button>
            </div>
            <div class="col-md-6 right-container">
                <div class="excode-container" id="excode-container">
                    <div class="control-buttons">
                        <button class="minbtn" onclick="toggleMinimize()">－</button>
                    </div>
<pre>
public class Main {
    public static void main(String[] args) {
        boolean fire = true;
        int water = 10;

        while(water > 0) {
            water--;
            if(water == 0) {
                fire = false;
            }
        }
    }
}
</pre>
                </div>
                <div class="code-container" id="code-container">
<pre>
<pre>
public class Main {
    public static void main(String[] args) {
        boolean fire = true;
        int water = 10;

        do {
            <input type="text" id="iInit" placeholder="" oninput="autoResize(this)">;
            if(<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">) {
                fire = false;
            }
        } while(<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">);
    }
}
</pre>
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
            const paper = document.getElementById('excode-container');
            const codeContent = paper.querySelector('pre');
            const codeContainer = document.querySelector('.code-container');
            
            if (codeContent.style.display === 'none') {
                codeContent.style.display = 'block';
                paper.style.height = '30%'; 
                codeContainer.style.height = '35%';
            } else {
                codeContent.style.display = 'none';
                paper.style.height = '6%';
                codeContainer.style.height = 'auto';
            }
        }
    </script>
</body>

</html>