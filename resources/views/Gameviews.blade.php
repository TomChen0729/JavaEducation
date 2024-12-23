@extends('layouts.application')

@section('title', '選擇遊戲')

@section('style')
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        .containers {
            margin-top: 5%;
            padding: 20px;
            background-color: #4D613C;
            border: 3px solid #455736;
            border-radius: 30px;
            text-align: center;
        }

        h2 {
            font-size: 60px;
            font-weight: bold;
            margin: 10px;
            color: #4D613C;
            text-shadow: -1px -1px 0 #F6B654, 1px -1px 0 #F6B654, -1px 1px 0 #F6B654, 1px 1px 0 #F6B654;
        }

        p {
            margin: 20px 30px;
            text-align: left;
            color: #F8F2ED;
        }

        .TF,
        .CH,
        .MA,
        .RE {
            font-size: 28px;
            font-weight: bold;
            margin: 30px;
            padding: 20px;
            width: 150px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            text-align: center;
            text-decoration: none;
        }

        .TF {
            background-color: #f1c232;
        }

        .CH {
            background-color: #bcdf49;
        }

        .MA {
            background-color: #e06666;
        }

        .RE {
            background-color: #76a5af;
        }

        a:hover {
            color: white;
        }

        .TF:hover,
        .CH:hover,
        .MA:hover,
        .RE:hover {
            box-shadow: 0 0 10px rgb(100, 100, 100);
            transform: scale(1.03);
        }

        .btn {
            width: 100%;
            display: inline-block;
            margin-top: 15px;
            padding: 15px 25px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            outline: none;
            color: #fff;
            background-color: #04AA6D;
            border: none;
            border-radius: 15px;
            box-shadow: 0 9px #999;
        }

        .btn:hover {
            background-color: #3e8e41
        }

        .btn:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }

        @media (max-width: 900px) {
            .popup .content {
                width: 90%;
                height: auto;
                max-height: 80vh;
            }

            .button-group .btn {
                width: calc(50% - 20px);
                margin-bottom: 10px;
            }

            .popup .pop h1 {
                font-size: 20px;
            }

            .popup .pop p {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .button-group .btn {
                width: calc(100% - 20px);
                margin-bottom: 10px;
                font-size: 18px;
                padding: 10px 20px;
            }

            .popup .pop h1 {
                font-size: 18px;
            }

            .popup .pop p {
                font-size: 12px;
            }

            .popup .close-btn {
                right: 10px;
                top: 10px;
                width: 25px;
                height: 25px;
                font-size: 20px;
                line-height: 25px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="containers">
        <h2>學習區</h2>
        <p><strong>是非關卡</strong><br>
            玩法說明：判斷題目所述內容的正確性，選擇正確答案是True還是False。</p>
        <p><strong>選擇關卡</strong><br>
            玩法說明：從多個選項中選擇一個最符合題意的答案。</p>
        <p><strong>配對關卡</strong><br>
            玩法說明：根據題目與正確的描述或應用進行配對。</p>
        <p><strong>填空關卡</strong><br>
            玩法說明：根據提示內容，在下方選擇適合答案拉上去使程式碼完整。</p>
        <!-- <p><strong>Debug關卡</strong><br>
                                        玩法說明：在這個關卡中，你會得到一段有錯誤的程式碼。你的任務是找出並修正這些錯誤。</p> -->
        @foreach ($Question_list as $item)
            @if ($item->gametype == '是非')
                <button class="TF"><a
                        href="{{ route('game.gameTypeChoose', ['GameType' => $item->gametype, 'country_id' => $item->country_id, 'levels' => $item->levels]) }}">{{ $item->gametype }}</a></button>
            @elseif($item->gametype == '選擇')
                <button class="CH"><a
                        href="{{ route('game.gameTypeChoose', ['GameType' => $item->gametype, 'country_id' => $item->country_id, 'levels' => $item->levels]) }}">{{ $item->gametype }}</a></button>
            @elseif($item->gametype == '配對')
                <button class="MA"><a
                        href="{{ route('game.gameTypeChoose', ['GameType' => $item->gametype, 'country_id' => $item->country_id, 'levels' => $item->levels]) }}">{{ $item->gametype }}</a></button>
            @else
                <button class="RE"><a
                        href="{{ route('game.gameTypeChoose', ['GameType' => $item->gametype, 'country_id' => $item->country_id, 'levels' => $item->levels]) }}">{{ $item->gametype }}</a></button>
            @endif
        @endforeach
    </div>

    <button class="btn"><a href="{{ route('country.index', ['country_id' => $currentCountry]) }}">選擇遊戲章節</a></button>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const message = @json(session('message')); // 使用 Blade 模板語法來傳遞變數
            console.log('Message:', message);
            if (message === 'nextlevel') {
                alert('你已經解鎖下一章!');
            }
        });
    </script>
@endsection
