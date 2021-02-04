<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface ImagesServiceInterface extends BaseServiceInterface
{
        function AttributeCustom($request,$id = null);

        function saveAlbum($request);

        function saveToArray($data);

        function saveImagePath($Image);

        function unlinkphoto($id);

        function saveImageApi($data ,$id);
}
