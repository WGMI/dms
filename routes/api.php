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
    $column = $request->item;
    Log::info($column);
    switch($_GET['item']){
        case 'Bottle':
            $column = 'Bottle';
            break;
        case 'Tshirts':
            $column = 'Tshirts';
            break;
        case 'Cap':
            $column = 'Cap';
            break;
        case 'Reflector':
            $column = 'Reflector';
            break;
        case 'Umbrella':
            $column = 'Umbrella';
            break;
    }
    DB::update('update bb_counter set '.$column.' = '.$column.' + 1');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
