@extends('layouts.application')

@section('title', '選擇遊戲')

@section('head', '蠻金之國')

@section('style')
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        .popup .overlay{
            position: fixed;
            top: 0px;
            left: 0px;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
            display: none;
        }

        .popup .content{
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: #fff;
            width: 950px;
            height: 500px;
            z-index: 1;
            padding: 20px;
            box-sizing: border-box;
            overflow: auto; /* 滾輪 */
        }

        .popup .pop{
            color: #333333;
            margin: 30px;
            padding: 30px;
            border-radius: 50px;
            border: 5px solid #333333;
        }

        .popup .pop h1{
            text-align: center;
            font-size: 26px;
            font-weight: bolder;
            margin-bottom: 5px;
        }

        .popup .pop p{
            font-size: 16px;
        }

        .popup .pop p.cen{
            text-align: center;
            margin-bottom: 30px;
        }

        .popup .pop hr{
            margin: 10px 0;
        }

        .popup .close-btn{
            cursor: pointer;
            position: absolute;
            right: 20px;
            top: 20px;
            width: 30px;
            height: 30px;
            background-color: #222;
            color: #fff;
            font-size: 25px;
            font-weight: 600;
            line-height: 30px;
            text-align: center;
            border-radius: 50%;
        }

        .popup.active .overlay{
            display: block;
        }

        .popup.active .content{
            transition: all 300ms ease-in-out;
            transform: translate(-50%, -50%) scale(1);
        }

        .containers{
            background: rgba(255, 255, 255, 0.9);
            padding: 5px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 20px;
            box-sizing: border-box;
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
            border: 2px solid #333;
            margin: 20px 0;
        }

        .TF, .CH, .MA, .RE, .PASS {
            font-size: 24px;
            font-weight: bold;
            margin: 30px;
            padding: 20px;
            width: 150px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            text-align: center;
            text-decoration: none;
        }

        .TF{
            background-color: #f1c232;
        }

        .CH{
            background-color: #bcdf49;
        }

        .MA{
            background-color: #e06666;
        }

        .RE{
            background-color: #76a5af;
        }

        .PASS{
            background-color: #8e7cc3;
        }

        .TF:hover, .CH:hover, .MA:hover, .RE:hover, .PASS:hover {
            box-shadow: 0 0 10px rgb(100, 100, 100);
            transform: scale(1.03);
        }

        .pass-buttons {
            display: flex;
            justify-content: center;
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
<div class="popup active" id="popup-1">
        <div class="overlay"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup()">&times;</div>
            <div class="pop">
                    <h1>遊戲說明</h1>
                    <p class="cen">歡迎來到《綠野仙蹤》遊戲，在這個遊戲中，你將會經歷兩個大關卡：學習區和闖關區。</p>
                    <p><strong>學習區</strong><br>
                    在學習區，你將會遇到四種不同的關卡類型：是非、選擇、重組和配對。</p>
                    <p><strong>闖關區</strong><br>
                    在完成學習區的所有關卡後，你將進入闖關區。</p>
                    <hr>
                    <p><strong>是非關卡</strong><br>
                    玩法說明：判斷題目所述內容的正確性，選擇正確答案是True還是False。</p>
                    <p><strong>選擇關卡</strong><br>
                    玩法說明：從多個選項中選擇一個最符合題意的答案。</p>
                    <p><strong>重組關卡</strong><br>
                    玩法說明：根據提示內容，將打亂的程式碼片段按正確順序重組。</p>
                    <p><strong>配對關卡</strong><br>
                    玩法說明：根據題目與正確的描述或應用進行配對。</p>
                    <p><strong>Debug關卡</strong><br>
                    玩法說明：在這個關卡中，你會得到一段有錯誤的程式碼。你的任務是找出並修正這些錯誤。</p>
                    <hr>
                    <p><strong>獎勵</strong><br>
                    成功通過學習區和闖關區後，你將獲得一包知識卡，這將幫助你更好地理解和運用相關知識。</p>
                    <p>準備好開始你的冒險了嗎？快來挑戰這個充滿知識與樂趣的遊戲，提升你的編程技能吧！</p>
                </div>
        </div>
    </div>

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
                    <button class="RE"><a href="{{ route('game.gameTypeChoose', ['GameType' => $item -> gametype, 'country_id' => $item -> country_id, 'levels' => $item -> levels]) }}">{{ $item -> gametype }}</a></button>
                @endif
            @endforeach
        </div>
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
        // 畫面載入後顯示彈跳視窗
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById("popup-1").classList.add("active");
        });

        function togglePopup() {
            document.getElementById("popup-1").classList.toggle("active");
        }
    </script>
@endsection
