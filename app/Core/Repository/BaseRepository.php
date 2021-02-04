<?php


namespace App\Core\Repository;

use App\BaseModel;

class BaseRepository implements BaseRepositoryInterface
{
    protected $_model;

    public function __construct(BaseModel $baseEntity)
    {
        $this->_model = $baseEntity;
    }

    function Collection()
    {
        return $this->_model;
    }

    function create($model)
    {
        return $this->_model->create($model);
    }

    function update($id, $model)
    {
        return  $this->_model->where('id',$id)->update($model);
    }

    function getById($id)
    {
        return $this->_model->find($id);
    }

    function getByKey($key, $value)
    {
        return $this->_model->select($this->_model->getGridColumns())->where($key, $value)->first();
    }

    function updateByKey($key, $value, $model)
    {
        return $this->_model->where($key, $value)->update($model);
    }

    function getAllpaginate()
    {
        return $this->_model->select($this->_model->getGridColumns())->paginate();
    }

      function deleteByKey($key, $value)
      {
        return $this->_model->where($key, $value)->delete();
      }

    function getAll()
    {
        return $this->_model->select($this->_model->getGridColumns())->orderBy("created_at")->limit(200)->get();
    }

    function getGroupByKey($key, $value)
    {
        return $this->_model->select($this->_model->getGridColumns())->where($key, $value)->orderBy("created_at")->get();
    }

    function deleteById($id)
    {
        return $this->_model->where('id',$id)->delete();
    }


    function getCount()
    {
        return $this->_model->count();
    }

    function getGroupByKeyExceptKey($key, $value, $EKey, $EValue)
    {
       return  $this->_model->select($this->_model->getGridColumns())->where($key, $value)->where($EKey,'!=',$EValue)->orderByDesc("created_at")->get();
    }

    function getGroupByKeyWhereIn($key, $value)
    {
        return $this->_model->select($this->_model->getGridColumns())->whereIn($key, $value)->orderByDesc("created_at")->get();
    }
    function searchByKey($key, $value)
    {
      return $this->_model->select($this->_model->getGridColumns())->where($key,  'regexp', '/.*' . $value . '/i')->orderByDesc("created_at")->limit(15)->get();
    }
    function getByKeypaginate($key, $value)
    {
      return $this->_model->select($this->_model->getGridColumns())->where($key, $value)->paginate();
    }
}
