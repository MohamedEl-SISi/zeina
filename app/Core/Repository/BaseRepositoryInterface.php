<?php


namespace App\Core\Repository;

interface BaseRepositoryInterface
{
    function collection();

    function create($model);

    function update($id, $model);

    function getById($id);

    function getByKey($key, $value);

    function updateByKey($key, $value, $model);

    function getAll();

    function deleteByKey($key, $value);

    function getAllpaginate();

    function getGroupByKey($key, $value);

    function deleteById($id);

    function getCount();

    function getGroupByKeyExceptKey($key, $value,$EKey,$EValue);

    function getGroupByKeyWhereIn($key, $value);

    function searchByKey($key, $value);

    function getByKeypaginate($key, $value);
}
