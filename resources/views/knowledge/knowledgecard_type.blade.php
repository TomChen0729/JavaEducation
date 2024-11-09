@extends('layouts.application')

@section('title', '知識卡類別')

@section('style')
<style>
    * {
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-decoration: none;
        text-transform: capitalize;
        transition: .2s linear;
    }

    .container {
        margin-top: 100px;
        padding: 15px 9%;
        padding-bottom: 100px;
    }

    .container h1 {
        /* 字體設置 */
        font-family: 'Arial', sans-serif;
        /* 可以選擇適合的字體 */
        font-size: 60px;
        /* 調整字體大小 */
        font-weight: bold;
        /* 調整字體粗細 */

        text-shadow: -1px 0 #FBB03B, 0 1px #FBB03B, 5px 0 #FBB03B, 0 -1px #FBB03B;

        /* 顏色設置 */
        color: #FFFF33;
        /* 字體顏色 */

        /* 間距設置 */
        text-align: center;
        margin-top: 10px;
        /* 上邊距 */
        margin-bottom: 10px;
        /* 下邊距 */
        padding: 10px;
        /* 內邊距 */

        /* 其他樣式 */
        letter-spacing: 5px;
        /* 字母間距 */
    }

    .container .box-container {
        /* 網格結構，組織子元素 */
        display: grid;
        /* 定義網格結構: 重複一組列定義(自動調整列數量，定義每列的最小和最大寬度) */
        grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
        /* 設置網格項之間的間距為 15 像素 */
        gap: 15px;
    }

    .container .box-container .box {
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        border-radius: 5px;
        background: #fff;
        background: linear-gradient(45deg, #fad0c4, #ffd1ff);
        text-align: center;
        padding: 30px 20px;
    }

    .container .box-container .box h3 {
        color: #444;
        font-size: 22px;
        font-weight: bold;
        padding: 10px 0;
    }

    .container .box-container .box .btn {
        margin-top: 10px;
        display: inline-block;
        background-color: #ffb6c1;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 17px;
        font-weight: bolder;
    }

    .container .box-container .box .btn:hover {
        letter-spacing: 1px;
        background-color: #ea9999;
    }

    .container .box-container .box:hover {
        box-shadow: 0 10px 15px rgba(0, 0, 0, .3);
        transform: scale(1.03);
    }

    .head {
        background-color: #a5948c;
        border: 5px solid #d4b0a5;
        border-radius: 20px;
        padding: 10px;
        margin-bottom: 20px;
        display: flex;
        justify-content: end;
        align-items: center;
        /* 使內容垂直居中 */
    }

    .boxes {
        display: inline-flex;
        height: 50px;
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 30px;
        align-items: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        margin-left: 20px;
        position: relative;
    }

    .boxes input {
        color: gray;
        width: 100%;
        outline: none;
        border: none;
        font-weight: 500;
        font-size: 20px;
        transition: width 0.8s;
        background: transparent;
        padding: 0;
    }

    .boxes input:focus {
        box-shadow: none;
        outline: none;
    }

    /* .boxes:hover input {
            width: 250px;
        } */

    .boxes a .fas {
        color: #d4b0a5;
        font-size: 20px;
        margin-left: 10px;
    }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }
    }

    .suggestions-box {
        border: 1px solid #ddd;
        background-color: #fff;
        position: absolute;
        top: 100%;
        /* 顯示在 .boxes 的下方 */
        left: 0;
        width: 100%;
        max-width: 300px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        margin-top: 5px;
        max-height: 200px;
        overflow-y: auto;
    }

    .suggestion-item {
        display: block;
        padding: 10px;
        color: #333;
        text-decoration: none;
        font-size: 16px;
        background-color: white;
    }

    .suggestion-item:hover {
        background-color: #f1f1f1;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="head">
        <form action="{{ route('knowledge.search') }}" method="GET" style="display: flex; align-items: center;">
            <div class="boxes">
                <input type="text" name="keyword" id="search-input" placeholder="Search..." required autocomplete="off">
                <button type="submit">
                    <i class="fas fa-search"></i>
                </button>
                <div id="suggestions-box" class="suggestions-box"></div>
            </div>
            
        </form>
    </div>
    @foreach ($card_types as $item)
    <div>
        <h1>{{ $item['countryname'] }}</h1>
    </div>
    <div class="box-container">
        @foreach($item['cardTypeArray'] as $card_type_id => $card_type)
        <div class="box">
            <h3>{{ $card_type }}</h3>
            <a href="{{ route('showallcards', ['card_type_id' => $card_type_id]) }}" class="btn">GO</a>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection

@section('script')
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("search-input");
        const suggestionsBox = document.getElementById("suggestions-box");
        searchInput.addEventListener("input", function() {
            const query = searchInput.value.trim();
            if (query.length > 0) {
                fetch(`{{ route('knowledge.suggestions') }}?keyword=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Received data:', data); //確認是否有收到後端傳來的知識卡
                        suggestionsBox.innerHTML = ""; //清空
                        if (data.relatedKeywords.length > 0) {
                            suggestionsBox.style.display = "block"; //將搜尋欄顯示

                            // 顯示所有相關的知識卡
                            data.relatedKeywords.forEach(keyword => {
                                const suggestionItem = document.createElement("a");
                                suggestionItem.href = `{{ route('knowledge.search') }}?keyword=${encodeURIComponent(keyword)}`;
                                suggestionItem.className = "suggestion-item";
                                suggestionItem.textContent = keyword;
                                suggestionsBox.appendChild(suggestionItem);
                            });
                        } else {
                            suggestionsBox.style.display = "none"; //沒有找到相關的知識卡時引王
                        }
                    })
                    .catch(error => {
                        console.error("Error fetching suggestions:", error); //有問題時顯示
                    });
            } else {
                suggestionsBox.style.display = "none"; //沒有文字時隱藏
            }
        });

        // 點擊頁面其他地方隱藏建議框
        document.addEventListener("click", function(e) {
            if (!e.target.closest('.boxes')) {
                suggestionsBox.style.display = "none";
            }
        });
    });
</script>
@endsection