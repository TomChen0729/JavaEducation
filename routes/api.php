<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\KnowledgeCardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
    
})->middleware('auth:sanctum');
// 對答案
Route::get('/correct_User_ANS', [GameController::class, 'correctANS']);
// 配對題型對答案、存配對的紀錄
Route::get('/matchuserecord',[GameController::class,'matchuserecord']);
// debug對答案
Route::get('/correctDebug', [GameController::class, 'correctDebug']);
// show 卡片內容，在玩學習區那邊右下角彈窗的那個
Route::get('/show-card-detail', [KnowledgeCardController::class, 'showCurrentCard']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    
});
