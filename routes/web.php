<?php

use App\Models\Event;
use Illuminate\Support\Facades\DB;
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
    $ecount = DB::select('select count(eid) as count from events')[0];
    $pcount = DB::select('select count(pid) as count from publishers')[0];
    $list = Event::skip(0)->take(3)->get();

    if (Auth::user()){
        return view('index',['ecount'=>$ecount,'pcount'=>$pcount,'list'=>$list]);
    }
    else{
        return view('auth.login');
    }
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth','isAdmin');

Route::get('/listUsers',[App\Http\Controllers\UsersController::class , 'listUsers']);

Route::get('/listEvents' , [App\Http\Controllers\EventController::class , 'listEvents']);

Route::get('/deleteCheck' , [App\Http\Controllers\PublisherController::class , 'deleteCheck']);

Route::get('/addEvent',function (){
    $user = \Illuminate\Support\Facades\DB::select('select * from users');
    return view('events.addevent',['user'=>$user]);
});

Route::post('/createEvent',[App\Http\Controllers\EventController::class, 'createEvent']);

Route::get('/getEventId/{id}',[App\Http\Controllers\EventController::class, 'getEventId']);

Route::post('/createPublisher',[App\Http\Controllers\PublisherController::class, 'createPublisher']);

Route::get('/addPublisher/{id}', [App\Http\Controllers\PublisherController::class, 'addPublisher']);

Route::get('/exporttopdf/{id}',[App\Http\Controllers\PublisherController::class, 'generatePdf']);

Route::get('/getPublisherid/{id}',[App\Http\Controllers\PublisherController::class,'getPublisherid']);

Route::get('/exportPublisher/{id}',[App\Http\Controllers\ExportPublisher::class , 'export']);

Route::post('/importPublisher/{id}',[App\Http\Controllers\PublisherController::class , 'publisherImport']);

Route::get('/exporttopdfall/{id}',[App\Http\Controllers\PublisherController::class , 'exporttopdfall']);

Route::get('/getDataEvents/{id}',[App\Http\Controllers\EventController::class ,'getDataUpdate']);

Route::post('/updateEvent/{id}',[App\Http\Controllers\EventController::class , 'updateEvents']);

Route::get('/deletePublisher/{id}',[App\Http\Controllers\PublisherController::class , 'deletePublisher']);

Route::get('/deleteEvent/{id}',[App\Http\Controllers\EventController::class , 'deleteEvent']);

Route::get('/settingEvent',[App\Http\Controllers\EventController::class , 'settingEvent']);

Route::post('/updateMainEvent',[App\Http\Controllers\MainSettingController::class , 'updateMainEvent']);

Route::get('/smssingle/{id}',[App\Http\Controllers\PublisherController::class , 'smsSingle']);

Route::post('/sentSmsSingle/{id}',[App\Http\Controllers\PublisherController::class , 'sentSmsSingle']);

Route::get('/smsall/{id}',[App\Http\Controllers\PublisherController::class , 'smsAll']);

Route::post('/sentSmsAll/{id}',[App\Http\Controllers\PublisherController::class , 'sendSMSAll']);

Route::get('/getAddPageUser',[App\Http\Controllers\UsersController::class , 'getAddPageUser']);

Route::post('/createUser',[App\Http\Controllers\UsersController::class , 'createUser']);

Route::get('/getUserData/{id}' ,[App\Http\Controllers\UsersController::class , 'getUserData']);

Route::post('/updateUser/{id}' , [App\Http\Controllers\UsersController::class , 'updateUser']);

Route::get('/gameIndex',[App\Http\Controllers\GameController::class , 'index']);

Route::get('/getAddPageGame',[App\Http\Controllers\GameController::class , 'getAddPageGame']);

Route::post('/createGame',[App\Http\Controllers\GameController::class , 'createGame']);

Route::get('/getGameData/{id}',[App\Http\Controllers\GameController::class , 'getGameData']);

Route::post('/updateGame/{id}' , [App\Http\Controllers\GameController::class , 'updateGame']);

Route::get('/deletegame/{id}' , [App\Http\Controllers\GameController::class , 'deleteGame']);

Route::get('/editMessege' , [App\Http\Controllers\PublisherController::class , 'editMessege']);

Route::get('/getMessage/{id}' , [App\Http\Controllers\PublisherController::class , 'getmessage']);

Route::get('/deleteAllPublishers/{id}',[App\Http\Controllers\PublisherController::class , 'deleteAllPublishers']);

Route::get('/createMessageStatus/{id}' , [App\Http\Controllers\PublisherController::class , 'createMessageStatus']);

Route::get('/couponPage',[App\Http\Controllers\CouponController::class , 'index']);

Route::get('/couponPdf',[App\Http\Controllers\CouponController::class , 'couponPdf']);

Route::get('/getCouponeActive',[App\Http\Controllers\CouponController::class , 'getCopuneDetails']);

Route::get('/unactiveCoupone/{id}',[App\Http\Controllers\CouponController::class , 'unactiveCoupone']);

Route::get('/ExportCouponeActive',[App\Http\Controllers\CouponController::class , 'ExportCouponeActive']);

Route::get('/getSmsCoupone',[App\Http\Controllers\CouponController::class , 'getSmsCoupone']);

Route::post('/sendSmsAllCoupone',[App\Http\Controllers\CouponController::class , 'sendSmsAllCoupone']);

Route::post('/setRegBackground',[App\Http\Controllers\EventController::class , 'setRegBackground']);

Route::get('/QrAttachment' , [App\Http\Controllers\QrAttachmentController::class , 'index'])->name('qr.attachment');

Route::post('/createQrAttachment' , [App\Http\Controllers\QrAttachmentController::class , 'createQrAttachment']);

