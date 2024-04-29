<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Validation\ValidationException; // 驗證資料欄位
use App\Services\GameService;
use Exception;

class CountryController extends Controller implements HasMiddleware
// class CountryController extends Controller
{

    protected $gameService;
    /**
     * Display a listing of the resource.
     */
    public static function middleware(): array
    {
        return [
            'auth' => Authenticate::class,
        ];
    }
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }
    public function index()
    {
        //
        return view('level');
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
    //過去連連看畫面, 回傳資料
    public function GoMatchGame(Request $request, int $userID)
    {
        // 
        try{
            $method = $request->method();
            if ($method == 'GET'){
                $current_user = $this->gameService->getUserRecord($userID);
            }
            return view('game.match', ["current_user" => $current_user]);
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
