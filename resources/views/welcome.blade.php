<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>JavaEducation - 首頁</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
            /*底線去除*/
            list-style: none;
            /*去除清單前面的符號*/
        }

        :root {
            --bg-color: #222327;
            --text-color: #333333;
            --main-color: #6875F5;
        }

        body {
            background-image: url('/images/background/backgroundnoroad2.svg');
            background-repeat: no-repeat;
            background-position: top;
            background-attachment: scroll;
            background-size: cover;
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px 10%;
            background: rgba(22, 83, 126, 0.8);
            /* 透明背景 */
            transition: all 0.50s ease;
        }

        .light {
            position: relative;
            font-size: 7em;
            letter-spacing: 15px;
            /* 字元間距 */
            color: #0e3742;
            text-transform: uppercase;
            /* 所有字母皆為大寫 */
            width: 200px;
            text-align: center;
            -webkit-box-reflect: below 1px linear-gradient(transparent, #0e3742);
            /* 鏡像效果：反射方向 反射距離 線性漸變 */
            line-height: 0.1em;
            /* 設置行高 */
            outline: none;
            /* 輪廓線 */
            animation: animate 5s linear infinite;
        }

        @keyframes animate {
            from {
                transform: translateX(0);
                /* 起始位置 */
            }

            to {
                transform: translateX(50px);
                /* 结束位置 */
            }
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo span {
            color: #fff;
            font-size: 30px;
            font-weight: bolder;
        }

        .navbar {
            display: flex;
            align-items: center;
            /* 確保垂直方向對齊 */
            margin-left: auto;
            /* 讓 navbar 靠右對齊 */
        }

        .navbar a {
            color: #fff;
            font-size: 18px;
            letter-spacing: 2px;
            /* 字元間距 */
            font-weight: bolder;
            text-align: center;
            border: 2px solid #fff;
            border-radius: 5px;
            padding: 5px 15px;
            margin: 0px 30px;
            transition: all 0.50s ease;
        }

        .navbar a:hover {
            width: 200px;
            color: #999999;
            background: #fff;
        }

        .main {
            display: flex;
            align-items: center;
        }

        .main a {
            margin-right: 25px;
            margin-left: 10px;
            color: var(--text-color);
            font-size: 20px;
            font-weight: 500;
            transition: all 0.50s ease;
        }

        .user {
            display: flex;
            align-items: center;
        }

        .main a:hover {
            color: var(--main-color);
        }

        #menu-icon {
            font-size: 35px;
            color: #fff;
            cursor: pointer;
            z-index: 10001;
            display: none;
        }

        .container {
            margin-top: 80px;
            display: flex;
            width: 100%;
            max-width: 1300px;
            height: 500px;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .icon {
            display: flex;
            transition: transform 0.4s ease;
        }

        .icon a:hover {
            transform: scale(1.03);
        }

        .icon img {
            height: 80%;
            width: 100%;
            object-fit: fill;
        }

        @media (max-width: 1280px) {
            header {
                padding: 14px 2%;
                transition: 0.2s;
            }

            .navbar a {
                padding: 5px 0;
                margin: 0px 20px;
            }
        }

        @media (max-width: 1090px) {
            #menu-icon {
                display: block;
            }

            .navbar {
                position: absolute;
                top: 100%;
                right: -100%;
                width: 270px;
                background: #16537e;
                font-style: none;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                border-radius: 10px;
                transition: all 0.50s ease;
            }

            .navbar a {
                border: none;
                display: block;
                margin: 12px 0;
                padding: 0px 25px;
                transition: all 0.50s ease;
            }

            .navbar a:hover {
                border: none;
                color: var(--text-color);
                transform: translateY(5px);
            }

            .navbar.open {
                right: 2%;
            }

            .display-none {
                display: none;
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
            <li><a href="{{ route('showallcardtypes') }}">知識卡</a></li>
            <li><a href="{{ route('profile.show') }}">個人資料</a></li>
            <li>
                @if (Route::has('login'))
                @auth
                <a href="{{ url('/dashboard') }}" class="px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                    歷史答題記錄
                </a>
                @else
                <a href="{{ route('login') }}" class="px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
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
            <li><a href="#">排行榜</a></li>
            <li><a href="#">最新消息</a></li>
        </ul>

        <div class="main">
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <div class="container">
        <div class="icon">
            <!-- $country是國家圖檔名，$status是他的可點選狀態 -->
            @foreach ($countries as $country => $status)
                @if ($status == 1)
                    <button><a href="{{ route('country.index', ['country_id' => $loop->index + 1]) }}"><img src="/images/country/{{ $country}}" alt=""></a></button>
                @else
                    <button onclick="alert('尚未解鎖')"><img src="/images/country/{{ $country }}" style="opacity:0.2" disabled </button>
                @endif
            @endforeach
        </div>
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


    </script>
</body>

</html>