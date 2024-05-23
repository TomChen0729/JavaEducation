<?php

use App\Http\Controllers\KnowledgeCardController;
use App\Models\KnowledgeCards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// show 卡片內容，在玩學習區那邊右下角彈窗的那個
Route::get('/show-card-detail', [KnowledgeCardController::class, 'showCurrentCard']);