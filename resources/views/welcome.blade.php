<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>JavaEducation - 首頁</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none; /*底線去除*/
            list-style: none; /*去除清單前面的符號*/
        }

        :root{
            --bg-color: #222327;
            --text-color: #333333;
            --main-color: #6875F5;
        }

        body{
            background: url('/images/background/backgroundnoroad2.svg') no-repeat center center fixed;
            background-size: cover;
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        header{
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: transparent;
            padding: 28px 12%;
            margin: 10px;
            transition: all .50s ease;
        }

        .light{
            position: relative;
            font-size: 7em;
            letter-spacing: 15px; /* 字元間距 */
            color: #0e3742;
            text-transform: uppercase; /* 所有字母皆為大寫 */
            width: 200px;
            text-align: center;
            -webkit-box-reflect: below 1px linear-gradient(transparent, #0e3742); /* 鏡像效果：反射方向 反射距離 線性漸變 */
            line-height: 0.1em; /* 設置行高 */
            outline: none; /* 輪廓線 */
            animation: animate 5s linear infinite;
        }

        @keyframes animate {
            from {
                transform: translateX(0); /* 起始位置 */
            }
            to {
                transform: translateX(50px); /* 结束位置 */
            }
        }

        .logo{
            display: flex;
            align-items: center;
        }

        .logo span{
            color: var(--text-color);
            font-size: 30px;
            font-weight: bolder;
        }

        .navbar{
            display: flex;
        }

        .navbar a{
            color: var(--text-color);
            background: #fce5cd;
            border: 2px solid #5b5b5b;
            border-radius: 50px;
            font-size: 20px;
            font-weight: bolder;
            padding: 5px 15px;
            margin: 0px 30px;
            transition: all .50s ease;
        }

        .navbar a:hover{
            color: var(--main-color);
        }

        .main{
            display: flex;
            align-items: center;
        }

        .main a{
            margin-right: 25px;
            margin-left: 10px;
            color: var(--text-color);
            font-size: 20px;
            font-weight: 500;
            transition: all .50s ease;
        }

        .user{
            display: flex;
            align-items: center;
        }

        .main a:hover{
            color: var(--main-color);
        }

        #menu-icon{
            font-size: 35px;
            color: var(--text-color);
            cursor: pointer;
            z-index: 10001;
            display: none;
        }

        .wrapper {
            margin-top: 80px;
            display: flex;
            width: 100%;
            max-width: 1000px;
            height: 500px;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            height: 36px;
            width: 36px;
            background-color: #343f4f;
            border-radius: 50%;
            text-align: center;
            line-height: 36px;
            color: #fff;
            font-size: 15px;
            transition: all 0.3s linear;
            z-index: 100;
            cursor: pointer;
        }

        .button:active {
            transform: scale(0.94) translateY(-50%);
        }

        #prev {
            left: 25px;
        }

        #next {
            right: 25px;
        }

        .image-container {
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .carousel {
            display: flex;
            transition: transform 0.4s ease;
        }

        .carousel a {
            display: inline-block; /* 将链接元素设置为块级元素 */
            padding: 0; /* 清除内边距 */
            border: none; /* 清除边框 */
        }

        .carousel img {
            margin: 0 10px;
            height: 500px;
            width: 100%;
            object-fit: fill;
        }

        @media (max-width: 1280px){
            header{
                padding: 14px 2%;
                transition: .2s;
            }
            .navbar a{
                padding: 5px 0;
                margin: 0px 20px;
            }
        }

        @media (max-width: 1090px){
            #menu-icon{
                display: block;
            }

            .navbar{
                position: absolute;
                top: 100%;
                right: -100%;
                width: 270px;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                transition: all .50s ease;
            }

            .navbar a{
                display: block;
                margin: 12px 0;
                padding: 0px 25px;
                transition: all .50s ease;
            }

            .navbar a:hover{
                color: var(--text-color);
                transform: translateY(5px);
            }

            .navbar.open{
                right: 2%;
            }
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="light"><a href="{{ route('welcome') }}" class="logo"><span>綠野仙蹤</span></a></div>

        <ul class="navbar">
            <li><a href="#">知識卡</a></li>
            <li><a href="{{ route('profile.show') }}">個人資料</a></li>
            <li><a href="#">排行榜</a></li>
            <li><a href="#">最新消息</a></li>
            <li>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                            歷史答題記錄
                        </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                    Register
                                </a>
                        @endif
                    @endauth
                @endif
            </li>
        </ul>

        <div class="main">
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <section class="wrapper">
        <i class="fas fa-arrow-left button" id="prev"></i>
        <div class="image-container">
            <div class="carousel">
                <img src="/images/country/lv1.svg" alt="">
                <img src="/images/country/lv2.svg" alt="">
                <img src="/images/country/lv3.svg" alt="">
                <img src="/images/country/lv4.svg" alt="">
                <img src="/images/country/lv5.svg" alt="">
                <!-- <a href="{{route('country.index', ['country_id' => 1]) }}" style="display: inline-block;"><img src="/images/country/lv1.svg" alt=""></a>
                <a href="{{route('country.index', ['country_id' => 2]) }}" style="display: inline-block;"><img src="/images/country/lv2.svg" alt=""></a>
                <a href="{{route('country.index', ['country_id' => 3]) }}" style="display: inline-block;"><img src="/images/country/lv3.svg" alt=""></a>
                <a href="{{route('country.index', ['country_id' => 4]) }}" style="display: inline-block;"><img src="/images/country/lv4.svg" alt=""></a>
                <a href="{{route('country.index', ['country_id' => 5]) }}" style="display: inline-block;"><img src="/images/country/lv5.svg" alt=""></a> -->
            </div>
        </div>
        <i class="fas fa-arrow-right button" id="next"></i>
    </section>

    <!-- <div class="container" style="display: flex; justify-content: center; align-items: center;">
        @foreach ($countries as $country )
            @if ($country -> id == 1)
                <button style="border: 1px solid white; padding: 20px; margin-top: 300px"><a href="{{route('country.index', ['country_id' => $country -> id]) }}">{{  $country -> name }}</a></button>
            @else
                <button style="border: 1px solid white; padding: 20px; margin-left: 10px; margin-top: 300px"><a href="{{route('country.index', ['country_id' => $country -> id]) }}">{{  $country -> name }}</a></button>  
            @endif    
        @endforeach
    </div> -->

    <!-- <div class="container">
        <a href="{{route('country.index', ['country_id' => 1]) }}">國家一</a>
        <a href="{{route('country.index', ['country_id' => 2]) }}">國家二</a>
        <a href="{{route('country.index', ['country_id' => 3]) }}">國家三</a>
        <a href="{{route('country.index', ['country_id' => 4]) }}">國家四</a>
        <a href="{{route('country.index', ['country_id' => 5]) }}">國家五</a>
    </div> -->


    <!--js-->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script>
        let menu = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');

        menu.onclick = () => {
            menu.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        }

        // 輪播圖
        const wrapper = document.querySelector(".wrapper"),
            carousel = document.querySelector(".carousel"),
            images = document.querySelectorAll(".carousel img"),
            buttons = document.querySelectorAll(".button");

        let imageIndex = 0;

        // 更新輪播圖顯示以顯示指定影像函數
        const slideImage = () => {
            // 計算更新後的圖片索引
            if (imageIndex < 0) imageIndex = images.length - 1;
            if (imageIndex >= images.length) imageIndex = 0;
            // 更新輪播圖顯以顯示指定圖片
            carousel.style.transform = `translateX(-${imageIndex * 100}%)`;
        };

        // 更新輪播圖已顯示下一張或上一張
        const updateClick = (e) => {
            // 根據點擊的按鈕計算更新後的圖片索引
            imageIndex += e.target.id === "next" ? 1 : -1;
            slideImage();
        };

        // 導向按鈕事件監聽
        buttons.forEach(button => button.addEventListener("click", updateClick));

        // 初始化顯示第一張圖片
        slideImage();
    </script>
</body>
</html>
