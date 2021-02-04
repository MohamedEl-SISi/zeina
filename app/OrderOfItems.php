<?php

namespace App;


class OrderOfItems extends BaseModel
{
  protected $fillable = [
    'type','data'
  ];
    protected $gridColumns = ['id','type','data'];

    public function getDataAttribute($data)
    {
        return unserialize($data);
    }
}
