@extends('layouts.application')

@section('title', '學習區是非')

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
        
        .question{
            background-color: #f1c232;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 645px;
            overflow: hidden;
            padding: 90px;  /*內部*/
            margin: 20px;
            font-size: 28px;
            font-weight: bold;
            text-align: center;
        }

        .true{
            font-size: 20px;
            margin: 20px;
            background-color: #93c47d;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 300px;
            overflow: hidden;
            padding: 90px;  /*內部*/
        }

        .flase{
            font-size: 20px;
            margin: 20px;
            background-color: #e06666;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 300px;
            overflow: hidden;
            padding: 90px;  /*內部*/
        }
    </style>
@endsection

@section('content')
<div class="tof">
    <div class="question">
        <h2>float資料型態是否能儲存小數值</h2>
    </div>
    <div>
        <button class="true">True</button>
        <button class="flase">False</button>
    </div>
</div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection