<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\ArticlesRelated;
use ZeinaDev\Repository\Interfaces\ArticlesRelatedRepositoryInterface;

class ArticlesRelatedRepository extends BaseRepository implements ArticlesRelatedRepositoryInterface
{
    function __construct(ArticlesRelated $newsRelated)
    {
        parent::__construct($newsRelated);
    }

}
