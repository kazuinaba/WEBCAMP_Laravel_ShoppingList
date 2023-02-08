<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingListController;
use App\Http\Controllers\CompletedShoppingListController;
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

//Route::get('/', function () {
  //  return view('welcome');
    
    // タスク管理システム
Route::get('/', [AuthController::class, 'index']);
Route::get('/index', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::prefix('/shopping_list')->group(function () {
        Route::get('/list', [ShoppingListController::class, 'list'])->name('front.list');
        Route::post('/register', [ShoppingListController::class, 'register']);
        Route::get('/delete/{task_id}', [ShoppingListController::class, 'delete'])->whereNumber('task_id')->name('delete');
        Route::delete('/delete/{task_id}', [ShoppingListController::class, 'delete'])->whereNumber('task_id')->name('delete');
        Route::get('/complete/{task_id}', [ShoppingListController::class, 'complete'])->whereNumber('task_id')->name('complete');
        Route::post('/complete/{task_id}', [ShoppingListController::class, 'complete'])->whereNumber('task_id')->name('complete');
    });
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/completed_shopping_list/list', [CompletedShoppingListController::class, 'list']);
});    