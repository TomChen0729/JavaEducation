@extends('layouts.game')

@section('title', '學習區是非')

@section('style')
<style>
    body {
        /* margin: 0;
            padding: 0; */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        overflow: hidden;
        /*自動隱藏超出的文字或圖片*/
    }

    .tof {
        background-color: gray;
        padding: 10px;
        border-radius: 10px;
        border: 10px solid green;
    }

    .question {
        background-color: #f1c232;
        border-radius: 10px;
        box-shadow: 0 0 10px rgb(100, 100, 100);
        width: 1040px;
        overflow: hidden;
        padding: 90px;
        /*內部*/
        margin: 20px;
        font-size: 30px;
        font-weight: bold;
        text-align: center;
    }

    .true {
        font-size: 20px;
        margin: 20px;
        background-color: #93c47d;
        border-radius: 10px;
        box-shadow: 0 0 10px rgb(100, 100, 100);
        width: 500px;
        overflow: hidden;
        padding: 50px;
        /*內部*/
    }

    .false {
        font-size: 20px;
        margin: 20px;
        background-color: #e06666;
        border-radius: 10px;
        box-shadow: 0 0 10px rgb(100, 100, 100);
        width: 500px;
        overflow: hidden;
        padding: 50px;
        /*內部*/
    }
</style>
@endsection

@section('content')
<div class="tof">
    <!-- 顯示題目容器 -->
    <div class="question">
        <h1 id="cid">{{ $current_uid }}</h1>
        <p id="q-id" style="display: none;">{{ $question -> id }}</p>
        <h2 id="questions">{{ $question->questions}}</h2>
    </div>
    <div>
        <button class="true" id="trueB" value="O">True</button>
        <button class="false" id="falseB" value="X">False</button>
    </div>
</div>
@endsection

@section('script')
<script>
    const questionEl = document.getElementById('questions'); // 題目
    const trueBtn = document.getElementById('trueB'); // true 按鈕
    const falseBtn = document.getElementById('falseB'); //False 按鈕

    // 對答案 api
    document.querySelectorAll('button.true, button.false').forEach(button => {
        button.addEventListener('click', function() {
        var answerValue = this.value;
        var game_type = '是非';
        var question_id = document.getElementById('q-id').textContent;
        var cid = document.getElementById('cid').textContent;
        // console.log(question_id);
        // var question = document.getElementById('questions').textContent;
        // console.log(answerValue);  // 測試用
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // console.log(csrfToken); // 測試用
        var timer = stopTimer();
        console.log(timer);
        fetch('/api/correct_User_ANS?user_answer=' + encodeURIComponent(answerValue) + '&question_id=' + question_id + '&cid=' + cid , {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            // body: JSON.stringify({
            //     user_answer: answerValue,
            //     question:  question,
            //     game_type: '是非'
            // })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.message == 'correct'){
                alert('答對');
            }
            else if(data.message == 'wrongAnswer'){
                alert('答錯');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
            else{
                alert('伺服器錯誤');
                setTimeout(function() {
                    window.location.reload();
                }, 1000);
            }
        })
        // .catch(error => {
        //     console.error('Error:', error);
        //         });
            });
        });
    </script>
@endsection