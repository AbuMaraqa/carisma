<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'peventid',
        'pname',
        'pphone',
        'pemail',
        'pprofession',
        'pet',
        'pgift',
        'plunch',
        'peffict1',
        'peffict2'
    ];
}
