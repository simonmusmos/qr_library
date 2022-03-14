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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix'=>'books','as'=>'books.'], function(){
    Route::get('add', ['as' => 'add', 'uses' => 'BookController@create']);
    // Route::get('add', [BookController::class, 'create'])->name('add');
    Route::post('store', ['as' => 'store', 'uses' => 'BookController@store']);
});

Route::group(['prefix'=>'students','as'=>'students.'], function(){
    Route::get('add', ['as' => 'add', 'uses' => 'StudentController@create']);
    // Route::get('add', [BookController::class, 'create'])->name('add');
    Route::post('store', ['as' => 'store', 'uses' => 'StudentController@store']);
});
