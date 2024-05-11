@extends('layouts.application')

@section('title', '學習區重組')

@section('style')
    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .containers{
            background-color: #76a5af;
            margin: 1em;
            border-radius: 10px; /*圓角*/
            box-shadow: 0 0 10px rgb(100, 100, 100); /*陰影*/
            width: 600px;
            overflow: hidden;
        }

        .containers .content{
            margin: 25px 20px 35px 20px; /*上右下左*/
        }

        .content .word{
            font-size: 33px;
            font-weight: 500; /*字體中等粗細*/
            text-align: center;
            letter-spacing: 24px;
            margin: 25px 0 20px;
        }

        .content input{
            width: 100%;
            height: 60px;
            outline: none;
            font-size: 18px;
            padding: 0 16px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }

        .content .buttons{
            display: flex;
            margin-top: 20px;
            justify-content: space-between; /*分散對齊*/
        }

        .buttons button{
            border: none;
            outline: none;
            color: #fff;
            cursor: pointer;
            padding: 15px 0; /*上下 左右*/
            font-size: 20px;
            font-weight: bold;
            border-radius: 5px;
            width: calc(100% / 2 - 8px); /*寬度為父元素寬度的一半減去8px*/
        }

        .buttons .refresh-word{
            background-color: #5b5b5b;
        }

        .buttons .check-word{
            background-color: #0b5394;
        }
    </style>
@endsection

@section('content')
    <div class="containers">
        <div class="content">
            <p class="word">enaxpnions</p>
            <input type="text" placeholder="Enter a valid word">
            <div class="buttons">
                <button class="refresh-word">清除</button>
                <button class="check-word">送出</button>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        
    </script>
@endsection