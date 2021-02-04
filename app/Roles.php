<?php

namespace App;

class Roles extends BaseModel
{
    protected $fillable = [
        'name'
        ];

    protected  $gridColumns = ['id','name'];
}
