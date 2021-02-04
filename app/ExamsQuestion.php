<?php

namespace App;

class ExamsQuestion extends BaseModel {

    protected $collection = 'exams_questions';
    protected $fillable = [
	    'exam_id','question_id'
    ];

    protected $gridColumns = ['id','exam_id','question_id'];

    public function Question()
    {
        return $this->hasOne('App\Questions','id','question_id');
    }

}
