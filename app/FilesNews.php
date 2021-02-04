<?php

namespace App;


class FilesNews extends BaseModel
{

    protected $table = 'files_news';
    protected $fillable = [
      'file_Id',	'news_Id'
    ];
    protected $gridColumns = ['file_Id',	'news_Id'];

    public function file()
    {
        return $this->hasOne('App\Files','id','file_Id');
    }

    public function relatedNews()
    {
        return $this->hasOne('App\News','id','news_Id')->select(['id','title',	'slug',	'desc','imageId','sectionId','status']);
    }
}
