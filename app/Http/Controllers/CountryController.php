<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // 驗證資料欄位
use App\Services\GameService;
use Exception;
use Illuminate\Support\Facades\Route;
class CountryController extends Controller
{

    private GameService $gameService;
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
        // $this->
    }
    public function index(){
        // 導向顯示五個國家的那個頁面
        return view('');
    }
    // 導向是非題頁面，該遊戲資料，帶使用者資料，檢查玩家遊戲進度
    public function TrueORFalse()
    {
        //
        
        return view('game.TureORFalse');
    }

    //過去連連看畫面, 回傳資料
    public function GoMatchGame(Request $request, int $userID)
    {
        // 
        try{
            $method = $request->method();
            if ($method == 'GET'){
                $currentUser = auth()->user()->id;
                // getUserRecord($currentUser);

            }
            // return view('game.match', [""]);
            return response()->json(['success'=> "True", 'currentUser' => $currentUser]);
        }
        catch(ValidationException $e){
            return false;
        }
        catch(Exception $e){
            return response()->json(['error' => 'An error occurred'], 500);
        }
        
        
        
    }

    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
