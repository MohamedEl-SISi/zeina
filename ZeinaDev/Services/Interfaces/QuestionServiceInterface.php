<?php


namespace ZeinaDev\Services\Interfaces;
use App\Core\Services\BaseServiceInterface;

interface QuestionServiceInterface extends BaseServiceInterface
{
    function AttributeCustom($request ,$id = null);
}
