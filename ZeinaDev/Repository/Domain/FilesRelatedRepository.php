<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\FilesNews;
use ZeinaDev\Repository\Interfaces\FilesRelatedRepositoryInterface;

class FilesRelatedRepository extends BaseRepository implements FilesRelatedRepositoryInterface
{
    function __construct(FilesNews $filenews)
    {
        parent::__construct($filenews);
    }

}
