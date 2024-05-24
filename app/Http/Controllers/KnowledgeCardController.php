<?php

namespace App\Http\Controllers;

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
        // 每個國家第一層分類
        $knowledgecard = KnowledgeCard::all();
        return view('knowledgecard', ['knowledgecard' => $knowledgecard]);
    }

    public function showCurrentCard(Request $request){

        return response()->json();
    }
}
    