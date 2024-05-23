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
            <div class="box">
                <h3>float</h3>
                <p>單精浮點數</p>
                <a href="#" class="btn">read more</a>
            </div>

            <div class="box">
                <h3>double</h3>
                <p>雙精浮點數</p>
                <a href="#" class="btn">read more</a>
            </div>

            <div class="box">
                <h3>boolean</h3>
                <p>布林值</p>
                <a href="#" class="btn">read more</a>
            </div>

            <div class="box">
                <h3>int</h3>
                <p>整數</p>
                <a href="#" class="btn">read more</a>
            </div>

            <div class="box">
                <h3>char</h3>
                <p>字元</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection