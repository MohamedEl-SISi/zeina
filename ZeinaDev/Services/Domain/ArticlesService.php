<?php


namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use Carbon\Carbon;
use ZeinaDev\Services\Interfaces\ArticlesServiceInterface;
use ZeinaDev\Repository\Interfaces\ArticlesRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ArticlesKeywordsRepositoryInterface;
use ZeinaDev\Repository\Interfaces\ArticlesRelatedRepositoryInterface;
use ZeinaDev\Services\Interfaces\ImagesServiceInterface;
use App\Http\Helpers\Helpers;
use auth;

class ArticlesService extends BaseService implements ArticlesServiceInterface
{
        private $newsKeywords;
        private $images;
        private $newsRelated;

        public function __construct(ArticlesRepositoryInterface $newsRepository ,ImagesServiceInterface $imagesService  ,
                                    ArticlesRelatedRepositoryInterface $newsRelatedRepo,ArticlesKeywordsRepositoryInterface $newskeywordsRepo)
        {
            $this->_repo        = $newsRepository;
            $this->newsKeywords = $newskeywordsRepo;
            $this->newsRelated  = $newsRelatedRepo;
            $this->images       = $imagesService;
        }

        function NewsAttributeCustom($request,$id =null)
        {
          if($request->paragraph_body)
          {
            $content = array_map(function($item)
            {
                $album = [];
                if(isset($item['photos']))
                {
                    foreach ($item['photos'] as $photo)
                    {
                        $image= $this->images->getByKey('id',(int)$photo)->toArray();
                        array_push($album,$image);
                    }
                }
                $item['photos'] = $album;
            return $item;
            }, $request->content );
              $content = serialize(array_values($content)) ;
          }else
          {
            $content = serialize($request->block);
          }

            $model= array(
                'title'         => $request->title,
                'status'        => $request->status??"draft",
                'desc'          => $request->desc,
                'sectionId'     => $request->sectionId,
                'body'       => $content,
                'publisher_name'=> $request->publisher_name,
                'paragraph_body' => $request->paragraph_body?1:0,
            );

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

              if(is_null($id))
              {
                  $model['editor_id'] = auth::user()->id;
                  if($request->status=='published')
                  {
                    $model['publish_date'] = Carbon::now()->toDateTimeString();
                    $model['publisher_id'] = auth::user()->id;
                    $model['slug'] =  $request->slug;
                  }
              }
              else
              {
                $news = $this->_repo->getById($id);

                if($request->status=='published')
                {
                  if(is_null($news->publish_date))
                  {
                      $model['publish_date'] = Carbon::now()->toDateTimeString();
                      $model['publisher_id'] = auth::user()->id;
                      $model['slug'] =  $request->slug;
                  }else
                      {
                        $model['publish_date'] = $news->publish_date;
                      }
                }

              }

            return $model;
        }



    function getFilter($sectionId = null, $status = null, $keyword = null )
    {
        return $this->_repo->getFilter($sectionId , $status , $keyword );
    }

    function createAndUpdateRelatedKeywords($request,$id=null)
    {
       $this->newsKeywords->collection()->where('article_Id',$id)->delete();
       foreach ($request->relatedTags??[] as $key => $value) {
         $this->newsKeywords->create(['keyword_Id'=>(int)$value,'article_Id'=>$id]);
       }
       return true;
    }

    function createAndUpdateRelatednews($request,$id=null)
    {
       $this->newsRelated->collection()->where('article_Id',$id)->delete();
       foreach ($request->relatednews??[] as $key => $value) {
         $this->newsRelated->create(['related_Id'=>(int)$value,'article_Id'=>$id]);
       }
       return true;
    }

    function GetBySection($sectionId = null, $limit = 4 ,$execludeIds = null)
    {
      return $this->_repo->GetBySection($sectionId , $limit  ,$execludeIds );
    }

    function GetBySectionpaginate($sectionId = null, $limit = 4)
    {
      return $this->_repo->GetBySectionpaginate($sectionId, $limit );
    }
}
