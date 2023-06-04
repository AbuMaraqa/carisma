<?php

namespace App\Http\Controllers;

use App\Exports\CobonExport;
use App\Models\ParticipantRoyal;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;


class CouponController extends Controller
{
    public function index(){
        return view('royal.coupon');
    }

    public function couponPdf(){
        $query = DB::select('select * from participant_royal');
        ini_set('max_execution_time', '500');
        ini_set("pcre.backtrack_limit", "5000000");
        if ($query == null){
            return back()->with('fail','لا توجد كوبونات لعرضها');
        }
        else{
            $pdf = PDF::loadView('pdf.pdfcoupon', ['query'=>$query]);
            return $pdf->stream('document.pdf');
        }
    }

    public function getCopuneDetails(){
        $query = DB::select('select * from participant_royal where status  = 1');
        return view('royal.couponactive',['query'=>$query]);
    }

    public function unactiveCoupone($id){
        $query = DB::update('update participant_royal set pname = ?,pphone = ?,insertat = ?,insertby = ? , status = ? where pcobon = ?',[null,null,null,null,null,$id]);
        if ($query){
            return redirect()->back()->with('success','تم التعديل بنجاح');
        }
        else{
            return redirect()->back()->with('fail','لم يتم التعديل');
        }
    }

    public function ExportCouponeActive(){
        return Excel::download(new CobonExport(),'couponeActive.xlsx');
    }

    public function getSmsCoupone(){
        return view('royal.smsall');
    }

    public function sendSmsAllCoupone(Request $request){
        $query = DB::select('select * from participant_royal where status = 1');
        $message = "http://sms.supercode.ps/API/SendSMS.aspx?id=634a57f01743d3be86e6d465e8c96c4e&sender=Royal%20Fuel&to";

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

        return redirect()->back()->with('success','تم ارسال الرسالة بنجاح');
    }

    public function searchCobonindex(){
        return view('win.searchcobon');
    }

    public function searchCobon(Request $request){
        $data = ParticipantRoyal::where(['pcobon'=>$request->pcobon])->get();
        if (!$data->isEmpty()){
            return view('win.searchResult',['data'=>$data]);
        }
        else{
            return redirect()->route('royal.searchCobon.index')->with(['fail'=>'لا يتوفر كوبون بهذا الرقم']);
        }
    }
}
