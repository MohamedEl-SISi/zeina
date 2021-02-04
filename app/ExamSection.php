<?php

namespace App;

class ExamSection extends BaseModel
{
    protected $table = 'exams_section';
    protected $fillable = [
        'name', 'slug','desc','status'
    ];
    protected $gridColumns = ['id','name', 'slug','desc','status'];


}
