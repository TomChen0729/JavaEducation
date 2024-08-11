<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\Http\Request;

class SecCountryController extends Controller
{
    //
    protected $gameService;

    public function __construct(GameService $gameService){
        $this->gameService = $gameService;
    }
}
