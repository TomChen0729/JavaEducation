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
    Route::get('/welcome', function () {
        $Current_User_Country = auth()->user()->country_id;
        $Current_User_Country_Level = auth()->user()->levels;
        $Current_User_id = auth()->user()->id;
        // 用一個字典存放能玩跟不能玩的國家，key=imgPath，value=1(可以),0(不可以)
        $country_dic = array();
        //檢查玩家進度，如果國家id等於0和等級id等於0，就都給1進去。
        // 第一次玩
        if ($Current_User_Country == null && $Current_User_Country_Level == null) {
            $user = User::find($Current_User_id);
            $user->update([
                'country_id' => 1,
                'levels' => 1,
            ]);
            $canUseCountry = Country::where('id', 1)->pluck('imgPath')->toArray();
            $cantUserCountry = Country::where('id', '>', 1)->pluck('imgPath')->toArray();
            if ($canUseCountry != null && $cantUserCountry != null) {
                // 用迴圈將值放到字典裡面
                foreach ($canUseCountry as $item) {
                    // item是正在被讀取的國家icon檔名，後面帶狀態(1或是0)，用以區分可以玩或不能玩
                    $country_dic[$item] = 1;
                }
                foreach ($cantUserCountry as $item) {
                    $country_dic[$item] = 0;
                }
            }
        } 
        else {
            // 玩家可以點選的國家圖示
            $canUseCountry = Country::where('id', '<=', $Current_User_Country)->pluck('imgPath')->toArray();
            // 玩家不可以點選的國家圖示
            $cantUserCountry = Country::where('id', '>', $Current_User_Country)->pluck('imgPath')->toArray();
            if ($canUseCountry != null && $cantUserCountry != null) {
                foreach ($canUseCountry as $item) {
                    $country_dic[$item] = 1;
                }
                foreach ($cantUserCountry as $item) {
                    $country_dic[$item] = 0;
                }
            }
        }

        return view('welcome', ['countries' => $country_dic]);
    })->name('welcome');
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
