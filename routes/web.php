<?php
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\KnowledgeCardController;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // 顯示五個國家icon頁面
    Route::get('/welcome', [CountryController::class, 'welcome'])->name('welcome');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // 顯示該國家的劇情畫面
    Route::get('/drama/country/{country_id}', [CountryController::class, 'drama'])->name('country.drama');
    // 帶值進入第幾個國家的難度選取畫面，debug
    Route::get('/country/{country_id}', [CountryController::class, 'index'])->name('country.index');
    // 帶值(等級)進入遊戲類型選擇畫面1-4闖關
    Route::get('/levels/{levels}/country_id/{country_id}', [GameController::class, 'index'])->name('game.index');
    // 進入該遊戲畫面
    Route::get('/GameType/{GameType}/country_id/{country_id}/levels/{levels}', [GameController::class, 'ChooseGame'])->name('game.gameTypeChoose');
    // 隨機沒玩過的遊戲類型
    Route::get('/gameRD/{country_id}/{levels}', [GameController::class, 'randomChooseGame'])->name('game.gameRD');
    // 顯示知識卡所有分類
    Route::get('/knowledgecardtypes', [KnowledgeCardController::class, 'index'])->name('showallcardtypes');
    // 顯示目標分類底下所有知識卡
    Route::get('/knowledgecardtype/{card_type_id}', [KnowledgeCardController::class, 'showallcards'])->name('showallcards');
    // 顯示知識卡詳細內容
    Route::get('/knowledgecard/{card_id}', [KnowledgeCardController::class, 'showcardcontent'])->name('showcardcontent');
    // debug出題功能
    Route::get('debug/{country_id}', [GameController::class, 'Debug'])->name('game.debugRD');
});

//測試用
Route::get('TrueORFalse', function () {
    return view('game.TrueORFalse');
});
Route::get('choose', function () {
    return view('game.choose');
});
Route::get('match', function () {
    return view('game.match');
});
Route::get('reorganization', function () {
    return view('game.reorganization');
});
Route::get('Gameviews', function () {
    return view('Gameviews');
});
Route::get('level', function () {
    return view('level');
});
Route::get('knowledge', function () {
    return view('knowledge');
});
Route::get('debug', function () {
    return view('game.debug');
});
Route::get('boxgame', function () {
    return view('game.country2.boxgame');
});
Route::get('idcardgame', function () {
    return view('game.country2.idcardgame');
});
