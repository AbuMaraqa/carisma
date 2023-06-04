<?php

namespace App\Http\Controllers;

use App\Models\ParticipantRoyal;
use Illuminate\Http\Request;

class RoyalController extends Controller
{
    public function index(){
        $query = ParticipantRoyal::where('status',1)->orderByRaw('RAND()')->first();
        return view('win.index2');
    }

    public function getWinner(){
        $query = ParticipantRoyal::where('status',1)->orderByRaw('RAND()')->first();
        return response()->json([
            'data'=>$query
        ]);
    }

    public function royalGift(){
        return view('win.gift.index');
    }
}
