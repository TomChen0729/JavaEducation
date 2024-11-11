<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\KnowledgeCard;
use App\Models\UserKnowledgeCard;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Expr\FuncCall;

class KnowledgeCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 取得當前使用者的國家 ID
        $current_user_country = auth()->user()->country_id;

        // 抓取符合條件的知識卡資料並進行格式化
        $cardTypes = CardType::join('countries', 'countries.id', '=', 'card_types.country_id')
            ->select('countries.name as countryname', 'card_types.card_type as card_type', 'card_types.id as card_type_id', 'card_types.country_id as country_id')
            ->where('card_types.country_id', '<=', $current_user_country)
            ->orderBy('card_types.country_id', 'asc')
            ->orderBy('card_types.levels', 'asc')
            ->get();

        // 格式化資料，將每個國家分組並將 cardTypeArray 格式化
        $result = [];
        foreach ($cardTypes as $card) {
            $countryId = $card->country_id;

            if (!isset($result[$countryId])) {
                $result[$countryId] = [
                    'countryname' => $card->countryname,
                    'country_id' => $countryId,
                    'cardTypeArray' => []
                ];
            }

            // 將 card_type_id 與 card_type 加入到 cardTypeArray 中
            $result[$countryId]['cardTypeArray'][$card->card_type_id] = $card->card_type;
        }

        // 重新索引陣列
        $formattedCardTypes = array_values($result);
        Log::info($formattedCardTypes);
        /* 格式如下
            [
                {
                    "countryname": "蠻金之國",
                    "country_id": 1,
                    "cardTypeArray": {
                        "1": "資料型態",
                        "2": "資料輸入輸出",
                        "3": "運算子"
                    }
                },
                {
                    "countryname": "南國",
                    "country_id": 2,
                    "cardTypeArray": {
                        "4": "條件語句",
                        "5": "迴圈控制"
                    }
                }
            ]

        */
        return view('knowledge.knowledgecard_type', ['card_types' => $formattedCardTypes]);
    }


    // 顯示該分類底下所有的片
    public function showallcards(int $card_type_id)
    {
        $all_cards = KnowledgeCard::where('card_type_id', $card_type_id)->get();
        // 找出使用者擁有的卡片
        $current_user = auth()->user()->id;
        $user_cards_id = UserKnowledgeCard::with('knowledge_card_id')->where('user_id', $current_user)->pluck('knowledge_card_id');
        $card_type = CardType::where('id', '=', $card_type_id)->first();
        return view('knowledge.knowledge', ['all_cards' => $all_cards, 'user_cards_id' => $user_cards_id, 'card_type' => $card_type]);
    }


    public function showcardcontent(int $card_id)
    {
        $current_card = KnowledgeCard::find($card_id);
        $card_type = CardType::where('id', '=', $current_card->card_type_id)->first();
        return view('knowledge.knowledgecontent', ['current_card' => $current_card, 'card_type' => $card_type]);
    }

    // 題目知識卡
    public function questioncard(int $question_id, $web_id)
    {
        $question_card = KnowledgeCard::with('question_cards')->whereHas('question_cards', function ($query) use ($question_id) {
            $query->where('question_id', $question_id);
        })->get();
        return view($web_id, ['question_card' => $question_card]);
    }

    // 遊戲畫面中的知識卡功能
    public function showCurrentCard(Request $request)
    {
        if($request -> isMethod('get')){
            $card = $request->input('cardname');
            $cardcontent = KnowledgeCard::where('name', $card)->get()->toJson();
            Log::info($cardcontent);
            return response()->json(['message' => 'OK', 'cardcontent' => $cardcontent]);
        }else{
            return response()->json(['message' => 'http method error']);
        }
        
    }
    //搜尋功能
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // 找卡片
        $current_card = KnowledgeCard::where('name', 'LIKE', "%{$keyword}%")->first();
        $card_type = CardType::where('id', '=', $current_card->card_type_id)->first();
        // 如果卡片有找到的話 回傳卡片
        if ($current_card) {
            return redirect()->route('knowledge.show', ['id' => $current_card, 'card_type' => $card_type]);
        }

        // 如果沒有找到，返回找不到卡片
        return redirect()->back();
    }
    public function getSuggestions(Request $request)
    {
        $keyword = $request->input('keyword');
        $relatedKeywords = KnowledgeCard::where('name', 'like', "{$keyword}%")
            ->limit(5)
            ->pluck('name');

        return response()->json(['relatedKeywords' => $relatedKeywords]);
    }
}
