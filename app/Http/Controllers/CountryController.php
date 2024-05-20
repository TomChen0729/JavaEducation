<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\KnowledgeCards;
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
        $this -> gameService = $gameService;
    }


    // 導向等級選取，帶使用者資料，檢查玩家遊戲進度
    public function index(int $country_id)
    {
        
        //初始化玩家紀錄(檢查玩家的country_id 和 levels)
        $this->gameService->initUserRecord();
        // $Current_User_id = auth()->user()->id;
        $User_country = auth()->user()->country_id;

        // 如果玩家最新的國家id大於等於當前國家id
        // 帶出當前國家資訊 LV1-3
        if($User_country >= $country_id){
            // 國家底下的第一層知識卡
            $Parent_cards = KnowledgeCards::where('country_id', $country_id)->where('parent_id', 0)->get();
        }
        return view('level', ['parent_cards'=> $Parent_cards]);
    }

}
