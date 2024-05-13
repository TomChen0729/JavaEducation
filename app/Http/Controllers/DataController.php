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
            Country::firstOrCreate([
                'name'=> '蠻金之國',
            ]);
            PassFamiliarity::firstOrCreate([
                'levels' => '1',
                'country_id' => '1',
            ]);
            PassFamiliarity::firstOrCreate([
                'levels' => '2',
                'country_id' => '1',
            ]);
            PassFamiliarity::firstOrCreate([
                'levels' => '3',
                'country_id' => '1',
            ]);
            //是非 難度一
            //第一題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '1',
                'questions' => 'float資料型態是否能儲存小數值',
            ]);
            Answer::firstOrCreate([
                'question_id' => '1',
                'answers' => 'O'
            ]);
            //第二題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '1',
                'questions' => 'float資料型態是否能儲存整數值',
            ]);
            Answer::firstOrCreate([
                'question_id' => '2',
                'answers' => 'X'
            ]);
            //第三題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '1',
                'questions' => 'int資料型態是否能儲存小數值',
            ]);
            Answer::firstOrCreate([
                'question_id' => '3',
                'answers' => 'X'
            ]);
            //第四題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '1',
                'questions' => 'double資料型態是否能儲存小數值',
            ]);
            Answer::firstOrCreate([
                'question_id' => '4',
                'answers' => 'O'
            ]);
            //是非 難度二
            //第五題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '2',
                'questions' => 'keyin.nextLine()用於從鍵盤讀取下一行的用戶輸入',
            ]);
            Answer::firstOrCreate([
                'question_id' => '5',
                'answers' => 'O'
            ]);
            //第六題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '2',
                'questions' => 'keyin.close()是否關閉Scanner不能再輸入',
            ]);
            Answer::firstOrCreate([
                'question_id' => '6',
                'answers' => 'O'
            ]);
            //第七題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '2',
                'questions' => '查看下方這段程式碼是否為資料輸入宣告？
                Scanner keyin = new Scanner(System.in); ',
            ]);
            Answer::firstOrCreate([
                'question_id' => '7',
                'answers' => 'O'
            ]);
            //第八題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '2',
                'questions' => '查看下方這段程式碼是否為資料輸出？
                int a = keyin.nextInt(); ',
            ]);
            Answer::firstOrCreate([
                'question_id' => '8',
                'answers' => 'X'
            ]);
            //第九題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '2',
                'questions' => '查看下方這段程式碼是否為資料輸入？
                System.out.println(); ',
            ]);
            Answer::firstOrCreate([
                'question_id' => '9',
                'answers' => 'X'
            ]);
            //第十題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '2',
                'questions' => '查看下方這段程式碼，換行表示是否正確？
                System.out.print("\n"); ',
            ]);
            Answer::firstOrCreate([
                'question_id' => '10',
                'answers' => 'O'
            ]);
            //是非 難度三
            //第十一題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '3',
                'questions' => '&&是否用於表示邏輯運算的“AND” ',
            ]);
            Answer::firstOrCreate([
                'question_id' => '11',
                'answers' => 'O'
            ]);
            //第十二題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '3',
                'questions' => '||是否用於表示邏輯運算的“OR”',
            ]);
            Answer::firstOrCreate([
                'question_id' => '12',
                'answers' => 'O'
            ]);
            //第十三題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '3',
                'questions' => '"=="用於比較兩個值是否相等',
            ]);
            Answer::firstOrCreate([
                'question_id' => '13',
                'answers' => 'O'
            ]);
            //第十四題
            Question::firstOrCreate([
                'country_id' => '1',
                'pass_familiarity_id' => '3',
                'questions' => '"!="用於比較兩個值是否相等',
            ]);
            Answer::firstOrCreate([
                'question_id' => '14',
                'answers' => 'X'
            ]);
            });
        }

}
