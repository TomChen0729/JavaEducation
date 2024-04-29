<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JavaEducation - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
                text-decoration: none;
                list-style: none;
            }

            :root{
                --bg-color: #222327;
                --text-color: #fff;
                --main-color: #6875F5;
            }

            body{
                min-height: 100vh;
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
                transition: all .50s ease;
            }

            .logo{
                display: flex;
                align-items: center;
            }

            .logo span{
                color: var(--text-color);
                font-size: 20px;
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

            .navbar a.active{
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
                    height: 30px;
                    background: var(--bg-color);
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

                .navbar a.active{
                    color: var(--text-color);
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
        <a href="#" class="logo"><span>綠野仙蹤</span></a>
                        
                        <ul class="navbar">
                            <li><a href="#" class="active">知識卡</a></li>
                            <li><a href="{{ route("profile.show") }}">個人資料</a></li>
                            <li><a href="#">排行榜</a></li>
                            <li><a href="#">最新消息</a></li>
                            <li><a href="#">歷史答題記錄</a></li>
                        </ul>

                        <div class="main">
                            <div class="bx bx-menu" id="menu-icon"></div>
                        </div>
    </header>
    
    <content>
        @yield('content')
    </content>

    
    <!--js-->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    @yield('srcipt')
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