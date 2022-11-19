<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ecount = DB::select('select count(eid) as count from events')[0];
        $pcount = DB::select('select count(pid) as count from publishers')[0];
        return view('index',['ecount'=>$ecount,'pcount'=>$pcount]);
    }
}
