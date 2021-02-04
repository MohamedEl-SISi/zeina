<?php

namespace ZeinaDev\Repository\Interfaces;
use App\Core\Repository\BaseRepositoryInterface;

interface NewsRepositoryInterface extends BaseRepositoryInterface
{
  function filter($sectionId = null, $status = null, $keyword = null);

  function GetBySection($sectionId = null, $limit = 4 ,$execludeIds = null , $skip = 0);

  function GetForHome( $limit = 4 ,$execludeIds = null);

  function GetBySectionpaginate($sectionId = null, $limit = 4, $subsection = null);

  function GetBykeywordpaginate($keyword = null, $limit = 4);

  function SearchForWebsite($q);
}
