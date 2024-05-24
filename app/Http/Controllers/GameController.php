<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserRecord;
use App\Models\KnowledgeCard;
use App\Models\Option;
use App\Models\Question;
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
                    $question = Question::where('gametype','配對')->where('country_id',$country)->where('levels',$levels)->inRandomOrder()->first();
                    $options = Option::with('question')->where('question_id',$question->id)->inRandomOrder()->get();
                    return view('game.match',['question' => $question, 'options' => $options]);
                case 4:
                    // 
                    return view('game.reorganization');
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

    public function updateTrueorFalse(Request $request, string $state){
        if ($request->isMethod('get') && $state == 'True'){
            // 記錄玩了哪一題
            $Current_User = auth()->user()->id;
            $user_records = 0;
        }
    }

}
