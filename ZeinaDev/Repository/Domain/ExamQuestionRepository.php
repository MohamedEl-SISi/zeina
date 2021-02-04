<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\ExamsQuestion;
use ZeinaDev\Repository\Interfaces\ExamQuestionRepositoryInterface;

class ExamQuestionRepository extends BaseRepository implements ExamQuestionRepositoryInterface
{
    function __construct(ExamsQuestion $examQuestions)
    {
        parent::__construct($examQuestions);
    }

}
