<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeCard;
use App\Models\PassCourseGetCard;
use App\Models\PassCourseNeedCard;
use App\Models\SecAnswer;
use App\Models\SecGame;
use App\Models\SecParameter;
use App\Models\SecRecord;
use App\Models\UserKnowledgeCard;
use App\Services\GameService;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
    public function checkSecRecord(string $gameName, int $country_id)
    {
        $currentUserId = auth()->user()->id;
        // 查詢玩家是否玩過這遊戲
        // 找出這個gamename的所有parameterID
        $allParameterIDInCurrentGame = SecParameter::join('sec_games', 'sec_parameters.secGameID', '=', 'sec_games.id')
            ->where('sec_games.gamename', $gameName)
            ->pluck('sec_parameters.id')
            ->toArray();

        // sec_games先串sec_parameters，再串sec_records
        $secUserRecords = SecGame::join('sec_parameters', 'sec_parameters.secGameID', '=', 'sec_games.id')
            ->join('sec_records', 'sec_records.secParameterID', '=', 'sec_parameters.id')
            ->where('sec_games.country_id', $country_id)
            ->where('sec_records.user_id', $currentUserId)
            ->whereIn('sec_records.secParameterID', $allParameterIDInCurrentGame)
            ->get();
        // 如果玩家在這題有正確的紀錄時，記錄這筆資料
        $truesecRecords = $secUserRecords->where('status', 'true')->whereNotNull('user_answer');
        // 如果正確的紀錄不是空值，返回這筆資料
        if ($truesecRecords->isNotEmpty()) {
            return ['record' => $truesecRecords,'result'=>'truerecord'];}
        // 判斷是否有玩過這遊戲，如果有則返回那些資料
        elseif ($secUserRecords->isNotEmpty()) {
            return ['record' => $secUserRecords,'result'=>'haverecord'];}
        // 沒玩過，返回一個空集合
        else {
            return ['record' => collect(),'result'=>'norecord'];
        }
    }

    // 當第一次遊玩的時候要紀錄時調用(僅限第一次遊玩該遊戲時調用)
    public function recordWatchedParameter(int $secParameterID, array $parameter)
    {
        //基礎的資料
        $defaultdata = [
            'user_id' => auth()->user()->id,
            'secParameterID' => $secParameterID,
            'parameter' => json_encode($parameter),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        //初始化四個狀態
        $data = [
            array_merge($defaultdata, ['status' => 'watched', 'counter' => 1]),
            array_merge($defaultdata, ['status' => 'true', 'counter' => 0]),
            array_merge($defaultdata, ['status' => 'false', 'counter' => 0]),
            array_merge($defaultdata, ['status' => 'watch_again', 'counter' => 0]),
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
        for ($i = 0; $i < $quantity; $i++) {
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
    public function checkUserCards(int $secGameID)
    {
        // 這關需要的卡片
        $needCards = PassCourseNeedCard::where('secGameID', $secGameID)->pluck('knowledge_card_id')->toArray();
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

    // 如果有使用join去查詢，要記得查表順序第一張表串第二張表返回的collection的id會是第二張的id不是第一張的id
    // 根據icon導向遊戲
    public function chooseGame(Request $request, int $country_id, string $gameName)
    {
        if ($request->isMethod('get')) {
            // 進入checkUserCards的function，確認玩家是否能進入此關卡
            // $checkUserCards = $this->checkUserCards($gameName);
            // 測試用
            $currentSecGameID = SecGame::where('gamename', $gameName)->pluck('id')->first();
            // $checkUserCards = $this -> checkUserCards($currentSecGameID);
            $checkUserCards = true;
            if ($checkUserCards === true) {
                $currentUserId = auth()->user()->id;
                $record = $this->checkSecRecord($gameName, $country_id);
                $userRecords = $record['record'];
                if (isset($record['record'])) {
                    $userAnswersJson = $userRecords->pluck('user_answer')->toArray();
                    $userAnswers = json_decode(trim($userAnswersJson[0]), true);
                }
                $result = $record['result'];
                $variable = null;

                switch ($gameName) {
                    // 從記錄表撈玩過的，如果最近一次有玩的參數先導入(寫一個function)
                    // 如果沒玩過或是全對的話，隨便random
                    case '魔法寶箱':
                        if ($userRecords->isEmpty()) {
                            // 三角形層數變數
                            $variable = 3 + rand(0, 2) * 2;
                            $boxGameQuestion = SecGame::join('sec_parameters', 'sec_parameters.secGameID', '=', 'sec_games.id')
                                ->where('country_id', $country_id)
                                ->where('gamename', $gameName)
                                ->inRandomOrder()->first();
                            Log::info('data' . $boxGameQuestion);
                            $templateCode = $boxGameQuestion->template_code;
                            $templateCode = str_replace('$variable', $variable, $templateCode);
                            // 紀錄這筆資料
                            $this->recordWatchedParameter($boxGameQuestion->id, ['variable' => $variable]);
                            return view('game.country2.boxgame', ['boxGameQuestion' => $boxGameQuestion, 'templateCode' => $templateCode, 'variable' => $variable]);
                        } else if  ($result == 'truerecord'){
                            //解碼json字符串類型
                            $parameterJson = $userRecords->pluck(value: 'parameter')->first();
                            $parameterArray = json_decode($parameterJson, true);
                            $variable = $parameterArray['variable'];
                            //儲存當前的題目id
                            $secParameterID = $userRecords->first()->secParameterID;
                            //儲存該玩家的正確答案
                            SecRecord::where('user_id', $currentUserId)->where('secParameterID', $secParameterID)->where('status', 'watched')->increment('counter');
                            $boxGameQuestion = SecGame::join('sec_parameters', 'sec_games.id', '=', 'sec_parameters.secGameID')
                                ->where('sec_parameters.id', $secParameterID)->first();
                            $templateCode = $boxGameQuestion->template_code;
                            $templateCode = str_replace('$variable', $variable, $templateCode);
                            return view('game.country2.boxgame', ['boxGameQuestion' => $boxGameQuestion, 'templateCode' => $templateCode, 'variable' => $variable,'userAnswers' => $userAnswers]);
                        }
                        else {
                            //解碼json字符串類型
                            $parameterJson = $userRecords->pluck(value: 'parameter')->first();
                            $parameterArray = json_decode($parameterJson, true);
                            $variable = $parameterArray['variable'];
                            //儲存當前的題目id
                            $secParameterID = $userRecords->first()->secParameterID;
                            SecRecord::where('user_id', $currentUserId)->where('secParameterID', $secParameterID)->where('status', 'watched')->increment('counter');
                            $boxGameQuestion = SecGame::join('sec_parameters', 'sec_games.id', '=', 'sec_parameters.secGameID')
                                ->where('sec_parameters.id', $secParameterID)->first();
                            $templateCode = $boxGameQuestion->template_code;
                            $templateCode = str_replace('$variable', $variable, $templateCode);
                            return view('game.country2.boxgame', ['boxGameQuestion' => $boxGameQuestion, 'templateCode' => $templateCode, 'variable' => $variable]);
                        }
                    case '魔法門衛':
                        if ($userRecords->isEmpty()) {
                            $variable = rand(1, 5);
                            $idCardQuestion = SecGame::join('sec_parameters', 'sec_parameters.secGameID', '=', 'sec_games.id')
                                ->where('country_id', $country_id)
                                ->where('gamename', $gameName)
                                ->inRandomOrder()->first();
                            $templateCode = $idCardQuestion->template_code;
                            $templateCode = str_replace('$variable', $variable, $templateCode);
                            $idCardsData = $this->generateID($variable);
                            // 紀錄這筆資料
                            $this->recordWatchedParameter($idCardQuestion->id, ['variable' => $variable, 'idCardsData' => $idCardsData]);
                            return view('game.country2.idcardgame', ['idCardGameQuestion' => $idCardQuestion, 'templateCode' => $templateCode, 'variable' => $variable, 'idCardsData' => $idCardsData]);
                        } else {
                            //解碼json字符串類型
                            $parameterJson = $userRecords->pluck(value: 'parameter')->first();
                            $parameterArray = json_decode($parameterJson, true);
                            $variable = $parameterArray['variable'];
                            $idCardsData = $parameterArray['idCardsData'];
                            //儲存當前的題目id
                            $secParameterID = $userRecords->first()->secParameterID;
                            $idCardQuestion = SecGame::join('sec_parameters', 'sec_games.id', '=', 'sec_parameters.secGameID')
                                ->where('sec_parameters.id', $secParameterID)->first();
                            $templateCode = $idCardQuestion->template_code;
                            $templateCode = str_replace('$variable', $variable, $templateCode);
                            return view('game.country2.idcardgame', ['idCardGameQuestion' => $idCardQuestion, 'templateCode' => $templateCode, 'variable' => $variable, 'idCardsData' => $idCardsData]);
                        }
                    case '通關密碼':
                        if ($userRecords->isEmpty()) {
                            // 隨機產生的密碼
                            $variable = rand(1000, 9999);
                            $passwordGameQuestion = SecGame::join('sec_parameters', 'sec_parameters.secGameID', '=', 'sec_games.id')
                                ->where('country_id', $country_id)
                                ->where('gamename', $gameName)
                                ->inRandomOrder()->first();
                            $templateCode = $passwordGameQuestion->template_code;
                            // 紀錄這筆資料
                            $this->recordWatchedParameter($passwordGameQuestion->id, ['variable' => $variable]);
                            return view('game.country2.password', ['passwordGameQuestion' => $passwordGameQuestion, 'variable' => $variable, 'templateCode' => $templateCode]);
                        } else {
                            //解碼json字符串類型
                            $parameterJson = $userRecords->pluck(value: 'parameter')->first();
                            $parameterArray = json_decode($parameterJson, true);
                            $variable = $parameterArray['variable'];
                            //儲存當前的題目id
                            $secParameterID = $userRecords->first()->secParameterID;
                            $passwordGameQuestion = SecGame::join('sec_parameters', 'sec_games.id', '=', 'sec_parameters.secGameID')
                                ->where('sec_parameters.id', $secParameterID)->first();
                            $templateCode = $passwordGameQuestion->template_code;
                            return view('game.country2.password', ['passwordGameQuestion' => $passwordGameQuestion, 'variable' => $variable, 'templateCode' => $templateCode]);
                        }
                    case'調配藥水':
                        if($userRecords->isEmpty()){
                            $variable1 = rand(1, 50);
                            $variable2 = rand(1, 50);
                            //合併儲存到parameter
                            $variable = $variable1.',' . $variable2;
                            $makepotionQuestion = SecGame::join('sec_parameters', 'sec_parameters.secGameID', '=', 'sec_games.id')
                                ->where('country_id', $country_id)
                                ->where('gamename', $gameName)
                                ->inRandomOrder()->first();
                            // 拆template_code跟配方表
                            $template_Code = $makepotionQuestion->template_code;
                            $templateCodeArray = explode('|', $template_Code);
                            $templateCode = $templateCodeArray[0];
                            $formula = $templateCodeArray [1];
                            $templateCode = str_replace('$variable1', $variable1, $templateCode);
                            $templateCode = str_replace('$variable2', $variable2, $templateCode);     
                            // 紀錄這筆資料
                            $this->recordWatchedParameter($makepotionQuestion->id, ['variable' => $variable]);
                            return view('game.country2.makepotion', ['makepotionQuestion' => $makepotionQuestion, 'variable1' => $variable1,'variable2' => $variable2,'formula' => $formula, 'templateCode' => $templateCode]);
                        }else{
                            //解碼json字符串類型
                            $parameterJson = $userRecords->pluck(value: 'parameter')->first();
                            $parameterArray = json_decode($parameterJson, true);
                            $variable = $parameterArray['variable'];
                            $variablesArray = explode(',', $variable);
                            $variable1 = $variablesArray[0];
                            $variable2 = $variablesArray[1];
                            //儲存當前的題目id
                            $secParameterID = $userRecords->first()->secParameterID;
                            $makepotionQuestion = SecGame::join('sec_parameters', 'sec_games.id', '=', 'sec_parameters.secGameID')
                                ->where('sec_parameters.id', $secParameterID)->first();
                            $template_Code = $makepotionQuestion->template_code;
                            $templateCodeArray = explode('|', $template_Code);
                            $templateCode = $templateCodeArray[0];
                            $formula = $templateCodeArray [1];
                            $templateCode = str_replace('$variable1', $variable1, $templateCode);
                            $templateCode = str_replace('$variable2', $variable2, $templateCode);
                            return view('game.country2.makepotion', ['makepotionQuestion' => $makepotionQuestion, 'variable1' => $variable1,'variable2' => $variable2,'formula' => $formula, 'templateCode' => $templateCode]);                            
                        }
                    case '魔林解密':
                        if($userRecords->isEmpty()){
                            $variable1 = rand(50, 100);
                            $variable2 = rand(50, 100);
                            $variable = $variable1 . ',' . $variable2;
                            $appleQuestion = SecGame::join('sec_parameters', 'sec_parameters.secGameID', '=', 'sec_games.id')
                                ->where('country_id', $country_id)
                                ->where('gamename', $gameName)
                                ->inRandomOrder()->first();
                            $templateCode = $appleQuestion->template_code;
                            $templateCode = str_replace('$variable1', $variable1, $templateCode);
                            $templateCode = str_replace('$variable2', $variable2, $templateCode);
                            // 紀錄這筆資料
                            $this->recordWatchedParameter($appleQuestion->id, ['variable' => $variable]);
                            return view('game.country2.apple', ['appleQuestion' => $appleQuestion, 'variable1' => $variable1,'variable2' => $variable2, 'templateCode' => $templateCode]);
                        }else{
                            //解碼json字符串類型
                            $parameterJson = $userRecords->pluck(value: 'parameter')->first();
                            $parameterArray = json_decode($parameterJson, true);
                            $variable = $parameterArray['variable'];
                            //拆開variable
                            $variablesArray = explode(',', $variable);
                            $variable1 = $variablesArray[0];
                            $variable2 = $variablesArray[1];
                            //儲存當前的題目id
                            $secParameterID = $userRecords->first()->secParameterID;
                            $appleQuestion = SecGame::join('sec_parameters', 'sec_games.id', '=', 'sec_parameters.secGameID')
                                ->where('sec_parameters.id', $secParameterID)->first();
                            $templateCode = $appleQuestion->template_code;
                            $templateCode = str_replace('$variable1', $variable1, $templateCode);
                            $templateCode = str_replace('$variable2', $variable2, $templateCode);
                            return view('game.country2.apple', ['appleQuestion' => $appleQuestion, 'variable1' => $variable1,'variable2' => $variable2, 'templateCode' => $templateCode]);                            
                        }
                    default:
                        //
                        return response('error');
                }
            } else {
                $userNeedToGetCards = KnowledgeCard::whereIn('id', $checkUserCards['missingCards'])->pluck('name')->toArray();
                Log::info($userNeedToGetCards);
                return view('level2', ['userNeedToGetCards' => $userNeedToGetCards, 'currentCountry' => $country_id]);
            }
        } else {
            return response()->json(['message' => 'http method error!!']);
        }
    }

    // 派發知識卡的函式
    public function giveUserCards(int $secGameID, int $currentUID)
    {
        $randGiveCard = PassCourseGetCard::where('secGameID', $secGameID)->inRandomOrder()->first();
        Log::info($randGiveCard);
        $data = [
            'user_id' => $currentUID,
            'knowledge_card_id' => $randGiveCard->knowledge_card_id,
            'watchtime' => '00:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        UserKnowledgeCard::insert($data);

        return $randGiveCard;
    }
    public function CorrectUserRecord(int $userid,int $parameterid,  $useranswer){
        $CorrectUserRecord = SecRecord::where('user_id',$userid)->where('secParameterID',$parameterid)->where('status','true')->first();
        $CorrectUserRecord->counter+=1;
        $CorrectUserRecord->user_answer = json_encode($useranswer);
        $CorrectUserRecord->save();
        $WatchedtUserRecord = SecRecord::where('user_id',$userid)->where('secParameterID',$parameterid)->where('status','watched')->first();
        $WatchedtUserRecord->counter-=1;
        $WatchedtUserRecord->save();
    }
    public function WrongUserRecord(int $userid,int $parameterid){
        $WrongUserRecord = SecRecord::where('user_id',$userid)->where('secParameterID',$parameterid)->where('status','false')->first();
        $WrongUserRecord->counter+=1;
        $WrongUserRecord->save();
        $WatchedtUserRecord = SecRecord::where('user_id',$userid)->where('secParameterID',$parameterid)->where('status','watched')->first();
        $WatchedtUserRecord->counter-=1;
        $WatchedtUserRecord->save();
    }
    // 批改&紀錄
    public function checkUserAnswer(Request $request)
    {
        if ($request->isMethod('POST')) {
            // 從回傳的json解析題目資訊，因為每題的答案不一樣
            $gameName = $request->input('gameName');
            $currentUser = $request->input('currentUser');
            Log::info($currentUser);
            // 存返回錯誤的index
            $wrongIndexArray = [];
            switch ($gameName) {
                case '魔法寶箱':
                    //進一步解析userAnswer
                    $userAnswer = $request->input('userAnswer');
                    // 如過userAnswer不為空的話，逐一對答案，即為有答案的話
                    if (!empty($userAnswer)) {
                        $parameterID = $request->input('parameter_id');
                        // 抓答案出來
                        $answerData = $this->pluckAnswer($parameterID);
                        // 答案與玩家輸入的答案長度若一致
                        if(count($answerData) == count($userAnswer)){
                            foreach($answerData as $ansData){         
                                foreach($userAnswer as $userAns){
                                    if ($userAns['order'] == $ansData['order']) {
                                        if(preg_match('/'.str_replace('\\\\', '\\', $ansData['ans_patterns']).'/', $userAns['userAnswer'])){
                                            // 匹配成功就跳出內層迴圈繼續對下一個使用者的答案
                                            break;
                                        }else{
                                            array_push($wrongIndexArray, $userAns['order']);
                                        }
                                    }
                                }
                            }

                            if(!empty($wrongIndexArray)){
                                $this->WrongUserRecord($currentUser,$parameterID);
                                return response()->json(['message' => 'wrongAns', 'wrongIndex' => $wrongIndexArray]);
                            }else{
                                $this->CorrectUserRecord($currentUser,$parameterID, $userAnswer);
                                return response()->json(['message' => 'correct']);
                            }
                        }else{
                            return response()->json(['message' => 'Error']);
                        }
                        
                    } else {
                        return response()->json(['message' => 'Null']);
                    }
                case '魔法門衛':
                //進一步解析userAnswer
                $userAnswer = $request->input('userAnswer');
                // 如過userAnswer不為空的話，逐一對答案，即為有答案的話
                if (!empty($userAnswer)) {
                    $parameterID = $request->input('parameter_id');
                    // 抓答案出來
                    $answerData = $this->pluckAnswer($parameterID);
                    // 答案與玩家輸入的答案長度若一致
                    if(count($answerData) == count($userAnswer)){
                        foreach($answerData as $ansData){         
                            foreach($userAnswer as $userAns){
                                if ($userAns['order'] == $ansData['order']) {
                                    if(preg_match('/'.str_replace('\\\\', '\\', $ansData['ans_patterns']).'/', $userAns['userAnswer'])){
                                        // 匹配成功就跳出內層迴圈繼續對下一個使用者的答案
                                        break;
                                    }else{
                                        array_push($wrongIndexArray, $userAns['order']);
                                    }
                                }
                            }
                        }

                        if(!empty($wrongIndexArray)){
                            $this->WrongUserRecord($currentUser,$parameterID);
                            return response()->json(['message' => 'wrongAns', 'wrongIndex' => $wrongIndexArray]);
                        }else{
                            $this->CorrectUserRecord($currentUser,$parameterID, $userAnswer);
                            return response()->json(['message' => 'correct']);
                        }
                    }else{
                        return response()->json(['message' => 'Error']);
                    }
                    
                } else {
                    return response()->json(['message' => 'Null']);
                }
                case '通關密碼':
                //進一步解析userAnswer
                $userAnswer = $request->input('userAnswer');
                // 如過userAnswer不為空的話，逐一對答案，即為有答案的話
                if (!empty($userAnswer)) {
                    $parameterID = $request->input('parameter_id');
                    // 抓答案出來
                    $answerData = $this->pluckAnswer($parameterID);
                    // 答案與玩家輸入的答案長度若一致
                    if(count($answerData) == count($userAnswer)){
                        foreach($answerData as $ansData){         
                            foreach($userAnswer as $userAns){
                                if ($userAns['order'] == $ansData['order']) {
                                    if(preg_match('/'.str_replace('\\\\', '\\', $ansData['ans_patterns']).'/', $userAns['userAnswer'])){
                                        // 匹配成功就跳出內層迴圈繼續對下一個使用者的答案
                                        break;
                                    }else{
                                        array_push($wrongIndexArray, $userAns['order']);
                                    }
                                }
                            }
                        }

                        if(!empty($wrongIndexArray)){
                            $this->WrongUserRecord($currentUser,$parameterID);
                            return response()->json(['message' => 'wrongAns', 'wrongIndex' => $wrongIndexArray]);
                        }else{
                            $this->CorrectUserRecord($currentUser,$parameterID, $userAnswer);
                            return response()->json(['message' => 'correct']);
                        }
                    }else{
                        return response()->json(['message' => 'Error']);
                    }
                    
                } else {
                    return response()->json(['message' => 'Null']);
                }
                case'調配藥水':
                //進一步解析userAnswer
                $userAnswer = $request->input('userAnswer');
                // 如過userAnswer不為空的話，逐一對答案，即為有答案的話
                if (!empty($userAnswer)) {
                    $parameterID = $request->input('parameter_id');
                    // 抓答案出來
                    $answerData = $this->pluckAnswer($parameterID);
                    // 答案與玩家輸入的答案長度若一致
                    if(count($answerData) == count($userAnswer)){
                        foreach($answerData as $ansData){         
                            foreach($userAnswer as $userAns){
                                if ($userAns['order'] == $ansData['order']) {
                                    if(preg_match('/'.str_replace('\\\\', '\\', $ansData['ans_patterns']).'/', $userAns['userAnswer'])){
                                        // 匹配成功就跳出內層迴圈繼續對下一個使用者的答案
                                        break;
                                    }else{
                                        array_push($wrongIndexArray, $userAns['order']);
                                    }
                                }
                            }
                        }

                        if(!empty($wrongIndexArray)){
                            $this->WrongUserRecord($currentUser,$parameterID);
                            return response()->json(['message' => 'wrongAns', 'wrongIndex' => $wrongIndexArray]);
                        }else{
                            $this->CorrectUserRecord($currentUser,$parameterID, $userAnswer);
                            return response()->json(['message' => 'correct']);
                        }
                    }else{
                        return response()->json(['message' => 'Error']);
                    }
                    
                } else {
                    return response()->json(['message' => 'Null']);
                }
                default:
                    return response('沒有這個遊戲類型');
            }
        } 
        else {
            return response()->json(['message' => 'http method error!!']);
        }
    }


    public function pluckAnswer(int $secParameterID){
        if(!empty($secParameterID)){
            $answerData = SecAnswer::where('secParameterID', $secParameterID)->get();
            if(!empty($answerData)){
                Log::info('ans'.$answerData);
                return $answerData;
            }else{
                return Null;
            }
        }else{
            return Null;
        }
        
    }
}