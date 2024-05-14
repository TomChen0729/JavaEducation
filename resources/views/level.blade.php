@extends('layouts.application')

@section('title', '學習區難度')

@section('style')
    <style>
        .card-container{
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 100px;
        }

        .card{
            color: #000;
            width: 325px;
            background-color: #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 4px rgba(0,0,0,0.2);
            margin: 20px;
        }

        .card-content{
            padding: 16px;
        }

        .card-content h3{
            font-size: 28px;
            margin-bottom: 8px;
        }

        .card-content p{
            color: #666;
            font-size: 15px;
            line-height: 1.3;
        }

        .card-content .btn{
            color: #fff;
            display: inline-block;
            padding: 8px 16px;
            background-color: #333;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 16px;
        }
    </style>
@endsection

@section('content')
    <div class="card-container">
        <div class="card">
            <div class="card-content">
                <h3>LV.1</h3>
                <p>
                    變數與資料型態
                </p>
                <a href="{{ route('game.index',['pass_familiarty_id' => 1]) }}" class="btn">Start</a>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <h3>LV.2</h3>
                <p>
                    資料輸入與輸出
                </p>
                <a href="" class="btn">Start</a>
            </div>
        </div>
        <div class="card">
            <div class="card-content">
                <h3>LV.3</h3>
                <p>
                    運算子
                </p>
                <a href="" class="btn">Start</a>
            </div>
        </div>
    </div>
@endsection