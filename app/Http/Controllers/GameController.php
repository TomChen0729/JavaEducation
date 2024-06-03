<?php

namespace App\Http\Controllers;

use App\Models\MatchOption;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionStatus;
use App\Models\ReorganizationOption;
use App\Models\User;
use App\Models\UserRecord;
use App\Services\GameService;
use Exception;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $gameService;
    // 檢查登入狀態
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    //導向遊戲列表
    public function index(int $levels, int $country_id)
    {
        //
        $Question_list = Question::where('levels', $levels)->where('country_id', $country_id)->get();
        return view('Gameviews', ['Question_list' => $Question_list]);
    }

    // 依照遊戲類別 選擇導向遊戲畫面
    // 送至前端的東西：通關所需知識卡，題目資訊，
    public function ChooseGame(Request $request, int $GameType_id)
    {
        //

        if ($request->isMethod('get')) {
            switch ($GameType_id) {
                case 1:
                    // 如果GameType_id == 1
                    // 呼叫檢查使用者遊玩進度
                    // $user = auth()->user();
                    $country = auth()->user()->country_id;
                    $levels = auth()->user()->levels;
                    // 呼叫亂數出題
                    $question = Question::where('gametype', '是非')->where('country_id', $country)->where('levels', $levels)->inRandomOrder()->first();
                    // 還要帶該遊戲第二層知識卡，方便跳窗後點擊查詢卡片內容
                    return view('game.TrueORFalse', ['question' => $question]);

                case 2:
                    // 如果GameType_id == 2
                    // 呼叫檢查使用者遊玩進度
                    $user = auth()->user();
                    $country = $user->country_id;
                    $levels = $user->levels;
                    $question = Question::where('gametype', '選擇')->where('country_id', $country)->where('levels', $levels)->inRandomOrder()->first();
                    $options = Option::where('question_id', $question->id)->inRandomOrder()->get();
                    return view('game.choose', ['question' => $question, 'options' => $options]);
                case 3:
                    //
                    $user = auth()->user();
                    $country = $user->country_id;
                    $levels = $user->levels;
                    //隨機抓取六道題目
                    $questions = Question::where('gametype', '配對')->where('country_id', $country)->where('levels', $levels)->inRandomOrder()->take(6)->get();

                    //根據題目id去抓選項並將選項隨機
                    //whereIn能將options集合的元素視為單個條件值去跟question_id比對，$questions->pluck('id')會把$questions集合的每個問題的id抓出來
                    $options = MatchOption::whereIn('question_id', $questions->pluck('id'))->get()->shuffle();

                    return view('game.match', ['questions' => $questions, 'options' => $options]);
                case 4:
                    $user = auth()->user();
                    $country = $user->country_id;
                    $levels = $user->levels;
                    $question = Question::where('gametype', '重組')->where('country_id', $country)->where('levels', $levels)->inRandomOrder()->first();
                    $options = ReorganizationOption::where('question_id', $question->id)->inRandomOrder()->get();
                    return view('game.reorganization', ['question' => $question, 'options' => $options]);
                case 5:
                    //
                    break;
                    //
                default:
                    //
                    return response('error');
            }
        }
    }

    // 根據不同類型進行答案檢查
    // 對答案API
    public function correctANS(Request $request)
    {
        
        if($request -> isMethod('GET')){
            $user_ANS = $request->query('user_answer');
            $q_id = $request->query('question_id');
            $ANS = Question::where('id', $q_id)->pluck('answer')->first();
            if($user_ANS == $ANS){ // 答對的時候
                if(!QuestionStatus::where('question_id', $q_id)->exists()){ // 沒紀錄
                    QuestionStatus::create([
                        'question_id' => $q_id,
                        'status' => 1,
                    ]);
                }
                elseif(QuestionStatus::where('question_id', $q_id) == 0){ // 原本錯現在對

                }
                else{ // 原本對現在對

                }
                return response()->json(['message' => 'correct']);
            }
            else{  // 錯誤的時候
                if(!QuestionStatus::where('question_id', $q_id)->exists()){ // 沒紀錄
                    QuestionStatus::create([
                        'question_id' => $q_id,
                        'status' => 0,
                    ]);
                }
                 elseif(QuestionStatus::where('question_id', $q_id) == 1){ // 原本對現在錯

                 }
                 else{ // 原本錯現在錯
                    
                 }
                return response()->json(['message' => 'wrongAnswer']);
            }
        }
        else{
            return response()->json(['message' => 'http method must be get']);
        }
    }
}
