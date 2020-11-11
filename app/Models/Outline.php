<?php

namespace App\Models;
use  Illuminate\Database\Eloquent\Model;


class Outline extends Model  
{
    protected $fillable = [
        'title',
        'version',
        'subject_id',
        "user_id",
        "is_practice",
    ];

    public function subject(){
        return $this->belongsTo("App\Models\Subject","subject_id");
    }

    public function outlineDetails(){
        return $this->hasMany("App\Models\OutlineDetail","outline_id");
    }
}
