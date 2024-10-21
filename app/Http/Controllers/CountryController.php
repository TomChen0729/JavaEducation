<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\Country;
use App\Models\Drama;
use App\Models\KnowledgeCard;
use App\Models\SecGame;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\UserKnowledgeCard;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // 驗證資料欄位
use App\Services\GameService;
use Exception;
// use Illuminate\Support\Facades\Route;
// use vendor\laravel\framework\src\Illuminate\Database\Eloquent\Model;
class CountryController extends Controller
{

    private GameService $gameService;

    // 注入GameService
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function welcome()
    {
        $this->gameService->initUserRecord();
        $this->gameService->updateUserRecord();
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
        } else {
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
    }
    // 劇情畫面
    public function drama(int $country_id)
    {
        //初始化玩家紀錄(檢查玩家的country_id 和 levels)
        $this->gameService->initUserRecord();
        $this->gameService->updateUserRecord();
        // 選取這兩個欄位('role_icon', 'msg')
        // 排的順序是依照order欄位小到大
        $countryName = Country::find($country_id);
        $currentCountryDrama = Drama::select('role_icon', 'msg')
            ->where('country_id', $country_id)
            ->orderBy('order', 'asc')->get()
            // 用map跑一遍裡面撈出來的資料，並形成陣列sender是腳色icon，message是劇情訊息
            ->map(function ($item) {
                return [
                    'sender' => $item->role_icon,
                    'message' => $item->msg,
                ];
            });
        $backgroundImg = Country::where('id', $country_id)->pluck('imgPath')->first();
        return view('drama', ['dramas' => $currentCountryDrama, 'currentCountry' => $country_id, 'backgroundImg' => $backgroundImg, 'countryName' => $countryName->name]);
    }

