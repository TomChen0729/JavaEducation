<?php

namespace App\Http\Controllers;

use App\Models\SecQuestion;
use App\Models\SecRecord;
use App\Services\GameService;
use Illuminate\Http\Request;

class SecCountryController extends Controller
{
    //
    protected $gameService;

    public function __construct(GameService $gameService){
        $this->gameService = $gameService;
    }

    public function chooseGame(Request $request, string $Gametype, int $country_id){
        if($request->isMethod('get')){
            switch($Gametype){
                // 從記錄表撈玩過的，如果最近一次有玩的參數先導入
                // 如果沒玩過或是全對的話，隨便random
                case '寶箱遊戲':
                    // return view();
                    break;
                case '魔法門衛':
                    // return view();
                    break;
                default:
                    //
                    return response('error');
            }
        }
    }
}
