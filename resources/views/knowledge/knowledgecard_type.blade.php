@extends('layouts.application')

@section('title', '知識卡類別')

@section('head', '綠野仙蹤')

@section('style')
    <style>
        *{
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            text-transform: capitalize;
            transition: .2s linear;
        }

        .container{
            margin-top: 100px;
            padding: 15px 9%;
            padding-bottom: 100px;
        }

        .container h1 {
            /* 字體設置 */
            font-family: 'Arial', sans-serif; /* 可以選擇適合的字體 */
            font-size: 60px; /* 調整字體大小 */
            font-weight: bold; /* 調整字體粗細 */

            text-shadow: -1px 0 #FBB03B, 0 1px #FBB03B, 5px 0 #FBB03B, 0 -1px #FBB03B;

            /* 顏色設置 */
            color: #FFFF33; /* 字體顏色 */
            
            /* 間距設置 */
            text-align: center;
            margin-top: 10px; /* 上邊距 */
            margin-bottom: 10px; /* 下邊距 */
            padding: 10px; /* 內邊距 */
            
            /* 其他樣式 */
            letter-spacing: 5px; /* 字母間距 */
        }

        .container .box-container{
            /* 網格結構，組織子元素 */
            display: grid;
            /* 定義網格結構: 重複一組列定義(自動調整列數量，定義每列的最小和最大寬度) */
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            /* 設置網格項之間的間距為 15 像素 */
            gap: 15px;
        }

        .container .box-container .box{
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
            border-radius: 5px;
            background: #fff;
            background: linear-gradient(45deg, #fad0c4, #ffd1ff);
            text-align: center;
            padding: 30px 20px;
        }

        .container .box-container .box h3{
            color: #444;
            font-size: 22px;
            font-weight: bold;
            padding: 10px 0;
        }

        .container .box-container .box .btn{
            margin-top: 10px;
            display: inline-block;
            background-color: #ffb6c1;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 17px;
            font-weight: bolder;
        }

        .container .box-container .box .btn:hover{
            letter-spacing: 1px;
            background-color: #ea9999;
        }

        .container .box-container .box:hover{
            box-shadow: 0 10px 15px rgba(0,0,0,.3);
            transform: scale(1.03);
        }

        .head {
            background-color: #a5948c;
            border: 5px solid #d4b0a5;
            border-radius: 20px;
            padding: 10px;
            display: flex;
            justify-content: space-between; /* 在左右對齊 */
            align-items: center; /* 使內容垂直居中 */
        }

        .breadcrumbs {
            display: inline-flex;
            letter-spacing: 5px;
            font-size: 20px;
            font-family: sans-serif;
        }

        .breadcrumbs__item {
            display: inline-block;
        }

        .breadcrumbs__item:not(:last-of-type)::after {
            content: '\203a';
            margin: 0 10px 0 5px;
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
            color: 	#B6D3DC;
            font-weight: bold;
        }

        .breadcrumbs__link__active:hover {
            color: #d4b0a5;
        }

        .boxes {
            display: inline-flex;
            height: 30px;
            cursor: pointer;
            padding: 10px 20px;
            border-radius: 30px;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            background-color: #fff;
            margin-left: 20px;
        }

        .boxes input {
            color: gray;
            width: 0;
            outline: none;
            border: none;
            font-weight: 500;
            transition: width 0.8s;
            background: transparent;
            padding: 0; 
        }

        .boxes input:focus {
            box-shadow: none; /* 移除聚焦時的陰影 */
            outline: none; /* 移除藍框 */
        }

        .boxes:hover input {
            width: 250px; /* 當用戶懸停時，展開input */
        }

        .boxes a .fas {
            color: #d4b0a5;
            font-size: 18px;
            margin-left: 10px;
        }

        @media (max-width: 768px) {
            .container{
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
            </ul>
            <div class="boxes">
                <input type="text" placeholder="Search...">
                <a href="#">
                    <i class="fas fa-search"></i>
                </a>
            </div>
        </div>

        <div>
            <h1>蠻金之國</h1>
        </div>
        <div class="box-container">
            @foreach($card_types as $card_type)
                <div class="box">
                    <h3>{{ $card_type -> card_type }}</h3>
                    <a href="{{ route('showallcards', ['card_type_id' => $card_type -> id]) }}" class="btn">GO</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection