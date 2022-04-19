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

Route::get('/welcome', function () {
    return view('welcome-page');
})->name('welcome');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'BookController@viewDashboard')->name('dashboard');      

Route::group(['prefix'=>'books','as'=>'books.'], function(){
    Route::get('add', ['as' => 'add', 'uses' => 'BookController@create']);
    Route::get('', ['as' => 'manage', 'uses' => 'BookController@index']);
    // Route::get('add', [BookController::class, 'create'])->name('add');
    Route::post('store', ['as' => 'store', 'uses' => 'BookController@store']);
    Route::get('logs/', ['as' => 'logs', 'uses' => 'BookController@viewLogs']);
    Route::get('export', ['as' => 'export', 'uses' => 'BookController@export']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'BookController@destroy']);
});

Route::group(['prefix'=>'students','as'=>'students.'], function(){
    Route::get('add', ['as' => 'add', 'uses' => 'StudentController@create']);
    Route::get('', ['as' => 'manage', 'uses' => 'StudentController@index']);
    // Route::get('add', [BookController::class, 'create'])->name('add');
    Route::post('store', ['as' => 'store', 'uses' => 'StudentController@store']);
    Route::post('status', ['as' => 'status', 'uses' => 'StudentController@changeStatus']);
    Route::get('logs', ['as' => 'logs', 'uses' => 'StudentController@viewLogs']);
    Route::post('delete', ['as' => 'delete', 'uses' => 'StudentController@destroy']);
});

Route::group(['prefix'=>'borrow','as'=>'borrow.'], function(){
    Route::get('', ['as' => 'get', 'uses' => 'BookController@borrow']);
    Route::post('info', ['as' => 'get-info', 'uses' => 'BookController@getInfo']);
    Route::post('', ['as' => 'post', 'uses' => 'BookController@borrowAction']);
});

Route::group(['prefix'=>'return','as'=>'return.'], function(){
    Route::get('', ['as' => 'get', 'uses' => 'BookController@return']);
    Route::post('', ['as' => 'post', 'uses' => 'BookController@returnAction']);
});

Route::group(['prefix'=>'dog','as'=>'dog.'], function(){
    Route::get('', ['as' => 'index', 'uses' => 'DogController@index']);
    Route::get('generate', ['as' => 'generate', 'uses' => 'DogController@generateDog']);
});