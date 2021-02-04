<?php


namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use App\Http\Helpers\Helpers;
use ZeinaDev\Repository\Interfaces\ExamsRepositoryInterface;
use ZeinaDev\Services\Interfaces\ExamsServiceInterface;
use ZeinaDev\Repository\Interfaces\ExamQuestionRepositoryInterface;
use ZeinaDev\Services\Interfaces\ImagesServiceInterface;

class ExamsService extends BaseService implements ExamsServiceInterface
{
          protected $questionQ;
          private $images;

        public function __construct(ExamsRepositoryInterface $examRepository , ExamQuestionRepositoryInterface $examQuestions, ImagesServiceInterface $imagesService )
        {
            $this->_repo  = $examRepository;
            $this->questionQ = $examQuestions;
            $this->images    = $imagesService;
        }

        function AttributeCustom($request,$id = null)
        {
          $request->result = array_values($request->result);
          $request->result = array_map(function($item)
          {
              if(isset($item['photos']))
              {

                      $item['photos']= $this->images->getByKey('id',(int)$item['photos'])->toArray();
              }
          return $item;
          }, $request->result );
          $result = is_null($request->result[0]['from'])?null:serialize($request->result);
            $model= array(
                "title" => $request->title,
                "desc"     => $request->desc,
                "type" => $request->type,
                'sectionId'     => $request->sectionId,
                "result"     => $result,
            );

            if(is_null($id))
            {
                $model['slug'] =  $request->slug;
            }

            if(isset($request->imageselector))
            {
                $model['imageId'] = $request->imageselector;
            }
            if(!empty(request()->photo)){
                $data=array(
                    'title'=>$request->title,
                    'photo'=>request()->photo
                );
                $model['imageId'] = $this->images->saveToArray($data);
            }

            return $model;
        }

        function createAndUpdateRelatedQuestions($request,$id=null)
        {
           $this->questionQ->collection()->where('exam_id',$id)->delete();
           foreach ($request->relatedQuestions??[] as $key => $value) {
             $this->questionQ->create(['question_id'=>(int)$value,'exam_id'=>$id]);
           }
           return true;
        }

        function GetBySectionpaginate($sectionId = null, $limit = 4)
        {
          return $this->_repo->GetBySectionpaginate($sectionId, $limit );
        }
}
