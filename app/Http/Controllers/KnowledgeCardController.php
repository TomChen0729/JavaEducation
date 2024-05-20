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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
