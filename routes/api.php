<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
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
    DB::select("UPDATE `counter` SET `count` = (count + 1) WHERE `item` = '".$item."'");
    return DB::select("SELECT `count` from `counter` WHERE `item` = '".$item."'")[0]->count;
});

Route::get('checkcount',function(Request $request){
    Log::info($request->all());
    $gift = $request->gift;
    $location = $request->location;

    // Run the SQL query using Laravel's query builder
    $count = DB::table('gifts')
        ->select($gift)
        ->where('LOCATION', '=', $location)
        ->first();
    return response()->json(['count' => $count]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
