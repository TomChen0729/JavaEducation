<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
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

        a{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            width: 250px;
        }

        .img{
            margin-top: 30%;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- <button><a href="{{ url('/welcome') }}">開始遊戲</a></button> -->
    <a href="{{ url('/welcome') }}"><img class="img" src="/images/start/btn.svg" alt=""></a>
</div>
</body>
</html>