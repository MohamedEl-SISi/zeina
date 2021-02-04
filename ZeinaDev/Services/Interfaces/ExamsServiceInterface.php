<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface ExamsServiceInterface extends BaseServiceInterface
{
    function AttributeCustom($request ,$id = null);

    function createAndUpdateRelatedQuestions($request,$id=null);

    function GetBySectionpaginate($sectionId = null, $limit = 4);
}
