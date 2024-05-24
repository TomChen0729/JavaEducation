<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>開始遊戲</title>
    <style>
        body{
            background: url('/images/start/start.svg');
            background-repeat: no-repeat;
            background-position: top;
            background-attachment: fixed;
            background-size: cover;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh; 
            margin-top: 250px;
        }
    </style>
</head>
<body>
<div class="container">
    <button><a href="{{ url('/welcome') }}">開始遊戲</a></button>
    <!-- <a href="{{ url('/welcome') }}"><img src="/images/start/startbtn.svg" alt=""></a> -->
</div>
</body>
</html>