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
    public function checkSecRecord(string $gameName, int $country_id){
        $currentUserId = auth()->user()->id;
        $secUserRecords = SecQuestion::join('sec_records', 'sec_records.sec_Qid', '=', 'sec_questions.sec_Qid')
        ->where('country_id', $country_id)
        ->where('user_id', $currentUserId)
        ->where('gamename', $gameName)
        ->get();
        if($secUserRecords->status == 'watched' || $secUserRecords->status == 'false'){
            return $secUserRecords->parameter;
        }else{
            return null;
        }
    }

    // 當第一次遊玩的時候要紀錄時調用
    public function recordWatchedParameter(){
        
    }

    // 產生身分證的function
    public function generateID(int $quantity){
        $genders = ['男', '女'];
        $identities = ['怪物', '居民', '商人'];

        $idCards = [];
        // array_rand()是return陣列的index
        for($i = 0; $i <= $quantity; $i++){
            $gender = $genders[array_rand($genders)];
            $identity = $identities[array_rand($identities)];
            $age = rand(20, 50);

            $idCards[] = [
                'gender' => $gender,
                'identity' => $identity,
                'age' => $age,
            ];
        }

        return $idCards;
    }
    public function chooseGame(Request $request, int $country_id, string $gameName)
    {
        if ($request->isMethod('get')) {
            switch ($gameName) {
                // 從記錄表撈玩過的，如果最近一次有玩的參數先導入(寫一個function)
                // 如果沒玩過或是全對的話，隨便random
                case '魔法寶箱':
                    // 排查
                    // 檢查checkSecRecord()的回傳結果
                    // 玩過
                    // if($this->checkSecRecord($gameName, $country_id)){

                    // }
                    // // 沒玩過
                    // else{
                    //     // 紀錄遊戲參數
                    //     $this->recordWatchedParameter();
                    // }
                    
                    // 三角形層數變數
                    $variable = 3 + rand(0, 2) * 2;
                    $boxGameQuestion = SecQuestion::where('country_id', $country_id)
                        ->where('gamename', $gameName)
                        ->inRandomOrder()->first();
                    $templateCode = $boxGameQuestion->template_code;
                    $templateCode = str_replace('$variable', $variable, $templateCode);
                    return view('game.country2.boxgame', ['boxGameQuestion' => $boxGameQuestion, 'templateCode' => $templateCode, 'variable' => $variable]);
                case '魔法門衛':
                    $variable = rand(1, 5);
                    $idCardQuestion = SecQuestion::where('country_id', $country_id)
                    ->where('gamename', $gameName)
                    ->inRandomOrder()->first();
                    $templateCode = $idCardQuestion->template_code;
                    $templateCode = str_replace('$variable', $variable, $templateCode);
                    $idCardsData = $this->generateID($variable);
                    return view('game.country2.idcardgame', ['idCardGameQuestion' => $idCardQuestion, 'templateCode' => $templateCode, 'variable' => $variable, 'idCardsData' => $idCardsData]);
                default:
                    //
                    return response('error');
            }
        } else {
            return response()->json(['message' => 'http method error!!']);
        }
    }


    // 批改&紀錄
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
