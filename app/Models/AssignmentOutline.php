<?php

namespace App\Models;
use  Illuminate\Database\Eloquent\Model;


class AssignmentOutline extends Model  
{
    protected $fillable = [
        'outline_assign_id',
        'user_id'
    ];

    public function subject(){
        return $this->belongsTo("App\Models\Subject","outline_assign_id");
    }
}
