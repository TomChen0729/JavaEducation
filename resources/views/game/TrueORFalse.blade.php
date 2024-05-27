@extends('layouts.application')

@section('title', '學習區是非')

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
            background-color: #f1c232;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 645px;
            overflow: hidden;
            padding: 90px;  /*內部*/
            margin: 20px;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
        }

        .true{
            font-size: 20px;
            margin: 20px;
            background-color: #93c47d;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 300px;
            overflow: hidden;
            padding: 90px;  /*內部*/
        }

        .false{
            font-size: 20px;
            margin: 20px;
            background-color: #e06666;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 300px;
            overflow: hidden;
            padding: 90px;  /*內部*/
        }
    </style>
@endsection

@section('content')
<div class="tof">
    <!-- 顯示題目容器 -->
    <div class="question">
        <h2 id="questions">{{ $question->questions}}</h2>
    </div>
    <div>
        <button class="true" id="trueB">True</button>
        <button class="false" id="falseB">False</button>
    </div>
</div>
@endsection

@section('script')
    <script>
        const questionEl = document.getElementById('questions'); // 題目
        const trueBtn = document.getElementById('trueB'); // true 按鈕
        const falseBtn = document.getElementById('falseB'); //False 按鈕

        // // 接後端
        // //題目
        // const quizData = [
        //     {
        //         question:"float資料型態是否能儲存小數值",
        //         answer: true,
        //     },
        //     {
        //         question:"float資料型態是否能儲存整數值",
        //         answer: false,
        //     },
        //     {
        //         question:"int資料型態是否能儲存小數值",
        //         answer: false,
        //     },
        //     {
        //         question:"double資料型態是否能儲存小數值",
        //         answer: true,
        //     },
        // ];

        // let correctAnswer; //用來儲存正確答案

        // // 隨機題目
        // function getRandomQuestion() {
        //     // 生成隨機數
        //     const randomIndex = Math.floor( Math.random() * quizData.length);
        //     // 選擇隨機題目
        //     const randomQuestion = quizData[randomIndex];
        //     // 渲染到頁面上
        //     questionEl.textContent = randomQuestion.question;
        //     // 將正確答案保存，以便後續檢查答案
        //     correctAnswer = randomQuestion.answer;
        // }
        
        // // 顯示隨機題目
        // getRandomQuestion();

        // // 點true按鈕執行
        // trueBtn.addEventListener('click', () => {
        //     checkAnswer(true);
        // });
        
        // // 點false按鈕執行
        // falseBtn.addEventListener('click', () => {
        //     checkAnswer(false);
        // });

        // // 檢查答案是否正確
        // function checkAnswer(userAnswer) { 
        //     if (userAnswer === correctAnswer) {
        //         window.location.href = "{{ route('game.gameTypeChoose', ['GameType_id' => 2]) }}/";
        //     } else {
        //         // 答案錯誤
        //         alert("答錯了！");
        //     }
        // }

        // 對答案api->街後端updateTrueORFalse(request, st)
        fetch()
    </script>
@endsection