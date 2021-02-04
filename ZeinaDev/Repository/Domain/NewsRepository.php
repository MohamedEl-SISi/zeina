<?php


namespace ZeinaDev\Repository\Domain;
use App\Core\Repository\BaseRepository;
use App\News;
use Carbon\Carbon;
use ZeinaDev\Repository\Interfaces\NewsRepositoryInterface;

class NewsRepository extends BaseRepository implements NewsRepositoryInterface
{
    function __construct(News $news)
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


    function filter($sectionId = null, $status = null, $keyword = null )
    {

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

    function GetBySection($sectionId = null, $limit = 4 ,$execludeIds = null, $skip = 0)
    {
        $query = $this->_model->select($this->_model->getGridColumns())->where('status','published');
        if (!is_null($execludeIds)) {
          $query->whereNotIn("id", $execludeIds);
          }
        if (!is_null($sectionId)) {
          $query->where("sectionId", $sectionId);
          }
        return $query->skip($skip * $limit)->orderby("publish_date","desc")
                      ->limit($limit)->get();
    }

    function GetForHome( $limit = 4 ,$execludeIds = null)
    {
      $query = $this->_model->select($this->_model->getGridColumns())->where('status','published')->where('in_home',1);
      if (!is_null($execludeIds)) {
        $query->whereNotIn("id", $execludeIds);
        }
      return $query->limit($limit)->get();
    }

    function GetBySectionpaginate($sectionId = null, $limit = 4, $subsection = null)
    {
        $query = $this->_model->select($this->_model->getGridColumns())->where('status','published');
        if (!is_null($sectionId)) {
          $query->where("sectionId", $sectionId);
          }
      if (!is_null($subsection)) {
        $query->where("subSectionId", $subsection);
        }
          return $query->orderby("publish_date","desc")
                        ->paginate($limit);

    }
    function GetBykeywordpaginate($keyword = null, $limit = 4)
    {
      $query = $this->_model->select($this->_model->getGridColumns())->where('status','published');
      if (!is_null($keyword)) {
        $query->whereHas('keywords', function($q) use($keyword){
          $q->where('keyword_Id', $keyword);
      });
        // $query->join('news_keywords', 'news.id', '=', 'news_keywords.news_Id');
        // ->where("news_keywords.keyword_Id", $keyword);
        }
        // dd($query->toSql());
        return $query->orderby("publish_date","desc")
                      ->paginate($limit);
    }
    function SearchForWebsite($q)
    {
          return  $this->_model->select($this->_model->getGridColumns())->where('status','published')->where('title','LIKE', "%{$q}%")->orderby("publish_date","desc")
                        ->paginate(10);
    }
}
