<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeCard;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuestionCard;
use App\Models\ReorganizationOption;
use App\Models\User;
use App\Models\UserRecord;
use App\Models\Debug;
use App\Models\DebugRecord;
use App\Services\GameService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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
        $this->gameService->updateUserRecord();
        // 查詢進入當前國家當前等級的遊戲種類有哪些
        $Question_list = Question::select('gametype', 'country_id', 'levels')
            ->where('levels', $levels)
            ->where('country_id', $country_id)
            ->groupBy('gametype', 'country_id', 'levels')
            ->orderBy('id')
            ->get();

        return view('Gameviews', ['Question_list' => $Question_list, 'currentCountry' => $country_id]);
    }

    // 依照遊戲類別 選擇導向遊戲畫面
    // 送至前端的東西：通關所需知識卡，題目資訊，
    public function ChooseGame(Request $request, string $GameType, int $country_id, int $levels)
    {
        //呼叫更新使用者紀錄
        $this->gameService->updateUserRecord();
        $cards = [];
        //
        if ($request->isMethod('get')) {
            switch ($GameType) {
                case '是非':
                    // 如果GameType_id == 是非
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $questionsPlayed = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 玩過且正確的是非題
                    $trueORFalseOK = Question::whereIn('id', $questionsPlayed)
                        ->where('gametype', '是非')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->pluck('id')->toArray();
                    // 當前國家當前等級會有的是非題目id
                    $trueorfalse_count = Question::select('id')->where('gametype', '是非')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過此系統
                    if (UserRecord::where('user_id', $current_uid)->count() > 0) {
                        // 還有錯誤題的時候
                        if (count($trueORFalseOK) < count($trueorfalse_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '是非')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $trueORFalseOK)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
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
                    return view('game.TrueORFalse', ['question' => $question, 'questions_cards' => $cards, 'currentLV' => $levels, 'currentCountry' => $country_id]);

                case '選擇':
                    // 如果GameType_id == 選擇
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $questionsPlayed = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 玩過且正確的選擇題
                    $chooseOK = Question::whereIn('id', $questionsPlayed)
                        ->where('gametype', '選擇')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->pluck('id')->toArray();
                    // 當前國家當前等級會有的選擇題目id
                    $choose_count = Question::select('id')->where('gametype', '選擇')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過
                    if (UserRecord::where('user_id', $current_uid)->count() > 0) {
                        // 還有錯題
                        if (count($chooseOK) < count($choose_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '選擇')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $chooseOK)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
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
                    return view('game.choose', ['question' => $question, 'options' => $options, 'questions_cards' => $cards, 'currentCountry' => $country_id, 'currentLV' => $levels]);
                case '配對':
                    $current_uid = auth()->user()->id;
                    // 查詢當前使用者玩過(一堆q_id)
                    $questionsPlayed = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 玩過且正確的配對題
                    $matchOK = Question::whereIn('id', $questionsPlayed)
                        ->where('gametype', '配對')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->pluck('id')->toArray();
                    // 當前國家當前等級會有的配對題目id
                    $match_count = Question::select('id')->where('gametype', '配對')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 玩過
                    if (UserRecord::where('user_id', $current_uid)->count() > 0) {
                        // 還有錯
                        if (count($match_count) > count($matchOK)) {
                            // 抓還不是正確的配對題目
                            $matchRD = Question::where('gametype', '配對')
                                ->where('country_id', $country_id)
                                ->whereNotIn('id', $matchOK)
                                ->where('levels', $levels)->inRandomOrder()->get();
                            if ($matchRD->count() < 4) {
                                $question_append = Question::whereIn('id', $questionsPlayed)
                                    ->where('gametype', '配對')
                                    ->where('country_id', $country_id)
                                    ->where('levels', $levels)
                                    ->take(4 - count($matchRD))->inRandomOrder()->get();

                                $questions = $matchRD->merge($question_append);
                            } else {
                                $matchRD = Question::whereNotIn('id', $questionsPlayed)
                                    ->where('gametype', '配對')
                                    ->where('country_id', $country_id)
                                    ->whereNotIn('id', $matchOK)
                                    ->where('levels', $levels)
                                    ->inRandomOrder()->take(4)->get();
                                $questions = $matchRD;
                            }
                        } else { // 沒有錯
                            $questions = Question::where('gametype', '配對')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)->inRandomOrder()->take(4)->get();
                        }
                    } else { // 沒玩過
                        $questions = Question::where('gametype', '配對')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)->inRandomOrder()->take(4)->get();
                    }
                    // Log::info('questions' . $questions);
                    if(!empty($questions)){
                        $qid = $questions->pluck('id')->toArray();
                        $Q_cards = QuestionCard::whereIn('question_id', $qid)->pluck('knowledge_card_id')->toArray();
                        $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        // Log::info($cards);
                    }
                    return view('game.match', ['questions' => $questions, 'questions_cards' => $cards]);
                case '填空':
                    // 如果GameType_id == 填空
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $questionsPlayed = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 當前國家當前等級會有的題目id
                    $reog_count = Question::select('id')->where('gametype', '填空')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 玩過且正確的填空題
                    $reogOK = Question::whereIn('id', $questionsPlayed)
                        ->where('gametype', '填空')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->pluck('id')->toArray();
                    // 有玩過
                    if (UserRecord::where('user_id', $current_uid)->count() > 0) {
                        // 還有錯題
                        if (count($reogOK) < count($reog_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::select('id', 'questions', 'describe', 'levels')
                                ->where('gametype', '填空')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $reogOK)
                                ->inRandomOrder()
                                ->first();


                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
                        }
                        // 沒有錯題
                        else {
                            // 如果玩過忽略排查紀錄，直接隨機出題
                            $question = Question::select('id', 'questions', 'describe', 'levels')
                                ->where('gametype', '填空')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->inRandomOrder()
                                ->first();

                            Log::info('question' . $question);

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
                        $question = Question::select('id', 'questions', 'describe', 'levels')
                            ->where('gametype', '填空')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)
                            ->inRandomOrder()
                            ->first();


                        // 抓出這題會用到的知識卡id，存到一個陣列裡面
                        $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                        // 判斷$Q_cards是不是空的
                        if (count($Q_cards) > 0) {
                            // 照那個array裡面的所有卡片內容
                            $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        }
                    }
                    $options = Option::select('options')->where('question_id', $question['id'])
                        ->inRandomOrder()->get()
                        ->map(function ($item) {
                            return [
                                'option' => $item->options
                            ];
                        })->toArray();

                    $question_data = [
                        'country_id' => $country_id,
                        'levels' => $question['levels'],
                        'id' => $question['id'],
                        'question' => $question['questions'],
                        'hint' => $question['describe'],
                        'options' => $options
                    ];

                    return view('game.reorganization', ['question_data' => $question_data, 'questions_cards' => $cards, 'currentCountry' => $country_id]);
                case 5:
                    //
                    break;
                    //
                default:
                    //
                    return response('沒有這個遊戲類型');
            }
        }
    }

    // 
    // 依照遊戲類別 選擇導向遊戲畫面
    // 送至前端的東西：通關所需知識卡，題目資訊
    public function randomChooseGame(Request $request, int $country_id, int $levels)
    {
        //呼叫更新使用者紀錄
        $this->gameService->updateUserRecord();
        $cards = [];
        //
        if ($request->isMethod('get')) {
            // 串表去找使用者玩過的類型
            // 先串表、找答對的問題，再去questions表找符合等級的資料，最後只抓取遊戲種類
            $current_uid = auth()->user()->id;
            $PlayedGameType = UserRecord::join('questions', 'questions.id', '=', 'user_records.question_id')
            ->select('questions.gametype as gametype')
            ->where('questions.country_id', $country_id)
            ->where('questions.levels', $levels)
            ->where('user_records.user_id', $current_uid)
            ->distinct()->get()->toArray();
            $PlayedGameType = array_column($PlayedGameType, 'gametype');
            Log::info($PlayedGameType);
            // 儲存當前所有的遊戲種類
            $typelist = ['是非', '選擇', '配對', '填空'];
            // 用來記錄沒玩過的遊戲種類
            $UnPlayedGameType = [];

            foreach ($typelist as $gametype) {
                //去找所有沒玩過的遊戲類型，當這遊戲類型沒玩過就抓到$UnPlayedGameType裡
                if (!in_array($gametype, $PlayedGameType)) {
                    $UnPlayedGameType[] = $gametype;
                }
            }

            if (!empty($UnPlayedGameType)) {
                //如果$UnPlayedGameType不為空，就從其中隨機抽一個類型
                // https://www.runoob.com/php/func-array-rand.html 根據這個寫的
                $random = array_rand($UnPlayedGameType);
                $GameType = $UnPlayedGameType[$random];
            } else {
                //如果$UnPlayedGameType為空，就從$type其中隨機抽一個類型
                $random = array_rand($typelist);
                $GameType = $typelist[$random];
            }

            switch ($GameType) {
                case '是非':
                    // 如果GameType_id == 是非
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $questionsPlayed = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 玩過且正確的是非題
                    $trueORFalseOK = Question::whereIn('id', $questionsPlayed)
                        ->where('gametype', '是非')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->pluck('id')->toArray();
                    // 當前國家當前等級會有的是非題目id
                    $trueorfalse_count = Question::select('id')->where('gametype', '是非')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過此系統
                    if (UserRecord::where('user_id', $current_uid)->count() > 0) {
                        // 還有錯誤題的時候
                        if (count($trueORFalseOK) < count($trueorfalse_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '是非')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $trueORFalseOK)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
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
                    return view('game.TrueORFalse', ['question' => $question, 'questions_cards' => $cards, 'currentLV' => $levels, 'currentCountry' => $country_id]);

                case '選擇':
                    // 如果GameType_id == 選擇
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $questionsPlayed = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 玩過且正確的選擇題
                    $chooseOK = Question::whereIn('id', $questionsPlayed)
                        ->where('gametype', '選擇')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->pluck('id')->toArray();
                    // 當前國家當前等級會有的選擇題目id
                    $choose_count = Question::select('id')->where('gametype', '選擇')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 有玩過
                    if (UserRecord::where('user_id', $current_uid)->count() > 0) {
                        // 還有錯題
                        if (count($chooseOK) < count($choose_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::where('gametype', '選擇')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $chooseOK)->inRandomOrder()->first();

                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
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
                    return view('game.choose', ['question' => $question, 'options' => $options, 'questions_cards' => $cards, 'currentCountry' => $country_id, 'currentLV' => $levels]);
                case '配對':
                    $current_uid = auth()->user()->id;
                    // 查詢當前使用者玩過(一堆q_id)
                    $questionsPlayed = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 玩過且正確的配對題
                    $matchOK = Question::whereIn('id', $questionsPlayed)
                        ->where('gametype', '配對')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->pluck('id')->toArray();
                    // 當前國家當前等級會有的配對題目id
                    $match_count = Question::select('id')->where('gametype', '配對')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 玩過
                    if (UserRecord::where('user_id', $current_uid)->count() > 0) {
                        // 還有錯
                        if (count($match_count) > count($matchOK)) {
                            // 抓還不是正確的配對題目
                            $matchRD = Question::where('gametype', '配對')
                                ->where('country_id', $country_id)
                                ->whereNotIn('id', $matchOK)
                                ->where('levels', $levels)->inRandomOrder()->get();
                            if ($matchRD->count() < 4) {
                                $question_append = Question::whereIn('id', $questionsPlayed)
                                    ->where('gametype', '配對')
                                    ->where('country_id', $country_id)
                                    ->where('levels', $levels)
                                    ->take(4 - count($matchRD))->inRandomOrder()->get();

                                $questions = $matchRD->merge($question_append);
                            } else {
                                $matchRD = Question::whereNotIn('id', $questionsPlayed)
                                    ->where('gametype', '配對')
                                    ->where('country_id', $country_id)
                                    ->whereNotIn('id', $matchOK)
                                    ->where('levels', $levels)
                                    ->inRandomOrder()->take(4)->get();
                                $questions = $matchRD;
                            }
                        } else { // 沒有錯
                            $questions = Question::where('gametype', '配對')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)->inRandomOrder()->take(4)->get();
                        }
                    } else { // 沒玩過
                        $questions = Question::where('gametype', '配對')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)->inRandomOrder()->take(4)->get();
                    }
                    // Log::info('questions' . $questions);
                    if(!empty($questions)){
                        $qid = $questions->pluck('id')->toArray();
                        $Q_cards = QuestionCard::whereIn('question_id', $qid)->pluck('knowledge_card_id')->toArray();
                        $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        // Log::info($cards);
                    }
                    return view('game.match', ['questions' => $questions, 'questions_cards' => $cards]);
                case '填空':
                    // 如果GameType_id == 填空
                    // 呼叫檢查使用者遊玩進度
                    $current_uid = auth()->user()->id;
                    // 玩家在當前國家當前等級玩過且正確的題目id
                    $questionsPlayed = UserRecord::select('question_id')
                        ->where('user_id', $current_uid)
                        ->where('status', 1)->pluck('question_id')->toArray();
                    // 當前國家當前等級會有的題目id
                    $reog_count = Question::select('id')->where('gametype', '填空')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->get();
                    // 玩過且正確的填空題
                    $reogOK = Question::whereIn('id', $questionsPlayed)
                        ->where('gametype', '填空')
                        ->where('country_id', $country_id)
                        ->where('levels', $levels)->pluck('id')->toArray();
                    // 有玩過
                    if (UserRecord::where('user_id', $current_uid)->count() > 0) {
                        // 還有錯題
                        if (count($reogOK) < count($reog_count)) {
                            // 呼叫亂數出題
                            // 出當前使用者在當前國家當前等級未正確的題目
                            $question = Question::select('id', 'questions', 'describe', 'levels')
                                ->where('gametype', '填空')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->whereNotIn('id', $reogOK)
                                ->inRandomOrder()
                                ->first();


                            $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();
                            if (count($Q_cards) > 0) {
                                // 照那個array裡面的所有卡片內容
                                $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                            }
                        }
                        // 沒有錯題
                        else {
                            // 如果玩過忽略排查紀錄，直接隨機出題
                            $question = Question::select('id', 'questions', 'describe', 'levels')
                                ->where('gametype', '填空')
                                ->where('country_id', $country_id)
                                ->where('levels', $levels)
                                ->inRandomOrder()
                                ->first();

                            Log::info('question' . $question);

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
                        $question = Question::select('id', 'questions', 'describe', 'levels')
                            ->where('gametype', '填空')
                            ->where('country_id', $country_id)
                            ->where('levels', $levels)
                            ->inRandomOrder()
                            ->first();


                        // 抓出這題會用到的知識卡id，存到一個陣列裡面
                        $Q_cards = QuestionCard::where('question_id', $question->id)->pluck('knowledge_card_id')->toArray();

                        // 判斷$Q_cards是不是空的
                        if (count($Q_cards) > 0) {
                            // 照那個array裡面的所有卡片內容
                            $cards = KnowledgeCard::whereIn('id', $Q_cards)->get();
                        }
                    }
                    $options = Option::select('options')->where('question_id', $question['id'])
                        ->inRandomOrder()->get()
                        ->map(function ($item) {
                            return [
                                'option' => $item->options
                            ];
                        })->toArray();

                    $question_data = [
                        'country_id' => $country_id,
                        'levels' => $question['levels'],
                        'id' => $question['id'],
                        'question' => $question['questions'],
                        'hint' => $question['describe'],
                        'options' => $options
                    ];

                    return view('game.reorganization', ['question_data' => $question_data, 'questions_cards' => $cards, 'currentCountry' => $country_id]);
                case 5:
                    //
                    break;
                    //
                default:
                    //
                    return response('沒有這個遊戲類型');
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
                UserRecord::create([
                    'user_id' => $current_uid,
                    'question_id' => $q_id,
                    'watchtime' => $spent_time,
                    'status' => $status,
                ]);
            } else {
                UserRecord::where('question_id', $q_id)->where('user_id', $current_uid)->update(['status' => $status, 'watchtime' => $spent_time]);
            }
            return response()->json(['message' => '用戶記錄創建成功。'], 200);
        } else {
            return response()->json(['message' => 'HTTP 方法必須是 GET。'], 405);
        }
    }
    public function HistoryAnswerRecord(Request $request, int $levels)
    {
        $current_uid = auth()->user()->id;
        //抓當前使用者的答題記錄
        $UserRecords = UserRecord::with('question')
            ->where('user_id', $current_uid)
            ->whereHas('question', function ($query) use ($levels) {
                $query->where('levels', $levels);
            })
            ->get();
    }

    public function Debug(Request $request, int $country_id)
    {
        if ($request->isMethod('get')) {
            $current_uid = auth()->user()->id;
            // 玩家在當前國家玩過且正確的debug_id
            $current_count = DebugRecord::select('debug_id')
                ->where('user_id', $current_uid)
                ->where('status', 1)
                ->pluck('debug_id')->toArray();
            // 當前國家的debug_id
            $debug_count = Debug::select('id')->where('country_id', $country_id)->get();
            // 玩過
            if (DebugRecord::where('user_id', $current_uid)->count() > 0) {
                //還有沒玩過的
                if (count($debug_count) > count($current_count)) {
                    $question = Debug::where('country_id', $country_id)
                        ->whereNotIn('id', $current_count)
                        ->inRandomOrder()->get()
                        ->map(function ($item) {
                            return [
                                'debug_id' => $item->id,
                                'code' => $item->code,
                                'description' => $item->description
                            ];
                        })->first();
                } else {
                    $question = Debug::where('country_id', $country_id)
                        ->inRandomOrder()->get()
                        ->map(function ($item) {
                            return [
                                'debug_id' => $item->id,
                                'code' => $item->code,
                                'description' => $item->description
                            ];
                        })->first();
                }
            }
            //沒玩過
            else {
                $question = Debug::where('country_id', $country_id)
                    ->inRandomOrder()->get()
                    ->map(function ($item) {
                        return [
                            'debug_id' => $item->id,
                            'code' => $item->code,
                            'description' => $item->description
                        ];
                    })->first();
            }
            return view('game.debug', ['question' => $question, 'currentCountry' => $country_id]);
        }
    }

    // debug對答案(未處理重複記錄問題)
    public function correctDebug(Request $request)
    {
        if ($request->isMethod('get')) {
            // 當前使用者id
            $currentUid = $request->query('cid');
            // 使用者填寫的答案(code)
            $userAns = $request->query('user_answer');
            // 這個debug題的id
            $debug_id = $request->query('debug_id');
            // 使用者回答的錯誤行數
            $wrongLine = $request->query('wrongLine');
            // 使用者的作答時間
            $watchtime = $request->query('watchtime');
            // 正確答案的查詢
            $ansLine = Debug::where('id', $debug_id)->pluck('wrong_line')->first();
            $ansAnswer = Debug::where('id', $debug_id)->pluck('answer')->first();
            Log::info('User Answer: ' . $userAns);
            Log::info('Correct Answer: ' . $ansAnswer);
            Log::info('User Wrong Line: ' . $wrongLine);
            Log::info('Correct Wrong Line: ' . $ansLine);
            // 檢查正確行數
            if ($wrongLine == $ansLine) {
                // 再檢查填寫的答案
                // 答對
                if ($userAns == $ansAnswer) {
                    // 沒玩過這題
                    if (!DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->exists()) {
                        $createUserRecord = new DebugRecord();
                        $createUserRecord->create([
                            'user_id' => $currentUid,
                            'debug_id' => $debug_id,
                            'watchtime' => $watchtime,
                            'status' => 1,
                        ]);
                    }
                    // 原本錯現在對
                    elseif (DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->value('status') == 0) {
                        DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->update(['status' => 1]);
                    }
                    // 原本對現在對
                    else {
                        DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->update(['updated_at' => now()]);
                    }
                    return response()->json(['message' => 'correct']);
                    // 答錯
                } else {
                    // 沒玩過這題
                    if (!DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->exists()) {
                        $createUserRecord = new DebugRecord();
                        $createUserRecord->create([
                            'user_id' => $currentUid,
                            'debug_id' => $debug_id,
                            'status' => 0,
                        ]);
                    }
                    // 原本對現在錯
                    elseif (DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->value('status') == 1) {
                        DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->update(['status' => 0]);
                    }
                    // 原本錯現在錯
                    else {
                        DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->update(['updated_at' => now()]);
                    }
                    return response()->json(['message' => 'wrongAns']);
                }
                // 行數答錯
            } else {
                // 沒玩過，錯行數的時候
                if (!DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->exists()) {
                    $createUserRecord = new DebugRecord();
                    $createUserRecord->create([
                        'user_id' => $currentUid,
                        'debug_id' => $debug_id,
                        'status' => 0,
                    ]);
                }
                // 原本答對，但現在錯行數
                elseif (DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->value('status') == 1) {
                    DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->update(['status' => 0]);
                }
                // 原本答錯，現在錯行數
                else {
                    DebugRecord::where('debug_id', $debug_id)->where('user_id', $currentUid)->update(['updated_at' => now()]);
                }
                return response()->json(['message' => 'wrongline']);
            }
        } else {
            return response()->json(['message' => 'http method must be get!']);
        }
    }
}
