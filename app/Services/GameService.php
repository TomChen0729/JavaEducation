<?php 

namespace App\Services;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use App\Models\Answer;
use App\Models\Country;
use App\Models\Question;
use App\Models\UserRecord;

class GameService{
    public function getUserRecord(){
        $User_record = auth()->user();
        return $User_record;
    }
    public function initUserRecord(){
        //檢查玩家進度，如果國家id等於0和等級id等於0，就都給1進去。
        $Current_User_Country = auth()->user()->country_id;
        $Current_User_Country_Level = auth()->user()->levels;
        $Current_User_id = auth()->user()->id;
        if ($Current_User_Country == null  && $Current_User_Country_Level == null){
            $user = User::find($Current_User_id);
            $user -> update([
                'country_id' => 1,
                'levels' => 1,
            ]);
        }
    }

    // 傳入當前國家id, 當前levels
    public function updateUserRecord(int $country_id, int $levels){
        $current_user_id = auth()->user()->id;
        // 查詢該國家該等級應該有的不重複玩法形成集合
        $gametype_set = Question::select('game_type')
        ->where('country_id', $country_id)
        ->where('levels', $levels)->distinct()->get();
        // 調取目前玩家有的當前國家當前等級不重複玩法集合(未完成)
        $user_gametype_set = UserRecord::all();
        // 如果兩者相等的話，等級加一
        if(count($gametype_set) == count($user_gametype_set)){
            $current_user_levels = auth()->user()->levels;
            $current_user_levels ++;
            $current_user = User::find($current_user_id);
            $current_user->update([
                'levels' => $current_user_levels
            ]);
            // 查詢當前玩家在該國家的等級是否是最高，如果是，levels變成1，country_id ++(未完成)
            $current_country = 0;
            if(auth()->user()->levels){
                $current_user_country = auth()->user()->country_id;
                $current_user_country ++;
                $current_user = User::find($current_user_id);
                $current_user->update([
                    'country_id' => $current_user_country
                ]);
            }
        }
    }
    public function giveUserCards(int $user_id){
        //將要改變的資料從前端接收
        //將資料存入變數
        //使用ORM update CurrentUserRecord

    }
    // 帶遊戲資料，參數有目前玩家的遊戲進度
    public function getGameData(){

    }
    // 隨機出題，帶國家id，難度id查詢資料庫，呼叫檢查當前用戶遊玩紀錄比對，篩選掉已經玩過的題目
    public function Random(int $Country_id, int $pass_familiarity_id){

    }
    // 檢查遊玩次數(紀錄)
    public function CheckPlayedCount(){

    }

    // 關卡需要使用者具備哪些知識卡
    public function CheckCurrentGameKGrequired(int $Country_id){
        // 國家->難度->關卡->知識卡要求
        $CurrentCountry = Country::where('country_id', $Country_id); // 當前國家
        $CurrentCountry->pass_familiarities;
        
        return ;
    }
    
}