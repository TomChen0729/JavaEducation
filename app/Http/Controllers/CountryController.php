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

    // 劇情畫面
    public function drama(int $country_id)
    {
        //初始化玩家紀錄(檢查玩家的country_id 和 levels)
        $this->gameService->initUserRecord();
        // 選取這兩個欄位('role_icon', 'msg')
        // 排的順序是依照order欄位小到大
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
        return view('drama', ['dramas' => $currentCountryDrama, 'currentCountry' => (int)$country_id, 'backgroundImg' => $backgroundImg]);
    }

    // 導向等級選取，帶使用者資料，檢查玩家遊戲進度
    public function index(int $country_id)
    {
        //初始化玩家紀錄(檢查玩家的country_id 和 levels)
        $this->gameService->initUserRecord();
        $User_country = auth()->user()->country_id;
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
    }
}
