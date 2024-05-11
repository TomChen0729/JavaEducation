@extends('layouts.application')

@section('title', '學習區選擇')

@section('style')
    <style>
        body{
            /* margin: 0;
            padding: 0; */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden; /*自動隱藏超出的文字或圖片*/
        }
        
        .question{
            margin: 1em;
            background-color: #bcdf49;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 600px;
            overflow: hidden;
        }

        .quiz-header{
            padding: 4rem;  /*內部*/
        }

        #questions{
            font-size: 28px;
            font-weight: bold;
            padding: 1rem;
            text-align: center;
            margin: 0;
        }

        .quiz-header ul{
            list-style-type: none; /*無標號*/
            padding: 0;
        }

        .quiz-header ul li{
            font-size: 20px;
            margin: 18px 0;
        }

        .quiz-header ul li label{
            cursor: pointer; /*改變滑鼠游標*/
        }

        #sub{
            color: #333;
            font-weight: bold;
            display: block;
            width: 100%;
            font-size: 18px;
            padding: 10px;
        }

        #sub:hover {
            color: var(--text-color);
            background-color: rgb(136, 136, 136);
        }

        #sub:focus{
            outline: solid; /*輪廓線，不占空間*/
            background-color: rgb(99, 99, 99);
        }
    </style>
@endsection

@section('content')
    <div class="question" id="questionSection">
        <div class="quiz-header">
            <h2 id="questions"></h2>
            <ul>
                <li>
                    <input type="radio" name="answer" id="a" class="answer">
                    <label for="a" id="a-text"></label>
                </li>
                <li>
                    <input type="radio" name="answer" id="b" class="answer">
                    <label for="b" id="b-text"></label>
                </li>
                <li>
                    <input type="radio" name="answer" id="c" class="answer">
                    <label for="c" id="c-text"></label>
                </li>
                <li>
                    <input type="radio" name="answer" id="d" class="answer">
                    <label for="d" id="d-text"></label>
                </li>
            </ul>
        </div>
        <button id="sub">送出</button>
    </div>
@endsection

@section('script')
    <script>
        
        const quiz = document.getElementById('questionSection')//獲取題目容器
        const answerEls = document.querySelectorAll('.answer')//獲取答案選項
        const questionEl = document.getElementById('questions')// 這裡的 ID 是 'questions'
        const a_text = document.getElementById('a-text')// 這裡的 ID 是 'a-text'
        const b_text = document.getElementById('b-text')
        const c_text = document.getElementById('c-text')
        const d_text = document.getElementById('d-text')
        const submitBtn = document.getElementById('sub')//提交

        // 接後端
        //題目
        const quizData = [
            {
                question:"在 Java 中，下列哪個資料型態用於表示整數？",
                a:"int",
                b:"double",
                c:"float",
                d:"char",
                correct:"a",
            },
            {
                question:"下列哪個是正確的？",
                a:"int x = 10;",
                b:"int y;",
                c:"double z;",
                d:"char name = 'John';",
                correct:"a",
            },
            {
                question:"下列哪個資料型態用於表示字串？",
                a:"int",
                b:"double",
                c:"char",
                d:"String",
                correct:"d",
            },
            {
                question:"下列哪個資料型態用於表示雙精度浮點數？",
                a:"int",
                b:"double",
                c:"boolean",
                d:"char",
                correct:"b",
            },
        ]
        

        // 預設要顯示的第一道題目，按照陣列長度的index為零
        let currentQuiz = 0

        // 清除選項
        function clearSelections() {
            answerEls.forEach(answerEl => answerEl.checked = false);
        }

        //渲染題目和選項
        function renderQuestion(quizData, index) {
            const currentQuizData = quizData[index];
            questionEl.textContent = currentQuizData.question;
            a_text.textContent = currentQuizData.a;
            b_text.textContent = currentQuizData.b;
            c_text.textContent = currentQuizData.c;
            d_text.textContent = currentQuizData.d;
        }

        // //獲取下一道題目
        // function getNextQuestion() {
        //     clearSelections();//清除選項狀態
        //     currentQuiz++;//當前題目索引加1
        //     if (currentQuiz < quizData.length) {
        //         renderQuestion(quizData, currentQuiz); //渲染下一道題目
        //     } else {
        //         //最後一道題目，重新開始
        //         quiz.innerHTML = `<button onclick="location.reload()">重新开始</button>`;
        //     }
        // }

        //獲取使用者選擇答案的函數
        function getSelectedAnswer() {
            for (const answerEl of answerEls) {
                if (answerEl.checked) {
                    return answerEl.id; //返回被選中的ID
                }
            }
            return null; // 無答案 = null
        }

        //提交
        submitBtn.addEventListener('click', () => {
            const selectedAnswer = getSelectedAnswer(); //獲取用戶選擇答案
            if (selectedAnswer !== null) { //如果用戶選擇了答案
                // 檢查是否選擇答案
                if (selectedAnswer === quizData[currentQuiz].correct) {
                    // 正確
                    window.location.replace("match");
                } else {
                    // 錯誤
                    clearSelections();
                    alert("答錯了！");
                }
                getNextQuestion();
            } else {
                // 如果沒選擇答案就彈跳視窗
                alert("請選擇一個答案！");
            }
        });

        // 頁面加載時，渲染
        window.onload = () => {
            renderQuestion(quizData, currentQuiz);
        };

    </script>
@endsection