<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeCards;
use App\Models\Question;
use Illuminate\Http\Request;

class KnowledgeCardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        #透過等級分類
        $groupCards=[
            'level1'=>[],
            'level2'=>[],
            'level3'=>[],
        ];
        #透過switchcase將每個等級的知識卡放一起
        foreach (KnowledgeCards::all() as $card)
        {
            switch($card->levels)
                {
                    case 1:
                        $groupCards['level1'][]=$card;
                        break;
                    case 2:
                        $groupCards['level2'][]=$card;
                        break;
                    case 3:
                        $groupCards['level3'][]=$card;
                }
        }
        return view('knowledgecard');
    }

    public function showCurrentCard(Request $request){
        return response()->json();
    }
}
    