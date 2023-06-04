<?php

namespace App\Http\Controllers;

use App\Models\Polls;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function index(){
        $polls =  Polls::get();
        return view('polls.polls',['polls'=>$polls]);
    }

    public function addPagePolls(){
        return view('polls.addpool');
    }

    public function create(Request $request){
        $polls = new Polls();
        $polls->poll_title = $request->poll_name;
        $polls->insert_date = Carbon::now();
        $polls->insert_by = Auth::user()->name;

        if($request->hasFile('poll_image')){
            $file_extention = $request->poll_image->getClientOriginalExtension();
            $file_name = time().'.'.$file_extention;
            $path = 'assets/images/BFound';
            $request->poll_image ->move($path,$file_name);
            $polls->bg_image = $file_name;
        }
        else{
            $polls->bg_image = $polls->poll_image;
        }
        $polls->start_date = $request->poll_date;
        $polls->start_time = $request->poll_time;
        $polls->duration = $request->poll_duration;
        $polls->thanks_message = $request->poll_thanks_message;

        if ($polls->save()){
            return redirect()->route('polls.index')->with('success','تم اضافة التصويت بنجاح');
        }
        else{
            return redirect()->route('polls.index')->with('fail','لم تتم الاضافة بنجاح');
        }
    }

    public function updatePage($id){
        $polls = Polls::where('id',$id)->first();
        return view('polls.updatepoll',['polls'=>$polls]);
    }

    public function update(Request $request , $id){
        $polls = Polls::find($id);
        $polls->poll_title = $request->poll_name;
        $polls->insert_by = Auth::user()->name;

        if($request->hasFile('poll_image')){
            $file_extention = $request->poll_image ->getClientOriginalExtension();
            $file_name = time().".".$file_extention;
            $path = 'assets/images/BFound';
            $request->poll_image ->move($path,$file_name);
            $polls->bg_image = $file_name;
        }

        $polls->start_date = $request->poll_date;
        $polls->start_time = $request->poll_time;
        $polls->duration = $request->poll_duration;

        if ($polls->save()){
            return redirect()->route('polls.index')->with('success','تم التعديل بنجاح');
        }
        else{
            return redirect()->route('polls.index')->with('fail','لم يتم التعديل');
        }
    }

    public function delete($id){
        $delete = Polls::where('id',$id)->delete();
        if ($delete){
            return redirect()->route('polls.index')->with('success','تم الحذف بنجاح');
        }
        else{
            return redirect()->route('polls.index')->with('fail','لم يتم الحذق');
        }
    }

    public function getTimer(){
        $query = Polls::where('id',7)->get();
        return view('evaluation.timer',['query'=>$query]);
    }
}
