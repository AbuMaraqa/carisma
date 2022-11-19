<?php

namespace App\Exports;

use App\Models\Publisher;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class PublisherExport implements FromView
{

    protected $id;

    function __construct($id) {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $list = DB::select('select * from publishers where peventid = ?',[$this->id]);
        //return $list;
        return view('excel.index',['list'=>$list]);
    }
}