    // 導向等級選取，帶使用者資料，檢查玩家遊戲進度
    public function index(int $country_id)
    {
        //初始化玩家紀錄(檢查玩家的country_id 和 levels)
        $this->gameService->initUserRecord();
        $this->gameService->updateUserRecord();
        $User_country = auth()->user()->country_id;

        switch ($country_id) {
            case 1:
                // 如果玩家最新的國家id大於等於當前國家id
                // 帶出當前國家資訊 LV1-3
                if ($User_country >= $country_id) {
                    // 國家底下的第一層知識卡
                    $parent_cards = CardType::where('country_id', $country_id)->get();
                }
                // 找當前國家最大等級
                $currentCountryMaxLV = CardType::where('country_id', $country_id)->max('levels');
                if (!User::where('id', auth()->user()->id)->where('country_id', $country_id)->where('levels', $currentCountryMaxLV)->exists()) {
                    $debug = 0;
                } else {
                    $debug = 1;
                }

                return view('level', ['parent_cards' => $parent_cards, 'debug' => $debug, 'currentCountry' => $country_id]);

            case 2:
                // 因為通關密碼沒有需要能力檢查的部分，要額外處理
                // 已有通關紀錄「已通關狀態」也要處理
                // 直接檢查玩家持有卡片，用來檢查她在level2可以玩甚麼關卡，並且賦予遊戲icon狀態(有三種)
                // 可以玩(true)、不可玩(false)、已通關("pass")

                // sec_games先串sec_parameters，再串sec_records
                $PassSecGameData = SecGame::join('sec_parameters', 'sec_parameters.secGameID', '=', 'sec_games.id')
                    ->join('sec_records', 'sec_records.secParameterID', '=', 'sec_parameters.id')
                    ->where('sec_games.country_id', $country_id)
                    ->where('sec_records.user_id', auth()->user()->id)
                    ->where('status', 'true')->whereNotNull('user_answer')
                    ->select('sec_games.id as secGameID', 'sec_games.imgPath as imgPath')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'secGameID' => $item->secGameID,
                            'status' => 'pass',
                            'imgPath' => $item->imgPath,
                            'needCards' => []
                        ];
                    });
                $notNeedCheckSecGameID = $PassSecGameData->pluck('secGameID')->toArray();
                // Log::info($notNeedCheckSecGameID);
                // Log::info("---------------------------------------");
                // Log::info($PassSecGameData);
                // Log::info("---------------------------------------");
                $owedCardsInCurrentCountry = UserKnowledgeCard::join('knowledge_cards', 'knowledge_cards.id', '=', 'user_knowledge_cards.id')
                    ->where('user_id', auth()->user()->id)
                    ->where('country_id', $country_id)
                    ->pluck('knowledge_card_id')->toArray();

                $allGamesNeedCardsInCurrentCountry = SecGame::join('pass_course_need_cards', 'pass_course_need_cards.secGameID', '=', 'sec_games.id')
                    ->where('country_id', $country_id)
                    ->whereNotIn('sec_games.id', $notNeedCheckSecGameID)
                    ->select('sec_games.id as secGameID', 'pass_course_need_cards.knowledge_card_id as knowledge_card_id', 'sec_games.imgPath as imgPath')
                    ->get()
                    ->groupBy('secGameID') // 依照secGameID分組
                    // 上面的步驟執行完資料會長像以下這樣
                    // [
                    //     2 => [
                    //         {"secGameID":2,"needCards":24}
                    //     ],
                    //     3 => [
                    //         {"secGameID":3,"needCards":24},
                    //         {"secGameID":3,"needCards":26}
                    //     ],
                    //     4 => [
                    //         {"secGameID":4,"needCards":23}
                    //     ],
                    //     5 => [
                    //         {"secGameID":5,"needCards":23},
                    //         {"secGameID":5,"needCards":24}
                    //     ]
                    //     // ... 其他資料
                    // ]

                    ->map(function ($groupedItems, $secGameID) {
                        return [
                            'secGameID' => $secGameID,
                            'needCards' => $groupedItems->pluck('knowledge_card_id')->all(),  // 把同一個secGameID的卡片抓出來弄成一個陣列
                            'imgPath' => $groupedItems->first()->imgPath
                        ];
                    })
                    ->values();  // 重新整理索引
                // 執行完長這樣
                // [
                //     {"secGameID":2,"needCards":[24]},
                //     {"secGameID":3,"needCards":[24, 26]},
                //     {"secGameID":4,"needCards":[23]},
                //     {"secGameID":5,"needCards":[23, 24]},
                //     {"secGameID":6,"needCards":[25, 26]},
                //     {"secGameID":7,"needCards":[25]},
                //     {"secGameID":8,"needCards":[27, 29]},
                //     {"secGameID":9,"needCards":[25, 28]}
                // ]

                $iconData = $allGamesNeedCardsInCurrentCountry->map(function ($gameData) use ($owedCardsInCurrentCountry) {

                    // 如果needCards為 null，則直接設置 canPlay 為 true
                    if (is_null($gameData['needCards']) || in_array(null, $gameData['needCards'])) {
                        $gameData['needCards'] = []; // 將 needCards 設置為空陣列
                        $canPlay = true;
                        $missingCards = [];
                    } else {
                        // 否則根據擁有的卡片判斷是否能進入
                        $missingCards = array_diff($gameData['needCards'], $owedCardsInCurrentCountry);
                        $canPlay = empty($missingCards); // 如果是空等於他該有的都有，返回true，反之則是false
                    }

                    return [
                        'secGameID' => $gameData['secGameID'],
                        'status' => $canPlay,
                        'imgPath' => $gameData['imgPath'],
                        'needCards' => array_values(array_diff($gameData['needCards'], $owedCardsInCurrentCountry))
                    ];
                });



                $iconData = collect($iconData)->merge(collect($PassSecGameData))->sortBy('secGameID')->values();


                // Log::info($allGamesNeedCardsInCurrentCountry);
                // Log::info($owedCardsInCurrentCountry);
                Log::info($iconData);
                return view('level2', ['currentCountry' => $country_id, 'iconData' => $iconData]);

            case 3:
                break;
        }
    }
}
