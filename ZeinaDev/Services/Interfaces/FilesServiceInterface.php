<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface FilesServiceInterface extends BaseServiceInterface
{
    function AttributeCustom($request ,$id = null);
    function createAndUpdateRelatedNews($request,$id=null);

    function getForHome();
}
