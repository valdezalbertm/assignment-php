<?php

declare(strict_types=1);

use App\Http\Controllers\KeyController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'token'] , function () {
    Route::resource('/key', KeyController::class)->only(['index', 'destroy', 'update', 'store', 'show']);
    Route::get('language', LanguageController::class);
    Route::put('translation', 'App\Http\Controllers\TranslationController@update');
    Route::get('translation/export', 'App\Http\Controllers\TranslationController@export');
});
