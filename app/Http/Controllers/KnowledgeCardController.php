<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\KnowledgeCard;
use App\Models\UserKnowledgeCard;
use App\Models\Question;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class KnowledgeCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 抓出該知識卡分類上層的國家
        // 每個國家第一層分類
        $current_user_country = auth()->user()->country_id;
        $card_types = CardType::select('*')
            ->where('country_id', '<=', $current_user_country)->get();
        return view('knowledge.knowledgecard_type', ['card_types' => $card_types]);
    }

    // 顯示該分類底下所有的片
    public function showallcards(int $card_type_id)
    {
        $all_cards = KnowledgeCard::where('card_type_id', $card_type_id)->get();
        // 找出使用者擁有的卡片
        $current_user = auth()->user()->id;
        $user_cards_id = UserKnowledgeCard::with('knowledge_card_id')->where('user_id', $current_user)->pluck('knowledge_card_id');
        $card_type = CardType::where('id','=',$card_type_id)->first();
        return view('knowledge.knowledge', ['all_cards' => $all_cards, 'user_cards_id' => $user_cards_id,'card_type'=>$card_type]);
    }


    public function showcardcontent(int $card_id)
    {
        $current_card = KnowledgeCard::find($card_id);
        $card_type = CardType::where('id','=',$current_card->card_type_id)->first();
        return view('knowledge.knowledgecontent', ['current_card' => $current_card,'card_type'=>$card_type]);
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

        return response()->json();
    }
    //搜尋功能
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        // 找卡片
        $current_card = KnowledgeCard::where('name', 'LIKE', "%{$keyword}%")->first();
        $card_type = CardType::where('id','=',$current_card->card_type_id)->first();
        // 如果卡片有找到的話 回傳卡片
        if ($current_card) {
            return redirect()->route('knowledge.show', ['id' => $current_card,'card_type'=>$card_type]);
        }

        // 如果沒有找到，返回找不到卡片
        return redirect()->back();    
    }
}
