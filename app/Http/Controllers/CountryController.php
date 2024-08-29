<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\Country;
use App\Models\Drama;
use App\Models\KnowledgeCard;
use App\Models\User;
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
        if ($country_id == 1) {
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
        }else{
            return view('level2', ['currentCountry' => $country_id]);
        }
    }
}
