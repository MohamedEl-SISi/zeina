<?php


namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use App\Http\Helpers\Helpers;
use ZeinaDev\Repository\Interfaces\ExamsSectionRepositoryInterface;
use ZeinaDev\Services\Interfaces\ExamsSectionServiceInterface;


class ExamsSectionService extends BaseService implements ExamsSectionServiceInterface
{
        public function __construct(ExamsSectionRepositoryInterface $sectionRepository  )
        {
            $this->_repo  = $sectionRepository;
        }

        function AttributeCustom($request,$id = null)
        {
            $model= array(
                'name' => $request->name,
                'status'    => $request->status,
                'desc' => $request->desc,
            );
            if(is_null($id))
            {
                $model['slug'] =  $request->slug;
            }

            return $model;
        }

      function getSectionbySlug($slug)
      {
        return $this->_repo->collection()->where('status','published')->where('slug',$slug)->first();
      }
}
