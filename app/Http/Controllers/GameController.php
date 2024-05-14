<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GameService;
class GameController extends Controller
{
    protected $gameService;
    // 檢查登入狀態
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    /**
     * Display a listing of the resource.
     */
    
    //導向遊戲列表
    public function index()
    {
        //
        return view('Gameviews');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function ChooseGame(Request $request, int $GameType_id)
    {
        //
        
        switch ($GameType_id) {
            case 1:
                // 如果GameType_id == 1
                // 呼叫檢查使用者遊玩進度
                // 呼叫亂數出題
                return view('game.TrueORFalse');
            case 2:
                // 
                return view('game.choose');
            case 3:
                // 
                return view('game.match');
            case 4:
                // 
                return view('game.reorganization');
            case 5:
                // 
                break;
            // 
            default:
                // 
                return response('error');
        }
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
