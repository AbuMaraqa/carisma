<?php

namespace App\Http\Controllers;

use App\Exports\PublisherDataExport;
use App\Imports\PublisherImport;
use App\Models\Event;
use App\Models\Publisher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\CountValidator\Exact;
use PDF;
use function GuzzleHttp\Promise\all;

class PublisherController extends Controller
{

    public function index(){
        $list = Publisher::all();
        return view('publisher.publisher',['users'=>$list]);
    }

    public function createPublisher(Request $request){

        $data = DB::insert('insert into publishers (peventid,pname,pphone,pemail,pprofession) values (?,?,?,?,?)',[$request->peventid,$request->pname,$request->pphone,$request->pemail,$request->pprofession]);

        if ($data){
            return back()->with('success','تم اضافة المشارك بنجاح');
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


        $publisher = DB::select('select * from publishers where pid = :id',['id'=>$id]);
        $pdf = PDF::loadView('pdf.pdf', ['publisher'=>$publisher]);
        //$pdf = PDF::chunkLoadView('<html-separator/>', 'pdf.pdf', ['publisher',$publisher]);
        return $pdf->stream('document.pdf');
    }


    public function exportExcel($id){
        return Excel::download(new PublisherDataExport($id), 'userData.xlsx');
    }

    public function getpublisherLogin(Request $request){

        $time = Carbon::now();
        $action = $request->action;
        $publisher = DB::update('update publishers set '.$action.' = ? where pid = ?',[$time,$request->pid]);




        if ($publisher){
            return ['status'=>'true'];
        }
        else{
            return ['status'=>'false'];
        }
    }

    public  function getPublisherid($id){
        $list = DB::select('select * from publishers where pid = ?',[$id]);
        return view('publisher.details',['list'=>$list]);
    }

    public function storeExcel(Request $request){
        $file = $request->file('file');
    }

    public function publisherImport(Request $request){

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

        Excel::queueImport(new PublisherImport,$file);

        return redirect()->back()->with([
            'success'=>'عملية الاستيراد قيد التنفيذ',
            'alert-type'=>'success'
        ]);
    }

    public function exporttopdfall($id){
        $list = DB::select('select * from publishers where peventid = ?',[$id]);
        $pdf = PDF::loadView('pdf.pdfAll', ['list'=>$list]);
        return $pdf->stream('document.pdf');
    }

}
