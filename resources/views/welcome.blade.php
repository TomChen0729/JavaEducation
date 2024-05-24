<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEducation - 首頁</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', ])
    <style>
            *{
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
                text-decoration: none; /*底線去除*/
                list-style: none; /*去除清單前面的符號*/
            }

            :root{
                --bg-color: #222327;
                --text-color: #fff;
                --main-color: #6875F5;
            }

            body{
                background: var(--bg-color);
                color: var(--text-color);
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

            .container{
                margin: 30px 0 0 0;
                display: flex;
                justify-content: center; /* 水平置中 */
                align-items: center; /* 垂直置中 */
                height: 80%; /* 這是可視窗口高度的百分比，確保容器填滿整個畫面 */
            }

            .light{
                position: relative;
                font-size: 6em;
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
                    transform: translateX(80px); /* 结束位置 */
                }
            }

            .logo{
                display: flex;
                align-items: center;
            }

            .logo span{
                color: var(--text-color);
                font-size: 24px;
                font-weight: 600;
            }

            .navbar{
                display: flex;
            }

            .navbar a{
                color: var(--text-color);
                font-size: 20px;
                font-weight: 500;
                padding: 5px 0;
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
                    background: var(--bg-color);
                    background-color: #222327;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-start;
                    border-radius: 10px;
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
            <li><a href="{{ route("profile.show") }}">個人資料</a></li>
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

    <div class="container" style="display: flex; justify-content: center; align-items: center;">
        @foreach ($countries as $country )
            @if ($country -> id == 1)
                <button style="border: 1px solid white; padding: 20px; margin-top: 300px"><a href="{{route('country.index', ['country_id' => $country -> id]) }}">{{  $country -> name }}</a></button>
            @else
                <button style="border: 1px solid white; padding: 20px; margin-left: 10px; margin-top: 300px"><a href="{{route('country.index', ['country_id' => $country -> id]) }}">{{  $country -> name }}</a></button>  
            @endif    
        @endforeach
    </div>


    <!--js-->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script>
        let menu = document.querySelector('#menu-icon');
        let navbar = document.querySelector('.navbar');

        menu.onclick = () => {
            menu.classList.toggle('bx-x');
            navbar.classList.toggle('open');
        }
    </script>
</body>
</html>
