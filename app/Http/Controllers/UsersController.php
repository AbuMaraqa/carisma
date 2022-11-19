<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function listUsers(){
        $list = User::all();
        //return view('users.users',['users'=>$list]);
        return view('users.users',['users'=>$list]);
    }
}
