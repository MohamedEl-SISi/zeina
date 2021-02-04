<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface ExamsSectionServiceInterface extends BaseServiceInterface
{
    function AttributeCustom($request ,$id = null);

    function getSectionbySlug($slug);
}
