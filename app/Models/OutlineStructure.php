<?php

namespace App\Models;
use  Illuminate\Database\Eloquent\Model;


class OutlineStructure extends Model  
{
    protected $fillable = [
        'title',
        'html_raw',
        'sort',
    ];
}
