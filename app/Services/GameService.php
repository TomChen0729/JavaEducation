<?php 

namespace App\Services;

use GuzzleHttp\Psr7\Request;

class GameService{
    
    // 存取玩家遊戲資訊
    public function GetUserRecord(Request $req, int $user_id){

        return response('存取成功');
    }

    // 更新玩家資訊
    public function UpdateUserRecord(Request $req, int $user_id){
        // 如果http狀態碼等於200 和 請求方法為get
        // if $req.status == 200{

        // }
        return response('更新成功');
    }

    
}