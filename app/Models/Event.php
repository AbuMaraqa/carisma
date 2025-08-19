<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'ename',
        'edate',
        'edescription',
        'estatus',
        'eimage',
        'ebackground'
    ];

    protected $primaryKey = 'eid';

    public function fields()
    {
        return $this->hasMany(Field::class, 'event_id', 'eid');
    }

    public function publishers() // المشاركون
    {
        return $this->hasMany(Publisher::class, 'peventid', 'eid');
    }
}
