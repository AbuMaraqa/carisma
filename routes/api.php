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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*   Events    */

Route::get('/listEvents',[App\Http\Controllers\EventController::class, 'listEvents']);
Route::post('/createEvent',[App\Http\Controllers\EventController::class, 'createEvent']);
Route::get('/dd',[App\Http\Controllers\EventController::class, 'dd'])->middleware('auth');
Route::post('/updateEvent/{id}',[App\Http\Controllers\EventController::class,'updateEvents']);
Route::post('/StatusDisable/{id}',[App\Http\Controllers\EventController::class,'statusDisable']);

/*   Publisher    */

Route::post('/createPublisher',[App\Http\Controllers\PublisherController::class, 'createPublisher']);
Route::post('/updatePublisher/{id}',[App\Http\Controllers\PublisherController::class, 'updatePublisher']);
Route::get('/ss',[App\Http\Controllers\PublisherController::class, 'getEvent']);

Route::get('/publisher',[App\Http\Controllers\PublisherController::class, 'index']);

Route::post('/getEventIdAPI/{id}',[App\Http\Controllers\EventController::class , 'getEventIdAPI']);

Route::post('/getpublisherLogin',[App\Http\Controllers\PublisherController::class , 'getpublisherLogin']);

Route::get('/getEventName',[App\Http\Controllers\EventController::class , 'getEventName']);

Route::post('/selectPublisherLogin',[App\Http\Controllers\PublisherController::class , 'selectPublisherLogin']);

Route::post('/sentSmsSingle/{id}',[App\Http\Controllers\PublisherController::class , 'sentSmsSingle']);

Route::post('/getUser',[App\Http\Controllers\UsersController::class , 'getUser']);

Route::post('/login',[App\Http\Controllers\UsersController::class , 'login']);


