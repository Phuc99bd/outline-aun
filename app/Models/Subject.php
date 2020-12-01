<?php

namespace App\Models;
use  Illuminate\Database\Eloquent\Model;


class Subject extends Model  
{
    protected $fillable = [
        'title', 'status' , 'title_en' , 'faculty_id' , 'subject_code'
    ];

    public function faculty(){
        return $this->belongsTo("App\Models\Faculty","faculty_id");
    }

    public function listAssignment(){
        return $this->hasMany("App\Models\AssignmentOutline","outline_assign_id", "id");
    }

    public function listCompleted()
    {
        # code...
        return $this->hasMany("App\Models\AssignmentOutline","outline_assign_id", "id")->where("status",1);
    }
}
