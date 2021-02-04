<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\Questions;
use ZeinaDev\Repository\Interfaces\QuestionRepositoryInterface;

class QuestionRepository extends BaseRepository implements QuestionRepositoryInterface
{
    function __construct(Questions $question)
    {
        parent::__construct($question);
    }

    function searchByKey($key, $value)
    {
      return $this->_model->select($this->_model->getGridColumns())->where($key,'LIKE', "%{$value}%")->orderByDesc("created_at")->limit(15)->get();
    }
}
