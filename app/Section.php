<?php namespace App;



class Section extends BaseModel {
    protected $collection = 'section';
    protected $fillable = [
        'name', 'slug','desc','in_home','in_menu','status','imageId','parentId'
    ];
    protected $gridColumns = ['id','name', 'slug','in_home','in_menu','parentId','status'];

    public function sub()
    {
        return $this->hasMany('App\Section','parentId');
    }

    public function parent()
    {
        return $this->hasOne('App\Section','id','parentId');
    }

    public function image()
    {
        return $this->hasOne('App\Images', 'id','imageId');
    }

}
