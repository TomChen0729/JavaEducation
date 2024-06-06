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
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    protected $gameService;
    // gameservice 注入
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    //導向遊戲列表
    public function index(int $levels, int $country_id)
    {
        //
        $this->gameService->updateUserRecord($country_id, $levels);
        $Question_list = Question::select('gametype')->distinct()->get();
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
                    $country = auth()->user()->country_id;
                    $levels = auth()->user()->levels;
                    $current_uid = auth()->user()->id;
                    $current_count = UserRecord::where('user_id', $current_uid)
                    ->whereIn('question_id', function ($query) {
                        $query->select('id')->from('questions')->where('gametype', '是非');
                    })->count();        
                    $trueorfalse_count=Question::where('gametype','是非')->count();
                    if($current_count < $trueorfalse_count){
                        // 呼叫亂數出題
                        $question = Question::where('gametype', '是非')
                        ->where('country_id', $country)
                        ->where('levels', $levels)
                        ->whereNotIn('id', function($query) use ($current_uid) {
                            $query->select('question_id')->from('user_records')
                            ->where('user_id', $current_uid);
                        })->inRandomOrder()->first();
                        $current_count+=1;
                    }
                    else
                        {
                            $question = Question::where('gametype', '是非')
                            ->where('country_id', $country)
                            ->where('levels', $levels)
                            ->inRandomOrder()->first();
                        }
                    // 還要帶該遊戲第二層知識卡，方便跳窗後點擊查詢卡片內容
                    return view('game.TrueORFalse', ['question' => $question, 'current_uid' => $current_uid]);

                case 2:
                    // 如果GameType_id == 2
                    // 呼叫檢查使用者遊玩進度
                    $user = auth()->user();
                    $country = $user->country_id;
                    $levels = $user->levels;
                    $question = Question::where('gametype', '選擇')
                    ->where('country_id', $country)
                    ->where('levels', $levels)
                    ->inRandomOrder()->first();
                    $options = Option::where('question_id', $question->id)->inRandomOrder()->get();
                    return view('game.choose', ['question' => $question, 'options' => $options]);
                case 3:
                    //
                    $user = auth()->user();
                    $country = $user->country_id;
                    $levels = $user->levels;
                    //隨機抓取六道題目
                    $questions = Question::where('gametype', '配對')
                    ->where('country_id', $country)
                    ->where('levels', $levels)->inRandomOrder()->take(6)->get();

                    //根據題目id去抓選項並將選項隨機
                    //whereIn能將options集合的元素視為單個條件值去跟question_id比對，$questions->pluck('id')會把$questions集合的每個問題的id抓出來
                    $options = MatchOption::whereIn('question_id', $questions->pluck('id'))->get()->shuffle();

                    return view('game.match', ['questions' => $questions, 'options' => $options]);
                case 4:
                    $user = auth()->user();
                    $country = $user->country_id;
                    $levels = $user->levels;
                    $question = Question::where('gametype', '重組')
                    ->where('country_id', $country)
                    ->where('levels', $levels)->inRandomOrder()->first();
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
            $current_uid = $request -> query('cid');
            $spent_time = $request -> query('timer');
            // $current_uid = auth()->user()->id;
            if($user_ANS == $ANS){ // 答對的時候
                if(!UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->exists()){ // 沒紀錄 
                    UserRecord::create([
                        'user_id' => $current_uid,
                        'watchtime' => $spent_time,
                        'question_id' => $q_id,
                        'status' => 1,
                    ]);
                    
                }
                elseif(UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->value('status')  == 0){ // 原本錯現在對
                    UserRecord::where('question_id',$q_id)->where('user_id', $current_uid)->update(['status'=> 1]);
                }
                else{ // 原本對現在對
                    UserRecord::where('question_id',$q_id)->where('user_id', $current_uid)->update(['updated_at'=> now()]);
                }
                return response()->json(['message' => 'correct']);
            }
            else{  // 錯誤的時候
                if(!UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->exists()){ // 沒紀錄
                    UserRecord::create([
                        'user_id' => $current_uid,
                        'question_id' => $q_id,
                        'watchtime' => $spent_time,
                        'status' => 0,
                    ]);
                }
                elseif(UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->value('status') == 1){ // 原本對現在錯
                    UserRecord::where('question_id',$q_id)->where('user_id', $current_uid)->update(['status'=> 0]);
                 }
                else{ // 原本錯現在錯
                    UserRecord::where('question_id',$q_id)->where('user_id', $current_uid)->update(['updated_at' => now()]);
                 }
                return response()->json(['message' => 'wrongAnswer']);
            }
        }
        else{
            return response()->json(['message' => 'http method must be get']);
        }
    }
}
