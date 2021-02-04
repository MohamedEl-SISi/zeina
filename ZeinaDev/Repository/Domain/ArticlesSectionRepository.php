<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\ArticleSection;
use ZeinaDev\Repository\Interfaces\ArticlesSectionRepositoryInterface;

class ArticlesSectionRepository extends BaseRepository implements ArticlesSectionRepositoryInterface
{
    function __construct(ArticleSection $section)
    {
        parent::__construct($section);
    }
}
