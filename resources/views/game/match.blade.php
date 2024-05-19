@extends('layouts.application')

@section('title', '學習區配對')

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

        .pair-container {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .question {
            font-size: 20px;
            margin-right: 10px;
            background-color: #A34343;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .question:hover {
            background-color: #e06666;
        }

        .answer {
            font-size: 20px;
            margin-left: 10px;
            background-color: #E9C874;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .answer:hover {
            background-color: #f1c232;
        }
    </style>
@endsection

@section('content')
    <div class="pair-container">
        <div class="question">題目</div>
        <div class="answer">答案</div>
    </div>
    <div class="pair-container">
        <div class="question">題目</div>
        <div class="answer">答案</div>
    </div>
    <div class="pair-container">
        <div class="question">題目</div>
        <div class="answer">答案</div>
    </div>
    <div class="pair-container">
        <div class="question">題目</div>
        <div class="answer">答案</div>
    </div>
    <div class="pair-container">
        <div class="question">題目</div>
        <div class="answer">答案</div>
    </div>
    <div class="pair-container">
        <div class="question">題目</div>
        <div class="answer">答案</div>
    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection
