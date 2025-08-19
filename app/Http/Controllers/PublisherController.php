<?php

namespace App\Http\Controllers;

use App\Exports\PublisherDataExport;
use App\Imports\PublisherImport;
use App\Models\Event;
use App\Models\MainSetting;
use App\Models\Publisher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\CountValidator\Exact;
use Mpdf\Http\Response;
use Mpdf\Tag\Input;
use PDF;
use function GuzzleHttp\Promise\all;

class PublisherController extends Controller
{

    public function index(){
        $list = Publisher::all();
        return view('publisher.publisher',['users'=>$list]);
    }

    public function createPublisher(Request $request){

        $validated = $request->validate([
            'pphone' => 'required|numeric|digits:10'
        ],
            [
                'pphone' => 'يجب ادخال رقم هاتف صالح'
            ]);

        $data = new Publisher();

        $status = DB::select('select * from publishers');
        if ($status[0] == null){
            $data->petstatus = false;
            $data->plunchstatus = false;
            $data->pgiftstatus = false;
            $data->peffict1status = false;
            $data->peffict2status = false;
        }

        //$data = DB::insert('insert into publishers (peventid,pname,pphone,pemail,pprofession) values (?,?,?,?,?)',[$request->peventid,$request->pname,$request->pphone,$request->pemail,$request->pprofession]);

        $data->peventid = $request->peventid;
        $data->pname = $request->pname;
        $data->pphone = $request->pphone;
        $data->pemail = $request->pphone;
        $data->pprofession = $request->pprofession;



        if ($data->save()){
            return redirect('/getEventId/'.$request->peventid)->with('success','تم اضافة المشارك بنجاح');
        }
        else{
            return back()->with('fail','لم يتم اضافة المشارك');
        }
    }


    public function updatePublisher(Request $request,$id){

        $publisher = DB::update('update publishers set peventid = ? , pname = ? , pemail = ? ,pprofession = ? ,pet = ? , pgift = ? , plunch = ? , peffict1 = ? , peffict2 = ? where pid = ?',
            [$request->peventid,$request->pname,$request->pemail,$request->pprofession,$request->pet,$request->pgift,$request->plunch,$request->peffict1,$request->peffict2,$id]);

        if ($publisher){
            return back()->with('success','تم تعديل المناسبة بنجاح');
        }
        else{
            return back()->with('fail','هناك خطا يرجى تعبئة البيانات المطلوبة');
        }
    }

    public function getEvent(){
        $list = DB::select('SELECT ename,pname FROM publishers INNER JOIN events ON events.eid = publishers.peventid;');
        return $list;
    }

    public function addPublisher($id){
        return view('publisher.addpublisher',['id'=>$id]);
    }

    public function generatePdf($id)
    {
//        $publisher = DB::select('select * from publishers where pid = :id',['id'=>$id]);
//        //return $publisher->pname;
//        $pdf = PDF::loadView('pdf.pdf', ['publisher'=>$publisher])->setOption('defaultFont', 'Courier');
//        return $pdf->stream('document.pdf');

        $query = DB::select('select * from publishers INNER JOIN events on publishers.peventid = events.eid where publishers.pid = ?',[$id])[0];

        $publisher = DB::select('select * from publishers where pid = :id',['id'=>$id]);
        $pdf = PDF::loadView('pdf.pdf', ['publisher'=>$publisher,'query'=>$query]);
        //$pdf = PDF::chunkLoadView('<html-separator/>', 'pdf.pdf', ['publisher',$publisher]);
        return $pdf->stream('document.pdf');
    }


    public function exportExcel($id){
        return Excel::download(new PublisherDataExport($id), 'userData.xlsx');
    }

    public function getpublisherLogin(Request $request){


        $time = Carbon::now();
        $action = $request->action;
        //$publisher = DB::update('update publishers set '.$action.' = ? where pid = ?',[$time,$request->pid]);

        $query2 = DB::select('select * from publishers where peventid = (select mainevent from settings where id = 1) and pid = ?',[$request->pid]);

        $smsID = DB::select('select * from events where eid = (select mainevent from settings where id = 1)');

        if($query2 == null){
            return ['status'=>'clear'];
        }

        $query3 = DB::select('select * from events where eid = (select mainevent from settings where id = 1)')[0];

        if (($query2[0]->$action == null))
        {

            if ($request->action == 'pet'){
                if ($smsID[0]->petstatus == true){
                    $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Event%20SMS&to";
                    $headers = array('Content-Type: application/json');
                    $url = $message . "&to=" . urlencode($query2[0]->pphone) . "&msg=" . urlencode("{$smsID[0]->petmessage}");
                    $fields = array();
                    $ch1 = curl_init();
                    curl_setopt($ch1, CURLOPT_URL, $url);
                    curl_setopt($ch1, CURLOPT_POST, true);
                    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result1 = curl_exec($ch1);
                    curl_close($ch1);
                }
            }
            if ($request->action == 'plunch'){
                if ($smsID[0]->plunchstatus == true ){
                    $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Event%20SMS&to";
                    $headers = array('Content-Type: application/json');
                    $url = $message . "&to=" . urlencode($query2[0]->pphone) . "&msg=" . urlencode("{$smsID[0]->plunchmessage}");
                    $fields = array();
                    $ch1 = curl_init();
                    curl_setopt($ch1, CURLOPT_URL, $url);
                    curl_setopt($ch1, CURLOPT_POST, true);
                    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result1 = curl_exec($ch1);
                    curl_close($ch1);
                }
            }
            if ( $request->action == 'pgift'){
                if ($smsID[0]->pgiftstatus == true){
                    $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Event%20SMS&to";
                    $headers = array('Content-Type: application/json');
                    $url = $message . "&to=" . urlencode($query2[0]->pphone) . "&msg=" . urlencode("{$smsID[0]->pgiftmessage}");
                    $fields = array();
                    $ch1 = curl_init();
                    curl_setopt($ch1, CURLOPT_URL, $url);
                    curl_setopt($ch1, CURLOPT_POST, true);
                    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result1 = curl_exec($ch1);
                    curl_close($ch1);
                }
            }
            if ( $request->action == 'peffict1'){
                if ($smsID[0]->peffict1status == true){
                    $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Event%20SMS&to";
                    $headers = array('Content-Type: application/json');
                    $url = $message . "&to=" . urlencode($query2[0]->pphone) . "&msg=" . urlencode("{$smsID[0]->peffict1message}");
                    $fields = array();
                    $ch1 = curl_init();
                    curl_setopt($ch1, CURLOPT_URL, $url);
                    curl_setopt($ch1, CURLOPT_POST, true);
                    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result1 = curl_exec($ch1);
                    curl_close($ch1);
                }
            }
            if ($request->action == 'peffict2'){
                if ( $smsID[0]->peffict2status == true){
                    $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Event%20SMS&to";
                    $headers = array('Content-Type: application/json');
                    $url = $message . "&to=" . urlencode($query2[0]->pphone) . "&msg=" . urlencode("{$smsID[0]->peffict2message}");
                    $fields = array();
                    $ch1 = curl_init();
                    curl_setopt($ch1, CURLOPT_URL, $url);
                    curl_setopt($ch1, CURLOPT_POST, true);
                    curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields));
                    $result1 = curl_exec($ch1);
                    curl_close($ch1);
                }
            }

            $query = DB::update('update publishers set '.$action.' = ? where peventid = (select mainevent from settings where id = 1) and pid = ? ',[$time,$request->pid]);
            if ($query){

                return [$query2,'status'=>'true'];
            }
            else{
                return [$query2,'status'=>'false'];
            }
        }
        else{
            return [$query2,'status' => 'false'];
        }


    }

    public  function getPublisherid($id){
        $list = DB::select('select * from publishers where pid = ?',[$id]);
        return view('publisher.details',['list'=>$list]);
    }

    public function storeExcel(Request $request){
        $file = $request->file('file');
    }

    public function publisherImport(Request $request,$id){

        $validation = Validator::make($request->all(),[
            'attatchment'=>'required|mimes:xlsx,xls'

        ],
            [
                'attatchment' => "يرجى اضافة ملف من نوع اكسيل"
            ]);

        if ($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $file = $request->file('attatchment');



        if (Excel::import(new PublisherImport($id),$file)){
            return redirect()->back()->with([
                'success'=>'عملية الاستيراد قيد التنفيذ',
                'alert-type'=>'success'
            ]);
        }
        else{
            return redirect()->back()->with([
                'fail'=>'هناك خطا',
                'alert-type'=>'success'
            ]);
        }


    }

    public function exporttopdfall($id){
        $query = DB::select('select * from events where eid = ?',[$id])[0];
        $list = DB::select('select * from publishers where peventid = ?',[$id]);
        if ($list == null){
            return back()->with('fail','لا توجد بيانات لعرضها');
        }
        else{
            $pdf = PDF::loadView('pdf.pdfAll', ['list'=>$list,'query'=>$query]);
            return $pdf->stream('document.pdf');
        }
    }

    public function deletePublisher($id){
        $query = DB::table('publishers')->where('pid',$id)->delete();

        if ($query){
            return back()->with('success','تم حذف المشارك بنجاح');
        }
        else{
            return back()->with('fail','لم يتم حذف المشارك');
        }
    }

    public function smsSingle($id){
        $query = DB::select('select * from publishers where pid = ?',[$id])[0];
        return view('SMS.smssingle',['query'=>$query,'id'=>$id]);
    }

    public function smsAll($id){
        $query = DB::select('select * from publishers where peventid = ?',[$id]);
        return view('SMS.smsall',['query'=>$query,'id'=>$id]);
    }

    public function sentSmsSingle(Request $request,$id){
        $query = DB::select('select * from publishers where pid = ?',[$id])[0];
        $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Event%20SMS&to";

        $headers = array('Content-Type: application/json');
        $url = $message . "&to=" . urlencode($query->pphone) . "&msg=" . urlencode("$request->message");


        $fields = array();
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url);
        curl_setopt($ch1, CURLOPT_POST, true);
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields));
        $result1 = curl_exec($ch1);
        curl_close($ch1);
        return redirect()->back()->with('success','تم ارسال الرسالة بنجاح');

//        if (!function_exists('curl_init')){
//            die('CURL is not installed!');
//        }
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $message);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $output = curl_exec($ch);
//        curl_close($ch);
//        if ($output){
//            return redirect()->back()->with('success','تم ارسال الرسالة بنجاح');
//        }
//        else{
//            return redirect()->back()->with('fail','لم يتم ارسال الرسالة');
//        }
    }

    public function sendSMSAll(Request $request,$id){
        $query = DB::select('select * from publishers where peventid = ?',[$id]);
        $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Event%20SMS&to";

        foreach ($query as $k){
            $headers = array('Content-Type: application/json');
            $url = $message . "&to=" . urlencode($k->pphone) . "&msg=" . urlencode("$request->message");

            $fields = array();
            $ch1 = curl_init();
            curl_setopt($ch1, CURLOPT_URL, $url);
            curl_setopt($ch1, CURLOPT_POST, true);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields));
            $result1 = curl_exec($ch1);
            curl_close($ch1);
        }

        return redirect('/getEventId/'.$query->peventid)->with('success','تم ارسال الرسالة بنجاح');
    }

    public function editMessege(Request $request){
        $query = DB::select('select * from publishers');

        if($request->petcheck === 'true'){
            DB::update('update publishers set petstatus = ? , petmessage = ?',[true,$request->petinput]);
        }
        else if($request->petcheck != 'true'){
            DB::update('update publishers set petstatus = ? ',[false]);
        }

        if($request->plunchcheck === 'true'){
            DB::update('update publishers set plunchstatus = ? , plunchmessage = ?',[true,$request->plunchinput]);
        }
        else if($request->plunchcheck != 'true'){
            DB::update('update publishers set plunchstatus = ?',[false]);
        }

        if($request->pgiftcheck === 'true'){
            DB::update('update publishers set pgiftstatus = ? , pgiftmessage = ?',[true,$request->pgiftinput]);
        }
        else if($request->pgiftcheck != 'true'){
            DB::update('update publishers set pgiftstatus = ?',[false]);
        }

        if($request->peffict1check === 'true'){
            DB::update('update publishers set peffict1status = ? , peffict1message = ?',[true,$request->peffict1input]);
        }
        else if($request->peffict1check != 'true'){
            DB::update('update publishers set peffict1status = ?',[false]);
        }

        if($request->peffict2check === 'true'){
            DB::update('update publishers set peffict2status = ? , peffict2message = ?',[true,$request->peffict2input]);
        }
        else if($request->peffict2check != 'true'){
            DB::update('update publishers set peffict2status= ?',[false]);
        }

        return redirect()->back()->with('success','تم التعديل بنجاح');

    }

    public function getmessage($id){

        $query = DB::select('select * from events where eid = ?',[$id]);
        return view('publisher.setting',['events'=>$query,'id'=>$id]);
    }

    public function createMessageStatus(Request $request,$id){

        $certificatemessage  = DB::update('update events set certificatemessage = ? where eid = ?',[$request->message,$id]);

        if($request->petcheck === 'true'){
            DB::update('update events set petstatus = ? , petmessage = ? where eid = ?',[true,$request->petinput,$id]);
        }
        else if($request->petcheck != 'true'){
            DB::update('update events set petstatus = ? , petmessage = ? where eid = ?',[false,$request->petinput,$id]);
        }

        if($request->plunchcheck === 'true'){
            DB::update('update events set plunchstatus = ? , plunchmessage = ? where eid = ?',[true,$request->plunchinput,$id]);
        }
        else if($request->plunchcheck != 'true'){
            DB::update('update events set plunchstatus = ? , plunchmessage = ? where eid = ?',[false,$request->plunchinput,$id]);
        }

        if($request->pgiftcheck === 'true'){
            DB::update('update events set pgiftstatus = ? , pgiftmessage = ? where eid = ?',[true,$request->pgiftinput,$id]);
        }
        else if($request->pgiftcheck != 'true'){
            DB::update('update events set pgiftstatus = ? , pgiftmessage = ? where eid = ?',[false,$request->pgiftinput,$id]);
        }

        if($request->peffict1check === 'true'){
            DB::update('update events set peffict1status = ? , peffict1message = ? where eid = ?',[true,$request->peffict1input,$id]);
        }
        else if($request->peffict1check != 'true'){
            DB::update('update events set peffict1status = ? , peffict1message = ? where eid = ?',[false,$request->peffict1input,$id]);
        }

        if($request->peffict2check === 'true'){
            DB::update('update events set peffict2status = ? , peffict2message = ? where eid = ?',[true,$request->peffict2input,$id]);
        }
        else if($request->peffict2check != 'true'){
            DB::update('update events set peffict2status= ? , peffict2message = ? where eid = ?',[false,$request->peffict2input,$id]);
        }

        $certificatemessage;
        return redirect()->back()->with('success','تم التعديل بنجاح');
    }

    public function pdfCertificate($id){
        $query = DB::select('select * from events where eid = ?',[$id])[0];
        $list = DB::select('select * from publishers where peventid = ?',[$id]);
        if ($list == null){
            return back()->with('fail','لا توجد بيانات لعرضها');
        }
        else{
            $pdf = PDF::loadView('pdf.pdfcertificate', ['list'=>$list,'query'=>$query],[],['title'=>'Certificate','format'=>'A4-L','orientation'=>'L']);
            return $pdf->stream('Certificate.pdf');
        }
    }

    public function pdfCertificateSingle($id){
        //$query = DB::select('select * from events where eid = ?',[$id])[0];
        //$list = DB::select('select * from publishers where pid = ?',[$id]);
        $query = DB::select('select * from publishers INNER JOIN events on publishers.peventid = events.eid where publishers.pid = ?',[$id])[0];
        if ($query == null){
            return back()->with('fail','لا توجد بيانات لعرضها');
        }
        else{
            $pdf = PDF::loadView('pdf.pdfcertificatesingle', ['query'=>$query],[],['title'=>'Certificate','format'=>'A4-L','orientation'=>'L']);
            return $pdf->dawnload('Certificate.pdf');
        }
    }

    public function sentSmsCertificateSingle(Request $request,$id){
        $query = DB::select('select * from publishers where pid = ?',[$id])[0];
        $event = DB::select('select * from events where id = ?', [$id]);
        $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Event%20SMS&to";
        $host = $request->getSchemeAndHttpHost();
        $headers = array('Content-Type: application/json');
        $url = $message . "&to=" . urlencode($query->pphone) . "&msg=" . urlencode($event[0]->certificatemessage." "."$host/pdfCertificateSingle/$id");


        $fields = array();
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $url);
        curl_setopt($ch1, CURLOPT_POST, true);
        curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields));
        $result1 = curl_exec($ch1);
        curl_close($ch1);
        return redirect()->back()->with('success','تم ارسال الرسالة بنجاح');

