@extends('layouts.application')

@section('title', '學習區配對')

@section('style')
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
            overflow: hidden; /* 自動隱藏超出的文字或圖片 */
        }

        .container {
            margin-top: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 10px;
        }

        /* 每一對題目、答案橫向對齊，保持間距 */
        .pair-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 800px;
            margin-bottom: 20px;
        }

        .question {
            font-size: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 300px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: #A34343 0.3s ease;
            text-align: center; /* 確保文字置中 */
            padding: 0 10px;
            margin-right: 50px;
            box-sizing: border-box; /* 確保padding不會影響寬度 */
            background-color: #A34343;
        }

        .question:hover {
            background-color: #e06666;
        }

        .answer {
            font-size: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: #E9C874 0.3s ease;
            text-align: center; /* 確保文字置中 */
            padding: 0 10px; 
            margin-left: 50px;
            box-sizing: border-box; /* 確保padding不會影響寬度 */
            background-color: #E9C874;
        }

        .answer:hover {
            background-color: #f1c232;
        }

        .selected {
            /* 選中項目有邊框顯示 */
            outline: 3px solid #0000ff;
        }

        .matched {
            /* 配對成功後的樣式 */
            background-color: #00ff00;
            pointer-events: none; /* 禁用已配對元素的點擊事件 */
        }

        @media (max-width: 768px) {
            .pair-container {
                align-items: center; /* 垂直排列时居中对齐 */
            }

            .question, .answer {
                margin: 10px; /* 垂直排列时保持间距 */
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- 動態生成問題和答案 -->
        <div id="pair-container"></div>
    </div>
@endsection

@section('script')
    <script>
        // 定義問題和答案
        let questions = [
            { question: "資料型態用於表示整數", answer: "int" },
            { question: "資料型態用於表示浮點數", answer: "float" },
            { question: "資料型態用於表示布林值", answer: "boolean" },
            { question: "資料型態用於表示雙精浮點數", answer: "double" },
            { question: "資料型態用於表示字串", answer: "String" },
            { question: "資料型態用於表示字元", answer: "char" }
        ];

        // 儲存當前選中的題目和答案
        let selectedQuestion = null;
        let selectedAnswer = null;

        // 頁面加載完成後執行的函數
        document.addEventListener('DOMContentLoaded', () => {
            const pairContainer = document.getElementById('pair-container');

            // 隨機打亂題目和答案的順序
            shuffleArray(questions);

            // 動態生成問題和答案的HTML結構
            questions.forEach((item, index) => {
                const pairDiv = document.createElement('div');
                pairDiv.className = 'pair-container';

                const questionDiv = createDiv(item.question, 'question', index);
                const answerDiv = createDiv(item.answer, 'answer', index);

                pairDiv.appendChild(questionDiv);
                pairDiv.appendChild(answerDiv);

                pairContainer.appendChild(pairDiv);
            });

            // 為每個題目和答案添加點擊事件監聽器
            document.querySelectorAll('.question').forEach(el => {
                el.addEventListener('click', () => selectQuestion(el));
            });

            document.querySelectorAll('.answer').forEach(el => {
                el.addEventListener('click', () => selectAnswer(el));
            });
        });

        // 創建一個帶有文本、類名和索引的 div 元素
        function createDiv(text, className, index) {
            const div = document.createElement('div');
            div.className = className;
            div.textContent = text;
            div.dataset.index = index; // 存儲題目或答案的索引
            return div;
        }

        // 打亂數組元素的順序
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        // 選擇題目時的處理函數
        function selectQuestion(el) {
            if (selectedQuestion) {
                selectedQuestion.classList.remove('selected'); // 取消之前選中的題目高亮顯示
            }
            selectedQuestion = el; // 設置當前選中的題目
            el.classList.add('selected'); // 高亮顯示當前選中的題目
            checkMatch(); // 檢查是否配對成功
        }

        // 選擇答案時的處理函數
        function selectAnswer(el) {
            if (selectedAnswer) {
                selectedAnswer.classList.remove('selected'); // 取消之前選中的答案高亮顯示
            }
            selectedAnswer = el; // 設置當前選中的答案
            el.classList.add('selected'); // 高亮顯示當前選中的答案
            checkMatch(); // 檢查是否配對成功
        }

        // 檢查題目和答案是否配對成功
        function checkMatch() {
            if (selectedQuestion && selectedAnswer) {
                if (selectedQuestion.dataset.index === selectedAnswer.dataset.index) {
                    alert('配對成功!');
                    selectedQuestion.classList.add('matched');
                    selectedAnswer.classList.add('matched');
                    selectedQuestion.classList.remove('selected');
                    selectedAnswer.classList.remove('selected');
                    selectedQuestion = null;
                    selectedAnswer = null;
                } else {
                    alert('配對失敗');
                    selectedQuestion.classList.remove('selected');
                    selectedAnswer.classList.remove('selected');
                    selectedQuestion = null;
                    selectedAnswer = null;
                }
            }
        }
    </script>
@endsection
