<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'store']); 
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])
    ->name('item.index');
    
    Route::get('/item_update/{id}', [App\Http\Controllers\Item_updateController::class,'edit'])->name('item.item_update');
    Route::post('/item_update/{id}', [App\Http\Controllers\Item_updateController::class,'edit'])->name('item.item_update');
    Route::post('/item_update/{id}', [App\Http\Controllers\Item_updateController::class,'update'])->name('item.item_update');
    Route::get('/ListDelete/{id}',[App\Http\Controllers\ItemListController::class, 'ListDelete']);
    


    //TODO
    Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('tasks.task');
    Route::post('/task', [App\Http\Controllers\TaskController::class, 'store'])->name('task');
    Route::delete('/task/{task}', [App\Http\Controllers\TaskController::class, 'destroy'])->name('/task/{task}');

    //カレンダー
    Route::get('/calendar', [App\Http\Controllers\CalendarController::class,'show']);


});
