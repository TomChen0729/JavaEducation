<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>命運試煉</title>
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
            padding-top: 6%;
            background-color: #EDF1D6;
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

        .first p {
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
            background: rgba(157, 192, 139, 0.8);
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
            color: #40513B;
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
            padding: 40px;
            background-color: #e5ffb3;
            border: 5px solid #bde66e;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .question::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            right: -10px;
            bottom: -10px;
            border: 3px dashed #dbf8a3;
            border-radius: 15px;
            pointer-events: none;
        }

        .question p {
            font-size: 25px;
            font-weight: bold;
        }

        .fightbg {
            background-image: url('/images/fight/fightbg.svg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin-top: 3%;
        }

        .control-buttons {
            text-align: right;
            padding: 5px;
            margin-bottom: -55px;
        }

        .minbtn {
            background-color: red;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            font-size: 24px;
            border: none;
        }

        .excode-container {
            width: 100%;
            height: 25%;
            margin-bottom: 5%;
            overflow-y: scroll;
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            padding: 5px 0px 0px 40px;
            overflow-x: auto;
        }

        .excode-container pre {
            font-size: 1.25em;
            display: inline-block;
            white-space: pre;
            margin: 0;
            padding: 10px;
        }

        .code-container {
            overflow-y:hidden;
            width: 100%;
            height: 35%;
            background-color: #f4f4f4;
            padding: 15px;
            border-radius: 8px;
            padding: 0px 0px 0px 40px;
        }

        .code-container pre {
            font-size: 1.25em;
            margin-bottom:-6.5%;
            overflow-y: scroll;
            height: 100%;
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
            margin-top: 20px;
            background-color: red;
            color: white;
            border-radius: 8px;
            font-weight: bold;
            font-size: 24px;
            border: none;
        }

        .character {
            position: absolute;
        }

        .weapon {
            top: 55%;
            left: 30%;
            transform: rotate(45deg);
            opacity: 0;
            /* 初始不可見 */
            position: relative;
        }

        /* 武器動畫 */
        @keyframes animate {
            0% {
                top: 55%;
                left: 30%;
                transform: rotate(45deg);
            }

            100% {
                top: -20%;
                left: 0;
                transform: rotate(-45deg);
            }
        }

        .weapon.show {
            animation: animate 1s ease-in-out;
            opacity: 1;
            /* 直接顯示 */
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
                padding-top: 4%;
            }

            .navbar a {
                font-size: 16px;
                padding: 5px 10px;
                margin: 0px 15px;
            }

            .question {
                font-size: 16px;
                padding: 25px;
            }

            .breadcrumbs {
                font-size: 16px;
                letter-spacing: 2px;
            }

            

            .btn-container button {
                font-size: 18px;
                margin: 0 5px;
            }

            .container-fluid {
                padding-left: 2%;
                padding-right: 2%;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            body {
                flex-direction: column;
                padding-top: 5%;
            }

            .navbar a {
                font-size: 18px;
                padding: 8px 16px;
            }

            .question {
                font-size: 18px;
                padding: 35px;
            }

            .breadcrumbs {
                font-size: 20px;
                letter-spacing: 3px;
            }

            .btn-container button {
                font-size: 22px;
                margin: 0 10px;
            }
        }

        @media (min-width: 1025px) {
            .container-fluid {
                padding-left: 4%;
                padding-right: 4%;
            }

            .navbar a {
                font-size: 22px;
                padding: 10px 20px;
            }

            .question {
                font-size: 22px;
                padding: 50px;
            }
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
                <p><strong>{{ $fightQuestion -> gamename }}</strong><br>
                    <hr>
                </p>
                <p>
                    {{ $fightQuestion -> pre_story }}
                </p>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="row">
            <ul class="col-ms-8 breadcrumbs">
                <li class="breadcrumbs__item">
                    <a href="{{ route('welcome') }}" class="breadcrumbs__link">綠野仙蹤</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="{{ route('country.index', ['country_id' => $fightQuestion->country_id]) }}" class="breadcrumbs__link">遊戲種類</a>
                </li>
                <li class="breadcrumbs__item">
                    <a href="#" class="breadcrumbs__link__active">命運試煉</a>
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
                    <p>{{ $fightQuestion -> game_explanation}}</p>
                </div>
                <div class="fightbg">
                    <div class="fight"></div>
                    <img class="character" id="character" src="/images/fight/witch.svg" alt="">
                    <img class="weapon" id="weapon" src="/images/fight/sword.svg" alt="">
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
        // 假設敵人類型和來自題目說明(變數)
        int enemyType = "魔女";

        if (enemyType == "魔女") { 
            System.out.println("魔女很弱，繼續進攻！");
        } else if (enemyType == "巨人") { 
            System.out.println("巨人很危險，考慮防禦！");
        } else if (enemyType == "龍") { 
            System.out.println("龍打不出傷害，尋求援助！");
        } else {
            System.out.println("未知敵人，請勿輕舉妄動！");
        }

    }
}
</pre>
                </div>
                <div class="code-container" id="code-container">
                    
