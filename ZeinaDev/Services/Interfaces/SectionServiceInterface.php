<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface SectionServiceInterface extends BaseServiceInterface
{
    function AttributeCustom($request ,$id = null);

    function GetpublishedAndHome();

    function getSectionbySlug($slug);
}
