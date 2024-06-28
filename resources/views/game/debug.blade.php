<!DOCTYPE html>
<html lang="zh-Hant">

<head>
<meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEducation - 闖關Debug</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
            background: url('/images/learn/lv1-5.svg') no-repeat top center fixed;
            background-size: cover;
            color: var(--text-color);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .popup .overlay {
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
            display: none;
        }

        .popup .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: #fff;
            width: 450px;
            height: 220px;
            z-index: 2;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .popup .close-btn {
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #222;
            color: #fff;
            font-size: 25px;
            font-weight: 600;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
        }

        .popup.active .overlay {
            display: block;
        }

        .popup.active .content {
            transition: all 300ms ease-in-out;
            transform: translate(-50%, -50%) scale(1);
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px 2%;
            background: rgba(121,165,177, 0.8);
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
            color: #009578;
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

        .container {
            width: 90%;
            margin-top: 100px;
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        .container .left {
            background-color: #333333;
            border-radius: 50px;
            color: #fff;
            width: 30%;
            margin: 10px;
            padding: 50px;
        }

        .container .right {
            background-color: #333333;
            color: #fff;
            border-radius: 50px;
            width: 70%;
            margin: 10px;
            padding: 50px;
            border: 2px solid #444;
        }

        h1 {
            font-size: 20px;
            font-weight: bolder;
        }

        input{
            color: #333333;
        }

        .container .left .content {
            padding: 20px;
            border: 2px solid #444;
        }

        .container .right .code {
            padding: 20px;
            border: 2px solid #444;
        }

        .container .right .box {
            margin-top: 30px;
        }

        .container .right .box .inputs {
            width: 550px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .container .right .box button {
            margin-top: 10px;
            padding: 5px;
            border: 1px solid #fff;
        }

        .container .right .box button:hover {
            background-color: #fff;
            color: #333333;
            padding: 5px;
            border: 1px solid #333333;
        }

        @media (max-width: 1280px) {
            header {
                padding: 14px 2%;
                transition: 0.2s;
            }

            .navbar a {
                padding: 5px 0;
                margin: 0px 20px;
            }
        }

        @media (max-width: 1090px) {
            #menu-icon {
                display: block;
            }

            .navbar {
                position: absolute;
                top: 90%;
                right: -100%;
                width: 270px;
                background: #a7aab8;
                font-style: none;
                border: 2px solid #5b5b5b;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                border-radius: 10px;
                transition: all 0.50s ease;
            }

            .navbar a {
                border: none;
                display: block;
                margin: 12px 0;
                padding: 0px 25px;
                transition: all 0.50s ease;
            }

            .navbar a:hover {
                color: var(--text-color);
                transform: translateY(5px);
            }

            .navbar.open {
                right: 2%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link">綠野仙蹤</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link">闖關區</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link__active">Debug題</a>
            </li>
        </ul>

        <ul class="navbar">
            <li><a href="#" onclick="togglePopup()"> 知識卡</a></li>
            <li><a onclick="history.back()"> 回上一頁</a></li>
            <li class="time" id="timer">00:00:00</li>
        </ul>

        <div class="main">
            <a href="#" class="logo"></a>
        </div>
    </header>

    <div class="container">
        <div class="left">
            <div class="content" id="question-content">
                <!-- 題目內容動態生成 -->
                <!-- <h1>題目說明：</h1>
                <p>請印出「The Wonderful Wizard of Oz」並換行</p>
                <br>
                <h1>結果輸出：</h1>
                <p>The Wonderful Wizard of Oz</p> -->
            </div>
        </div>
        <div class="right">
            <div class="code">
                <h1>程式碼：</h1>
                <pre id="code-block">
                    <!-- 程式碼內容動態生成 -->
                    <!-- 1. public class Ex01 {
                    2.     public static void main(String[] args) {
                    3.         System.out.println("The Wonderful Wizard of Oz");
                    4.     }
                    5. } -->
                </pre>
            </div>
            <div class="box">
                <div class="inputs">
                    <div>
                        <p>錯誤行數：</p>
                        <input type="text" id="errorLine">
                    </div>
                    <div>
                        <p>正確程式碼：</p>
                        <input type="text" id="correctCode">
                    </div>
                </div>
                <div class="buttons">
                    <button class="check-word" onclick="checkAnswer()">檢查答案</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // 題目(description)、程式碼(code)、正確行數(correctLine)、正確程式碼(correctCode)
        const questions = [
            {
                description: `歡迎來到綠野仙蹤~跟著我們一起冒險吧!請印出:
                <br>The Wonderful Wizard of Oz，並且自動換行。`,
                code: `public class Main {
    public static void main(String[] args) {
        System.out.print("The Wonderful Wizard of Oz");
    }
}`,
                correctLine: 3,
                correctCode: `System.out.println("The Wonderful Wizard of Oz");`
            },
            {
                description: `設計一個程式，輸入您的姓名，並輸出:
                <br>「歡迎(您的名字)進入綠野仙蹤，努力幫助桃樂絲通關吧!」`,
                code: `import java.util.Scanner;
public class Main {
    public static void main(String[] args) {
        Scanner keyin = new Scanner(System.in);
        System.out.print("請輸入您的名稱：");
        Int Name = keyin.nextInt();
        System.out.println("歡迎"+ Name +"進入綠野仙蹤，努力幫助桃樂絲通關吧!");
        keyin.close();
    }
}`,
                correctLine: 6,
                correctCode: `String Name = keyin.nextLine();`
            },
            {
                description: `桃樂絲和稻草人要在10分25秒跑3公里，逃離金黃色稻田到達南國以免被壞女巫抓住，請寫一個程式:
                <br>計算並顯示桃樂絲每小時的平均英哩時速(1英哩=1.6公里)
                <br>計算3公里 = x 英哩(列出公式，不用計算出答案)
                <br>10分25秒 = y小時
                <br>輸出 : 每小時的平均英哩數=?`,
                code: `public class Main {
    public static void main(String[] args) {
        double miles = 3 / 1.6;
        double hours = 10.0 / 60.0 + 25.0 / 3600.0;
        double avgSpeed = miles / hours;

        System.out.print("每小時的平均英哩數=%.2f", avgSpeed);
    }
}`,
                correctLine: 7,
                correctCode: `System.out.printf("每小時的平均英哩數=%.2f", avgSpeed);`
            },
            {
                description: `稻草人被綁在金黃色稻田裡，為了更快速地替稻草人解綁
                <br>請幫助桃樂絲計算金黃色稻田的周長和面積，稻田的半徑為2.5，寫一個程式
                <br>計算此圓的周長和面積，PI = 3.14`,
                code: `public class Main {
    public static void main(String[] args) {
        final int PI = 3.14;
		double r = 2.5;
		double Peri = 2*PI*r;
		double Area = PI*r*r;
		System.out.println("圓周長 = " +Peri+", 圓面積 = "+Area );
    }
}`,
                correctLine: 3,
                correctCode: `final double PI = 3.14;`
            },
            {
                description: `請幫助蠻金之國的小矮人收割稻草，小矮人族長為了報答您決定收滿1000個稻草送100個稻草，請寫一程式:
                <br>輸入您收割多少稻草並輸出得到多少稻草`,
                code: `import java.util.Scanner;
public class Main {
    public static void main(String[] args) {
        Scanner keyin = new Scanner(System.in);
        System.out.println("您收割了多少稻草：");
        int a = keyin.nextInt();
        System.out.print("您獲得了%d根稻草",(a/1000)*100);

    }
}`,
                correctLine: 8,
                correctCode: `keyin.close();`
            },
            {
                description: `稻草收割完稻草必須公平分配給每一位小矮人，輸入收割的稻草數(a)和小矮人人數(b)
                <br>輸出每個小矮人分配到的稻草數量(商)以及多餘的稻草(餘數)`,
                code: `public class Main {
   public static void main(String[] args) {
    Scanner keyin = new Scanner(System.in);
		
		//輸入兩個整數 a 及 b ，輸出 a 除以 b的商及餘數
		System.out.print("請輸入收割的稻草數（a）：");
		int a = keyin.nextInt();
        System.out.print("請輸入小矮人人數（b）：");
		int b = keyin.nextInt();
		System.out.printf("每個小矮人分配到的稻草數量為：%d，多餘稻草數為：%d",a/b,a%b);
        keyin.close();
   } 
}`,
                correctLine: 1,
                correctCode: `import java.util.Scanner;`
            },
            {
                description: `壞女巫對蠻金之國下了暴雨詛咒，農作物需要馬上收割，小矮人請桃樂絲幫助他們收割並給她薪水，寫一個程式
                <br>輸入桃樂絲幫忙小矮人收割的時數，並計算其薪資(時薪183)`,
                code: `import java.util.Scanner;
public class Main {
    public static void main(String[] args) {
        Scanner keyin = new Scanner(System.in);

        System.out.print("請輸入桃樂絲幫忙收割的時數：");
        float hours = keyin.nextInt();

        double salaryRate = 183.0;
        double salary = hours * salaryRate;

        System.out.println("桃樂絲的薪資為：" + salary);
        keyin.close();
    }
}`,
                correctLine: 7,
                correctCode: `float hours = keyin.nextFloat();`
            }
        ];

        // 初始化
        let currentQuestionIndex = 0;

        // 加載問題索引，接受參數'index'
        function loadQuestion(index) {
            // 獲取問題(從questions數組中根據索引獲取題目)
            const question = questions[index];
            // 顯示問題描述(獲取id為'question-content'的元素)
            const questionContent = document.getElementById('question-content');
            // 顯示程式碼(獲取id為'code-block'的元素)
            const codeBlock = document.getElementById('code-block');
            // 丟數組中的description進去'question-content'，replace()函數用於替換字符串為新的字符串，這裡將所有\n替換為<br>以便在HTML中正確顯示段落
            questionContent.innerHTML = `<h1>題目說明：</h1><p>${question.description.replace(/\n/g, '<br>')}</p>`;
            // 丟數組中的code進去'code-block'，將程式碼以\n分割成行(用來組成陣列)，用map()函數對陣列每一行加行數(從1開始)，回呼函式有兩個參數(line, idx)，最後用join('\n')連接成字串
            codeBlock.textContent = question.code.split('\n').map((line, idx) => `${idx + 1}. ${line}`).join('\n');
        }


        // 檢查答案
        function checkAnswer() {
            // trim()用於刪除字串的頭尾空白、tab、換行符號
            let errorLine = document.getElementById('errorLine').value.trim();
            let correctCode = document.getElementById('correctCode').value.trim();
            const question = questions[currentQuestionIndex];

            if (errorLine == question.correctLine && correctCode == question.correctCode) {
                alert('答案正確!');
            } else {
                alert('答案錯誤，請再試一次!');
            }
        }

        function getRandomQuestionIndex() {
            return Math.floor(Math.random() * questions.length);
        }

        window.onload = function() {
            currentQuestionIndex = getRandomQuestionIndex();
            loadQuestion(currentQuestionIndex);
        };
    </script>
</body>

</html>
