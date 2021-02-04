<?php namespace App;


use App\Http\Helpers\Helpers;

class Images extends BaseModel {
    protected $table = 'images';
    protected $fillable = [
        'title', 'path','fileName',
    ];
    protected $appends = ["image_src", "image_thumb"];

    protected $gridColumns = ['id','title', 'path','fileName'];

    public function getImageThumbAttribute()
    {

            return Helpers::getImageUrl($this->fileName, "300x250",$this->path);
    }

    public function getImageSrcAttribute()
    {
            return Helpers::getImageUrl($this->fileName,'src',$this->path);
    }

}
