<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
    return view('welcome');
});


// Authorization Route -------------------------------------------------------------------
Route::get('login',function (){
    return view('auth.login');
})->name('login');

Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::post('verifiyuser',[AuthController::class,'authenticate'])->name('verifyUser');

//restricted area

Route::get('admindashboard', function(){
    return view('dashboard');
})->name('admindashboard')->middleware('auth:admin');

Route::get('dashboard', function(){
    return view('dashboard');
})->name('dashboard')->middleware('auth:authuser');

Route::get('changepassword/{perid}', function(Request $request) {
    return view('auth.changepassword',['perid'=> $request->perid]);
})->name('changepassword')->middleware('auth:authuser');

Route::get('adminchangepassword/{perid}', function(Request $request) {
    return view('auth.changepassword',['perid'=> $request->perid]);
})->name('adminchangepassword')->middleware('auth:admin');

Route::post('updatepassword',[AuthController::class,'updatepassword'])->name('updatepassword');

//User management -----------------------------------------------------------------------------------------------------------------
Route::resource('user', UserController::class)->middleware('auth:admin');
Route::get('user/resetpassword/{id}',[UserController::class,'resetpassword'])->middleware('auth:admin')->name('user.resetpassword');
Route::post('user/updatepassword/{id}',[UserController::class,'updatepassword'])->middleware('auth:admin')->name('user.updatepassword');

//Group managment -----------------------------------------------------------------------------------------------------------------
Route::resource('group', GroupController::class)->middleware('auth:admin');


// Subject -----------------------------------------------------------------------------------------------------------------
Route::group(['middleware'=>'auth:authuser'],function () {
    Route::resource('subject', SubjectController::class);


});





