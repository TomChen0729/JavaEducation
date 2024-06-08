@extends('layouts.application')

@section('title', '遊戲難度')

@section('style')
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 80px auto 0;
            padding: 10px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8); /* 添加背景颜色 */
            border-radius: 12px; /* 添加圆角 */
        }

        .headers {
            margin: 50px auto;
            padding: 20px;
            background-color: #f1c232;
            border: 3px solid #ff8a00;
            border-radius: 30px;
            text-align: center;
            max-width: 800px;
        }

        .headers h1 {
            font-size: 36px;
            font-weight: bold;
            margin: 10px;
            color: #007bff;
        }

        .headers p {
            font-size: 18px;
            color: #666;
            margin-bottom: 10px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            color: #000;
            width: 250px;
            background: linear-gradient(45deg, #a8edea, #fed6e3);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin: 20px;
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .card-content {
            padding: 24px;
            text-align: center;
        }

        .card-content h3 {
            font-size: 24px;
            margin-bottom: 12px;
            color: #333;
        }

        .card-content p {
            color: #666;
            font-size: 16px;
            font-weight: bold;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .card-content .btn {
            color: #333;
            display: inline-block;
            padding: 10px 20px;
            background-color: #fff;
            border: 2px solid #333;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .card-content .btn:hover {
            background-color: #333;
            color: #fff;
            transform: translateY(-2px);
        }

        .card-content .icon {
            font-size: 48px;
            margin-bottom: 15px;
            color: #007bff;
        }

        /* RWD for smaller devices */
        @media screen and (max-width: 600px) {
            .card {
                width: 90%; /* Adjust card width */
                margin: 10px auto;
            }

            .headers h1 {
                font-size: 24px; /* Reduce header font size */
            }

            .headers p {
                font-size: 14px; /* Reduce paragraph font size */
            }
        }
    </style>
@endsection

@section('content')
<div class="container">
        <div class="headers">
            <h1>選擇你的遊戲難度</h1>
            <p>挑戰不同的關卡，提升你的程式技能！</p>
        </div>

        <div class="card-container">
            @foreach($parent_cards as $card)
                <div class="card">
                    <div class="card-content">
                        <div class="icon">&#x1F3AE;</div> <!-- 示例图标，可以替换为其他图标 -->
                        <h3>LV.{{ $card->levels }}</h3>
                        <p>{{ $card->card_type }}</p>
                        <a href="{{ route('game.index', ['levels' => $card->levels, 'country_id' => $card->country_id]) }}" class="btn">開始遊戲</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

