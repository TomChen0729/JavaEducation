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
    @extends('layouts.application2')

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
            overflow: hidden;
            
        }

        .container-fluid {
            background-image: url('/images/country2choose/secnoroad.svg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            width: 100%;
            height: 110%; /* 使用視窗高度 */
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
                <div class="button" data-index="{{ $loop->index }}" data-secgameid="{{ $item['secGameID'] }}" data-status="{{ $item['status'] }}">
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

function setButtonPositions() {
    const screenWidth = window.innerWidth;
    const screenHeight = window.innerHeight;

    buttons.forEach((button, index) => {
        const status = button.getAttribute('data-status'); // 獲取 status
        console.log(`Button ${index + 1}: status = ${status}`);
        const img = button.querySelector('img'); // 獲取 img
        img.style.position = 'absolute';
        img.style.width = '20%'; 
        img.style.height = 'auto';

        // 根據螢幕大小調位置
        switch (index) {
            case 0:
                img.style.top = `${screenHeight * 0.45}px`;
                img.style.left = `${screenWidth * 0.39}px`;
                break;
            case 1:
                img.style.top = `${screenHeight * 0.15}px`;
                img.style.left = `${screenWidth * 0.68}px`;
                break;
            case 2:
                img.style.top = `${screenHeight * 0.45}px`;
                img.style.left = `${screenWidth * 0.10}px`;
                break;
            case 3:
                img.style.top = `${screenHeight * 0.10}px`;
                img.style.left = `${screenWidth * 0.38}px`;
                break;
            case 4:
                img.style.top = `${screenHeight * 0.10}px`;
                img.style.left = `${screenWidth * 0.05}px`;
                break;
            case 5:
                img.style.top = `${screenHeight * 0.75}px`;
                img.style.left = `${screenWidth * 0.39}px`;
                break;
            case 6:
                img.style.top = `${screenHeight * 0.75}px`;
                img.style.left = `${screenWidth * 0.10}px`;
                break;
            case 7:
                img.style.top = `${screenHeight * 0.75}px`;
                img.style.left = `${screenWidth * 0.75}px`;
                break;
            case 8:
                img.style.top = `${screenHeight * 0.45}px`;
                img.style.left = `${screenWidth * 0.70}px`;
                break;
            default:
                break;
        }

        switch (status) {
            case '1':
                
                break;
            case '':
                img.style.opacity = '0.2';
                button.querySelector('a').addEventListener('click', function(e) {
                    e.preventDefault();
                    alert('尚未解鎖');
                });
                break;
            case 'pass':
                const completedLabel = document.createElement('span');
                completedLabel.innerText = '已通關';
                completedLabel.style.position = 'absolute';
                completedLabel.style.transform = 'translateX(-50%)'; 
                completedLabel.style.color = 'green';
                completedLabel.style.fontSize = '48px';
                completedLabel.style.fontWeight = 'bold';
                completedLabel.style.backgroundColor = 'white';
                completedLabel.style.padding = '5px';
                completedLabel.style.borderRadius = '5px';
                completedLabel.style.pointerEvents = 'none';
                button.style.position = 'relative';

                // 計算圖片的位置
                const imgRect = img.getBoundingClientRect();
                const imgCenterX = imgRect.left + imgRect.width / 2;
                const imgCenterY = imgRect.top + imgRect.height / 2;

                completedLabel.style.top = `${imgCenterY}px`; // 設在圖片中心
                completedLabel.style.left = `${imgCenterX}px`;
                completedLabel.style.transform = 'translate(-72%, -50%)';

                
                button.appendChild(completedLabel); // 添加標籤到按鈕
                break;
            default:
                break;
        }
    });
}

// 在 DOM 加載完成後設置按鈕位置
document.addEventListener('DOMContentLoaded', setButtonPositions);

// 當窗口大小改變時重新設置按鈕位置
window.addEventListener('resize', setButtonPositions);

</script>
</html>