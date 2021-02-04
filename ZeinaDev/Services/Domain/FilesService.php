<?php


namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use App\Http\Helpers\Helpers;
use ZeinaDev\Repository\Interfaces\FilesRepositoryInterface;
use ZeinaDev\Services\Interfaces\FilesServiceInterface;
use ZeinaDev\Repository\Interfaces\FilesRelatedRepositoryInterface;

class FilesService extends BaseService implements FilesServiceInterface
{
          protected $fileRelated;

        public function __construct(FilesRepositoryInterface $fileRepository , FilesRelatedRepositoryInterface $filerelated )
        {
            $this->_repo  = $fileRepository;
            $this->fileRelated = $filerelated;
        }

        function AttributeCustom($request,$id = null)
        {
            $model= array(
                "title" => $request->title,
                "desc"     => $request->desc,
            );

            if(is_null($id))
            {
                $model['slug'] =  $request->slug;
            }

            return $model;
        }

        function createAndUpdateRelatedNews($request,$id=null)
        {
           $this->fileRelated->collection()->where('file_Id',$id)->delete();
           foreach ($request->relatednews??[] as $key => $value) {
             $this->fileRelated->create(['news_Id'=>(int)$value,'file_Id'=>$id]);
           }
           return true;
        }

        function getForHome()
        {
          return $this->_repo->collection()->limit(4)->orderByDesc('updated_at')->get();
        }
}
