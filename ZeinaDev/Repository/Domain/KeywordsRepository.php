<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\Keywords;
use ZeinaDev\Repository\Interfaces\KeywordsRepositoryInterface;

class KeywordsRepository extends BaseRepository implements KeywordsRepositoryInterface
{
    function __construct(Keywords $keyword)
    {
        parent::__construct($keyword);
    }
    function searchByKey($key, $value)
    {
      return $this->_model->select($this->_model->getGridColumns())->where($key,'LIKE', "%{$value}%")->orderByDesc("created_at")->limit(15)->get();
    }
    function getFilter($keyword = null)
    {
      return $this->_model->select($this->_model->getGridColumns())->where('name','LIKE', "%{$keyword}%")->orderByDesc("created_at")->paginate();
    }
}
