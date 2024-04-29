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
    <div class="question" >
        <div class="quiz-header">
            <h2 id="questions">Question Test</h2>
            <ul>
                <li>
                    <input type="radio" name="answer" id="a" class="answer">
                    <label for="a" id="a-text">a</label>
                </li>
                <li>
                    <input type="radio" name="answer" id="b" class="answer">
                    <label for="a" id="a-text">b</label>
                </li>
                <li>
                    <input type="radio" name="answer" id="c" class="answer">
                    <label for="a" id="a-text">c</label>
                </li>
                <li>
                    <input type="radio" name="answer" id="d" class="answer">
                    <label for="a" id="a-text">d</label>
                </li>
            </ul>
        </div>
        <button id="sub">送出</button>
    </div>
@endsection

@section('script')
    <script>
        //題目
        conest quizData = [
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
                d:"char name = "John";",
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
        
        conest question = document.getElementById("question");
        const answerEls = document.querySelectorAll(".answer");
        conest questionEl = document.getElementById("question");
        const a_text = document.getElementById("a-text");
        const b_text = document.getElementById("b-text");
        const c_text = document.getElementById("c-text");
        const d_text = document.getElementById("d-text");
        conest submitBtn = document.getElementById("sub");
        
        //預設要顯示的第一道題目，按照陣列長度的index為零
        let currentQuiz = 0;
        //得分初始為零
        let score = 0;

        //將每個input的狀態設回未選定(false)
        function deselectAnswers() {
            answerEls.forEach((answerEl) => (answerEl.checked = false))
        }

        function loadQuiz() {
            deselectAnswers()
            //將quizData中的第一道題目，放進變數currentQuizData中，然後渲染到DOM.innerText裡面
            conest currentQuizData = quizData[currentQuiz]
            questionEl.innerText = currentQuizData.question
            a.text.innerText = currentQuizData.a
            b.text.innerText = currentQuizData.b
            c.text.innerText = currentQuizData.c
            d.text.innerText = currentQuizData.d
        }

        //產生答案，視被選定的input.id為何(a, b, c, d)
        function getSelected() {
            let answer

            
        }


    </script>
@endsection