<?php


namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use App\Http\Helpers\Helpers;
use ZeinaDev\Repository\Interfaces\QuestionRepositoryInterface;
use ZeinaDev\Services\Interfaces\QuestionServiceInterface;


class QuestionService extends BaseService implements QuestionServiceInterface
{

        public function __construct(QuestionRepositoryInterface $questionRepository  )
        {
            $this->_repo  = $questionRepository;
            
        }

        function AttributeCustom($request,$id = null)
        {

            $model= array(
                "question_head" => $request->question_head,
                "answer_1"     => $request->answer_1,
                "answer_1_value" => $request->answer_1_value,
                "answer_2"     => $request->answer_2,
                "answer_2_value" => $request->answer_2_value,
                "answer_3"     => $request->answer_3,
                "answer_3_value" => $request->answer_3_value,
                "answer_4"     => $request->answer_4,
                "answer_4_value" => $request->answer_4_value
            );
            return $model;
        }
}
