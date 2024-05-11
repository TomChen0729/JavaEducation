<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException; // 驗證資料欄位
use App\Services\GameService;
use Exception;
use Illuminate\Support\Facades\Route;
use vendor\laravel\framework\src\Illuminate\Database\Eloquent\Model;
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
    public function TrueORFalse(int $country_id)
    {
        //檢查玩家進度，如果國家id等於0和等級id等於0，就都給1進去。
        $Current_user_country = auth()->user()->country_id;
        $Current_user_country_level = auth()->user()->pass_familiarity;
        $Current_user_id = auth()->user()->id;
        if ($Current_user_country == null  && $Current_user_country_level==null){
            $user = User::find($Current_user_id);
            $user -> update([
                'country_id' => 1,
                'pass_familiarity_id' => 1,
            ]);
        }
        
        return view('game.TrueORFalse');
        // return response()->json();
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
