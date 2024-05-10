<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>開始遊戲</title>
    <style>
        body{
            background-color: black;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .beginGame {
            font-size: large;
            font-family: "標楷體";
        }
        .beginGame a{
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <button class="beginGame"><a href="{{ url('/welcome') }}">開始遊戲</a></button>
</div>
</body>
</html>