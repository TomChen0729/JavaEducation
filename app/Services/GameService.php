<?php

namespace App\Services;

use App\Models\CardType;
use App\Models\Country;
use App\Models\Debug;
use App\Models\DebugRecord;
use App\Models\KnowledgeCard;
use App\Models\Question;
use App\Models\User;
use App\Models\UserKnowledgeCard;

class GameService
{
    public function getUserRecord()
    {
        $User_record = auth()->user();
        return $User_record;
    }
    public function initUserRecord()
    {
        //檢查玩家進度，如果國家id等於0和等級id等於0，就都給1進去。
        $Current_User_Country = auth()->user()->country_id;
        $Current_User_Country_Level = auth()->user()->levels;
        $Current_User_id = auth()->user()->id;
        if ($Current_User_Country == null && $Current_User_Country_Level == null) {
            $user = User::find($Current_User_id);
            $user->update([
                'country_id' => 1,
                'levels' => 1,
            ]);
        }
    }

    // 升級功能
    public function updateUserRecord()
    {
        $current_user = auth()->user();
        $currentUserCountry = $current_user->country_id;
        switch ($currentUserCountry) {
            case 1:
                // 查詢玩家當前最高國家最高等級應該有的不重複玩法形成集合(if -> country_id=1 & levels=1，找1, 1中會出現的)
                $gametype_set = Question::select('gametype')
                    ->where('country_id', $current_user->country_id)
                    ->where('levels', $current_user->levels)->distinct()->get();
                // 調取目前玩家有的最高國家最高等級玩過且正確不重複玩法集合(if -> country_id=1 & levels=1，找1, 1中玩過且正確的)
                // questions->users_records->distinct gametype欄位
                $user_gametype_set = Question::join('user_records', 'user_records.question_id', '=', 'questions.id')
                    ->where('country_id', $current_user->country_id)
                    ->where('levels', $current_user->levels)
                    ->where('user_id', $current_user->id)
                    ->where('status', 1)
                    ->distinct()->pluck('questions.gametype');

                $countryMaxLV = CardType::where('country_id', $current_user->country_id)->max('levels');
                // 查看他自己的遊玩進度是不是最大的
                // 如果不是的話，才進行等級晉升動作
                if (!User::where('id', $current_user->id)->where('country_id', $current_user->country_id)->where('levels', $countryMaxLV)->exists()) {
                    // 不是最大的話，檢查他遊玩進度的最大等級的所有學習區類型是否玩過且有正確紀錄
                    // 如果兩者長度相等的話，等級加一
                    if (count($gametype_set) == count($user_gametype_set)) {
                        if (!User::where('id', $current_user->id)->where('country_id', $current_user->country_id)->where('levels', $current_user->levels + 1)->exists()) {
                            // 抓當前國家id & levels，找出他的cardtype有哪些(之後可能會有一個levels對很多個type的問題，到時候有需要的話改迴圈)
                            $all_cardtypes_in_current_lv = CardType::where('country_id', $current_user->country_id)->where('levels', $current_user->levels)->pluck('id');
                            // 利用找到的card_type_id，去資料庫拉相關的所有知識卡
                            $all_cards_in_current_lv = KnowledgeCard::whereIn('card_type_id', $all_cardtypes_in_current_lv)->get();
                            // 新增一個當前使用者的UserKnowledgeCard物件
                            $current_user_card = new UserKnowledgeCard();
                            if ((count($all_cards_in_current_lv) != 0)) {
                                foreach ($all_cards_in_current_lv as $item) {
                                    $current_user_card->create([
                                        'user_id' => $current_user->id,
                                        'knowledge_card_id' => $item->id,
                                        'watchtime' => '00:00:00'
                                    ]);
                                }
                            }
                            $current_user_levels = auth()->user()->levels;
                            $current_user_levels++;
                            $current_user = User::find($current_user->id);
                            $current_user->update([
                                'levels' => $current_user_levels
                            ]);
                        }
                    }
                } else {
                    // 這邊是他已經在他最高的國家中已經是最高等級
                    // 再去檢查他該國家dubug類型是否有正確了一題
                    // 抓玩過且正確的所有debug_id
                    $debugID = DebugRecord::where('user_id', auth()->user()->id)->where('status', 1)->pluck('debug_id')->toArray();
                    // 帶$debugID查詢debugs表題目，計算筆數是否>=1
                    if (Debug::whereIn('id', $debugID)->where('country_id', $current_user->country_id)->get()->count() >= 1) {
                        // 升級國家
                        // 等級回到一
                        $current_user_country = auth()->user()->country_id;
                        $current_user_country++;
                        $current_user = User::find($current_user->id);
                        $current_user->update([
                            'country_id' => $current_user_country,
                            'levels' => 1
                        ]);
                    } else {
                        // 找出最高等級的所有 gametype
                        $gametype_set_MAX = Question::select('gametype')
                            ->where('country_id', $current_user->country_id)
                            ->where('levels', $countryMaxLV)
                            ->distinct()
                            ->get();
                        // 找出玩家已經完成且正確的 gametype 集合
                        $user_gametype_set_MAX = Question::join('user_records', 'user_records.question_id', '=', 'questions.id')
                            ->where('questions.country_id', $current_user->country_id)
                            ->where('questions.levels', $countryMaxLV)
                            ->where('user_records.user_id', $current_user->id)
                            ->where('user_records.status', 1)
                            ->distinct()
                            ->pluck('questions.gametype');
                        // 比較兩個集合大小
                        if (count($gametype_set_MAX) == count($user_gametype_set_MAX)) {
                            // 找出最高等級的所有cardtype
                            $all_cardtypes_in_max_lv = CardType::where('country_id', $current_user->country_id)
                                ->where('levels', $countryMaxLV)
                                ->pluck('id')
                                ->toArray();
                            // 利用找到的card_type_id，去資料庫拉相關的所有知識卡
                            $all_cards_in_max_lv = KnowledgeCard::whereIn('card_type_id', $all_cardtypes_in_max_lv)->get();
                            // 找到玩家已經擁有的知識卡
                            $owned_knowledge_card_id = UserKnowledgeCard::where('user_id', $current_user->id)
                                ->pluck('knowledge_card_id')
                                ->toArray();
                            // 過濾掉玩家已經擁有的知識卡，避免重複派發
                            $new_cards = $all_cards_in_max_lv->filter(function ($card) use ($owned_knowledge_card_id) {
                                // 回傳多出來的
                                return !in_array($card->id, $owned_knowledge_card_id);
                            });
                            // 產生需要插入的資料，以及其格式
                            if ($new_cards->isNotEmpty()) {
                                $new_card_data = $new_cards->map(function ($card) use ($current_user) {
                                    return [
                                        'user_id' => $current_user->id,
                                        'knowledge_card_id' => $card->id,
                                        'watchtime' => '00:00:00',
                                    ];
                                })->toArray();
                                // 執行插入
                                UserKnowledgeCard::insert($new_card_data);
                            }
                        }
                    }
                }
                break;
            case 2:
                // 檢查他在南國有沒有持有卡片，沒有的話讓他等級歸零
                $allCardsInCurrentLv = KnowledgeCard::where('country_id', $currentUserCountry)->pluck('id')->toArray();
                $owned_knowledge_card_id = UserKnowledgeCard::join('knowledge_cards', 'knowledge_cards.id', '=', 'user_knowledge_cards.id')
                                            ->where('user_id', $current_user->id)
                                            ->where('country_id', $currentUserCountry)
                                            ->pluck('knowledge_card_id')->toArray();
                
                if(count($allCardsInCurrentLv)!=count($owned_knowledge_card_id)){
                    return;
                }else{
                    User::find(auth()->user()->id)->increment('country_id');
                }
            default:
        }
    }

    // 帶遊戲資料，參數有目前玩家的遊戲進度
    public function getGameData() {}
    // 隨機出題，帶國家id，難度id查詢資料庫，呼叫檢查當前用戶遊玩紀錄比對，篩選掉已經玩過的題目
    public function Random(int $Country_id, int $levels) {}
    // 檢查遊玩次數(紀錄)
    public function CheckPlayedCount() {}

    // 關卡需要使用者具備哪些知識卡
    public function CheckCurrentGameKGrequired(int $Country_id)
    {
        // 國家->難度->關卡->知識卡要求
        $CurrentCountry = Country::where('id', $Country_id); // 當前國家
        $CurrentCountry->pass_familiarities;

        return;
    }
}
