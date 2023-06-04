<?php

namespace App\Http\Controllers;

use App\Models\Jawwal;
use Illuminate\Http\Request;

class JawwalController extends Controller
{
    public function index(){
        $jawwal = Jawwal::where('status',1)->get();
        return view('jawwal.jawwal',['jawwal'=>$jawwal]);
    }
}
