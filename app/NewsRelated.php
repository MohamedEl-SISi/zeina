<?php

namespace App;

class NewsRelated extends BaseModel
{
  protected $table = 'news_related';
  protected $fillable = [
    'related_Id',	'news_Id'
  ];

  protected $gridColumns = ['related_Id',	'news_Id'];

  public function news()
  {
      return $this->hasOne('App\News','id','news_Id')->select(['id','title',	'slug',	'desc','imageId','sectionId','status']);
  }
  public function relatedNews()
  {
      return $this->hasOne('App\News','id','related_Id')->select(['id','title',	'slug',	'desc','imageId','sectionId','status']);
  }
}
