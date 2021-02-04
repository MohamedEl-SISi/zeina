<?php

namespace App;

class Questions extends BaseModel {
    protected $collection = 'questions';
    protected $fillable = [
	     'question_head'	,'answer_1','answer_1_value',	'answer_2',	'answer_2_value',	'answer_3',	'answer_3_value',	'answer_4',	'answer_4_value'
    ];

    protected $gridColumns = ['id','question_head'];

}
