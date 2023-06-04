<?php

namespace App\Http\Controllers;

use App\Models\PollOptions;
use App\Models\PollResult;
use App\Models\Polls;
use Illuminate\Http\Request;
use PDF;


class PollOptionsController extends Controller
{
    public function index($id){
        $pollsOption = \App\Models\PollOptions::where('poll_id',$id)->get();
        $polls = Polls::where('id',$id)->first();
        return view('polls.polloptions.polloption',['pollsOption'=>$pollsOption,'polls'=>$polls]);
    }

    public function addPollOptions($id){
        return view('polls.polloptions.addpolloption',['id'=>$id]);
    }

    public function create(Request $request){
        $pooloption = new \App\Models\PollOptions();
        $pooloption->poll_id = $request->id;
        $pooloption->option_text = $request->polloption_name;
        if ($pooloption->save()){
            return redirect()->route('poll.options.index',['id'=>$request->id])->with('success','تم اضافة الخيار بنجاح');
        }
        else{
            return redirect()->route('poll.options.index',['id'=>$request->id])->with('fail','لم يتم اضافة الخيار');
        }
    }

    public function delete($id){
        $find = PollOptions::where('id',$id)->first();
        $polls = Polls::where('id',$id)->first();
        $delete = PollOptions::where('id',$id)->delete();
        if ($delete){
            return redirect()->route('poll.options.index',['id'=>$find->poll_id])->with('success','تم الحذف بنجاح');
        }
        else{
            return redirect()->route('poll.options.index',['id'=>$find->poll_id])->with('fail','لم يتم الحذق');
        }
    }

    public function pollOptionsQr(Request $request,$id){
        $host = $request->getSchemeAndHttpHost();
        $query = Polls::where('id',$id)->get();
        $pdf = PDF::loadView('polls.polloptions.pollqrpdf',['query'=>$query,'host'=>$host],[],['title'=>'Certificate','format'=>'A4-L','orientation'=>'L']);
        return $pdf->stream('Certificate.pdf');
    }
}
