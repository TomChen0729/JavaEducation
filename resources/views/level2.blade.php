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

        .button img, .button2 img, .button3 img, .button4 img, .button5 img, .button6 img, .button7 img, .button8 img {
            position: absolute;
            width: 20%;
            height: auto;
            cursor: pointer;
        }


        .button img{
            top: 350px;
            left: 10%;
        }

        .button2 img{
            top: 0px;
            left: 38%;
        }

        .button3 img{
            top: 0px;
            left: 70%;
        }

        .button4 img{
            top: 520px;
            left: 10%;
        }

        .button5 img{
            top: 300px;
            left: 39%;
        }

        .button6 img{
            top: 10px;
            left: 5%;
        }

        .button7 img{
            top: 530px;
            left: 39%;
        }

        .button8 img{
            top: 340px;
            left: 75%;
        }



    </style>
</head>

<body>
    <div class="header">

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="button">
                    <a href="{{ route('sec.GameChoose', ['country_id' => $currentCountry, 'gameName' => '通關密碼']) }}">
                    <img src="/images/country2choose/password.svg" alt="Button">
                </a>
            </div>
            <div class="button2">
                <a href="{{ route('sec.GameChoose', ['country_id' => $currentCountry, 'gameName' => '魔法門衛']) }}">
                    <img src="/images/country2choose/idcard.svg" alt="Button">
                </a>
            </div>
            <div class="button3">
                <a href="{{ route('sec.GameChoose', ['country_id' => $currentCountry, 'gameName' => '魔法寶箱']) }}">
                    <img src="/images/country2choose/box.svg" alt="Button">
                </a>
            </div>
            <div class="button4">
                <a href="#">
                    <img src="/images/country2choose/gem.svg" alt="Button">
                </a>
            </div>
            <div class="button5">
                <a href="#">
                    <img src="/images/country2choose/cave.svg" alt="Button">
                </a>
            </div>
            <div class="button6">
                <a href="#">
                    <img src="/images/country2choose/sword.svg" alt="Button">
                </a>
            </div>
            <div class="button7">
                <a href="#">
                    <img src="/images/country2choose/3doors.svg" alt="Button">
                </a>
            </div>
            <div class="button8">
                <a href="#">
                    <img src="/images/country2choose/monster.svg" alt="Button">
                </a>
            </div>

            </div>
        </div>
        
    </div>
</body>

</html>