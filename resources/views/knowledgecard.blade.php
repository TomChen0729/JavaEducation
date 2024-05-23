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
            background: linear-gradient(45deg, blueviolet, lightgreen);
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
            background: #333;
            color: #fff;
            font-size: 17px;
            border-radius: 5px;
            padding: 8px 25px;
        }

        .container .box-container .box .btn:hover{
            letter-spacing: 1px;
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
            @foreach($knowledgecard as $knowledgecards)
                <!-- 蠻金之國 資料型態 -->
                @if ($knowledgecards -> country_id == 1)
                    <div class="box">
                        <h3>{{ $knowledgecards -> name }}</h3>
                        <p>{{ $knowledgecards -> content }}</p>
                        <a href="#" class="btn">資料型態</a>
                    </div>
                @endif
                <!-- 蠻金之國 資料輸入輸出 -->
                @if ($knowledgecards -> country_id == 2)
                    <div class="box">
                        <h3>{{ $knowledgecards -> name }}</h3>
                        <p>{{ $knowledgecards -> content }}</p>
                        <a href="#" class="btn">資料輸入輸出</a>
                    </div>
                @endif
                <!-- 蠻金之國 運算子 -->
                @if ($knowledgecards -> country_id == 3)
                    <div class="box">
                        <h3>{{ $knowledgecards -> name }}</h3>
                        <p>{{ $knowledgecards -> content }}</p>
                        <a href="#" class="btn">運算子</a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection