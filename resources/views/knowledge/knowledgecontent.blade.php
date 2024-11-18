@extends('layouts.application')

@section('title', '知識卡內容')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/monokai.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/clike/clike.min.js"></script>
@endsection

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

    .containers {
        margin-top: 100px;
        padding: 15px 9%;
        padding-bottom: 100px;
    }

    .containers .box-container {
        display: grid;
        /* 增加最小寬度，減少每列元素數量 */
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        /* 減少間距，讓內容更寬敞 */
        gap: 10px;
    }


    .containers .box-container .box {
        box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        border-radius: 5%;
        background: #fff;
        background: #fbed96;
        text-align: center;
        padding: 30px 20px;
    }

    .containers .box-container .box h3 {
        color: #444;
        font-size: 40px;
        padding: 10px 0;
    }

    .containers .box-container .box p {
        font-size: 20px;
        line-height: 1.8;
        color: black;
        font-size: 20px;
        font-weight: bolder
    }

    .containers .box-container .box img {
        padding: 10px;
        margin: 0 auto;
        display: block;
    }

    .containers .box-container .box .btn {
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

    .containers .box-container .box .btn:hover {
        letter-spacing: 1px;
        background-color: #ea9999;
    }

    .head {
            background-color: #a5948c;
            border: 5px solid #d4b0a5;
            border-radius: 20px;
            padding: 10px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between; /* 在左右對齊 */
            align-items: center; /* 使內容垂直居中 */
        }

        .breadcrumbs {
            display: inline-flex;
            letter-spacing: 5px;
            font-size: 24px;
            font-family: sans-serif;
        }

        .breadcrumbs__item {
            display: inline-block;
        }

        .breadcrumbs__item:not(:last-of-type)::after {
            content: '\203a';
            margin: 0 10px 0 5px;
            font-size: 25px;
            color: #fff;
        }

        .breadcrumbs__link {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .breadcrumbs__link:hover {
            text-decoration: underline;
            text-decoration: none;
            color: gray;
        }

        .breadcrumbs__link__active {
            text-decoration: none;
            color: 	#B6D3DC;
            font-weight: bold;
            text-shadow: 0 10px 15px rgba(0,0,0,0.3);
        }

        .breadcrumbs__link__active:hover {
            color: #d4b0a5;
        }

        .editor-container {
            display: flex;
            justify-content: center;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .CodeMirror {
            width: 100%;
            text-align: left;
        }

        .copy-button {
            margin:1%;
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight:bold;
            transition: background-color 0.3s ease;
        }

        .copy-button:hover {
            background-color: #ea9999;
        }

        .context{
            background: #d4b0a5;
            border-radius: 5%;
            padding: 30px;
        }

        .context h3{
            text-align: center;
            font-size: 40px;
            color: #444;
            align-items:center;
        }

        .context pre{
            color: black;
            font-size: 28px;
            font-weight: bolder;
        }

    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="containers">
    <div class="head">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('showallcardtypes') }}" class="breadcrumbs__link">知識卡</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="{{ route('showallcards', ['card_type_id' => $card_type -> id]) }}" class="breadcrumbs__link">{{ $card_type -> card_type }}</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link__active">{{ $current_card -> name}}</a>
            </li>
        </ul>
    </div>

    <div class="box-container">
        @if ($current_card != null)
            <div class="box">
                <h3>{{ $current_card -> name }}</h3>
                <!-- <p style="color: black; font-weight:900">{{ $current_card -> content }}</p> -->
                <p>{{ $current_card -> summary }}</p>
                <div class="editor-container">
                    <textarea class="code-editor" id="code-editor">{{ $current_card->code }}</textarea>
                </div>
                <button class="copy-button" id="copy-button">COPY</button>
            </div>
            <div class="context">
                <h3>Introduction</h3><br><br>
                <p><pre>{{ $current_card -> description }}</pre></p>
            </div>
        @endif

    </div>
</div>
@endsection

@section('script')
<script>
    let editor;//存codemirror讓後續COPY可以使用

    document.addEventListener("DOMContentLoaded", function() {
        editor = CodeMirror.fromTextArea(document.getElementById('code-editor'), {
            mode: "text/x-java",
            theme: "monokai",
            // lineNumbers: true, // 顯示行號
        });
        editor.setSize(null, "auto"); // 寬度自適應，高度隨內容調整
    });

    //複製code
    document.getElementById('copy-button').addEventListener('click', function() {
            const code = editor.getValue(); // 獲取編輯器內容
            navigator.clipboard.writeText(code).then(function() {
                alert("內容已複製！"); // 提示用戶已複製
            }, function(err) {
                console.error("複製失敗: ", err);
            });
    });
</script>
@endsection