<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Events;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function listEvents(){
        $list = Event::all();
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
            $destination_path = 'public/storage/images/BFound';
            $image = $request->file('eimage');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('eimage')->storeAs($destination_path,$image_name);

            $event->eimage = $image_name;
        }

        if($request->hasFile('ebackground')){
            $destination_path = 'public/storage/images/BFound';
            $image = $request->file('ebackground');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('ebackground')->storeAs($destination_path,$image_name);

            $event->ebackground = $image_name;
        }

        $event->estatus = true;

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

        //$request->ename = $event->ename;

        //return $query;
        return view('events.updateevent',['query'=>$query]);
    }

    public function updateEvents(Request $request,$id){
        //$find = DB::select('select * from events where eid = :eid',['eid'=>$id])[0];

        $event = DB::update('update events set ename = ? ,edate = ? ,edescription = ? ,estatus = ? where eid  = ?' ,
            [$request->ename,$request->edate,$request->edescription,$request->estatus,$id]);

        if ($event)
        {
            return ['status'=>'true'];
        }
        else
        {
            return ['status'=>'false'];
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

}
