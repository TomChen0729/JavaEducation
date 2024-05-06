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
        
        const quiz = document.getElementById('questionSection')
        const answerEls = document.querySelectorAll('.answer')
        const questionEl = document.getElementById('questions')// 這裡的 ID 是 'questions'
        const a_text = document.getElementById('a-text')// 這裡的 ID 是 'a-text'
        const b_text = document.getElementById('b-text')
        const c_text = document.getElementById('c-text')
        const d_text = document.getElementById('d-text')
        const submitBtn = document.getElementById('sub')

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

        // 封装常用的DOM操作函数
        function clearSelections() {
            answerEls.forEach(answerEl => answerEl.checked = false);
        }

        function renderQuestion(quizData, index) {
            const currentQuizData = quizData[index];
            questionEl.textContent = currentQuizData.question;
            a_text.textContent = currentQuizData.a;
            b_text.textContent = currentQuizData.b;
            c_text.textContent = currentQuizData.c;
            d_text.textContent = currentQuizData.d;
        }

        function getNextQuestion() {
            clearSelections();
            currentQuiz++;
            if (currentQuiz < quizData.length) {
                renderQuestion(quizData, currentQuiz);
            } else {
                quiz.innerHTML = `<button onclick="location.reload()">重新开始</button>`;
            }
        }

        function getSelectedAnswer() {
            for (const answerEl of answerEls) {
                if (answerEl.checked) {
                    return answerEl.id;
                }
            }
            return null; // 如果没有选择任何答案，则返回 null
        }

        submitBtn.addEventListener('click', () => {
            const selectedAnswer = getSelectedAnswer();
            if (selectedAnswer !== null) {
                // 检查用户是否选择了答案
                if (selectedAnswer === quizData[currentQuiz].correct) {
                    // 正确答案的处理逻辑
                } else {
                    // 错误答案的处理逻辑
                }
                getNextQuestion();
            } else {
                // 用户没有选择答案时的处理逻辑
                alert("请选择一个答案！");
            }
        });

        // 页面加载时渲染第一题
        window.onload = () => {
            renderQuestion(quizData, currentQuiz);
        };

    </script>
@endsection