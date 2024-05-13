<?php
use App\Http\Controllers\DataController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

//輸入資料
Route::get('/data', [DataController::class, 'storeData']);

Route::get('/', function(){
    return view('home');
});
Route::resource('countries', CountryController::class);
Route::get('/country', [CountryController::class, 'index'])->name('root');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // 顯示五個國家icon頁面
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // 帶值進入第幾個國家，並顯示主副線，or gametype_id 1~4，分別對應四種遊戲方式，5，debug關
    Route::get('/country/{country_id}', [CountryController::class, 'index'])->name('country.index');
    // 帶值判斷該導向哪個遊戲畫面，也要帶使用者資料跟該關卡遊戲資料，知識卡等
    Route::get('/gametype/{gametype_id}/Level/{pass_familiarty_id}', [GameController::class, 'GameChoose']);
});

//測試用
Route::get('TrueORFalse', function(){
    return view('game.TrueORFalse');
});
Route::get('choose', function(){
    return view('game.choose');
});
Route::get('match', function(){
    return view('game.match');
});
Route::get('reorganization', function(){
    return view('game.reorganization');
});
Route::get('Gameviews', function(){
    return view('Gameviews');
});