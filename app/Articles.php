<?php namespace App;

class Articles extends BaseModel {

    protected $table = 'articles';
    protected $fillable = [
  	'title',	'slug',	'publish_date','status'	,'desc',	'body'	,'editor_id'	,'publisher_id'	,'sectionId','imageId','publisher_name',
    'paragraph_body'
    ];

    protected $gridColumns = ['id','title',	'slug',	'publisher_name','sectionId','publish_date','imageId','status'];

    public function section()
    {
        return $this->hasOne('App\ArticleSection','id','sectionId');
    }

    public function related()
    {
        return $this->hasMany('App\ArticlesRelated','article_Id','id');
    }

    public function keywords()
    {
        return $this->hasMany('App\ArticlesKeywords','article_Id','id');
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
