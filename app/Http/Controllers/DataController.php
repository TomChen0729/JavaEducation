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
            
            });
        }

}
