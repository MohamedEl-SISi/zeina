<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\Images;
use ZeinaDev\Repository\Interfaces\ImagesRepositoryInterface;

class ImagesRepository extends BaseRepository implements ImagesRepositoryInterface
{
    function __construct(Images $images)
    {
        parent::__construct($images);
    }

    public function getlastid()
    {
        $data= $this->_model->select('imageId')->latest('imageId')->first();
        return  $data?$data->imageId:60;
    }

    function getAllpaginate()
    {
        return $this->_model->select($this->_model->getGridColumns())->orderBy("created_at",'desc')->paginate();
    }

    function searchByKey($key, $value)
    {
        return $this->_model->select($this->_model->getGridColumns())->where($key,'LIKE', "%{$value}%")->orderByDesc("created_at")->paginate();
    }
}
