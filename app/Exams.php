<?php

namespace App;

class Exams extends BaseModel {

    protected $collection = 'questions';
    protected $fillable = [
	    'title','slug','desc','type',	'result','imageId'
    ];

    protected $gridColumns = ['id','title','slug','type','imageId','desc'];

    public function questions()
    {
        return $this->hasMany('App\ExamsQuestion','exam_id','id');
    }

    public function getResultAttribute($data)
    {
        return is_null($data)?null:unserialize($data);
    }
    public function image()
    {
        return $this->hasOne('App\Images', 'id','imageId');
    }

}
