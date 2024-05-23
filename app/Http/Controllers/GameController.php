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
                    return view('game.TrueORFalse',['question' => $question]);
                
                case 2:
                    // 如果GameType_id == 2
                    // 呼叫檢查使用者遊玩進度
                    $user = auth()->user();
                    $country = $user->country_id;
                    $levels = $user->levels;
                    $match = false;
                    while(!$match){
                        $question = Question::where('gametype', '選擇')->inRandomOrder()->first();
                        $options  = Option::where('question_id', $question -> id)->inRandomOrder()->get();
                        $question_card = $question->knowledge_cards;
                        $question_levels = $question_card->levels;
                        if($country===$question->country_id && $levels===$question_levels){
                            // 儲存當前隨機亂數的題目
                            $userrecord = new UserRecord();
                            $userrecord->user_id = $user->id;
                            $userrecord->question_id = $question->id;
                            $userrecord->times = 0;
                            $userrecord->save();
                            $match = true;
                        }
                    }
                    return view('game.choose', ['question' => $question, 'options' => $options]);
                case 3:
                    // 
                    return view('game.match');
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
