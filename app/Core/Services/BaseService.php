<?php

namespace App\Core\Services;

use App\Http\Helpers\Helpers;

abstract class BaseService implements BaseServiceInterface
{
    protected $_repo;

    function create($model)
    {
        return $this->_repo->create($model);
    }

    function update($id, $model)
    {
      return $this->_repo->update($id, $model);
    }

    function getById($id)
    {
        return $this->_repo->getById($id);
    }

    function getByKey($key, $value)
    {
      return $this->_repo->getByKey($key, $value);
    }

    function updateByKey($key, $value, $model)
    {
      return $this->_repo->updateByKey($key, $value, $model);
    }

      function getAll()
      {
          return $this->_repo->getAll();
      }

      function deleteByKey($key, $value)
      {
        return $this->_repo->deleteByKey($key, $value);
      }

        function getAllpaginate()
        {
            return $this->_repo->getAllpaginate();
        }

        function getGroupByKey($key, $value)
        {
            return $this->_repo->getGroupByKey($key, $value);
        }

        function getGroupByKeyExceptKey($key, $value,$EKey,$EValue)
        {
            return $this->_repo->getGroupByKeyExceptKey($key, $value,$EKey,$EValue);
        }

        function deleteById($id)
        {
            return $this->_repo->deleteById($id);
        }

        function getAllSerializeSelect()
        {
            $data = $this->getAll();
            $data = Helpers::SerializeDataForSelect($data);
            return $data;
        }

        function getCount()
        {
            return $this->_repo->getCount();
        }

        function getGroupByKeySerialize($key, $value , $EKey = null ,$EValue = null)
        {
            if(is_null($EKey)|| is_null($EValue))
            {
                $data = $this->getGroupByKey($key, $value);
                $data = Helpers::SerializeDataForSelect($data);
            }else
            {
                $data = $this->getGroupByKeyExceptKey($key, $value,$EKey,$EValue);
                $data = Helpers::SerializeDataForSelect($data);
            }
            return $data;
        }

        function getGroupByKeyWhereIn($key, $value)
        {
            return $this->_repo->getGroupByKeyWhereIn($key, $value);
        }

        function searchByKey($key, $value)
        {
          return $this->_repo->searchByKey($key, $value);
        }

        function searchByKeySerialize($key, $value)
        {
            $data = $this->_repo->searchByKey($key, $value);
            $data = Helpers::SerializeDataForSelect($data);
            return $data;
        }

        function getGroupByKeyWhereInSerialize($key, $value)
        {
            $data = $this->_repo->getGroupByKeyWhereIn($key, $value);
            $data = Helpers::SerializeDataForSelect($data);
            return $data;
        }

        function getByKeypaginate($key, $value)
        {
          return $this->_repo->getByKeypaginate($key, $value);
        }

}
