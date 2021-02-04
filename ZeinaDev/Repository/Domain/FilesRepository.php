<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\Files;
use ZeinaDev\Repository\Interfaces\FilesRepositoryInterface;

class FilesRepository extends BaseRepository implements FilesRepositoryInterface
{
    function __construct(Files $files)
    {
        parent::__construct($files);
    }
}
