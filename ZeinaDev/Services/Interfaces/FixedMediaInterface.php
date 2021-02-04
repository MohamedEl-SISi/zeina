<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface FixedMediaInterface extends BaseServiceInterface
{
    function HomeNewMedia($request ,$new);
    function SectionOrder($request);
    function SectionOrderMenu($request);
    function saveFixedHome($request);
    function saveSocailMedia($request);
}
