<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>選擇遊戲</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/base16-dark.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/clike/clike.min.js"></script>
    @extends('layouts.application')

    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
            list-style: none;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .container-fluid {
            background-image: url('/images/country2choose/secnoroad.svg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            width: 100%;
            height: 100vh; /* 使用視窗高度 */
            position: relative; /* 使子元素可以基於此定位 */
        }

        .userNeedCards{
            background-color: white;
            height: 200px;
            width: 200px;
        }

    </style>
</head>

<body>
    <div class="header">

    </div>
    @if(!empty($userNeedToGetCards))
        <div class="userNeedCards" id="userNeedCards">
            @foreach ($userNeedToGetCards as $item)
                <p>你缺少{{ $item }}知識卡</p>
            @endforeach
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @foreach ($iconData as $item)
                    <div class="button" data-index="{{ $iconData }}">
                        <a href="{{ route('sec.GameChoose', ['country_id' => $currentCountry, 'secGameID' => $item['secGameID']]) }}">
                            <img src="/images/country2choose/{{ $item['imgPath'] }}" alt="Button">
                        </a>
                    </div>
                @endforeach
            </div>
        </div> 
    </div>
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var userNeedCards = document.getElementById('userNeedCards');
    if (userNeedCards) {
        setTimeout(function() {
            userNeedCards.style.transition = 'opacity 0.5s';
            userNeedCards.style.opacity = '0';
            setTimeout(function() {
                userNeedCards.style.display = 'none';  // 淡出完成後隱藏元素並移除空間
            }, 500);  // 淡出時間需要和過渡時間一致
        }, 1000);  // 1秒後淡出
    }
});

// 獲取所有按鈕
const buttons = document.querySelectorAll('.button');

buttons.forEach((button, iconData) => {
    const img = button.querySelector('img'); // 獲取img
    img.style.position = 'absolute';
    img.style.width = '20%'; 
    img.style.height = 'auto';

    switch (iconData) {
        case 0:
            img.style.top = '380px';
            img.style.left = '39%';
            break;
        case 1:
            img.style.top = '100px';
            img.style.left = '68%';
            break;
        case 2:
            img.style.top = '420px';
            img.style.left = '10%';
            break;
        case 3:
            img.style.top = '90px';
            img.style.left = '38%';
            break;
        case 4:
            img.style.top = '60px';
            img.style.left = '5%';
            break;
        case 5:
            img.style.top = '660px';
            img.style.left = '39%';
            break;
        case 6:
            img.style.top = '640px';
            img.style.left = '10%';
            break;
        case 7:
            img.style.top = '600px';
            img.style.left = '75%';
            break;
        case 8:
        img.style.top = '350px';
        img.style.left = '70%';
        break;
        default:
            break;
    }
});
</script>
</html>