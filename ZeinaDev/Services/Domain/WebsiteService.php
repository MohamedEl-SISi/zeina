<?php


namespace ZeinaDev\Services\Domain;
use App\Core\Services\BaseService;
use ZeinaDev\Services\Interfaces\WebsiteInterface;
use ZeinaDev\Services\Interfaces\FixedMediaInterface;
use ZeinaDev\Services\Interfaces\NewsServiceInterface;
use ZeinaDev\Services\Interfaces\SectionServiceInterface;
use ZeinaDev\Services\Interfaces\ArticleSectionServiceInterface;
use ZeinaDev\Repository\Interfaces\ArticlesRepositoryInterface;
use ZeinaDev\Services\Interfaces\FilesServiceInterface;
use ZeinaDev\Services\Interfaces\KeywordsServiceInterface;
use ZeinaDev\Services\Interfaces\ExamsServiceInterface;
use ZeinaDev\Services\Interfaces\ExamsSectionServiceInterface;
use App\Http\Helpers\Helpers;

class WebsiteService  implements WebsiteInterface
{
    private $news,$fixed,$section,$ar_section,$articles,$files,$keyword,$exams,$ex_section;

    public function __construct(NewsServiceInterface $newsService,FixedMediaInterface $fixedMediaService,SectionServiceInterface $sectionService,KeywordsServiceInterface $keywordServices,
                                ArticleSectionServiceInterface $articleSectionService,ArticlesRepositoryInterface $articleServices,
                                ExamsServiceInterface $examService,FilesServiceInterface $fileServices, ExamsSectionServiceInterface $examServiceSection)
    {
      $this->news = $newsService;
      $this->fixed = $fixedMediaService;
      $this->section = $sectionService;
      $this->ar_section = $articleSectionService;
      $this->articles = $articleServices;
      $this->files = $fileServices;
      $this->keywords = $keywordServices;
      $this->exams = $examService;
      $this->ex_section = $examServiceSection;
    }
    public function HomeData()
    {
        $fixedNews = $this->fixed->getByKey('type','news');
        $data['fixed_News_order'] = $fixedNews->data??[];
        $data['fixed_News_order'] = array_filter($data['fixed_News_order'], function($item){
          if($item == "new") return false;
          return true;
        });
        $data['fixed_News_order'] = array_values($data['fixed_News_order']);
        // dd($data['fixed_News_order']);
        $data['fixed_News'] = $this->news->getGroupByKeyWhereIn('id',$data['fixed_News_order']);
        $sectionHome = $this->section->GetpublishedAndHome();
        // $newsids=array_merge($newsids??[],Helpers::getKeyValues($data['fixed_News'], 'id'));

        $editorNewsId = $this->fixed->getByKey('type','editorchoice');

        $data['editor_News_chocie'] = $this->news->getGroupByKeyWhereIn('id' ,$editorNewsId->data??[])->take(4);

        $orderSection = $this->fixed->getByKey('type','SectionsOrder');

        $fixednewsId = $this->fixed->getByKey('type','NewsFixedHome');
        $news = $this->news->getGroupByKeyWhereIn('id', $fixednewsId->data??[]);

        foreach($fixednewsId->data??[] as $key =>$id)
        {
          $data['positionNews'][$key] = $news->where('id',$id)->first();
        }
        // dd($data['positionNews']);
        // $newsids=array_merge($newsids??[],Helpers::getKeyValues($data['editor_News_chocie'], 'id'));

        foreach ($orderSection->data??[] as $key => $id) {
             $section = $sectionHome->where('id',$id)->first();

             if($section)
             {
               if($section->status == 'published')
               {
                  $data['category_News'][] = $this->news->GetBySection($section->id, 4 );
               }
                // if($key)
                // {
                //   $newsids=array_merge($newsids??[],Helpers::getKeyValues($data['category_News'][$key-1]??[], 'id'));
                // }

             }
        }
        $ar_sectionHome = $this->ar_section->GetpublishedAndHome(2);
        foreach ($ar_sectionHome as $key => $section) {
          $data['category_Articles'][] = $this->articles->GetBySection($section->id, 3 );
        }

        $data['files'] = $this->files->getForHome();
        return $data;
    }

    function newsSection($slug)
    {
      $data['section'] = $this->section->getSectionbySlug($slug);
      if(is_null($data['section'])) return null;
      if(is_null($data['section']->parentId))
      {
          $data['news']  = $this->news->GetBySectionpaginate($data['section']->id, 10 );
      }else
      {
        $data['news']  = $this->news->GetBySectionpaginate(null, 10,$data['section']->id );
      }

      return $data;
    }

    function newsSectionapi($slug)
    {
      $section = $this->section->getSectionbySlug($slug);
      if(is_null($section)) return null;
      if(is_null($section->parentId))
      {
          $data  = $this->news->GetBySectionpaginate($section->id, 10 );
      }else
      {
        $data  = $this->news->GetBySectionpaginate(null, 10,$section->id );
      }
      $data->map(function ($index) {
        $index->section['name'] = $index->section->name;
        $index->imageUrl = $index->image->getImageThumbAttribute();
          return $index;
      })->toArray();
      return $data;
    }

