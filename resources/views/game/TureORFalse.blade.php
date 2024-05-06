@extends('layouts.application')

@section('title', '學習區是非')

@section('style')
    <style>
        .bubbly-button:focus {
            outline: 0; /* 移除輪廓線 */
        }

        .bubbly-button:before,.bubbly-button:after{
            position: inherit;
        }
    </style>
@endsection

@section('content')
    <div class="tof">
        <div class="question">
            <h2>Question Test</h2>
        </div>
        <div class="true">
            <button class="bubbly-button">True</button>
        </div>
        <div class="false">
            <button class="bubbly-button">True</button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        
    </script>
@endsection