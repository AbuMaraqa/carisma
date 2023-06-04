<?php

namespace App\Imports;

use App\Models\Event;
use App\Models\Publisher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class PublisherImport implements ToModel
{

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @param array $row
    * @param Collection $collection
    */
    public function model(array $row)
    {
//        $query = DB::select('select * from publishers where pname = ? and peventid = ?',[$row[0],$this->id]);
            if (!(Publisher::where('pphone','=',$row[1])->where('peventid','=',$this->id))->exists()){
                return new Publisher(
                    [
                        'peventid'=>$this->id,
                        'pname'=>$row[0],
                        'pphone'=>$row[1],
                        'pprofession'=>$row[2]
                    ]
                );

                 }





//        return new Publisher(
//            [
//                'peventid'=>$this->id,
//                'pname'=>$row[0],
//                'pphone'=>$row[1],
//                'pprofession'=>$row[2]
//            ]
//        );

    }

//    public function rules(): array{
//        return [
//            'pname' => 'distinct',
//        ];
//    }

//    public function customValidationMessages(){
//        return [
//            'pname' => 'required'
//        ];
//    }

}
