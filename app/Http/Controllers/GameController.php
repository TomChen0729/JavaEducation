<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserRecord;
use App\Models\KnowledgeCards;
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
        
        switch ($GameType_id) {
            case 1:
                // 如果GameType_id == 1
                // 呼叫檢查使用者遊玩進度
                $user = auth()->user();
                $country = $user->country_id;
                $levels = $user->levels;
                // 迴圈用來判斷題目是否符合當前user的country跟level
                $match = false;
                while(!$match){
                    // 呼叫亂數出題
                    $question = Question::where('gametype', '是非')->inRandomOrder()->first();
                    $question_card = $question->knowledge_cards;
                    $question_levels = $question_card->levels;
                    if($country===$question->country_id && $levels===$question_levels){
                        // 儲存當前隨機亂數的題目
                        $userrecord = new UserRecord();
                        $userrecord->user_id = $user->id;
                        $userrecord->question_id = $question->id;
                        $userrecord->save();
                        $match = true;
                    }
                }
                return view('game.TrueORFalse',['question' => $question]);
            case 2:
                // 
                return view('game.choose');
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
