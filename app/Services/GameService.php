<?php 

namespace App\Services;

class GameService{
    public static function getUserRecord(int $user_id){
        $currenUser = $user_id;
        $User_record = auth()->user();
        return $User_record;
    }

    public function updateUserRecord(){

    }

}