<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Country;
use App\Models\PassFamiliarity;
use App\Models\Question;
use App\Models\Answer;

class DataController extends Controller
{
    #輸入資料
    public function storeData(Request $request)
    {
        DB::transaction(function (){
        Country::create([
            'name'=> '蠻金之國'
        ]);
        PassFamiliarity::create([
            'levels' => '1',
            'country_id' => '1',
        ]);
        PassFamiliarity::create([
            'levels' => '2',
            'country_id' => '1',
        ]);
        PassFamiliarity::create([
            'levels' => '3',
            'country_id' => '1',
        ]);
        //是非
        //第一題
        Question::create([
            'country_id' => '1',
            'pass_familiarity_id' => '1',
            'questions' => 'float資料型態是否能儲存小數值',
        ]);
        Answer::create([
            'question_id' => '1',
            'answers' => 'O'
        ]);
        //第二題
        Question::create([
            'country_id' => '1',
            'pass_familiarity_id' => '1',
            'questions' => 'float資料型態是否能儲存整數值',
        ]);
        Answer::create([
            'question_id' => '2',
            'answers' => 'X'
        ]);
        //第三題
        Question::create([
            'country_id' => '1',
            'pass_familiarity_id' => '1',
            'questions' => 'int資料型態是否能儲存小數值',
        ]);
        Answer::create([
            'question_id' => '3',
            'answers' => 'X'
        ]);
        //第四題
        Question::create([
            'country_id' => '1',
            'pass_familiarity_id' => '1',
            'questions' => 'double資料型態是否能儲存小數值',
        ]);
        Answer::create([
            'question_id' => '4',
            'answers' => 'O'
        ]);
        return '資料傳輸成功'; 
        });
    }

}
