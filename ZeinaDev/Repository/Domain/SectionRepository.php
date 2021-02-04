<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\Section;
use ZeinaDev\Repository\Interfaces\SectionRepositoryInterface;

class SectionRepository extends BaseRepository implements SectionRepositoryInterface
{
    function __construct(Section $section)
    {
        parent::__construct($section);
    }
}
