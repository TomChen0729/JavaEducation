@extends('layouts.application')

@section('title', '學習區重組')

@section('style')
    <style>
        body{
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden; /*自動隱藏超出的文字或圖片*/
        }

        #board{
            width: 399px;
            height: 80px;
            border: 2px solid purple;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            margin: 10px auto;
            display: flex;
            flex-wrap: wrap;
        }

        #board img{
            width: 79px;
            height: 79px;
            border: 0.5px solid lightblue;
        }

        #pieces{
            width: 399px;
            height: 80px;
            border: 2px solid purple;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            margin: 10px auto;
            display: flex;
            flex-wrap: wrap;
        }

        #pieces img{
            width: 79px;
            height: 79px;
            border: 0.5px solid lightblue;
        }
    </style>
@endsection

@section('content')
    <div id="board"></div>
    <div id="pieces"></div>
@endsection

@section('script')
    <script>
        var currTile;  // 正在拖動的圖片
        var otherTile; // 目標圖片

        // 題目
        window.onload = function() {
            let questions = [
                "int years = 18;",
                "String roads = '林森北七路';",
                "float double miles = 3 / 1.6;",
                "boolean mine = false;",
                "boolean yourself = true;",
                "char K = '王';"
            ];

            // 隨機題目
            let question = questions[Math.floor(Math.random() * questions.length)];
            let parts = question.split(' '); // 用空格將題目分開

            // 初始化圖片
            for (let i = 0; i < parts.length; i++) {
                let tile = document.createElement('img');
                tile.src = "./images/blank.jpg"; // 空白圖片佔位

                // 拖放功能
                tile.addEventListener("dragstart", dragStart);
                tile.addEventListener("dragover", dragOver);
                tile.addEventListener("dragenter", dragEnter);
                tile.addEventListener("dragleave", dragLeave);
                tile.addEventListener("drop", dragDrop);
                tile.addEventListener("dragend", dragEnd);

                document.getElementById("board").append(tile);
            }

            // 生成拼圖片
            let pieces = parts.map(part => generateImageFromText(part));

            // 隨機打亂拼圖
            for (let i = 0; i < pieces.length; i++) {
                let j = Math.floor(Math.random() * pieces.length);
                let tmp = pieces[i];
                pieces[i] = pieces[j];
                pieces[j] = tmp;
            }

            // 將拼圖片加到頁面
            for (let i = 0; i < pieces.length; i++) {
                let tile = document.createElement('img');
                tile.src = pieces[i]; // 使用生成拚圖片

                // 拖放功能
                tile.addEventListener("dragstart", dragStart);
                tile.addEventListener("dragover", dragOver);
                tile.addEventListener("dragenter", dragEnter);
                tile.addEventListener("dragleave", dragLeave);
                tile.addEventListener("drop", dragDrop);
                tile.addEventListener("dragend", dragEnd);

                document.getElementById("pieces").append(tile);
            }
        }

        // 生成帶有文本的圖片
        function generateImageFromText(text) {
            let canvas = document.createElement('canvas');
            canvas.width = 79;
            canvas.height = 79;
            let context = canvas.getContext('2d');
            context.fillStyle = 'white'; // 背景白色
            context.fillRect(0, 0, canvas.width, canvas.height);
            context.fillStyle = 'black'; // 文字黑色
            context.font = '10px Arial';
            context.fillText(text, 10, 40); // 文字、位置
            return canvas.toDataURL(); // 返回圖片
        }

        // 拖放功能
        function dragStart() {
            currTile = this; // 記錄當下正在拖放的圖片
        }

        function dragOver(e) {
            e.preventDefault(); // 同意拖放操作
        }

        function dragEnter(e) {
            e.preventDefault(); // 同意拖放操作
        }

        function dragLeave() {
            // 不需要處理
        }

        function dragDrop() {
            otherTile = this; // 紀錄目標圖片
        }

        function dragEnd() {
            if (currTile.src.includes("blank")) {
                return; // 如果是空白圖片，跳過
            }
            let currImg = currTile.src;
            let otherImg = otherTile.src;
            currTile.src = otherImg; // 交換圖片
            otherTile.src = currImg;
        }
    </script>
@endsection