<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>遊戲選擇</title>
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
            background-image: url('/images/country3choose/countrychoose3bg.svg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            width: 100%;
            height: 110%; /* 使用視窗高度 */
            position: relative; /* 使子元素可以基於此定位 */
        }

        .userNeedCards {
            font-size: 40px;
            font-weight: bold;
            background-color: #FFEEBC;
            border: 5px solid #26422a;
            color: #26422a;
            padding: 50px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
            border-radius: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.8);
            z-index: 1000;
        }

        .close-btn {
            position: absolute;
            padding: 0 20px;
            top: 20px;
            right: 20px;
            font-size: 40px;
            color: #FFF;
            cursor: pointer;
            border-radius: 50px;
            background: #26422a;
        }

    </style>
</head>
<body>
    <div class="header"></div>

    @if(session('notice'))
        <div class="userNeedCards" id="userNeedCards">
            <button class="close-btn" onclick="closeNotice()">&times;</button>
            @foreach (session('notice')['userNeedToGetCards'] as $item)
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
                            <img src="/images/country3choose/{{ $item['imgPath'] }}" alt="Button">
                        </a>
                    </div>
                @endforeach
            </div>
        </div> 
    </div>

    <script>
        // 關閉彈窗
        function closeNotice() {
            var userNeedCards = document.getElementById('userNeedCards');
            if (userNeedCards) {
                userNeedCards.style.display = 'none';
            }
        }
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
                        img.style.top = `${screenHeight * 0.75}px`;
                        img.style.left = `${screenWidth * 0.02}px`;
                        break;
                    case 1:
                        img.style.top = `${screenHeight * 0.10}px`;
                        img.style.left = `${screenWidth * 0.80}px`;
                        break;
                    case 2:
                        img.style.top = `${screenHeight * 0.75}px`;
                        img.style.left = `${screenWidth * 0.80}px`;
                        break;
                    case 3:
                        img.style.top = `${screenHeight * 0.10}px`;
                        img.style.left = `${screenWidth * 0.30}px`;
                        break;
                    case 4:
                        img.style.top = `${screenHeight * 0.425}px`;
                        img.style.left = `${screenWidth * 0.565}px`;
                        break;
                    case 5:
                        img.style.top = `${screenHeight * 0.10}px`;
                        img.style.left = `${screenWidth * 0.565}px`;
                        break;
                    case 6:
                        img.style.top = `${screenHeight * 0.45}px`;
                        img.style.left = `${screenWidth * 0.02}px`;
                        break;
                    case 7:
                        img.style.top = `${screenHeight * 0.75}px`;
                        img.style.left = `${screenWidth * 0.57}px`;
                        break;
                    case 8:
                        img.style.top = `${screenHeight * 0.76}px`;
                        img.style.left = `${screenWidth * 0.30}px`;
                        break;
                    case 9:
                        img.style.top = `${screenHeight * 0.10}px`;
                        img.style.left = `${screenWidth * 0.02}px`;
                        break;
                    case 10:
                        img.style.top = `${screenHeight * 0.47}px`;
                        img.style.left = `${screenWidth * 0.30}px`;
                        break;
                    case 11:
                        img.style.top = `${screenHeight * 0.47}px`;
                        img.style.left = `${screenWidth * 0.80}px`;
                        break;
                    default:
                        break;
                }

                switch (status) {
                    case 'true':

                        break;
                    case 'false':
                        img.style.opacity = '0.2';
                        
                        break;
                    case 'pass':
                        switch (index) {
                            case 0:
                                img.src = '/images/country3choose/clear/treasure.svg';
                                break;
                            case 1:
                                img.src = '/images/country3choose/clear/food.svg';
                                break;
                            case 2:
                                img.src = '/images/country3choose/clear/check.svg';
                                break;
                            case 3:
                                img.src = '/images/country3choose/clear/member.svg';
                                break;
                            case 4:
                                img.src = '/images/country3choose/clear/spy.svg';
                                break;
                            case 5:
                                img.src = '/images/country3choose/clear/clean.svg';
                                break;
                            case 6:
                                img.src = '/images/country3choose/clear/award.svg';
                                break;
                            case 7:
                                img.src = '/images/country3choose/clear/spell.svg';
                                break;
                            case 8:
                                img.src = '/images/country3choose/clear/paper.svg';
                                break;
                            case 9:
                                img.src = '/images/country3choose/clear/book.svg';
                                break;
                            case 10:
                                img.src = '/images/country3choose/clear/shop.svg';
                                break;
                            case 11:
                                img.src = '/images/country3choose/clear/flyers.svg';
                                break;
                            default:
                                break;
                        }
                        img.style.opacity = '1'; // 確保圖片全顯示
                        
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
</body>
</html>
