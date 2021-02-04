<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\ExamSection;
use ZeinaDev\Repository\Interfaces\ExamsSectionRepositoryInterface;

class ExamsSectionRepository extends BaseRepository implements ExamsSectionRepositoryInterface
{
    function __construct(ExamSection $section)
    {
        parent::__construct($section);
    }
}
