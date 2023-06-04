<?php

namespace App\Http\Controllers;

use App\Models\MainSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainSettingController extends Controller
{
    public function updateMainEvent(Request $request){

        $query = DB::update('update settings set mainevent = ? where id = 1',[$request->dropdownlist]);

        if ($query){
            return back()->with('success','تم التعديل بنجاح');
        }
        else{
            return back()->with('fail','لم يتم اجراء اي تعديل');
        }
    }

    public function index(){
        $query = DB::select('select * from settings');
        return view('setting.index',['query'=>$query]);
    }

}
