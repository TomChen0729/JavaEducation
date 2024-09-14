<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>調配藥水</title>
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

        .container-fluid {
            width:100%;
            overflow: visible;
            margin-top: 2%;
            position: relative;
            transition: transform 0.5s ease-in-out;
            z-index: 1;
            height:100vh;
        }

        .row {
            height:100%;
        }

        .left-container {
            background-color:#BFBDA0;
        }

        .question {
            width: 100%;
            height: auto;
            border-radius: 20px;
            padding: 20px;
            text-align: left;
            margin-top:5%;
            margin-bottom:-10%;
            transition: max-height 0.3s ease;
        }

        .question h5 {
            font-weight: bold;
            color:white;
        }

        .team {
            padding: 2em 0 2em 2.5em;
            margin: 0;
            margin-top:-5%;
        }

        .member {
            margin: 1.5em 0 0.5em;
            padding: 0.73em;
            background: linear-gradient(
                83deg,
                var(--yellow) 0 97%,
                #fff0 calc(97% + 1px) 100%
            );
            position: relative;
            list-style: none;
            display: inline-block;
            transform: scale(0.85);
        }

        .thumb {
            width: 13vmin;
            height: 13vmin;
            float: left;
            margin-right: 1.25em;
            background: linear-gradient(
                var(--deg),
                var(--dark) 0 70%,
                var(--yellow) 0% 100%
            );
            transform: rotate(-4deg);
            border-radius: 0.25em;
            overflow: hidden;
            margin-left: -3em;
            padding: 0.5em;
        }

        .thumb img {
            width: 100%;
            height: 100%;
            border-radius: 0.25em;
            filter: grayscale(1);
            background: var(--dark);
        }

        .member:hover {
            transform: scale(1);
            filter: drop-shadow(0px 20px 10px #0008);
        }

        .member:hover .thumb {
            padding: 0.1em;
            transform: rotate(-1deg);
            --deg: -89deg;
        }

        .member:hover .thumb img {
            filter: none;
        }

        .description h3 {
            font-weight:bold;
        }

        .description p {
            font-size:20px;
            padding: 0 2em;
            margin-bottom: 1em;
        }

        .container-code {
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
            right: 60px;
            bottom: 80px;
        }

        .btn-submit{
            background-color:red;
            width:80px;
            height:35px;
            border:none;
            color:white;
            border-radius: 5px;

        }

        .right-container {
            background-color:#5F5F5F;
            display: flex;
            justify-content: center;  
            align-items: center; 
            height: auto;             
        }

        #img-container {
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #img-container img {
            width: 500px;
            height: auto; 
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
                <p><strong>調配藥水</strong><br><hr></p>
                <p>
                    桃樂絲一行人從蠻金之國到蘋果樹林這都沒有涉入食物，過度飢餓導致無力繼續前進，請幫助他們調配出治癒藥水，能夠回復體力並不會再度飢餓

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
                    <a href="#" class="breadcrumbs__link__active">調配藥水</a>
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
                <div class="question" id="question">
                <h5>桃樂絲一行人過度飢餓，無法繼續前進。你需要幫助他們隨機獲得一個藥水配方，並使用 if 條件語句成功調製治癒藥水。</h5>
                    <ul class="team">
                        <li class="member co-funder">
                            <div class="thumb"><img src="/images/potion/heal.svg"></div>
                            <div class="description">
                                <h3>配方表</h3>
                                <p>材料一 (material1) 需大於等於 20 且小於 50，並且材料二(material2) 小於 30。</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div  class="container-code" id="code">
<pre>
public class Main {
    public static void main(String[] args) {
        int material1 = 30;
        int material2 = 20;

        // 判斷治癒藥水的配方條件
        if (<input type="text" id="iInit" placeholder="" oninput="autoResize(this)">) {
            System.out.println("治癒藥水的配方條件成立。");
        }
    }
}
</pre>
                    <div class="btn-container">
                        <button id="send-code" class="btn-submit">提交</button>
                    </div>
                </div>
            </div>

                <div class="col-md-6 right-container">
                    <div id="img-container">
                        <img src="/images/potion/pot.svg" alt="pot">
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

        function toggleMinimize() {
            const question = document.getElementById('question');
            question.classList.toggle('minimized'); // 切換最小化
        }
    </script>
</body>

</html>