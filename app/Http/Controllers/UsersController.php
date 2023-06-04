<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function listUsers(){
        $list = User::all();
        //return view('users.users',['users'=>$list]);
        return view('users.users',['users'=>$list]);
    }

    public function getAddPageUser(){
        return view('users.adduser');
    }

    public function createUser(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_level = $request->user_level;

        if ($user->save()){
            return redirect()->back()->with('success','تم اضافة المستخدم بنجاح');
        }
        else{
            return redirect()->back()->with('fail','لم يتم اضافة المستخدم');
        }
    }

    public function getUserData($id){
        $find = DB::select('select * from users where id = ?',[$id]);
        return view('users.edituser',['user'=>$find,'id'=>$id]);
    }

    public function updateUser(Request $request,$id){
        $update = DB::update('update users set name = ? , email = ? , password = ? , user_level = ? where id = ?',[$request->name,$request->email,Hash::make($request->password),$request->user_level,$id]);
        if ($update){
            return redirect()->back()->with('success','تم تعديل المستخدم بنجاح');
        }
        else{
            return redirect()->back()->with('fail','لم يتم تعديل المستخدم');
        }
    }

    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', '=', $email)->first();
        if (!$user) {
            return response()->json(['success'=>false, 'message' => 'Login Fail, please check email id']);
        }
        if (!Hash::check($password, $user->password)) {
            return response()->json(['success'=>false, 'message' => 'Login Fail, pls check password']);
        }
        return response()->json(['success'=>true,'message'=>'success', 'data' => $user]);
    }

}
