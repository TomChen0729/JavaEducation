<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEducation - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <a href="#" class="logo"><span>綠野仙蹤</span></a>
        
        <ul class="navbar">
            <li><a href="#" class="active">知識卡</a></li>
            <li><a href="#">個人資料</a></li>
            <li><a href="#">排行榜</a></li>
            <li><a href="#">最新消息</a></li>
            <li><a href="#">歷史答題記錄</a></li>
        </ul>

        <div class="main">
            <a href="#" class="user">登入</a>
            <a href="#">註冊</a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>

    </header>
    
    <content>
        @yield('content')
    </content>

    
    <!--js-->
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