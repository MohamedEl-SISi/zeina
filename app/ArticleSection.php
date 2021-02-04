<?php

namespace App;

class ArticleSection extends BaseModel
{
    protected $table = 'articlesections';
    protected $fillable = [
        'name', 'slug','desc','in_home','in_menu','status','imageId'
    ];
    protected $gridColumns = ['id','name', 'slug','in_home','in_menu','status'];

    public function image()
    {
        return $this->hasOne('App\Images', 'id','imageId');
    }

}
