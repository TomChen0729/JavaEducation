<?php

namespace App\Http\Controllers;

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
        // $this->
    }


    // 導向等級選取，帶使用者資料，檢查玩家遊戲進度
    public function index(int $country_id)
    {
        
        //初始化玩家紀錄(檢查玩家的country_id 和 pass_familiarity_id)
        $this->gameService->initUserRecord();

        $Current_User_id = auth()->user()->id;
        $current_country = $Current_User_id;
        
        return view('level');
    }

}
