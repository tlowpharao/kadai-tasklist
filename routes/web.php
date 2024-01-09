<?php

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

// routes/web.phpでは
// '/' に GET メソッドでHTTPリクエストが来ると、 
// view('welcome') が実行されることで、トップページが表示されます。
Route::get('/', function () {
    return view('welcome');
});
