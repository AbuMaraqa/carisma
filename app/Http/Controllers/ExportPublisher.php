<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PublisherExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportPublisher extends Controller
{
    public function export($id){
        $list = DB::table('publishers')->where('peventid',3)->get();
        return Excel::download(new PublisherExport($id) ,'publishers.xlsx');
    }
}
