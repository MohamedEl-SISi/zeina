<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface KeywordsServiceInterface extends BaseServiceInterface
{
    function AttributeCustom($request , $id = null);

    function getFilter($keyword = null);
}
