<?php

namespace App;

class NewsKeywords extends BaseModel
{
  protected $table = 'news_keywords';
  protected $fillable = [
    'keyword_Id',	'news_Id'
  ];

  protected $gridColumns = ['keyword_Id',	'news_Id'];

  public function news()
  {
      return $this->hasOne('App\News','id','news_Id');
  }
  public function keyword()
  {
      return $this->hasOne('App\Keywords','id','keyword_Id');
  }
}
