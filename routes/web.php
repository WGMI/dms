<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FolderController;

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

Route::get('/', [FileController::class, 'index'])->name('home');
Route::get('/home', [FileController::class, 'index'])->name('home');
Route::post('files',[FileController::class,'store'])->middleware('optimizeImages');
Route::get('recent',[FileController::class,'recent']);
Route::get('shared',[FileController::class,'shared']);
Route::get('files/{id}',[FileController::class,'download']);

Route::get('folder/{id}',[FolderController::class,'show']);
Route::post('folder',[FolderController::class,'store']);
Route::post('openfolder',[FolderController::class,'open']);

Auth::routes();

