<?php

namespace App\Http\Controllers;

use App\Models\SecQuestion;
use App\Models\SecRecord;
use App\Services\GameService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class SecCountryController extends Controller
{
    //
    protected $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    // 檢查玩家沒有玩個該遊戲名稱的紀錄，如果有回傳當時參數
    public function checkSecRecord(string $Gametype){

    }
    public function chooseGame(Request $request, string $Gametype, int $country_id)
    {
        if ($request->isMethod('get')) {
            switch ($Gametype) {
                // 從記錄表撈玩過的，如果最近一次有玩的參數先導入(寫一個function)
                // 如果沒玩過或是全對的話，隨便random
                case '寶箱遊戲':
                    // 檢查checkSecRecord()的回傳結果
                    if($Gametype){

                    }else{

                    }
                    // return view();
                    break;
                case '魔法門衛':
                    // return view();
                    break;
                default:
                    //
                    return response('error');
            }
        } else {
            return response()->json(['message' => 'http method error!!']);
        }
    }


    public function checkUserAnswer(Request $request)
    {
        if ($request->isMethod('post')) {
            // 從回傳的json解析題目資訊，因為每題的答案不一樣
            $gameName = $request->input('gameName');
            switch ($gameName) {
                case '寶箱遊戲':
                    //進一步解析userAnswer
                case '魔法門衛':
                    //進一步解析userAnswer
                default:
                    return response('沒有這個遊戲類型');
            }
        } else {
            return response()->json(['message' => 'http method error!!']);
        }
    }
}
