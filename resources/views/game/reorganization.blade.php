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
            margin: 0 auto;
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
            margin: 0 auto;
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
    <br>
    <div id="board"></div>
    <h2>Turns：<span id="turns">0</span></h2>
    <div id="pieces"></div>
@endsection

@section('script')
    <script>
        var rows = 5;
        var columns = 1;

        var currTile;
        var otherTile;

        var turns = 0;

        window.onload = function() {
            //5*1
            for (let r = 0; r < rows; r++) {
                for (let c = 0; c < columns; c++) {
                    //img
                    let tile = document.createElement('img');
                    tile.src = "./images/blank.jpg";

                    // 拖曳功能
                    tile.addEventListener("dragstart", dragStart); //點擊圖片拖曳
                    tile.addEventListener("dragover", dragOver); // 拖曳圖片
                    tile.addEventListener("dragenter", dragEnter); // 圖片拖到圖片
                    tile.addEventListener("dragleave", dragLeave); // 圖片拖離圖片
                    tile.addEventListener("drop", dragDrop); // 將圖片放到圖片上
                    tile.addEventListener("dragend", dragEnd); //完成拖曳

                    document.getElementById("board").append(tile);
                }
            }

            // pieces
            let pieces = [];
            for (let i = 0; i < rows*columns; i++) {
                pieces.push(i.toString()); // 放1~25進陣列，拼圖共25張
            }

            pieces.reverse();
            // 隨機題目
            for (let i = 0; i < pieces.length; i++) {
                let j = Math.floor(Math.random() * pieces.length);

                let tmp = pieces[i];
                pieces[i] = pieces[j];
                pieces[j] =tmp;
            }

            for(let i = 0; i < pieces.length; i++) {
                let tile = document.createElement("img");
                tile.src = "./images/" + pieces[i] + ".jpg";

                // 拖曳功能
                tile.addEventListener("dragstart", dragStart); //點擊圖片拖曳
                tile.addEventListener("dragover", dragOver); // 拖曳圖片
                tile.addEventListener("dragenter", dragEnter); // 圖片拖到圖片
                tile.addEventListener("dragleave", dragLeave); // 圖片拖離圖片
                tile.addEventListener("drop", dragDrop); // 將圖片放到圖片上
                tile.addEventListener("dragend", dragEnd); //完成拖曳

                document.getElementById("pieces").append(tile);
            }
        }

        // 拖曳功能
        function dragStart() {
            currTile = this; //點擊進行拖曳
        }

        function dragOver(e) {
            currTile = this; 
        }

        function dragEnter(e) {
            currTile = this; 
        }

        function dragLeave() {
            currTile = this; 
        }

        function dragDrop() {
            otherTile = this; //被拖曳的圖片
        }

        function dragEnd() {
            if (currTile.src.includes("blank")) {
                return;
            }
            let currImg =currTile.src;
            let otherImg = otherTile.src;
            currTile.src = otherImg;
            otherTile.src = currImg;

            turns += 1;
            document.getElementById("turns").innerText = turns;
        }

    </script>
@endsection