@extends('layouts.application')

@section('title', '知識卡')

@section('style')
<style>
    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-decoration: none;
        transition: .2s linear;
    }

    .container {
        margin-top: 100px;
        padding: 15px 9%;
        padding-bottom: 100px;
    }

    .container .box-container {
        /* 網格結構，組織子元素 */
        display: grid;
        /* 定義網格結構: 重複一組列定義(自動調整列數量，定義每列的最小和最大寬度) */
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
        /* 設置網格項之間的間距為 15 像素 */
        gap: 15px;
    }

    .container .box-container .box {
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        border-radius: 5px;
        text-align: center;
        padding: 30px 20px;
    }

    /* 使用者擁有卡片的顏色 */
    .owned-card {
        background-color: #ffffff;
    }

    /* 使用者尚未擁有卡片的顏色 */
    .unowned-card {
        background-color: #f3e7e9;
        opacity: 0.7;
    }

    .container .box-container .box h3 {
        color: #444;
        font-size: 22px;
        padding: 10px 0;
    }

    .container .box-container .box p {
        font-size: 15px;
        line-height: 1.8;
    }

    .container .box-container .box .btn {
        margin-top: 10px;
        display: inline-block;
        background-color: #fcb69f;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 17px;
        font-weight: bolder;
    }

    .container .box-container .box .btn:hover {
        letter-spacing: 1px;
        background-color: #f1c232;
    }

    .container .box-container .box:hover {
        box-shadow: 0 10px 15px rgba(0, 0, 0, .3);
        transform: scale(1.03);
    }

    .head {
        background-color: #a5948c;
        border: 5px solid #d4b0a5;
        border-radius: 20px;
        padding: 10px;
        margin-bottom: 20px;
        display: flex;
        justify-content: space-between;
        /* 在左右對齊 */
        align-items: center;
        /* 使內容垂直居中 */
    }

    .breadcrumbs {
        display: inline-flex;
        letter-spacing: 5px;
        font-size: 24px;
        font-family: sans-serif;
    }

    .breadcrumbs__item {
        display: inline-block;
    }

    .breadcrumbs__item:not(:last-of-type)::after {
        content: '\203a';
        margin: 0 10px 0 5px;
        font-size: 25px;
        color: #fff;
    }

    .breadcrumbs__link {
        text-decoration: none;
        color: #fff;
        font-weight: bold;
    }

    .breadcrumbs__link:hover {
        text-decoration: underline;
        text-decoration: none;
        color: gray;
    }

    .breadcrumbs__link__active {
        text-decoration: none;
        color: #B6D3DC;
        font-weight: bold;
        text-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
    }

    .breadcrumbs__link__active:hover {
        color: #d4b0a5;
    }

    .boxes {
        display: inline-flex;
        height: 50px;
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 30px;
        align-items: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        margin-left: 20px;
    }

    .boxes input {
        color: gray;
        width: 100%;
        outline: none;
        border: none;
        font-weight: 500;
        font-size: 20px;
        transition: width 0.8s;
        background: transparent;
        padding: 0;
    }

    .boxes input:focus {
        box-shadow: none;
        outline: none;
    }

    /* .boxes:hover input {
            width: 250px;
        } */

    .boxes a .fas {
        color: #d4b0a5;
        font-size: 20px;
        margin-left: 10px;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="head">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('showallcardtypes') }}" class="breadcrumbs__link">知識卡</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link__active">{{ $card_type -> card_type }}</a>
            </li>
        </ul>
        {{-- <form action="{{ route('knowledge.search') }}" method="GET" style="display: flex; align-items: center;">
            <div class="boxes">
                <input type="text" name="keyword" placeholder="Search..." required>
                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form> --}}
    </div>

    <div class="box-container">
        @foreach($all_cards as $all_card)
        @php
        $owned = $user_cards_id->contains($all_card->id);
        @endphp
        <div class="box {{ $owned ? 'owned-card' : 'unowned-card' }}">
            <h3><strong>{{ $all_card -> name }}</strong></h3>
            <a href="{{ route('showcardcontent', ['card_id' => $all_card -> id]) }}" class="btn">Read More</a>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('script')
<script>

</script>
@endsection