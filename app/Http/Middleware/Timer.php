<?php

namespace App\Http\Middleware;

use App\Models\PollResult;
use App\Models\Polls;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Timer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $se = Session::get('temp_id');
        $polls = DB::select('select * from polls where id = ?',[$request->id])[0];
        $pollresult = DB::select('select * from poll_result where session_id = ? and poll_id = ?',[$se,$request->id]);
        //dd($polls);
        if ($pollresult != null){
            return redirect('/thanks/'.$pollresult[0]->poll_id);
        }

        if (($polls->start_date) > Carbon::now()->toDateString()){
            //return $next($request);
            return redirect('/getTimer/'.$polls->id);
        }

        else if (($polls->start_date) <= Carbon::now()->toDateString()) {
            if ($polls->start_time <= Carbon::now()->toTimeString()){
                return $next($request);
            }
            else{
//                return redirect('/EndTimer');
                return redirect('/thanks/'.$pollresult->poll_id);
            }
//            else if ($polls->start_time >= Carbon::now()->toTimeString()){
//                return redirect('/thanks/'.$polls->id);
//            }
        }

        else
        {
            return redirect('/thanks/'.$polls->id);
        }

        return $next($request);
    }
}
