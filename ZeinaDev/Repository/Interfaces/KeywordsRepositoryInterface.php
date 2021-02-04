<?php


namespace ZeinaDev\Repository\Interfaces;
use App\Core\Repository\BaseRepositoryInterface;

interface KeywordsRepositoryInterface extends BaseRepositoryInterface
{
    function getFilter($keyword = null);
}
