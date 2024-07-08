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


    .popup .overlay {
        position: fixed;
        top: 0px;
        left: 0px;
        width: 100vw;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        z-index: 1;
        display: none;
    }

    .popup .content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        background: #223E53;
        border-radius: 30px;
        width: 60%;
        z-index: 1;
        padding: 20px;
        box-sizing: border-box;
    }

    .popup .pop {
        color: #E7F2E1;
        margin: 30px;
        padding: 30px;
        border-radius: 50px;
        border: 5px solid #CABA89;
    }

    .popup .pop h1 {
        text-align: center;
        font-size: 26px;
        font-weight: bolder;
        margin-bottom: 5px;
    }

    .popup .pop p {
        font-size: 16px;
    }

    .popup .pop p.cen {
        text-align: center;
        margin-bottom: 20px;
    }

    .popup .pop hr {
        margin: 10px 0;
        border: 1px solid #CABA89;
    }

    .popup .close-btn {
        cursor: pointer;
        position: absolute;
        right: 20px;
        top: 20px;
        width: 30px;
        height: 30px;
        background-color: #CABA89;
        color: #E7F2E1;
        font-size: 25px;
        font-weight: 600;
        line-height: 30px;
        text-align: center;
        border-radius: 50%;
    }

    .popup.active .overlay {
        display: block;
    }

    .popup.active .content {
        transition: all 300ms ease-in-out;
        transform: translate(-50%, -50%) scale(1);
    }


    .container {
        max-width: 1000px;
        height: 100%;
        margin: 80px auto 0;
        padding: 10px;
        text-align: center;
        background-color: rgba(255, 255, 255, 0.8);
        /* 添加背景颜色 */
        border-radius: 12px;
        /* 添加圆角 */
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
        color: #274e13;
    }

    .headers p {
        font-size: 18px;
        color: #783f04;
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
        color: #fff;
        display: inline-block;
        padding: 10px 20px;
        background-color: #333;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .card-content .btn:hover {
        background-color: #fff;
        color: #333;
        border: 2px solid #333;
        transform: translateY(-2px);
    }

    .card-content .icon {
        font-size: 48px;
        margin-bottom: 15px;
        color: #007bff;
    }

    .footers {
        margin: 50px auto;
        padding: 20px;
        background-color: #59412D;
        border: 3px solid #452E34;
        border-radius: 30px;
        text-align: center;
        max-width: 800px;
    }

    .footers h1 {
        font-size: 36px;
        font-weight: bold;
        margin: 10px;
        color: #59412D;
        text-shadow: -1px -1px 0 #F1F4DA, 1px -1px 0 #F1F4DA, -1px 1px 0 #F1F4DA, 1px 1px 0 #F1F4DA;
    }

    .footers p {
        font-size: 18px;
        color: #F1F4DA;
        margin-bottom: 10px;
    }

    .PASS {
        background: #F1F4DA;
        border: 2px solid #F1F4DA;
        font-size: 20px;
        font-weight: bold;
        color: #59412D;
        margin: 10px;
        padding: 10px;
        width: 120px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        text-decoration: none;
    }

    .PASS:hover {
        box-shadow: 0 0 10px rgb(100, 100, 100);
        background-color: #59412D;
        border: 2px solid #F1F4DA;
        color: #F1F4DA;
        transform: scale(1.03);
    }

    @media (max-width: 1300px) {
        .popup .content {
            top: 60%;
        }
    }

    @media (max-width: 900px) {
        .container {
            height: 100%;
        }

        .card {
            width: 90%;
            /* Adjust card width */
            margin: 10px auto;
        }

        .headers h1 {
            font-size: 24px;
            /* Reduce header font size */
        }

        .headers p {
            font-size: 14px;
            /* Reduce paragraph font size */
        }

        .popup .content {
            width: 90%;
            height: auto;
            max-height: 80vh;
        }

        .popup .pop h1 {
            font-size: 20px;
        }

        .popup .pop p {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
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
            <p><strong>獎勵</strong><br>
                成功通過學習區後，你將獲得一包知識卡，這將幫助你更好地理解和運用相關知識，來決戰闖關區。</p>
            <p>準備好開始你的冒險了嗎？快來挑戰這個充滿知識與樂趣的遊戲，提升你的編程技能吧！</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="headers">
        <h1>選擇你的學習區遊戲難度</h1>
        <p>挑戰不同的關卡，提升你的程式技能！</p>
    </div>

    <div class="card-container">
        @foreach($parent_cards as $card)
        @if((($card->country_id) <= auth()->user()->country_id) &&(($card -> levels) <= auth()->user()->levels))
                <div class="card">
                    <div class="card-content">
                        <div class="icon">{{ html_entity_decode($card -> img) }}</div>
                        <h3>LV.{{ $card->levels }}</h3>
                        <p>{{ $card->card_type }}</p>
                        <a href="{{ route('game.index', ['levels' => $card->levels, 'country_id' => $card->country_id]) }}" class="btn">開始遊戲</a>
                    </div>
                </div>
                @else
                <div class="card">
                    <div class="card-content">
                        <div class="icon">{{ html_entity_decode($card -> img) }}</div>
                        <h3>LV.{{ $card->levels }}</h3>
                        <p>{{ $card->card_type }}</p>
                        <a href="#" onclick="alert('尚未解鎖')" class="btn">開始遊戲</a>
                    </div>
                </div>
                @endif
                @endforeach
    </div>
    @if($debug == 1)
    <div class="footers">
        <h1>闖關區</h1>
        <p>在完成上方學習區的所有關卡後，你將進入闖關區。</p>
        <button class="PASS"><a href="{{ route('game.debugRD', ['country_id' => $currentCountry]) }}">闖關區</a></button>
    </div>
    @else
    <div class="footers">
        <h1>闖關區</h1>
        <p>在完成上方學習區的所有關卡後，你將進入闖關區。</p>
        <button class="PASS" onclick="alert('尚未解鎖')">闖關區</button>
    </div>
    @endif
</div>
@endsection

@section('script')
<script>
    // 畫面載入後顯示彈跳視窗
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById("popup-1").classList.add("active");
    });

    function togglePopup() {
        document.getElementById("popup-1").classList.toggle("active");
    }
</script>
@endsection