//        if (!function_exists('curl_init')){
//            die('CURL is not installed!');
//        }
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $message);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        $output = curl_exec($ch);
//        curl_close($ch);
//        if ($output){
//            return redirect()->back()->with('success','تم ارسال الرسالة بنجاح');
//        }
//        else{
//            return redirect()->back()->with('fail','لم يتم ارسال الرسالة');
//        }
    }

    public function sentSmsCertificateAll(Request $request,$id)
    {
        $query = DB::select('select * from publishers where peventid = ?', [$id]);
        $event = DB::select('select * from events where id = ?', [$id]);
        $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Event%20SMS&to";
        $host = $request->getSchemeAndHttpHost();

        foreach ($query as $k) {
            $headers = array('Content-Type: application/json');
            $url = $message . "&to=" . urlencode($k->pphone) . "&msg=" . urlencode($event[0]->certificatemessage." "."$host/pdfCertificateSingle/$k->pid");
            $fields = array();
            $ch1 = curl_init();
            curl_setopt($ch1, CURLOPT_URL, $url);
            curl_setopt($ch1, CURLOPT_POST, true);
            curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch1, CURLOPT_POSTFIELDS, json_encode($fields));
            $result1 = curl_exec($ch1);
            curl_close($ch1);
        }
        return redirect()->back()->with('success', 'تم ارسال الرسالة بنجاح');
    }

    public function deleteCheck(Request $request){
        $id = $_GET['id'];
        Publisher::where('pid',$id)->delete();
    }

    public function deleteAllPublishers($id){
        $delete = Publisher::where('peventid',$id)->get();
        if ($delete->isEmpty()){
            return \redirect()->back()->with('fail','لا يوجد مشتركين لحذفهم');
        }
        else{
            foreach ($delete as $key){
                Publisher::where('pid',$key->pid)->delete();
            }
            return \redirect()->back()->with('success','تم حذف المشتركين بنجاح');
        }
        return $delete;
    }

    public function eventsFieldPage($eventid)
    {
        $event = Event::find($eventid);
        return view('publisher.events_fields',['eventid'=>$eventid , 'event'=>$event]);
    }
}
