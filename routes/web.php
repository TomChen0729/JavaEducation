<?php
use App\Http\Controllers\DataController;
use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

//輸入資料
Route::get('/data', [DataController::class, 'storeData']);

Route::get('/', function(){
    return view('home');
});
Route::resource('countries', CountryController::class);
Route::get('/country', [CountryController::class, 'index'])->name('root');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
