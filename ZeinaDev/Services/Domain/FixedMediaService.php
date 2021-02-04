<?php


namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use ZeinaDev\Repository\Interfaces\FixedMediaRepositoryInterface;
use ZeinaDev\Services\Interfaces\FixedMediaInterface;


class FixedMediaService extends BaseService implements FixedMediaInterface
{
    public function __construct(FixedMediaRepositoryInterface $fixedMediaRepository )
    {
        $this->_repo = $fixedMediaRepository;

    }

    function HomeNewMedia($request, $new)
    {
        $fixedNew = $request->inHomeNews;
        if(count($fixedNew??[])>5)
        {
            array_splice($fixedNew, 5, count($fixedNew));
        }

        $fixedNew = array_map(function($item) use ($new)
        {
            if($item == 'new')
            {
                if($new->status == "published" && $new->in_home)
                $item =$new->id;
            }
            return $item;
            },$fixedNew);
// dd($fixedNew);
            $model = array(
                'type'=>'news',
                'data'=>serialize($fixedNew)
            );

            $check = $this->_repo->getByKey('type','news');
            if(is_null($check))
            {
                $this->_repo->create($model);
            }
            else
                {
                    $this->_repo->update($check->id,$model);
                }
        return true;
    }

    function SectionOrder($request)
    {
      $sectionOrder = $request->section;
      array_splice($sectionOrder, $request->no, count($sectionOrder));
      $model = array(
          'type'=>'SectionsOrder',
          'data'=>serialize($sectionOrder)
      );

      $check = $this->_repo->getByKey('type','SectionsOrder');

      if(is_null($check))
      {
          $this->_repo->create($model);
      }
      else
          {
              $this->_repo->update($check->id,$model);
          }
      return true;
    }

    function SectionOrderMenu($request)
    {
      $sectionOrder = $request->section;
      // array_splice($fixedNew, 5, count($fixedNew));
      $model = array(
          'type'=>'SectionsOrderMenu',
          'data'=>serialize($sectionOrder)
      );

      $check = $this->_repo->getByKey('type','SectionsOrderMenu');

      if(is_null($check))
      {
          $this->_repo->create($model);
      }
      else
          {
              $this->_repo->update($check->id,$model);
          }
      return true;
    }

    function saveFixedHome($request)
    {
      $positionnews = $request->positionnews;
      $model = array(
          'type'=>'NewsFixedHome',
          'data'=>serialize($positionnews)
      );

      $check = $this->_repo->getByKey('type','NewsFixedHome');

      if(is_null($check))
      {
          $this->_repo->create($model);
      }
      else
          {
              $this->_repo->update($check->id,$model);
          }

      $editorchoice = $request->editorchoice;
      $model = array(
          'type'=>'editorchoice',
          'data'=>serialize($editorchoice)
      );

      $check = $this->_repo->getByKey('type','editorchoice');

      if(is_null($check))
      {
          $this->_repo->create($model);
      }
      else
          {
              $this->_repo->update($check->id,$model);
          }

      return true;
    }

    function saveSocailMedia($request)
    {
      $data = $request->data;
      $model = array(
          'type'=>'socailMedia',
          'data'=>serialize($data)
      );

      $check = $this->_repo->getByKey('type','socailMedia');

      if(is_null($check))
      {
          $this->_repo->create($model);
      }
      else
          {
              $this->_repo->update($check->id,$model);
          }
      return true;
    }

}
