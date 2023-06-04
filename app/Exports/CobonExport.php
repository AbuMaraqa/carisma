<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CobonExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $list = DB::select('select * from participant_royal where status = 1');
        return view('excel.cobon',['list'=>$list]);
    }
}
