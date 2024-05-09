<?php 

namespace App\Services;

use GuzzleHttp\Psr7\Request;
use App\Models\Answer;
class GameService{
    public function getUserRecord(){
        $User_record = auth()->user();
        return $User_record;
    }
    public function updateUserRecord(int $user_id){
        //將要改變的資料從前端接收
        //將資料存入變數
        //使用ORM update CurrentUserRecord
        //return repose 200 OK

    }
    // 帶遊戲資料，參數有目前玩家的遊戲進度
    public function getGameData(){

    }
    // 隨機出題
    public function Random(){

    }
    // 檢查遊玩次數
    public function CheckPlayedCount(){

    }

    

}