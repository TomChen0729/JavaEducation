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

    .container {
        margin-top: 100px;
        padding: 15px 9%;
        padding-bottom: 100px;
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
        border-radius: 5%;
        background: #fff;
        background: #fbed96;
        text-align: center;
        padding: 30px 20px;
    }

    .container .box-container .box h3 {
        color: #444;
        font-size: 22px;
        padding: 10px 0;
    }

    .container .box-container .box p {
        font-size: 15px;
        line-height: 1.8;
    }

    .container .box-container .box img {
        padding: 10px;
        margin: 0 auto;
        display: block;
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
            height: auto;
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

        .context h3{
            text-align: center;
        }
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="head">
        <ul class="breadcrumbs">
            <li class="breadcrumbs__item">
                <a href="{{ route('showallcardtypes') }}" class="breadcrumbs__link">知識卡</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link">{{ $card_type -> card_type }}</a>
            </li>
            <li class="breadcrumbs__item">
                <a href="#" class="breadcrumbs__link__active">{{ $current_card -> name}}</a>
            </li>
        </ul>
    </div>

    <div class="box-container" style="display: wrap; width:100%">
        @if ($current_card != null)
            <div class="box">
                <h3 style="font-size: 40px">{{ $current_card -> name }}</h3>
                <!-- <p style="color: black; font-weight:900">{{ $current_card -> content }}</p> -->
                <p style="color: black; font-size: 20px; font-weight: bolder">{{ $current_card -> summary }}</p>
                <div class="editor-container">
                    <textarea class="code-editor" id="code-editor">{{ $current_card->code }}</textarea>
                </div>
                <button class="copy-button" id="copy-button">COPY</button>
            </div>
            <div class="context" style="background: #d4b0a5; border-radius: 5%; padding: 30px;">
                <h3 style="font-size: 40px; color: #444; align-items:center">Introduction</h3><br><br>
                <p><pre style="color: black; font-size: 20px; font-weight: bolder">{{ $current_card -> description }}</pre></p>
            </div>
        @endif

    </di>
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