{!! $templateCode !!}

                </div>
                <div class="btn-container">
                    <button id="send-code" class="btn-submit">提交</button>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script>
        var parameter_id = parseInt('{{ $fightQuestion->id }}');
        console.log('parameter_id:' + parameter_id);
        // 畫面載入後顯示彈跳視窗
        function togglePopup1() {
            document.getElementById("popup").classList.toggle("active");
        }

        // 等題目跟答案從資料庫提取出來再修正獲取的來源，跟寶箱遊戲一樣
        function witch() {
            const img = document.getElementById('character');
            img.src = '/images/fight/witch.svg';
        }

        function giant() {
            const img = document.getElementById('character');
            img.src = '/images/fight/giant.svg';
        }

        function dragon() {
            const img = document.getElementById('character');
            img.src = '/images/fight/dragon.svg';
        }

        // 一開始進入時，呼叫需要攻擊的角色
        // document.addEventListener('DOMContentLoaded', function{

        // });

        // 按下按鈕後立即顯示武器並開始動畫
        function play() {
            const weaponElement = document.getElementById('weapon');
            weaponElement.classList.add('show');

            // 重置動畫
            setTimeout(() => {
                weaponElement.classList.remove('show');
            }, 1000); // 1秒後重置動畫
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
                paper.style.height = '20%';
                codeContainer.style.height = '35%';
            } else {
                codeContent.style.display = 'none';
                paper.style.height = '6%';
                codeContainer.style.height = '80%';
            }
        }
        // 點擊送出按鈕時讀取input中的值，並存放置陣列中
        var submitBtn = document.getElementById('send-code');
        submitBtn.addEventListener('click', function() {
            let inputsArray = [];
            // 使用querySelectorAll選取所有type = "text"的input
            const inputs = document.querySelectorAll('input[type="text"]');
            let index = 0;
            let allFilled = true; // 用來檢查是否所有input都有填值
            // 迴圈遍歷每個input，將值加入陣列
            inputs.forEach(input => {
                index++;
                if (input.value.trim() === '') {
                    allFilled = false; // 如果有一個input的值是空的，將allFilled設為false
                }
                inputsArray.push({
                    order: index,
                    userAnswer: input.value
                });
                console.log('填寫的第' + index + '答案為' + input.value)
            });

            if (!allFilled) {
                alert('你還有空格未填入答案');
                return; // 如果有未填的答案，則不進入fetch
            }

            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            userAnswer = inputsArray;
            console.log(userAnswer);
            url = '/api/checkUserAnswer';
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        userAnswer: userAnswer,
                        parameter_id: parameter_id,
                        currentUser: parseInt('{{ auth()->user()->id }}')
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message == 'correct') {
                        alert('答對');
                    } else if (data.message == 'wrongAns') {
                        console.log(data.wrongIndex);
                    } else if (data.message == 'Null') {
                        alert('請填入答案');
                    } else {
                        alert('答錯');
                    }
                })

        });
        var userAnswersandOrder = <?php echo json_encode(!empty($userAnswers) ? $userAnswers : []); ?>;
        console.log('正確答案：', userAnswersandOrder);
        if (userAnswersandOrder.length > 0) {
            var userAnswers = userAnswersandOrder.map(function(answer) {
                return answer.userAnswer;
            });
            console.log(userAnswers);
            document.addEventListener('DOMContentLoaded', function() {
                // 尋找template_code的格子
                const inputs = document.querySelectorAll('input[type="text"]');
                //尋找提交的按鈕
                const submitButton = document.getElementById('send-code');
                //填入答案
                inputs.forEach((input, index) => {
                    if (userAnswers[index]) {
                        input.value = userAnswers[index];
                        autoResize(input);
                    }
                });
                // 有答案後隱藏按鈕
                if (userAnswers.length > 0) {
                    submitButton.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>