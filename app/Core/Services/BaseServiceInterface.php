<?php


namespace App\Core\Services;


interface BaseServiceInterface
{
    function create($model);

    function update($id, $model);

    function getById($id);

    function getByKey($key, $value);

    function updateByKey($key, $value, $model);

    function getAll();

    function deleteByKey($key, $value);

    function getAllpaginate();

    function getGroupByKey($key, $value);

    function getGroupByKeyExceptKey($key, $value, $EKey, $EValue);

    function deleteById($id);

    function getAllSerializeSelect();

    function getCount();

    function getGroupByKeySerialize($key, $value, $EKey = null , $EValue = null);

    function getGroupByKeyWhereIn($key, $value);

    function searchByKey($key, $value);

    function searchByKeySerialize($key, $value);

    function getGroupByKeyWhereInSerialize($key, $value);

    function getByKeypaginate($key, $value);
}
