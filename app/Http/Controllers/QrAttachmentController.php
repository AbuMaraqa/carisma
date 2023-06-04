<?php

namespace App\Http\Controllers;

use App\Models\QrAttachment;
use App\Models\QrLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class QrAttachmentController extends Controller
{
    public function index(Request $request){
        $query = DB::select('select * from qr_attachment');
        $host = $request->getSchemeAndHttpHost();
        return view('Qr_attachment.index',['query'=>$query,'host'=>$host]);
    }

    public function createQrAttachment(Request $request){
        $qr = new QrAttachment();
        //$qr->attachmentFile = $request->attatchment;

        if($request->hasFile('attatchment')){
            $file_extention = $request->attatchment->getClientOriginalExtension();
            $file_name = time().".".$file_extention;
            //$file_name = time();
            $path = public_path('attachment/BFound');
            $request->attatchment ->move($path,$file_name);
            $qr->attachmentFile = $file_name;
        }

        $qr->description = $request->description;

        if ($qr->save()){
            return redirect()->back()->with('success','تم اضافة البيانات بنجاح');
        }
        else{
            return redirect()->back()->with('fail','لم يتم اضافة البيانات');
        }
    }

    public function getPDFQR(Request $request,$id){
        $query = DB::select('select * from qr_attachment where id = ?',[$id])[0];
        $host = $request->getSchemeAndHttpHost();
        //$list = DB::select('select * from publishers where peventid = ?',[$id]);
        if ($query == null){
            return back()->with('fail','لا توجد بيانات لعرضها');
        }
        else{
            $pdf = PDF::loadView('pdf.pdfqrattachment', ['query'=>$query,'id'=>$id,'host'=>$host]);
            return $pdf->stream('document.pdf');
        }
    }

    public function deleteQrAttachment($id){
        $query = DB::delete('delete from qr_attachment where id = ?',[$id]);
        if ($query){
            return redirect()->back()->with('success','تم حذف الرابط بنجاح');
        }
        else{
            return redirect()->back()->with('fail','لم بتم حذف الرابط');
        }
    }

    public function getQrLink(Request $request){
        //$host = $request->getSchemeAndHttpHost();
        $query = DB::select('select * from qr_link');
        return view('Qr_attachment.qrlink',['query'=>$query]);
    }

    public function createQrLink(Request $request){
        $qr = new QrLink();
        $qr->url_link = $request->link;
        $qr->description = $request->description;

        if ($qr->save()){
            return redirect()->route('qr.link')->with('success','تم اضافة البيانات بنجاح');
        }
        else{
            return redirect()->route('qr.link')->with('fail','لم يتم اضافة البيانات');
        }
    }

    public function pdfQrLink($id){
        $query = DB::select('select * from qr_link where id = ?',[$id])[0];
        //$host = $request->getSchemeAndHttpHost();
        //$list = DB::select('select * from publishers where peventid = ?',[$id]);
        if ($query == null){
            return back()->with('fail','لا توجد بيانات لعرضها');
        }
        else{
            $pdf = PDF::loadView('pdf.pdfqrlink', ['query'=>$query,'id'=>$id]);
            return $pdf->stream('document.pdf');
        }
    }

    public function deleteQrLink($id){
        $query = DB::delete('delete from qr_link where id = ?',[$id]);
        if ($query){
            return redirect()->back()->with('success','تم حذف الرابط بنجاح');
        }
        else{
            return redirect()->back()->with('fail','لم بتم حذف الرابط');
        }
    }
}
