<?php


namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use App\Http\Helpers\Helpers;
use ZeinaDev\Repository\Interfaces\SectionRepositoryInterface;
use ZeinaDev\Services\Interfaces\SectionServiceInterface;
use ZeinaDev\Services\Interfaces\ImagesServiceInterface;

class SectionService extends BaseService implements SectionServiceInterface
{
        private $images;
        public function __construct(SectionRepositoryInterface $sectionRepository ,ImagesServiceInterface $imagesService )
        {
            $this->_repo  = $sectionRepository;
            $this->images = $imagesService;
        }

        function AttributeCustom($request,$id = null)
        {
            $parentSection = ($request->parentId =='0')?null:((int)$request->parentId);
            $model= array(
                'name' => $request->name,
                'parentId' => $parentSection,
                'status'    => $request->status,
                'desc' => $request->desc,
                'in_home' => $request->in_home?1:0,
                'in_menu' => $request->in_menu?1:0
            );
            if(is_null($id))
            {
                $model['slug'] =  $request->slug;
            }

            if(isset($request->imageprofileId))
            {
                $model['imageId'] = $request->imageprofileId;
            }
            if(!empty(request()->photo)){
                $data=array(
                    'title' => $request->name,
                    'photo' => request()->photo
                );
                $model['imageId'] = $this->images->saveToArray($data);
            }

            return $model;
        }

        function GetpublishedAndHome()
        {
          return $this->_repo->collection()->where('in_home',1)->where('status','published')->whereNull('parentId')->get();
        }

        function getSectionbySlug($slug)
        {
          return $this->_repo->collection()->where('status','published')->where('slug',$slug)->first();
        }
}
