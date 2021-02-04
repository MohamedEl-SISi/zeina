<?php

namespace App;

class ArticlesRelated extends BaseModel
{
  protected $table = 'article_related';
  protected $fillable = [
    'related_Id',	'article_Id'
  ];

  protected $gridColumns = ['related_Id',	'article_Id'];

  public function news()
  {
      return $this->hasOne('App\Articles','id','article_Id')->select(['id','title',	'slug',	'publisher_name','sectionId','publish_date','imageId','status']);
  }
  public function relatedNews()
  {
      return $this->hasOne('App\Articles','id','related_Id')->select(['id','title',	'slug',	'publisher_name','sectionId','publish_date','imageId','status']);
  }
}