    function newsSingle($id,$slug)
    {
      $news =  $this->news->getById($id);
      if(is_null($news)) return null;
      if($news->slug != $slug ) return null;
      $news['related_news'] = count($news->related)?$news->related:$this->news->GetBySection($news->sectionId,6,[$id]);
      if(count($news->related))
      {
      $news['related_news']=   $news['related_news']->map(function ($news) {
              return $news->relatedNews;
          });
      }

      return $news;
    }

    function articles()
    {
      $ar_sectionHome = $this->ar_section->GetpublishedAndHome(3);
      foreach ($ar_sectionHome as $key => $section) {
        $data[] = $this->articles->GetBySection($section->id, 10 );
      }
      return $data??[];
    }

    function articlesSection($slug)
    {
      $data['section'] = $this->ar_section->getSectionbySlug($slug);
      if(is_null($data['section'])) return null;
      $data['news']= $this->articles->GetBySectionpaginate($data['section']->id, 10);

      return $data;
    }

    function articleSectionapi($slug)
    {
      $section = $this->ar_section->getSectionbySlug($slug);
      if(is_null($section)) return null;
      $data= $this->articles->GetBySectionpaginate($section->id, 10);
      $data->map(function ($index) {
        $index->section['name'] = $index->section->name;
        $index->imageUrl = $index->image->getImageThumbAttribute();
          return $index;
      })->toArray();
      return $data;
    }

    function articleSingle($id,$slug)
    {
      $news =  $this->articles->getById($id);
      if(is_null($news)) return null;
      if($news->slug != $slug ) return null;
      $news['related_news'] = count($news->related)?$news->related:$this->articles->GetBySection($news->sectionId,6,[$id]);
      if(count($news->related))
      {
      $news['related_news']=   $news['related_news']->map(function ($news) {
              return $news->relatedNews;
          });
      }

      return $news;
    }

    public function files()
    {
      $data =  $this->files->getAllpaginate();
      return $data;
    }

    public function filesApi()
    {
      $data =  $this->files->getAllpaginate();

      $data->map(function ($index) {
        $index->imageUrl = $index->firstNews?$index->firstNews->relatedNews->image->getImageThumbAttribute():url('default.png');
          return $index;
      })->toArray();
      return $data;
    }

    function fileSingle($id,$slug)
    {
        $file =  $this->files->getById($id);
        if(is_null($file)) return null;
        if($file->slug != $slug ) return null;

        if(count($file->news))
        {
          $file['news']=   $file->news->map(function ($news) {
              return $news->relatedNews;
            });
        }
        return $file;
    }

      function newstags($slug)
      {
        $section = $this->keywords->getByKey('slug',$slug);
        if(is_null($section)) return null;
        $data['keyword']=$section;
        $data['news']= $this->news->GetBykeywordpaginate($section->id, 10);
        return $data;
      }

      function newstagsapi($slug)
      {
        $section = $this->keywords->getByKey('slug',$slug);
        if(is_null($section)) return null;
        $data = $this->news->GetBykeywordpaginate($section->id, 10);

        $data->map(function ($index) {
          $index->section['name'] = $index->section->name;
          $index->imageUrl = $index->image->getImageThumbAttribute();
            return $index;
        })->toArray();

        return $data;
      }


      function search($q)
      {
          $data['keyword'] = $q;
          $data['news'] = $this->news->SearchForWebsite($q);
          return $data;
      }

      function searchapi($q)
      {
        $data = $this->news->SearchForWebsite($q);
        $data->map(function ($index) {
          $index->section['name'] = $index->section->name;
          $index->imageUrl = $index->image->getImageThumbAttribute();
            return $index;
        })->toArray();
        return $data;
      }
      function exam()
      {
        $data['sections'] = $this->ex_section->getGroupByKey('status','published');
        $data['exams'] = $this->exams->getByKeypaginate('type','multipleQuestions');
        return $data;
      }

      function examSection($slug)
      {
        $data['section'] = $this->ex_section->getSectionbySlug($slug);
        if(is_null($data['section'])) return null;
        $data['exams']= $this->exams->GetBySectionpaginate($data['section']->id, 10);
        return $data;
      }
      function examApi($slug = null)
      {
        if(is_null($slug))
        {
          $data = $this->exams->getByKeypaginate('type','multipleQuestions');
        }
        else
        {
          $section = $this->ex_section->getSectionbySlug($slug);
          $data = $this->exams->GetBySectionpaginate($section->id, 10);
        }
        $data->map(function ($index) {
            if($index->image)
            {
                $index->imageUrl = $index->image->getImageThumbAttribute();
            }else{
              $index->imageUrl = url('default.png');
            }

            return $index;
        })->toArray();
        return $data;
      }

      function examSingle($id,$slug)
      {
        $exam =  $this->exams->getById($id);
        if(is_null($exam)) return null;
        if($exam->slug != $slug ) return null;
        $exam['related'] = $this->exams->getGroupByKeyExceptKey('type','multipleQuestions', 'id',$exam->id )->take(3);
        if(count($exam->questions))
        {
        $exam['questions'] = $exam['questions']->map(function ($news) {
                return $news->Question;
            });
        }

        return $exam;

      }


}
