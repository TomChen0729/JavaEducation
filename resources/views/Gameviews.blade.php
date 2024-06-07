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

        .containers{
            background: rgba(255,255,255, 0.8); /* 透明背景 */
            border: 5px solid #333333;
            border-radius: 50px;
        }

        h2{
            font-size: 28px;
            font-weight: bold;
            color: #333333;
            padding: 1rem;
            text-align: center;
            margin: 0;
            padding-top: 50px;
        }

        hr{
            border: 2px solid #333333;
        }

        .TF{
            font-size: 24px;
            font-weight: bold;
            margin: 30px;
            background-color: #f1c232;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            padding: 30px;  /*內部*/
        }

        .TF:hover{
            box-shadow: 0 0 10px rgb(100, 100, 100);
            transform: scale(1.03);
        }

        .CH{
            font-size: 24px;
            font-weight: bold;
            margin: 30px;
            background-color: #bcdf49;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 150px;
            padding: 30px;  /*內部*/
        }

        .CH:hover{
            box-shadow: 0 0 10px rgb(100, 100, 100);
            transform: scale(1.03);
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

        .MA:hover{
            box-shadow: 0 0 10px rgb(100, 100, 100);
            transform: scale(1.03);
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

        .RE:hover{
            box-shadow: 0 0 10px rgb(100, 100, 100);
            transform: scale(1.03);
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

        .PASS:hover{
            box-shadow: 0 0 10px rgb(100, 100, 100);
            transform: scale(1.03);
        }

    </style>
@endsection

@section('content')
    <div class="containers">
        <div class="learnarea">
            <h2>學習區</h2>
            @foreach($Question_list as $item)
                @if($item -> gametype == '是非')
                    <button class="TF"><a href="{{ route('game.gameTypeChoose', ['GameType' => $item -> gametype, 'country_id' => $item -> country_id, 'levels' => $item -> levels]) }}">{{ $item -> gametype }}</a></button>
                @elseif($item -> gametype == '選擇')
                    <button class="CH"><a href="{{ route('game.gameTypeChoose', ['GameType' => $item -> gametype, 'country_id' => $item -> country_id, 'levels' => $item -> levels]) }}">{{ $item -> gametype }}</a></button>
                @elseif($item -> gametype == '配對')
                    <button class="MA"><a href="{{ route('game.gameTypeChoose', ['GameType' => $item -> gametype, 'country_id' => $item -> country_id, 'levels' => $item -> levels]) }}">{{ $item -> gametype }}</a></button>
                @else
                    <button class="RE"><a href="{{ route('game.gameTypeChoose', ['GameType' => $item -> gametype, 'country_id' => $item -> country_id, 'levels' => $item -> levels]) }}) }}">{{ $item -> gametype }}</a></button>
                @endif
            @endforeach
            
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
