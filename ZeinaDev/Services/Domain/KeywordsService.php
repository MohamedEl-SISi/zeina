<?php

namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use App\Http\Helpers\Helpers;
use ZeinaDev\Repository\Interfaces\KeywordsRepositoryInterface;
use ZeinaDev\Services\Interfaces\KeywordsServiceInterface;


class KeywordsService extends BaseService implements KeywordsServiceInterface
{


        public function __construct(KeywordsRepositoryInterface $keywordsRepository)
        {
            $this->_repo  = $keywordsRepository;
        }

        function AttributeCustom($request,$id = null)
        {
              $model= array(
                    'name' => $request->name,
                    );
            if(is_null($id))
            {
                $model['slug'] =  $request->slug;
            }
            return $model;
        }


        function getFilter($keyword = null)
        {
            return $this->_repo->getFilter($keyword );
        }
}
