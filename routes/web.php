<?php
use App\Http\Controllers\DataController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

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
    // 帶值進入第幾個國家的難度選取畫面
    Route::get('/country/{country_id}', [CountryController::class, 'index'])->name('country.index');
    // 帶值進入遊戲類型選擇畫面1-4闖關，5主線
    Route::get('/levels/{levels}', [GameController::class, 'index'])->name('game.index');
    // 進入該遊戲畫面
    Route::get('/GameType_id/{GameType_id}',[GameController::class, 'ChooseGame'])->name('game.gameTypeChoose');
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
Route::get('level', function(){
    return view('level');
});
Route::get('knowledgecard', function(){
    return view('knowledgecard');
});