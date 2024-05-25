<?php

namespace App\Http\Controllers;

use App\Models\CardType;
use App\Models\KnowledgeCard;
use App\Models\Question;
use Illuminate\Http\Request;

class KnowledgeCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 抓出該知識卡分類上層的國家
        // 每個國家第一層分類
        $card_types = CardType::all();
        return view('knowledgecard', ['card_types' => $card_types]);
    }

    // 顯示該分類底下所有的片
    public function showallcards(int $card_type_id){

    }


    public function showcardcontent(int $card_id){
        $current_card = KnowledgeCard::find('id', $card_id);
        return view('cardcontent', ['current_card' => $current_card]);
    }

    // 遊戲畫面中的知識卡功能
    public function showCurrentCard(Request $request){

        return response()->json();
    }
}
    