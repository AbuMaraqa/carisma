<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'name',
        'type',
        'label',
        'options',
        'is_required',
        'order'
    ];


    protected $table = 'event_fields';

    protected $casts = [
        'options' => 'array',   // يخزنها JSON تلقائياً
        'is_required' => 'boolean',
    ];
}
