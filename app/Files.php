<?php

namespace App;

class Files extends BaseModel
{
  protected $table = 'files';
  protected $fillable = [
      'title','desc','slug'
  ];

  protected $gridColumns = ['id','title','slug','desc'];

  public function news()
  {
      return $this->hasMany('App\FilesNews','file_Id','id');
  }
  public function firstNews()
  {
    return $this->hasOne('App\FilesNews','file_Id','id');
  }
}
