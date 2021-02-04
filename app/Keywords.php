<?php namespace App;

class Keywords extends BaseModel {

    protected $table = 'keywords';
    protected $fillable = [
        'name','slug'
    ];

    protected $gridColumns = ['id','name','slug'];
}
