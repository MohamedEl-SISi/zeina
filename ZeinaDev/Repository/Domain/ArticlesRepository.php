<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\Articles;
use Carbon\Carbon;
use ZeinaDev\Repository\Interfaces\ArticlesRepositoryInterface;

class ArticlesRepository extends BaseRepository implements ArticlesRepositoryInterface
{
    function __construct(Articles $news)
    {
        parent::__construct($news);
    }

    function getAllpaginate()
    {
        return $this->_model->select($this->_model->getGridColumns())->orderBy("created_at",'desc')->paginate();
    }

    function searchByKey($key, $value)
    {
      return $this->_model->select($this->_model->getGridColumns())->where($key,'LIKE', "%{$value}%")->orderByDesc("created_at")->limit(15)->get();
    }

    function getFilter($sectionId = null, $status = null, $keyword = null )
    {
      // dd($sectionId , $status , $keyword );
        $query = $this->_model->select($this->_model->getGridColumns());

        if(!is_null($sectionId) && $sectionId != "null" )
        {
            $query->where('sectionId',$sectionId);
        }

        if(!is_null($status) && $status != "null")
        {
            $query->where('status',$status);
        }

        if(!is_null($keyword) )
        {
            $query->where('title','LIKE', "%{$keyword}%");
        }

        return $query->orderBy('publish_date','desc')->paginate();

    }

    function GetBySection($sectionId = null, $limit = 4 ,$execludeIds = null)
    {
        $query = $this->_model->select($this->_model->getGridColumns())->where('status','published');
        if (!is_null($execludeIds)) {
          $query->whereNotIn("id", $execludeIds);
          }
        if (!is_null($sectionId)) {
          $query->where("sectionId", $sectionId);
          }

        return $query->orderby("publish_date","desc")->limit($limit)->get();
    }

    function GetBySectionpaginate($sectionId = null, $limit = 4)
    {
        $query = $this->_model->select($this->_model->getGridColumns())->where('status','published');
        if (!is_null($sectionId)) {
          $query->where("sectionId", $sectionId);
          }
          return $query->orderby("publish_date","desc")
                        ->paginate($limit);

    }
}
