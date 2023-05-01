<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('temp',function(Request $request){
    $item = $request->item;
    DB::select("UPDATE `counter` SET `count` = (count + 1) WHERE `item` = ".$item);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
