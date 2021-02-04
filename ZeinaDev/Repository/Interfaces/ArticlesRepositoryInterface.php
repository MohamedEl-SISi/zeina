<?php

namespace ZeinaDev\Repository\Interfaces;
use App\Core\Repository\BaseRepositoryInterface;

interface ArticlesRepositoryInterface extends BaseRepositoryInterface
{
    function getFilter($sectionId = null, $status = null, $keyword = null );

    function GetBySection($sectionId = null, $limit = 4 ,$execludeIds = null);

    function GetBySectionpaginate($sectionId = null, $limit = 4);
}
