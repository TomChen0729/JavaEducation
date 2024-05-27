<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserRecord;
use App\Models\KnowledgeCard;
use App\Models\Option;
use App\Models\MatchOption;
use App\Models\Question;
use App\Models\ReorganizationOption;
use Illuminate\Http\Request;
use App\Services\GameService;

class GameController extends Controller
{
    protected $gameService;
    // 檢查登入狀態
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Display a listing of the resource.
     */
    
    //導向遊戲列表
    public function index(int $levels)
    {
        //
        $gameList = Question::class;
        return view('Gameviews');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ChooseGame(Request $request, int $GameType_id)
    {
        //
        
        if($request->isMethod('get')){
            switch ($GameType_id) {
                case 1:
                    // 如果GameType_id == 1
                    // 呼叫檢查使用者遊玩進度
                    $user = auth()->user();
                    $country = $user->country_id;
                    $levels = $user->levels;
                    // 迴圈用來判斷題目是否符合當前user的country跟level
                    // 呼叫亂數出題
                    $question = Question::where('gametype', '是非')->where('country_id',$country)->where('levels',$levels)->inRandomOrder()->first();
                    // 儲存當前隨機亂數的題目
                    // 還要帶該遊戲第二層知識卡，方便跳窗後點擊查詢卡片內容           
                    return view('game.TrueORFalse',['question' => $question]);
                
                case 2:
                    // 如果GameType_id == 2
                    // 呼叫檢查使用者遊玩進度
                    $user = auth()->user();
                    $country = $user->country_id;
                    $levels = $user->levels;
                    $question = Question::where('gametype', '選擇')->where('country_id',$country)->where('levels',$levels)->inRandomOrder()->first();
                    $options  = Option::where('question_id', $question -> id)->inRandomOrder()->get();
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
                    $question = Question::where('gametype', '重組')->where('country_id',$country)->where('levels',$levels)->inRandomOrder()->first();
                    $options  = ReorganizationOption::where('question_id', $question -> id)->inRandomOrder()->get();
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
    public function correctANS(Request $request, string $game_type){
        if($request -> isMethod('get')){
            if($game_type==4)
                {
                $questionId = $request->input('question_id');
                $usersort = $request->input('usersort');
                $sort = ReorganizationOption::where('question_id',$questionId)->orderBy('sort','asc')->pluck('sort')->toArray();
                if ($usersort == $sort)
                    return response()->json(['message'=>'答案正確']);
                else
                    return response()->json(['message'=>'答案錯誤']);
                }
            else
                {
                $questionId = $request->input('question_id');
                $useranswer = $request->input('useranswer');
                $answer = Question::where('question_id',$questionId)->pluck('answer')->first();
                if($useranswer==$answer)
                    return response()->json(['message'=>'答案正確']);
                else
                    return response()->json(['message'=>'答案錯誤']);
                }
        }
    }

}
