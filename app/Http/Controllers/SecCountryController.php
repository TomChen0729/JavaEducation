<?php

namespace App\Http\Controllers;

use App\Models\PassCourseGetCard;
use App\Models\PassCourseNeedCard;
use App\Models\SecQuestion;
use App\Models\SecRecord;
use App\Models\UserKnowledgeCard;
use App\Services\GameService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Mockery\Generator\Parameter;

class SecCountryController extends Controller
{
    //
    protected $gameService;

    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    // 檢查玩家沒有玩個該遊戲名稱的紀錄，如果有回傳當時參數
    // 檢查是否正確紀錄為空
    public function checkSecRecord(string $gameName, int $country_id){
        $currentUserId = auth()->user()->id;
        // 查詢玩家是否玩過這遊戲
        $secUserRecords = SecQuestion::join('sec_records', 'sec_records.sec_Qid', '=', 'sec_questions.id')
        ->where('country_id', $country_id)
        ->where('user_id', $currentUserId)
        ->where('gamename', $gameName)
        ->get();
        // 如果玩家在這題有正確的紀錄時，記錄這筆資料
        $truesecRecords= $secUserRecords->where('status', true)->where('counter','!=',0);
        // 如果正確的紀錄不是空值，返回這筆資料
        if($truesecRecords->isNotEmpty()){
            return $truesecRecords;
        }
        // 判斷是否有玩過這遊戲，如果有則返回那些資料
        elseif($secUserRecords->isNotEmpty()){
            return $secUserRecords;
        }
        // 沒玩過，返回一個空集合
        else{
            return collect();
        }
    }

