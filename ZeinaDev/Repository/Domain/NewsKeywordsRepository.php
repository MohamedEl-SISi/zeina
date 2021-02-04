<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\NewsKeywords;
use ZeinaDev\Repository\Interfaces\NewsKeywordsRepositoryInterface;

class NewsKeywordsRepository extends BaseRepository implements NewsKeywordsRepositoryInterface
{
    function __construct(NewsKeywords $newsKeywords)
    {
        parent::__construct($newsKeywords);
    }

}
