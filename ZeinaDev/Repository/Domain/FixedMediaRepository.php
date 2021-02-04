<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\OrderOfItems;
use ZeinaDev\Repository\Interfaces\FixedMediaRepositoryInterface;

class FixedMediaRepository extends BaseRepository implements FixedMediaRepositoryInterface
{
    function __construct(OrderOfItems $fixedMedia)
    {
        parent::__construct($fixedMedia);
    }


}
