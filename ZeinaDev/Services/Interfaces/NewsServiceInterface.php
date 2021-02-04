<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface NewsServiceInterface extends BaseServiceInterface
{
    function NewsAttributeCustom($request,$id = null );

    function getFilter($sectionId = null,$status = null,$keyword = null );

    function createAndUpdateRelatedKeywords($request,$id=null);

    function createAndUpdateRelatednews($request,$id=null);

    function GetBySection($sectionId = null, $limit = 4 ,$execludeIds = null , $skip = 0);

    function GetForHome( $limit = 4 ,$execludeIds = null);

    function GetBySectionpaginate($sectionId = null, $limit = 4 , $subsection = null);

    function GetBykeywordpaginate($keyword = null, $limit = 4);

    function SearchForWebsite($q);
}
