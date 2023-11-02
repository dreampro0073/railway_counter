<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EntryContoller;

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


Route::get('/', [UserController::class,'login'])->name("login");
Route::post('/login', [UserController::class,'postLogin']);


Route::get('/logout',function(){
	Auth::logout();
	return Redirect::to('/');
});

// Route::group(['middleware'=>'auth'],function(){
	Route::group(['prefix'=>"admin"], function(){
		Route::get('/dashboard',[AdminController::class,'dashboard']);
	});
// });

Route::group(['prefix'=>"api"], function(){
	Route::group(['prefix'=>"dashboard"], function(){
		Route::post('/init',[EntryContoller::class,'initEntries']);
		Route::post('/edit-init',[EntryContoller::class,'editEntry']);
		Route::post('/store',[EntryContoller::class,'store']);
		Route::post('/cal-check',[EntryContoller::class,'calCheck']);
	});
});
