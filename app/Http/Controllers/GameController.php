<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameController extends Controller
{
    public function index(){
        $query = DB::select('select * from games');
        return view('game.game',['query'=>$query]);
    }

    public function getAddPageGame(){
        return view('game.addgame');
    }

    public function createGame(Request $request){

        $game = new Game();
        $game->name = $request->name;
        $game->link = $request->link;
        $game->description = $request->description;

        if ($game->save()){
            return redirect()->back()->with('success','تم اضافة البيانات بنجاح');
        }
        else{
            return redirect()->back()->with('fail','لم يتم اضافة البيانات بنجاح');
        }

    }

    public function getGameData($id){
        $find = DB::select('select * from games where id = ?',[$id]);
        return view('game.editgame',['game'=>$find,'id'=>$id]);
    }

    public function updateGame(Request $request,$id){
        $update = DB::update('update games set name = ? , link = ? , description = ? where id = ?',[$request->name,$request->link,($request->description),$id]);
        if ($update){
            return redirect()->back()->with('success','تم تعديل اللعبة بنجاح');
        }
        else{
            return redirect()->back()->with('fail','لم يتم اللعبة المستخدم');
        }
    }

    public function deleteGame($id){
        $delete = DB::delete('delete from games where id = ?',[$id]);
        if ($delete){
            return redirect()->back()->with('success','تم حذف اللعبة بنجاح');
        }
        else{
            return redirect()->back()->with('fail','لم يتم حذف اللعبة');
        }
    }
}
