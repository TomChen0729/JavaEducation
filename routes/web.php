<?php
use App\Http\Controllers\DataController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\GameController;
use App\Models\Country;
use App\Models\User;
use App\Http\Controllers\KnowledgeCardController;
use Illuminate\Routing\RouteUri;
use Illuminate\Support\Facades\Route;
use App\Services\GameService;


Route::get('/', function(){
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // 顯示五個國家icon頁面
    Route::get('/welcome', function () {

        
        $Current_User_Country = auth()->user()->country_id;
        $Current_User_Country_Level = auth()->user()->levels;
        $Current_User_id=auth()->user()->id;
        // 用一個字典存放能玩跟不能玩的國家
        $country_json = array();
        //檢查玩家進度，如果國家id等於0和等級id等於0，就都給1進去。
        // 第一次玩
        if ($Current_User_Country == null && $Current_User_Country_Level == null) {
            $user = User::find($Current_User_id);
            $user->update([
                'country_id' => 1,
                'levels' => 1,
            ]);
            $countries = Country::where('id', 1)->get();
        }
        else{
            $countries = Country::where('id', '<=', $Current_User_Country)->get();
        }

        return view('welcome', ['countries' => $countries]);
    })->name('welcome');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    // 帶值進入第幾個國家的難度選取畫面
    Route::get('/country/{country_id}', [CountryController::class, 'index'])->name('country.index');
    // 帶值(等級)進入遊戲類型選擇畫面1-4闖關，5主線
    Route::get('/levels/{levels}/country_id/{country_id}', [GameController::class, 'index'])->name('game.index');
    // 進入該遊戲畫面
    Route::get('/GameType/{GameType}/country_id/{country_id}/levels/{levels}',[GameController::class, 'ChooseGame'])->name('game.gameTypeChoose');
    // 顯示知識卡所有分類
    Route::get('/knowledgecardtypes', [KnowledgeCardController::class, 'index'])->name('showallcardtypes');
    // 顯示目標分類底下所有知識卡
    Route::get('/knowledgecardtype/{card_type_id}', [KnowledgeCardController::class, 'showallcards'])->name('showallcards');
    // 顯示知識卡詳細內容
    Route::get('/knowledgecard/{card_id}', [KnowledgeCardController::class, 'showcardcontent'])->name('showcardcontent');
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
Route::get('knowledge', function(){
    return view('knowledge');
});

