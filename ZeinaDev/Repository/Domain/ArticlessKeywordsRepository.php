<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\ArticlesKeywords;
use ZeinaDev\Repository\Interfaces\ArticlesKeywordsRepositoryInterface;

class ArticlessKeywordsRepository extends BaseRepository implements ArticlesKeywordsRepositoryInterface
{
    function __construct(ArticlesKeywords $newsKeywords)
    {
        parent::__construct($newsKeywords);
    }

}
