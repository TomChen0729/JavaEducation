@extends('layouts.application')

@section('title', '選擇遊戲')
@section('head', '蠻金之國')
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

        h2{
            font-size: 28px;
            font-weight: bold;
            padding: 1rem;
            text-align: center;
            margin: 0;
            padding-top: 50px;
        }

        .TF{
            font-size: 24px;
            font-weight: bold;
            margin: 30px;
            background-color: #f1c232;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            overflow: hidden;
            padding: 30px;  /*內部*/
        }

        .CH{
            font-size: 24px;
            font-weight: bold;
            margin: 30px;
            background-color: #bcdf49;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            overflow: hidden;
            padding: 30px;  /*內部*/
        }

        .MA{
            font-size: 24px;
            font-weight: bold;
            margin: 30px;
            background-color: #e06666;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            overflow: hidden;
            padding: 30px;  /*內部*/
        }

        .RE{
            font-size: 24px;
            font-weight: bold;
            margin: 30px;
            background-color: #76a5af;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            overflow: hidden;
            padding: 30px;  /*內部*/
        }

        .PASS{
            font-size: 24px;
            font-weight: bold;
            margin: 30px;
            background-color: #8e7cc3;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            overflow: hidden;
            padding: 30px;  /*內部*/
        }

        .pass-buttons {
            display: flex;
            justify-content: center;
        }

    </style>
@endsection

@section('content')
    <div class="containers">
        <div class="learnarea">
            <h2>學習區</h2>
            <button class="TF"><a href="{{ route('game.gameTypeChoose', ['GameType_id' => 1]) }}">是非</a></button>
            <button class="CH"><a href="{{ route('game.gameTypeChoose', ['GameType_id' => 2]) }}">選擇</a></button>
            <button class="MA"><a href="{{ route('game.gameTypeChoose', ['GameType_id' => 3]) }}">配對</a></button>
            <button class="RE"><a href="{{ route('game.gameTypeChoose', ['GameType_id' => 4]) }}">重組</a></button>
        </div>
        <hr>
        <div class="passarea">
            <h2>闖關區</h2>
            <div class="pass-buttons">
                <button class="PASS">闖關區</button>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>

    </script>
@endsection