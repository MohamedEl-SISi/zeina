<?php

namespace App;

class ArticlesKeywords extends BaseModel
{
  protected $table = 'articles_keywords';
  protected $fillable = [
    'keyword_Id',	'article_Id'
  ];

  protected $gridColumns = ['keyword_Id',	'article_Id'];

  public function news()
  {
      return $this->hasOne('App\Articles','id','article_Id')->select(['id','title',	'slug',	'publisher_name','sectionId','publish_date','imageId','status']);
  }
  public function keyword()
  {
      return $this->hasOne('App\Keywords','id','keyword_Id');
  }
}
