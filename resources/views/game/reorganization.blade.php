@extends('layouts.application')

@section('title', '學習區重組')

@section('style')
    <style>
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .containers{
            background-color: #76a5af;
            margin: 1em;
            border-radius: 10px; /*圓角*/
            box-shadow: 0 0 10px rgb(100, 100, 100); /*陰影*/
            width: 600px;
            overflow: hidden;
        }

        .containers .content{
            margin: 25px 20px 35px 20px; /*上右下左*/
        }

        .content .word{
            font-size: 25px;
            font-weight: 500; /*字體中等粗細*/
            text-align: center;
            padding: 18px 25px;
            border-bottom: 1px solid #ccc;
            /* letter-spacing: 1px; */
            margin: 25px 0 20px;
        }

        .content .details{
            margin: 25px 0 20px;
        }

        .details p{
            font-size: 18px;
            margin-bottom: 10px;
        }

        .content input{
            width: 100%;
            height: 60px;
            outline: none;
            font-size: 18px;
            padding: 0 16px;
            border-radius: 5px;
            border: 1px solid #aaa;
        }

        .content .buttons{
            display: flex;
            margin-top: 20px;
            justify-content: space-between; /*分散對齊*/
        }

        .buttons button{
            border: none;
            outline: none;
            color: #fff;
            cursor: pointer;
            padding: 15px 0; /*上下 左右*/
            font-size: 20px;
            font-weight: bold;
            border-radius: 5px;
            width: calc(100% / 2 - 8px); /*寬度為父元素寬度的一半減去8px*/
        }

        .buttons .refresh-word{
            background-color: #5b5b5b;
        }

        .buttons .check-word{
            background-color: #0b5394;
        }
    </style>
@endsection

@section('content')
    <div class="containers">
        <div class="content">
            <p class="word">enaxpnions</p>
            <div class="details">
                <p class="hint">說明： <span></span></p>
            </div>
            <input type="text" placeholder="Enter a valid word">
            <div class="buttons">
                <button class="refresh-word">刷新題目</button>
                <button class="check-word">送出</button>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
    <script>
        const words = [
            {
                word: "int years = 18;",
                hint: "宣告年齡18歲"
            },
            {
                word: "String roads = '林森北七路';",
                hint: "宣告路名「林森北七路」"
            },
            {
                word: "float miles = 3 / 1.6;",
                hint: "宣告公哩"
            },
            {
                word: "boolean mine = False;",
                hint: "宣告「我」是False"
            },
            {
                word: "boolean yourself = True;",
                hint: "宣告「你」是True"
            },
            {
                word: "char K = '王';",
                hint: "宣告「K」姓王"
            }
        ];

        const wordText = document.querySelector(".word");
        const hintText = document.querySelector(".hint span");
        const refreshBtn = document.querySelector(".refresh-word");
        const checkBtn = document.querySelector(".check-word");

        //隨機題目，切割題目
        const initGame = () => {
            let randomObj = words[Math.floor(Math.random() * words.length)]; //隨機出題
            let wordArray = randomObj.word.split(" "); //以空白切割
            for (let i = wordArray.length - 1; i > 0; i--) {
                let j = Math.floor(Math.random() * (i + 1)); //得到隨機數
                //隨機打亂wordArray
                // let temp = wordArray[i];
                // wordArray[i] = wordArray[j];
                // wordArray[j] = temp;
                [wordArray[i], wordArray[j]] = [wordArray[j], wordArray[i]];
            }
            //打亂的題目隨機顯示至畫面
            wordText.innerText = wordArray.join("　　");
            //隨機題目的提示顯示至畫面
            hintText.innerText = randomObj.hint;
            console.log(wordArray, randomObj.word);
        }

        initGame(); //呼叫initGame

        refreshBtn.addEventListener("click", initGame); //刷新題目，重新呼叫initGame
        checkBtn.addEventListener("click", checkWord); //

    </script>
@endsection