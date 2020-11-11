<?php

namespace App\Models;
use  Illuminate\Database\Eloquent\Model;


class OutlineDetail extends Model  
{
    protected $fillable = [
        'outline_id',
        'content',
        'sort',
        'structure_id',
    ];

    public function outlineStructure(){
        return $this->belongsTo("App\Models\OutlineStructure","structure_id","id");
    }
}
