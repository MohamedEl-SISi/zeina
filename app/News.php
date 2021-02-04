<?php namespace App;

class News extends BaseModel {

    protected $table = 'news';
    protected $fillable = [
  	'title',	'slug',	'publish_date','status'	,'desc',	'body'	,'editor_id'	,'publisher_id',	'imageId'	,'sectionId'
    ,	'subSectionId','in_home','publisher_name','paragraph_body'
    ];

    protected $gridColumns = ['id','title',	'slug',	'desc','imageId','sectionId','status','publish_date','subSectionId'];

    public function section()
    {
        return $this->hasOne('App\Section','id','sectionId');
    }

    public function subsection()
    {
        return $this->hasOne('App\Section','id','subSectionId');
    }

    public function related()
    {
        return $this->hasMany('App\NewsRelated','news_Id','id');
    }

    public function keywords()
    {
        return $this->hasMany('App\NewsKeywords','news_Id','id');
    }

    public function getBodyAttribute($data)
    {
        return unserialize($data);
    }

    public function image()
    {
        return $this->hasOne('App\Images', 'id','imageId');
    }

}
