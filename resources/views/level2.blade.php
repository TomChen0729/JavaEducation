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

        .userNeedCards {
            background-color: white;
            padding: 20px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 250px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            background: none;
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
                            <img src="/images/country2choose/{{ $item['imgPath'] }}" alt="Button">
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
                    case 'true':
                        
                        break;
                    case 'false':
                        img.style.opacity = '0.2';
                        
                        break;
                    case 'pass':
                        switch (index) {
                            case 0:
                                img.src = '/images/country2choose/CLEAR/clearopendoor.svg';
                                break;
                            case 1:
                                img.src = '/images/country2choose/CLEAR/clearopenbox.svg';
                                break;
                            case 2:
                                img.src = '/images/country2choose/CLEAR/clearidcard.svg';
                                break;
                            case 3:
                                img.src = '/images/country2choose/CLEAR/cleargem.svg';
                                break;
                            case 4:
                                img.src = '/images/country2choose/CLEAR/clearcave.svg';
                                break;
                            case 5:
                                img.src = '/images/country2choose/CLEAR/clear3doors.svg';
                                break;
                            case 6:
                                img.src = '/images/country2choose/CLEAR/clearsword.svg';
                                break;
                            case 7:
                                img.src = '/images/country2choose/CLEAR/clearmonster.svg';
                                break;
                            case 8:
                                img.src = '/images/country2choose/CLEAR/clearfire.svg';
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