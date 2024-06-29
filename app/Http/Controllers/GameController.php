<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeCard;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionCard;
use App\Models\ReorganizationOption;
use App\Models\User;
use App\Models\UserRecord;
use App\Services\GameService;
use Illuminate\Http\Request;

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
        //呼叫更新使用者紀錄
        $this->gameService->updateUserRecord($country_id, $levels);
        // 查詢進入當前國家當前等級的遊戲種類有哪些
        $Question_list = Question::select('gametype', 'country_id', 'levels')
            ->where('levels', $levels)
            ->where('country_id', $country_id)
            ->groupBy('gametype', 'country_id', 'levels')
            ->get();

        return view('Gameviews', ['Question_list' => $Question_list]);
    }

    // 依照遊戲類別 選擇導向遊戲畫面
    // 送至前端的東西：通關所需知識卡，題目資訊，
    public function ChooseGame(Request $request, string $GameType, int $country_id, int $levels)
    {
        //
        if ($request->isMethod('get')) {
            switch ($GameType) {
                case '是非':
                    // 如果GameType_id == 是非
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $current_count = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 當前國家當前等級會有的題目id
                    $trueorfalse_count = Question::select('id')->where('gametype', '是非')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過
                    if (count($current_count) > 0) {
                        // 還有錯誤題的時候
                        if (count($current_count) < count($trueorfalse_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '是非')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $current_count)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                        } else { // 沒有錯誤題的時候
                            // 如果玩過忽略排查紀錄，直接隨機出題
                            $question = Question::where('gametype', '是非')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->inRandomOrder()->first();

                            // 抓出這題會用到的知識卡id，存到一個陣列裡面
                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                            // 判斷$Q_cards是不是空的
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
                        }
                    } else { // 沒玩過
                        // 如果玩過忽略排查紀錄，直接隨機出題
                        $question = Question::where('gametype', '是非')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)
                            ->inRandomOrder()->first();

                        // 抓出這題會用到的知識卡id，存到一個陣列裡面
                        $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                        // 判斷$Q_cards是不是空的
                        if (count($Q_cards) > 0) {
                            // 照那個array裡面的所有卡片內容
                            $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        }
                    }
                    // 還要帶該遊戲第二層知識卡，方便跳窗後點擊查詢卡片內容
                    return view('game.TrueORFalse', ['question' => $question, 'questions_cards' => $cards]);

                case '選擇':
                    // 如果GameType_id == 選擇
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $current_count = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 當前國家當前等級會有的題目id
                    $trueorfalse_count = Question::select('id')->where('gametype', '選擇')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過
                    if (count($current_count) > 0) {
                        // 還有錯題
                        if (count($current_count) < count($trueorfalse_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '選擇')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $current_count)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                        }
                        // 沒有錯題
                        else {
                            // 如果玩過忽略排查紀錄，直接隨機出題
                            $question = Question::where('gametype', '選擇')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->inRandomOrder()->first();

                            // 抓出這題會用到的知識卡id，存到一個陣列裡面
                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                            // 判斷$Q_cards是不是空的
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
                        }
                    } else { // 沒玩過
                        // 沒玩過就不管了反正只會跑一次，全部亂數
                        $question = Question::where('gametype', '選擇')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)
                            ->inRandomOrder()->first();

                        // 抓出這題會用到的知識卡id，存到一個陣列裡面
                        $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                        // 判斷$Q_cards是不是空的
                        if (count($Q_cards) > 0) {
                            // 照那個array裡面的所有卡片內容
                            $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        }
                    }
                    $options = Option::where('question_id', $question->id)->inRandomOrder()->get();
                    return view('game.choose', ['question' => $question, 'options' => $options, 'questions_cards' => $cards]);
                case '配對':
                    //
                    $current_uid = auth()->user()->id;
                    //串表查詢當前使用者玩過哪些配對題目的總數
                    $played_count = UserRecord::with('question')->whereHas('question', function ($query) use ($levels) {
                        $query->where('gametype', '配對')->where('levels', $levels);
                    })->count();
                    //當前題庫中的該等級配對題目總數
                    $match_question_count = Question::where('gametype', '配對')->where('levels', $levels)->count();
                    //計算需要從玩過的題目補的數量
                    $difference = 6 - ($match_question_count - $played_count);
                    //如果都玩過，就隨機出題
                    if ($played_count == $match_question_count) {
                        //隨機抓取六道題目
                        $questions = Question::where('gametype', '配對')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)->inRandomOrder()->take(6)->get();
                    } else {
                        //去抓玩過哪些題目
                        $played_questions = UserRecord::with('question')->whereHas('question', function ($query) use ($levels) {
                            $query->where('gametype', '配對')->where('levels', $levels);
                        })->pluck('question_id')->toArray();
                        //沒玩過的題目
                        $not_played_questions = Question::whereNotIn('id', $played_questions)->where('gametype', '配對')->where('levels', $levels)->get();
                        //額外補充的題目，先排除上面沒玩過的題目
                        $fill_questions = Question::whereNotIn('id', $not_played_questions->pluck('id')->toArray())
                            ->where('gametype', '配對')
                            ->where('levels', $levels)
                            ->take($difference)
                            ->get();
                        //當需要補的數量>0就跟沒玩過的題目合併，沒的話就沒玩過的題目直接隨機排列
                        if ($difference > 0) {
                            $questions = $not_played_questions->merge($fill_questions)->shuffle();
                        } else {
                            $questions = $not_played_questions->shuffle();
                        }
                    }
                    return view('game.match', ['questions' => $questions]);
                case '填空':
                    // 如果GameType_id == 填空
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $current_count = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 當前國家當前等級會有的題目id
                    $trueorfalse_count = Question::select('id')->where('gametype', '填空')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過
                    if (count($current_count) > 0) {
                        // 還有錯題
                        if (count($current_count) < count($trueorfalse_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '填空')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $current_count)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                        }
                        // 沒有錯題
                        else {
                            // 如果玩過忽略排查紀錄，直接隨機出題
                            $question = Question::where('gametype', '填空')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->inRandomOrder()->first();

                            // 抓出這題會用到的知識卡id，存到一個陣列裡面
                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                            // 判斷$Q_cards是不是空的
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
                        }
                    } else { // 沒玩過
                        // 沒玩過就不管了反正只會跑一次，全部亂數
                        $question = Question::where('gametype', '填空')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)
                            ->inRandomOrder()->first();

                        // 抓出這題會用到的知識卡id，存到一個陣列裡面
                        $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                        // 判斷$Q_cards是不是空的
                        if (count($Q_cards) > 0) {
                            // 照那個array裡面的所有卡片內容
                            $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        }
                    }
                    $options = Option::where('question_id', $question->id)->inRandomOrder()->get();
                    return view('game.reorganization', ['question' => $question, 'options' => $options, 'questions_cards' => $cards]);
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

    // 
    // 依照遊戲類別 選擇導向遊戲畫面
    // 送至前端的東西：通關所需知識卡，題目資訊，
    public function randomChooseGame(Request $request, int $country_id, int $levels)
    {
        //
        if ($request->isMethod('get')) {
            $GameType='';
            switch ($GameType) {
                case '是非':
                    // 如果GameType_id == 是非
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $current_count = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 當前國家當前等級會有的題目id
                    $trueorfalse_count = Question::select('id')->where('gametype', '是非')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過
                    if (count($current_count) > 0) {
                        // 還有錯誤題的時候
                        if (count($current_count) < count($trueorfalse_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '是非')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $current_count)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                        } else { // 沒有錯誤題的時候
                            // 如果玩過忽略排查紀錄，直接隨機出題
                            $question = Question::where('gametype', '是非')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->inRandomOrder()->first();

                            // 抓出這題會用到的知識卡id，存到一個陣列裡面
                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                            // 判斷$Q_cards是不是空的
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
                        }
                    } else { // 沒玩過
                        // 如果玩過忽略排查紀錄，直接隨機出題
                        $question = Question::where('gametype', '是非')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)
                            ->inRandomOrder()->first();

                        // 抓出這題會用到的知識卡id，存到一個陣列裡面
                        $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                        // 判斷$Q_cards是不是空的
                        if (count($Q_cards) > 0) {
                            // 照那個array裡面的所有卡片內容
                            $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        }
                    }
                    // 還要帶該遊戲第二層知識卡，方便跳窗後點擊查詢卡片內容
                    return view('game.TrueORFalse', ['question' => $question, 'questions_cards' => $cards]);

                case '選擇':
                    // 如果GameType_id == 選擇
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $current_count = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 當前國家當前等級會有的題目id
                    $trueorfalse_count = Question::select('id')->where('gametype', '選擇')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過
                    if (count($current_count) > 0) {
                        // 還有錯題
                        if (count($current_count) < count($trueorfalse_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '選擇')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $current_count)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                        }
                        // 沒有錯題
                        else {
                            // 如果玩過忽略排查紀錄，直接隨機出題
                            $question = Question::where('gametype', '選擇')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->inRandomOrder()->first();

                            // 抓出這題會用到的知識卡id，存到一個陣列裡面
                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                            // 判斷$Q_cards是不是空的
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
                        }
                    } else { // 沒玩過
                        // 沒玩過就不管了反正只會跑一次，全部亂數
                        $question = Question::where('gametype', '選擇')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)
                            ->inRandomOrder()->first();

                        // 抓出這題會用到的知識卡id，存到一個陣列裡面
                        $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                        // 判斷$Q_cards是不是空的
                        if (count($Q_cards) > 0) {
                            // 照那個array裡面的所有卡片內容
                            $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        }
                    }
                    $options = Option::where('question_id', $question->id)->inRandomOrder()->get();
                    return view('game.choose', ['question' => $question, 'options' => $options, 'questions_cards' => $cards]);
                case '配對':
                    //
                    $current_uid = auth()->user()->id;
                    //串表查詢當前使用者玩過哪些配對題目的總數
                    $played_count = UserRecord::with('question')->whereHas('question', function ($query) use ($levels) {
                        $query->where('gametype', '配對')->where('levels', $levels);
                    })->count();
                    //當前題庫中的該等級配對題目總數
                    $match_question_count = Question::where('gametype', '配對')->where('levels', $levels)->count();
                    //計算需要從玩過的題目補的數量
                    $difference = 6 - ($match_question_count - $played_count);
                    //如果都玩過，就隨機出題
                    if ($played_count == $match_question_count) {
                        //隨機抓取六道題目
                        $questions = Question::where('gametype', '配對')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)->inRandomOrder()->take(6)->get();
                    } else {
                        //去抓玩過哪些題目
                        $played_questions = UserRecord::with('question')->whereHas('question', function ($query) use ($levels) {
                            $query->where('gametype', '配對')->where('levels', $levels);
                        })->pluck('question_id')->toArray();
                        //沒玩過的題目
                        $not_played_questions = Question::whereNotIn('id', $played_questions)->where('gametype', '配對')->where('levels', $levels)->get();
                        //額外補充的題目，先排除上面沒玩過的題目
                        $fill_questions = Question::whereNotIn('id', $not_played_questions->pluck('id')->toArray())
                            ->where('gametype', '配對')
                            ->where('levels', $levels)
                            ->take($difference)
                            ->get();
                        //當需要補的數量>0就跟沒玩過的題目合併，沒的話就沒玩過的題目直接隨機排列
                        if ($difference > 0) {
                            $questions = $not_played_questions->merge($fill_questions)->shuffle();
                        } else {
                            $questions = $not_played_questions->shuffle();
                        }
                    }
                    return view('game.match', ['questions' => $questions]);
                case '填空':
                    // 如果GameType_id == 填空
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $current_count = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 當前國家當前等級會有的題目id
                    $trueorfalse_count = Question::select('id')->where('gametype', '填空')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過
                    if (count($current_count) > 0) {
                        // 還有錯題
                        if (count($current_count) < count($trueorfalse_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '填空')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $current_count)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                        }
                        // 沒有錯題
                        else {
                            // 如果玩過忽略排查紀錄，直接隨機出題
                            $question = Question::where('gametype', '填空')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->inRandomOrder()->first();

                            // 抓出這題會用到的知識卡id，存到一個陣列裡面
                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                            // 判斷$Q_cards是不是空的
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
                        }
                    } else { // 沒玩過
                        // 沒玩過就不管了反正只會跑一次，全部亂數
                        $question = Question::where('gametype', '填空')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)
                            ->inRandomOrder()->first();

                        // 抓出這題會用到的知識卡id，存到一個陣列裡面
                        $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                        // 判斷$Q_cards是不是空的
                        if (count($Q_cards) > 0) {
                            // 照那個array裡面的所有卡片內容
                            $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        }
                    }
                    $options = Option::where('question_id', $question->id)->inRandomOrder()->get();
                    return view('game.reorganization', ['question' => $question, 'options' => $options, 'questions_cards' => $cards]);
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

        if ($request->isMethod('GET')) {
            $user_ANS = $request->query('user_answer');
            $q_id = $request->query('question_id');
            $ANS = Question::where('id', $q_id)->pluck('answer')->first();
            $current_uid = $request->query('cid');
            $spent_time = $request->query('timer');
            if ($user_ANS == $ANS) { // 答對的時候
                if (!UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->exists()) { // 沒紀錄
                    UserRecord::create([
                        'user_id' => $current_uid,
                        'watchtime' => $spent_time,
                        'question_id' => $q_id,
                        'status' => 1,
                    ]);
                } elseif (UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->value('status') == 0) { // 原本錯現在對
                    UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->update(['status' => 1]);
                } else { // 原本對現在對
                    UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->update(['updated_at' => now()]);
                }
                return response()->json(['message' => 'correct']);
            } else { // 錯誤的時候
                if (!UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->exists()) { // 沒紀錄
                    UserRecord::create([
                        'user_id' => $current_uid,
                        'question_id' => $q_id,
                        'watchtime' => $spent_time,
                        'status' => 0,
                    ]);
                } elseif (UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->value('status') == 1) { // 原本對現在錯
                    UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->update(['status' => 0]);
                } else { // 原本錯現在錯
                    UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->update(['updated_at' => now()]);
                }
                return response()->json(['message' => 'wrongAnswer']);
            }
        } else {
            return response()->json(['message' => 'http method must be get']);
        }
    }
    //配對使用者紀錄
    public function matchuserecord(Request $request)
    {
        if ($request->isMethod('GET')) {
            $q_id = $request->query('question_id');
            $current_uid = $request->query('cid');
            $spent_time = $request->query('timer');
            $status = $request->query('status');

            if (!UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->exists()) {
                $record = UserRecord::create([
                    'user_id' => $current_uid,
                    'question_id' => $q_id,
                    'watchtime' => $spent_time,
                    'status' => $status,
                ]);
            } else {
                UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->update(['status' => $status, 'watchtime' => $spent_time]);
            }

            if (!$record) {
                throw new \Exception('創建用戶記錄失敗。');
            }
            return response()->json(['message' => '用戶記錄創建成功。'], 200);
        } else {
            return response()->json(['message' => 'HTTP 方法必須是 GET。'], 405);
        }

    }
}
