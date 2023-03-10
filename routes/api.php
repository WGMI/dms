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
        case 'Freezos10':
            $column = 'Freezos';
            break;
        case 'Juices10':
            $column = 'Juices';
            break;
        case 'Coffee70':
            $column = 'Coffee';
            break;
    }
    DB::update('update counter set '.$column.' = '.$column.' + 1');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
