<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Events;
use App\Models\MainSetting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Redirector;

class EventController extends Controller
{
    public function listEvents(){
        $list = Event::orderBy('eid','DESC')->get();
        return view('events.events',['events'=>$list]);
    }

    public function createEvent(Request $request){

        $request->validate([
            'ename'=>'required',
            'edate'=>'required',
        ],
        [
            'ename'=>'يرجى ملئ حقل الاسم',
            'edate' => 'يرجى ملئ حقل التاريخ'
        ]);

        $event = new Event();
        $event->ename = $request->ename;
        $event->edate = $request->edate;
        $event->edescription = $request->edescription;

        if($request->hasFile('eimage')){
            $file_extention = $request->eimage ->getClientOriginalName();
            $file_name = time().".".$file_extention;
            $path = 'storage/images/BFound';
            $request->eimage ->move($path,$file_name);
            $event->eimage = $file_name;
        }

        if($request->hasFile('ebackground')){
            $file_extention = $request->ebackground ->getClientOriginalName();
            $file_name = time().".".$file_extention;
            $path = 'storage/images/BFound';
            $request->ebackground ->move($path,$file_name);
            $event->ebackground = $file_name;
            }

        $event->estatus = true;
        $event->AuthUser = $request->dropdownlist;

//        $imageName = time().'.'.request()->image->getClientOriginalExtension();
//        request()->image->move(public_path('images'), $imageName);
//        $event->image = $imageName;

        if ($event->save()){
            return back()->with('success','تم اضافة البيانات بنجاح');
        }
        else{
            return back()->with('fail','يرجى ملئ الحقول اللازمة');
        }
    }

    public function getDataUpdate($id){

        $query = DB::select('select * from events where eid = ?',[$id]);
        $user = DB::select('select * from users');
        //$request->ename = $event->ename;
        //return $query;
        return view('events.updateevent',['query'=>$query,'user'=>$user]);
    }

    public function updateEvents(Request $request,$id){

        $post = DB::select('select * from events where eid = ?',[$id])[0];

        $photo = "";
        if($request->hasFile('eimage')){
            $file_extention = $request->eimage ->getClientOriginalName();
            $file_name = time().".".$file_extention;
            $path = 'assets/images/BFound';
            $request->eimage ->move($path,$file_name);
            $photo = $file_name;
        }
        else{
            $photo = $post->eimage;
        }

        $background = "";

        if($request->hasFile('ebackground')){
            $file_extention = $request->ebackground ->getClientOriginalName();
            $file_name = time().".".$file_extention;
            $path = 'assets/images/BFound';
            $request->ebackground ->move($path,$file_name);
            $background = $file_name;
        }
        else{
            $background = $post->ebackground;
        }

        $certificateimage = "";

        if($request->hasFile('attatchment')){
            $file_extention = $request->attatchment ->getClientOriginalName();
            $file_name = time().".".$file_extention;
            $path = 'assets/images/BFound';
            $request->attatchment ->move($path,$file_name);
            $certificateimage = $file_name;
        }
        else{
            $certificateimage = $post->certificateimage;
        }

        if ($post)
        {
            DB::update('update events set ename = ? , edate = ? , edescription = ? , estatus = ? , eimage = ? , ebackground = ? , AuthUser = ? , certificateimage = ? where eid = ?',[$request->ename,$request->edate,$request->edescription,true,$photo,$background,$request->dropdownlist , $certificateimage,$id]);
            return back()->with('success','تم التعديل بنجاح');
        }
        else
        {
            return back()->with('fail','لم يتم التعديل');
        }


    }

    public function statusDisable(Request $request,$id){
        $status = DB::update('update events set estatus = ? where eid = ?',[$request->estatus,$id]);

        if($status){
            return ['status'=>'true'];
        }
        else{
            return ['status'=>'false'];
        }
    }

    public function getEventId($id){
        $query = DB::select('select * from publishers where peventid = :id',['id'=>$id]);
        $event = DB::select('select * from events where eid = :id',['id'=>$id]);
        return view('publisher.index',['list'=>$query,'event'=>$event,'id'=>$id],compact('query'));
    }

    public function getEventIdAPI($id){
        $query = DB::select('select * from publishers where peventid = :id',['id'=>$id]);
        $event = DB::select('select * from events where eid = :id',['id'=>$id]);
        return $query;
    }

    public function deleteEvent($id){
        $query = DB::table('events')->where('eid',$id)->delete();

        if ($query){
            return back()->with('success','تم حذف المناسبة بنجاح');
        }
        else{
            return back()->with('fail','لم يتم حذف المناسبة');
        }
    }

    public function settingEvent(){
        $query = DB::table('events')->get();
        $publisher = DB::table('publishers')->get();
        return view('setting.index',['query'=>$query,'publishers'=>$publisher]);
    }

    public function getEventName(){
        $query = DB::select('select * from settings inner join events on settings.mainevent = events.eid where settings.id = 1');
        return $query;
    }

    public function setRegBackground(Request $request){

        $background = "";
        if($request->hasFile('image')){
            $file_extention = $request->image ->getClientOriginalName();
            $file_name = time().".".$file_extention;
            $path = 'assets/images/BFound';
            $request->image ->move($path,$file_name);
            $background = $file_name;
        }

        $query = DB::update('update events set regbackground = ?',[$background]);

        if ($query){
            return redirect()->back()->with('success','تم تعديل الصورة بنجاح');
        }
        else{
            return redirect()->back()->with('fail','يرجى اضافة صورة');
        }
    }



}
