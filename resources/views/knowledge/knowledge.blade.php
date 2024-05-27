@extends('layouts.application')

@section('title', '知識卡')

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
            padding: 10px 0;
        }

        .container .box-container .box p{
            font-size: 15px;
            line-height: 1.8;
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

        @media (max-width: 768px) {
            .container{
                padding: 20px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="box-container">
            @foreach($all_cards as $all_card)
                <div class="box">
                    <h3>{{ $all_card -> name }}</h3>
                    <a href="{{ route('showcardcontent', ['card_id' => $all_card -> id]) }}" class="btn">GO</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection