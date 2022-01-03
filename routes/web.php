<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\EventController;
use App\Models\Subject;
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
    return view('dashboard');
})->middleware('auth');


// Authorization Route -------------------------------------------------------------------
Route::get('login',function (){
    return view('auth.login');
})->name('login');

Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::post('verifiyuser',[AuthController::class,'authenticate'])->name('verifyUser');

//restricted area

// Route::get('admindashboard', function(){
//     return view('dashboard');
// })->name('admindashboard')->middleware('auth:admin');

Route::get('dashboard', function(){
    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('changepassword/{perid}', function(Request $request) {
    return view('auth.changepassword',['perid'=> $request->perid]);
})->name('changepassword')->middleware('auth');

// Route::get('adminchangepassword/{perid}', function(Request $request) {
//     return view('auth.changepassword',['perid'=> $request->perid]);
// })->name('adminchangepassword')->middleware('auth:admin');

Route::post('updatepassword',[AuthController::class,'updatepassword'])->name('updatepassword');

//User management -----------------------------------------------------------------------------------------------------------------
Route::resource('user', UserController::class)->middleware('auth');
Route::get('user/resetpassword/{id}',[UserController::class,'resetpassword'])->middleware('auth')->name('user.resetpassword');
Route::post('user/updatepassword/{id}',[UserController::class,'updatepassword'])->middleware('auth')->name('user.updatepassword');

//Group managment -----------------------------------------------------------------------------------------------------------------
Route::resource('group', GroupController::class)->middleware('auth');
Route::get('listgroup',[GroupController::class,'listGroup'])->name('group.listgroup');
Route::get('groupsubject',[GroupController::class,'viewSubjectGroup'])->name('group.viewsubject');


// Subject -----------------------------------------------------------------------------------------------------------------
Route::group(['middleware'=>'auth'],function () {

    Route::get('subject/create',[SubjectController::class,'create'])->name('subject.create');
    Route::post('subject/store',[SubjectController::class,'store'])->name('subject.store');
    Route::get('subject/{id}/{tab}',[SubjectController::class,'show'])->name('subject.show');
    Route::get('subjectedit/{id}',[SubjectController::class,'edit'])->name('subject.edit');
    Route::put('subjectupdate/{id}',[SubjectController::class,'update'])->name('subject.update');
    Route::delete('subject/destroy/{id}',[SubjectController::class,'destroy'])->name('subject.destroy');

    Route::get('subject/attachgroup/{id}/{group_id}',[SubjectController::class,'attachGroup'])->name('subject.attachgroup');
    Route::get('subject/detachgroup/{id}/{group_id}',[SubjectController::class,'detachGroup'])->name('subject.detachgroup');
    Route::post('subject/indexsubject',[SubjectController::class,'indexSubject'])->name('subject.indexsubject');
});

// Contact -----------------------------------------------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {

    Route::get('contact/create/{id}',[ContactController::class,'create'])->name('contact.create');
    Route::get('contact/edit/{id}',[ContactController::class,'edit'])->name('contact.edit');
    Route::post('contact/store',[ContactController::class,"store"])->name('contact.store');
    Route::put('contact/update/{id}',[ContactController::class,'update'])->name('contact.update');
    Route::delete('contact/delete/{id}',[ContactController::class,'destroy'])->name('contact.destroy');
});

// Vehicle --------------------------------------------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::post('vehicle',[VehicleController::class,'index'])->name('vehicle.index');
    Route::get('vehicle/create',[VehicleController::class,'create'])->name('vehicle.create');
    Route::post('vehicle/store',[VehicleController::class,'store'])->name('vehicle.store');
    Route::get('vehicle/{id}',[VehicleController::class,'show'])->name('vehicle.show');

    Route::post('vehicle/{id}/findsubject',[VehicleController::class,'findSubject'])->name('vehicle.findsubject');
    Route::post('vehicle/{id}/attachsubject',[VehicleController::class,'attachSubject'])->name('vehicle.attachsubject');

    Route::get('vehicle/edit/{id}',[VehicleController::class,'edit'])->name('vehicle.edit');
    Route::put('vehicle/update/{id}',[VehicleController::class,'update'])->name('vehicle.update');
    Route::delete('vehicle/delete/{id}',[VehicleController::class,'destroy'])->name('vehicle.destroy');


});

// Place ----------------------------------------------------------------------------------------------------------------
Route::middleware(['auth'])->group(function(){

    Route::get('place/create/{id}',[PlaceController::class,'create'])->name('place.create');
    Route::post('place/store/{id}',[PlaceController::class,'store'])->name('place.store');
    Route::get('place/edit/{id}',[PlaceController::class,'edit'])->name('place.edit');
    Route::put('place/update/{id}',[PlaceController::class,'update'])->name('place.update');
    Route::delete('place/delete/{id}',[PlaceController::class,'destroy'])->name('place.destroy');
});

// Note -----------------------------------------------------------------------------------------------------------------
Route::middleware(['auth'])->group(function(){

    Route::get('note/create/{id}',[NoteController::class,'create'])->name('note.create');
    Route::post('note/store/',[NoteController::class,'store'])->name('note.store');
    Route::get('note/edit/{id}',[NoteController::class,'edit'])->name('note.edit');
    Route::put('note/update/{id}',[NoteController::class,'update'])->name('note.update');
    Route::delete('note/destroy/{id}}',[NoteController::class,'destroy'])->name('note.destroy');
});


// Photo ---------------------------------------------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {

    Route::get('photo/{id}',[PhotoController::class,'index'])->name('photo.index');
    Route::post('photo/store/{id}',[PhotoController::class,'store'])->name('photo.store');
    Route::get('photo/show/{id}',[PhotoController::class,'show'])->name('photo.show');
    Route::put('photo/update/{id}',[PhotoController::class,'update'])->name('photo.update');
    Route::delete('photo/destroy/{id}',[PhotoController::class,'destroy'])->name('photo.destroy');
    Route::get('photo/updatephotosubject/{id}',[PhotoController::class,'updatephotosubject'])->name('photo.updatephotosubject');

});

// Event ----------------------------------------------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::resource('event',EventController::class);
    Route::get('event/editeventsubject/{id}',[EventController::class,'editEventSubject'])->name('event.editeventsubject');
    Route::get('event/{id}/attacheventsubject/{subject_id}',[EventController::class,'attachEventSubject'])->name('event.attacheventsubject');
    Route::get('event/{id}/detacheventsubject/{subject_id}',[EventController::class,'detachEventSubject'])->name('event.detacheventsubject');
    Route::post('event/find',[EventController::class,'find'])->name('event.find');
});

// Document ------------------------------------------------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::post('document',[DocumentController::class,'store'])->name('document.store');
    Route::delete('document/destroy/{id}',[DocumentController::class,'destroy'])->name('document.destroy');
    Route::put('document/update/{id}',[DocumentController::class,'update'])->name('document.update');

});




