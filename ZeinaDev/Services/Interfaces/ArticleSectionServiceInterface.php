<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface ArticleSectionServiceInterface extends BaseServiceInterface
{
    function AttributeCustom($request ,$id = null);

    function GetpublishedAndHome($limit = 2);

    function getSectionbySlug($slug);
}
