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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/listUsers',[App\Http\Controllers\UsersController::class , 'listUsers']);

Route::get('/listEvents' , [App\Http\Controllers\EventController::class , 'listEvents']);

Route::get('/addEvent',function (){
    return view('events.addevent');
});

Route::post('/createEvent',[App\Http\Controllers\EventController::class, 'createEvent']);

Route::get('/getEventId/{id}',[App\Http\Controllers\EventController::class, 'getEventId']);

Route::post('/createPublisher',[App\Http\Controllers\PublisherController::class, 'createPublisher']);

Route::get('/addPublisher/{id}', [App\Http\Controllers\PublisherController::class, 'addPublisher']);

Route::get('/exporttopdf/{id}',[App\Http\Controllers\PublisherController::class, 'generatePdf']);

Route::get('/getPublisherid/{id}',[App\Http\Controllers\PublisherController::class,'getPublisherid']);

Route::get('/exportPublisher/{id}',[App\Http\Controllers\ExportPublisher::class , 'export']);

Route::post('/importPublisher',[App\Http\Controllers\PublisherController::class , 'publisherImport']);

Route::get('/exporttopdfall/{id}',[App\Http\Controllers\PublisherController::class , 'exporttopdfall']);

Route::get('/getDataEvents/{id}',[App\Http\Controllers\EventController::class ,'getDataUpdate']);












