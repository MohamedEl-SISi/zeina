<?php


namespace ZeinaDev\Repository\Interfaces;
use App\Core\Repository\BaseRepositoryInterface;

interface ExamsRepositoryInterface extends BaseRepositoryInterface
{
      function GetBySectionpaginate($sectionId = null, $limit = 4);
}