Route::get('/getPDFQR/{id}' , [App\Http\Controllers\QrAttachmentController::class , 'getPDFQR']);

Route::get('/deleteQrAttachment/{id}' , [App\Http\Controllers\QrAttachmentController::class , 'deleteQrAttachment']);

Route::get('/getcertificatepdf/{id}' , [App\Http\Controllers\PublisherController::class , 'pdfCertificate']);

Route::get('/pdfCertificate/{id}' , [App\Http\Controllers\PublisherController::class , 'pdfCertificate']);

Route::get('/pdfCertificateSingle/{id}' , [App\Http\Controllers\PublisherController::class , 'pdfCertificateSingle']);

Route::get('/sentSmsCertificateSingle/{id}' , [App\Http\Controllers\PublisherController::class , 'sentSmsCertificateSingle']);

Route::get('/sentSmsCertificateAll/{id}' , [App\Http\Controllers\PublisherController::class , 'sentSmsCertificateAll']);

Route::get('/Qr/Link' , [App\Http\Controllers\QrAttachmentController::class , 'getQrLink'])->name('qr.link');

Route::post('/Qr/Link/Create' , [App\Http\Controllers\QrAttachmentController::class , 'createQrLink'])->name('qr.link.create');

Route::get('/Qr/Link/Pdf/{id}' , [App\Http\Controllers\QrAttachmentController::class , 'pdfQrLink'])->name('qr.link.pdf');

Route::get('/Qr/Link/Pdf/delete/{id}' , [App\Http\Controllers\QrAttachmentController::class , 'deleteQrLink'])->name('qr.link.delete');


Route::group(['middleware'=>['auth','isAdmin'],'prefix'=>'polls'],function (){
    Route::get('index' , [App\Http\Controllers\PollController::class , 'index'])->name('polls.index');
    Route::get('addPage' , [App\Http\Controllers\PollController::class , 'addPagePolls'])->name('polls.addpage');
    Route::post('/addPage/create' , [App\Http\Controllers\PollController::class , 'create'])->name('polls.create');
    Route::get('/updatePage/{id}' , [App\Http\Controllers\PollController::class , 'updatePage'])->name('polls.updatePage');
    Route::post('/updatePage/{id}/update' , [App\Http\Controllers\PollController::class , 'update'])->name('polls.update');
    Route::get('delete/{id}' , [App\Http\Controllers\PollController::class , 'delete'])->name('polls.delete');
});

Route::group(['middleware'=>['auth','isAdmin'],'prefix'=>'polls/pollsOptions'],function (){
    Route::get('index/{id}' , [App\Http\Controllers\PollOptionsController::class , 'index'])->name('poll.options.index');
    Route::get('{id}/addPage' , [App\Http\Controllers\PollOptionsController::class , 'addPollOptions'])->name('poll.options.addPage');
    Route::post('create' , [App\Http\Controllers\PollOptionsController::class , 'create'])->name('poll.options.create');
    Route::get('delete/{id}' , [App\Http\Controllers\PollOptionsController::class , 'delete'])->name('poll.options.delete');
    Route::get('/pollOptionsQr/{id}' , [App\Http\Controllers\PollOptionsController::class , 'pollOptionsQr'])->name('polloptions.qr');
});

//Route::group(['middleware'=>['auth','isAdmin'],'prefix'=>'polls/pollsOptions'],function (){
//    Route::get('index/{id}' , [App\Http\Controllers\PollOptionsController::class , 'index'])->name('poll.options.index');
//    Route::get('{id}/addPage' , [App\Http\Controllers\PollOptionsController::class , 'addPollOptions'])->name('poll.options.addPage');
//    Route::post('create' , [App\Http\Controllers\PollOptionsController::class , 'create'])->name('poll.options.create');
//    Route::get('delete/{id}' , [App\Http\Controllers\PollOptionsController::class , 'delete'])->name('poll.options.delete');
//});

Route::get('/evaluation/index/{id}' , [App\Http\Controllers\PollResultController::class , 'index'])->name('pollresult.index');
Route::post('/evaluation/create' , [App\Http\Controllers\PollResultController::class , 'create'])->name('pollresult.create');

Route::get('/thanks/{id}' , function ($id){
    $query = \App\Models\Polls::where('id',$id)->get();
    return view('evaluation.thanksMessage',['query'=>$query]);
});


Route::get('/evaluation/getAllPolls' , [App\Http\Controllers\PollResultController::class , 'getAllPolls'])->name('pollresult.index2');
Route::get('/evaluation/getStatistics/{id}' , [App\Http\Controllers\PollResultController::class , 'getStatistics'])->name('pollresult.getStatistics');

Route::get('/getTimer/{id}', [App\Http\Controllers\PollResultController::class , 'getTimer']);
Route::get('/EndTimer' , [App\Http\Controllers\PollResultController::class , 'returnMessageTime']);

Route::group(['prefix'=>'Jawwal'], function (){
    Route::get('/jawwalView',[App\Http\Controllers\JawwalController::class , 'index'])->name('jawwal.index');
});

Route::get('/RoyalWinner' , [App\Http\Controllers\RoyalController::class , 'index'])->name('royal.winner');
Route::get('/getWinner' , [App\Http\Controllers\RoyalController::class , 'getWinner'])->name('royal.getWinner');
Route::get('/searchCobonIndex' , [App\Http\Controllers\CouponController::class , 'searchCobonindex'])->name('royal.searchCobon.index');
Route::post('/searchCobon' , [App\Http\Controllers\CouponController::class , 'searchCobon'])->name('royal.searchCobon');

Route::get('/royalGift' , [App\Http\Controllers\RoyalController::class , 'royalGift'])->name('royal.royalGift');











