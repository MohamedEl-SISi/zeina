<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\Exams;
use ZeinaDev\Repository\Interfaces\ExamsRepositoryInterface;

class ExamsRepository extends BaseRepository implements ExamsRepositoryInterface
{
    function __construct(Exams $exam)
    {
        parent::__construct($exam);
    }

    function GetBySectionpaginate($sectionId = null, $limit = 4)
    {
        $query = $this->_model->select($this->_model->getGridColumns())->where('type','multipleQuestions');
        if (!is_null($sectionId)) {
          $query->where("sectionId", $sectionId);
          }
          return $query->orderby("created_at","desc")
                        ->paginate($limit);

    }
}
