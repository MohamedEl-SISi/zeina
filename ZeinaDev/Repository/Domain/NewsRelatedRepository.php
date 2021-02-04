<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\NewsRelated;
use ZeinaDev\Repository\Interfaces\NewsRelatedRepositoryInterface;

class NewsRelatedRepository extends BaseRepository implements NewsRelatedRepositoryInterface
{
    function __construct(NewsRelated $newsRelated)
    {
        parent::__construct($newsRelated);
    }

}
