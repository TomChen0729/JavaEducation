@extends('layouts.application')

@section('title', '學習區選擇')

@section('style')
    <style>
        body{
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden; /*自動隱藏超出的文字或圖片*/
        }
        
        .question{
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
            font-size: 24px;
            padding: 1rem;
            text-align: center;
            margin: 0;
        }

        .quiz-header ul{
            list-style-type: none; /*無標號*/
            padding: 0;
        }

        .quiz-header ul li{
            font-size: 24px;
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
            <h2 id="questions">Question Test</h2>
            <ul>
                <li>
                    <input type="radio" name="answer" id="a" class="answer">
                    <label for="a" id="a-text">a</label>
                </li>
                <li>
                    <input type="radio" name="answer" id="b" class="answer">
                    <label for="b" id="b-text">b</label>
                </li>
                <li>
                    <input type="radio" name="answer" id="c" class="answer">
                    <label for="c" id="c-text">c</label>
                </li>
                <li>
                    <input type="radio" name="answer" id="d" class="answer">
                    <label for="d" id="d-text">d</label>
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
        // 得分數初始為零
        let score = 0

        // 將每個input的狀態設回未選定(false)
        function deselectAnswers() {
        answerEls.forEach((answerEl) => (answerEl.checked = false))
        }

        function loadQuiz() {
        deselectAnswers()
        // 將quizData中的第一道題目，放進變數currentQuizData中，然後渲染到DOM.innerText裡面。
        const currentQuizData = quizData[currentQuiz]
        questionEl.innerText = currentQuizData.question
        a_text.innerText = currentQuizData.a
        b_text.innerText = currentQuizData.b
        c_text.innerText = currentQuizData.c
        d_text.innerText = currentQuizData.d
        }

        // 產生答案，視被選定的input.id為何（a, b, c, d）
        function getSelected() {
        let answer

        answerEls.forEach((answerEl) => {
            if (answerEl.checked) {
            answer = answerEl.id
            }
        })

        return answer
        }


        submitBtn.addEventListener('click', () => {
        // 當submit被選中時，執行getSelected()，然後產生answer
        const answer = getSelected()

        if (answer) {
        // 若answer等於種子資料中的correct，則score + 1
            if (answer === quizData[currentQuiz].correct) {
            score++
            }
            
            // 被選定的題目序數 + 1
            currentQuiz++

            // 若被選定的題目序數小於題庫陣列長度，則再次渲染新的選擇題
            if (currentQuiz < quizData.length) {
            loadQuiz()
            } else {
            // 否則帶入成績
                quiz.innerHTML = `
                    <h2>You answered ${score}/${quizData.length} questions correctly</h2>
                    // 要重整畫面，一般會用onclick="location.reload()"，但在CodePen環境會失效，因此改為 onclick="history.go(0)"
                    // 兩者差別在於，前者是重新向server送request，後者是讀取緩存。
                    <button onclick="history.go(0);">Reload</button>
                `
            }
        }
        
        loadQuiz()
        
        })
    </script>
@endsection