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

        #hints{
            font-size: 28px;
            font-weight: bold;
            margin-top: 70px;
            margin-bottom: 20px;
            background-color: #76a5af;
            border-radius: 10px;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            width: 805.6px;
            overflow: hidden;
        }

        #board{
            width: 805.6px;
            height: 209px;
            border: 5px solid #76a5af;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            margin: 20px auto;
            display: flex;
            flex-wrap: wrap;
        }

        #board img{
            width: 199px;
            height: 199px;
            border: 0.5px solid #76a5af;
        }

        #pieces{
            width: 805.6px;
            height: 209px;
            border: 5px solid #76a5af;
            box-shadow: 0 0 10px rgb(100, 100, 100);
            margin: 10px auto;
            display: flex;
            flex-wrap: wrap;
        }

        #pieces img{
            width: 199px;
            height: 199px;
            border: 0.5px solid lightblue;
        }

        /* RWD */
        @media (max-width: 1200px) {
            #board, #pieces {
                width: auto;
                height: auto;
            }

            #board img, #pieces img {
                width: 150px;
                height: 150px;
            }
        }

        @media (max-width: 768px) {
            #board, #pieces {
                width: auto;
                height: auto;
            }

            #board img, #pieces img {
                width: 100px;
                height: 100px;
            }
        }

        @media (max-width: 480px) {
            #board, #pieces {
                flex-direction: column;
                width: auto;
                height: auto;
            }

            #board img, #pieces img {
                width: 80px;
                height: 80px;
            }
        }
    </style>
@endsection

@section('content')
<div class="container">
    <h2 id="hints"></h2>
    <div id="board"></div>
    <div id="pieces"></div>
</div>
@endsection

@section('script')
    <script>
        var currTile;  // 正在拖動的圖片
        var otherTile; // 目標圖片

        // 題目
        window.onload = function() {
            let questions = [
                { 
                    question: "int years = 18;",
                    hint: "years是整數變數" 
                },
                { 
                    question: "String roads = '中華路';",
                    hint: "roads是字符串變數" 
                },
                { 
                    question: "float miles = 3/1.6;",
                    hint: "miles是浮點數變數"
                },
                { 
                    question: "boolean mine = false;",
                    hint: "mine是布林值變數"
                },
                { 
                    question: "boolean yourself = true;",
                    hint: "yourself是布林值變數"
                },
                { 
                    question: "char K = '王';",
                    hint: "K是字符變數" 
                }
            ];

            // 隨機題目
            let selected = questions[Math.floor(Math.random() * questions.length)];
            let parts = selected.question.split(' '); // 用空格將題目分開

            // 初始化圖片
            for (let i = 0; i < parts.length; i++) {
                let tile = document.createElement('img');
                tile.src = "../images/blank.jpg"; // 空白圖片佔位

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

            // 提示
            let hint = document.createElement('h2');
            hint.className = 'hint';
            hint.textContent = '提示：' + selected.hint; // 在提示前加上 "提示：" 字樣
            document.getElementById("hints").insertAdjacentElement('afterbegin', hint); // 將提示添加到 board 元素中 "提示：" 的後面

        }

        // 生成帶有文本的圖片
        function generateImageFromText(text) {
            let canvas = document.createElement('canvas');
            canvas.width = 199;
            canvas.height = 199;
            let context = canvas.getContext('2d');
            context.fillStyle = 'white'; // 背景白色
            context.fillRect(0, 0, canvas.width, canvas.height);
            context.fillStyle = 'black'; // 文字黑色
            context.font = '30px Helvetica';

            // 計算文字寬度，將文字置中
            let textWidth = context.measureText(text).width;
            let x = (canvas.width - textWidth) / 2;
            let y = (canvas.height / 2) + 10;

            context.fillText(text, x, y); // 文字、位置
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