    // 當第一次遊玩的時候要紀錄時調用(僅限第一次遊玩該遊戲時調用)
    public function recordWatchedParameter(int $sec_Qid, array $parameter){
        //基礎的資料
        $defaultdata = [
            'user_id' => auth()->user()->id,
            'sec_Qid' => $sec_Qid,
            'parameter' => json_encode($parameter),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        //初始化四個狀態
        $data = [
            array_merge($defaultdata,['status' => 'watched', 'counter'=>1]),
            array_merge($defaultdata,['status' => 'true', 'counter'=>0]),
            array_merge($defaultdata,['status' => 'false', 'counter'=>0]),
            array_merge($defaultdata,['status' => 'watch_again', 'counter'=>0]),
        ];
        SecRecord::insert($data);
    }

    // 產生身分證的function
    public function generateID(int $quantity)
    {
        $genders = ['男', '女'];
        $identities = ['怪物', '居民', '商人'];

        $idCards = [];
        // array_rand()是return陣列的index
        for ($i = 0; $i <= $quantity; $i++) {
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

    // 檢查關卡進入點
    public function checkUserCards(int $sec_Qid)
    {
        // 這關需要的卡片
        $needCards = PassCourseNeedCard::where('sec_Qid', $sec_Qid)->pluck('knowledge_card_id')->toArray();
        // 玩家有的卡片
        $userCards = UserKnowledgeCard::where('user_id', auth()->user()->id)->pluck('knowledge_card_id')->toArray();
        // 如果這關需要的卡片是空的話直接回傳true
        if ($needCards == Null) {
            return true;
        } else { // 如果不是進行判斷
            // 找出使用者缺少的卡片
            $missingCards = array_diff($needCards, $userCards);
            // 如果沒有等同於使用者可以進入關卡
            if ($missingCards == Null) {
                return true;
            } else { // 如果有我就要回傳他缺少的
                return [
                    'status' => false,
                    'missingCards' => $missingCards
                ];
            }
        }
    }

    // 根據icon導向遊戲
    public function chooseGame(Request $request, int $country_id, string $gameName)
    {
        if ($request->isMethod('get')) {
            $currentUserId = auth()->user()->id;
            $userRecords = $this->checkSecRecord($gameName, $country_id);
            $variable = null;
            if($userRecords ->isNotEmpty()){
                //解碼json字符串類型
                $parameterJson = $userRecords->pluck('parameter')->first();
                $parameterArray = json_decode($parameterJson, true);
                $variable = $parameterArray['variable'];
                //儲存當前的題目id
                $sec_Qid = $userRecords->first()->sec_Qid;
                SecRecord::where('user_id', $currentUserId)->where('sec_Qid',$sec_Qid)->where('status','watched')->increment('counter');
            }

            switch ($gameName) {
                    // 從記錄表撈玩過的，如果最近一次有玩的參數先導入(寫一個function)
                    // 如果沒玩過或是全對的話，隨便random
                case '魔法寶箱':
                    // 排查
                    // 檢查是否能進入->checkUserCards($sec_Qid)
                    // 檢查checkSecRecord($gameName, $country_id)的回傳結果
                    // 玩過
                    // if($this->checkSecRecord($gameName, $country_id)){

                    // }
                    // // 沒玩過
                    // else{
                    //     // 紀錄遊戲參數
                    //     $this->recordWatchedParameter();
                    // }
                    if($userRecords->isEmpty()){
                        // 三角形層數變數
                        $variable = 3 + rand(0, 2) * 2;
                        $boxGameQuestion = SecQuestion::where('country_id', $country_id)
                            ->where('gamename', $gameName)
                            ->inRandomOrder()->first();
                        $templateCode = $boxGameQuestion->template_code;
                        $templateCode = str_replace('$variable', $variable, $templateCode);
                        // 紀錄這筆資料
                        $this->recordWatchedParameter($boxGameQuestion->id, ['variable' => $variable]);
                        return view('game.country2.boxgame', ['boxGameQuestion' => $boxGameQuestion, 'templateCode' => $templateCode, 'variable' => $variable]);
                    }
                    else{
                        $boxGameQuestion = SecQuestion::where('id', $sec_Qid)->first();
                        $templateCode = $boxGameQuestion->template_code;
                        $templateCode = str_replace('$variable', $variable, $templateCode);
                        return view('game.country2.boxgame', ['boxGameQuestion' => $boxGameQuestion, 'templateCode' => $templateCode, 'variable' => $variable]);
                    }
                case '魔法門衛':
                    if($userRecords->isEmpty()){
                        $variable = rand(1, 5);
                        $idCardQuestion = SecQuestion::where('country_id', $country_id)
                            ->where('gamename', $gameName)
                            ->inRandomOrder()->first();
                        $templateCode = $idCardQuestion->template_code;
                        $templateCode = str_replace('$variable', $variable, $templateCode);
                        $idCardsData = $this->generateID($variable);
                        // 紀錄這筆資料
                        $this->recordWatchedParameter($idCardQuestion->id, ['variable' => $variable]);
                    return view('game.country2.idcardgame', ['idCardGameQuestion' => $idCardQuestion, 'templateCode' => $templateCode, 'variable' => $variable, 'idCardsData' => $idCardsData]);
                    }
                    else{
                        $idCardQuestion = SecQuestion::where('id', $sec_Qid)->first();
                        $templateCode = $idCardQuestion->template_code;
                        $templateCode = str_replace('$variable', $variable, $templateCode);
                        $idCardsData = $this->generateID($variable);
                        return view('game.country2.idcardgame', ['idCardGameQuestion' => $idCardQuestion, 'templateCode' => $templateCode, 'variable' => $variable, 'idCardsData' => $idCardsData]);
                    }
                case '通關密碼':
                    if($userRecords->isEmpty()){
                        // 隨機產生的密碼
                        $variable = rand(1000, 9999);
                        $passwordGameQuestion = SecQuestion::where('country_id', $country_id)
                            ->where('gamename', $gameName)
                            ->inRandomOrder()->first();
                        $templateCode = $passwordGameQuestion->template_code;
                        // 紀錄這筆資料
                        $this->recordWatchedParameter($passwordGameQuestion->id, ['variable' => $variable]);
                        return view('game.country2.password', ['passwordGameQuestion' => $passwordGameQuestion,  'variable' => $variable, 'templateCode' => $templateCode]);
                    }
                    else{
                        $passwordGameQuestion = SecQuestion::where('id', $sec_Qid)->first();
                        $templateCode = $passwordGameQuestion->template_code;
                        return view('game.country2.password', ['passwordGameQuestion' => $passwordGameQuestion,  'variable' => $variable, 'templateCode' => $templateCode]);
                    }
                default:
                    //
                    return response('error');
            }
        } else {
            return response()->json(['message' => 'http method error!!']);
            }
        
    }

    // 派發知識卡的函式
    public function giveUserCards(int $sec_Qid)
    {
        $randGiveCard = PassCourseGetCard::where('sec_Qid', $sec_Qid)->inRandomOrder()->first();
        $data = [
            'user_id' => auth()->user()->id,
            'knowledge_card_id' => $randGiveCard->id,
        ];

        UserKnowledgeCard::insert($data);

        return $randGiveCard;
    }

    // 批改&紀錄
    public function checkUserAnswer(Request $request)
    {
        if ($request->isMethod('POST')) {
            // 從回傳的json解析題目資訊，因為每題的答案不一樣
            $gameName = $request->input('gameName');
            switch ($gameName) {
                case '寶箱遊戲':
                    //進一步解析userAnswer
                case '魔法門衛':
                    //進一步解析userAnswer
                case '通關密碼':
                    //進一步解析userAnswer
                default:
                    return response('沒有這個遊戲類型');
            }
        } else {
            return response()->json(['message' => 'http method error!!']);
        }
    }
}
