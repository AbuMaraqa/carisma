<?php

namespace App\Imports;

use App\Models\Publisher;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PublisherImport implements ToModel,WithHeadingRow,WithChunkReading,ShouldQueue
{

//    private $id;
//
//    public function __construct($id)
//    {
//        $this->id = $id;
//    }
    /**
     * @param array $row
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Publisher(
            [
                'pname'=>$row[0],
                'pphone'=>$row[1],
                'pprofession'=>$row[2]
            ]
        );
    }

    public function rules(): array{
        return [
            '*.0'=>['الاسم','unique:publishers,pname'],
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
