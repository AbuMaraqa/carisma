<?php

namespace App\Http\Controllers;

use App\Models\PollOptions;
use App\Models\PollResult;
use App\Models\Polls;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PollResultController extends Controller
{
    public function index($id){
        $polls = Polls::where('id',$id)->first();
        $polloptions = PollOptions::where('poll_id',$id)->get();

//        $se = Session::get('temp_id');
//
//        $query = DB::select('select * from poll_result where session_id = ?',[$se]);
//        return $query;

        if(Session::get('temp_id') == null){
            Session::put('temp_id', rand(111111,99999999));
        }
        $value = Session::get('temp_id');

        return view('evaluation.index',['polls'=>$polls,'polloptions'=>$polloptions,'value'=>$value]);
    }

    public function create(Request $request){

        $query = DB::select('select * from poll_result where session_id = ? and poll_id = ?',[Session::get('temp_id'),$request->id]);

        if ($query == null){
            $pollresult = new PollResult();
            $pollresult->poll_option_id = $request->radio;
            $pollresult->session_id = Session::get('temp_id');
            $pollresult->poll_id = $request->id;
            if ($pollresult->save()){
                return redirect('/thanks/'.$request->id);
            }
            else{
                abort(404);
            }
        }
        else{
            return redirect('/thanks/'.$request->id);
        }

    }

    public function getAllPolls(){
        $polls = Polls::get();
        return response()->json($polls);
        //return view('evaluation.index2',['polls'=>$polls]);
    }

    public function getStatistics($id){
        $polls = Polls::where('id',$id)->first();
        $polloptions = PollOptions::where('poll_id',$id)->get();
        //$count = DB::select ('SELEct COUNT(poll_result.poll_option_id) , poll_options.option_text FROM poll_result,poll_options where poll_result.poll_option_id = poll_options.id group by (poll_options.option_text);');
        $count = DB::select ('select count(poll_result.poll_option_id) as count , poll_options.option_text as text from poll_result right join poll_options on poll_result.poll_option_id = poll_options.id where poll_options.poll_id = ? group by (poll_options.option_text) order by count DESC  ',[$id]);
        $join = DB::select('select * from poll_result inner join poll_options on poll_result.poll_option_id = poll_options.id where poll_options.poll_id = ?',[$id]);

        $arrayText = PollOptions::where('poll_id',$id)->get();

        if ($polls == null){
            abort(404);
        }

        //$countJsonEndoce = DB::select ('select count(poll_result.poll_option_id) as count , poll_options.option_text as text from poll_result right join poll_options on poll_result.poll_option_id = poll_options.id where poll_options.poll_id = ? group by (poll_options.option_text) order by count DESC  ',[$id]);

        //return $join;
        return view('evaluation.statistics',['polls'=>$polls,'polloptions'=>$polloptions,'join'=>$join,'count'=>$count,'arrayText'=>$arrayText]);
    }

    public function getTimer($id){
        $query = \App\Models\Polls::where('id',$id)->get();
        return view('evaluation.timer',['query'=>$query]);
    }

    public function returnMessageTime(){
        return view('evaluation.endtimermessage');
    }
}
