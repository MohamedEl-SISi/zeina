<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ZeinaDev\Services\Interfaces\NewsServiceInterface;
use  ZeinaDev\Services\Interfaces\ImagesServiceInterface;
use ZeinaDev\Services\Interfaces\SectionServiceInterface;
use ZeinaDev\Services\Interfaces\FixedMediaInterface;
use App\NewsRelated;
use App\FilesNews;

class NewsController extends Controller
{
    private $news;
    private $images;
    private $newsCategories;
    private $fixedMedia;

    public function __construct(NewsServiceInterface $newsService , ImagesServiceInterface $imagesService
                                ,FixedMediaInterface $fixedMedia,SectionServiceInterface $sectionService )
    {
        $this->news           = $newsService;
        $this->images         = $imagesService;
        $this->newsCategories = $sectionService;
        $this->fixedMedia     = $fixedMedia;
    }

    public function index()
    {
        $news = $this->news->getAllpaginate();
        $newsCategories = $this->newsCategories->getGroupByKey('parentId',null);
        $newsCategories->prepend(['id'=>'null','name'=>'كل التصنيفات']);
        return view('dashboard.news.index',compact('news','newsCategories'));
    }

    public function create()
    {
        $images   = $this->images->getAllpaginate();
        $newsCategories = $this->newsCategories->getGroupByKey('parentId',null);
        $newsId = $this->fixedMedia->getByKey('type','news');

        $home_news = $this->news->getGroupByKeyWhereIn('id',(!is_null($newsId))?$newsId->data:[0]);

        return view('dashboard.news.mange',compact('images','newsCategories','home_news','newsId'));
    }
    public function edit($id)
    {
        $new_edit = $this->news->getById($id);
        if(is_null($new_edit)) return redirect()->route('news.create');
        $images   = $this->images->getAllpaginate();
        $newsCategories = $this->newsCategories->getGroupByKey('parentId',null);
        $section_child = $new_edit->section?$new_edit->section->sub:collect([]);
        $section_child->count()?$section_child->prepend(['id'=>0,'name'=>'بدون تصنيف فرعي']):null;
        $newsId = $this->fixedMedia->getByKey('type','news');


        $home_news = $this->news->getGroupByKeyWhereIn('id',(!is_null($newsId))?$newsId->data:[0]);

        return view('dashboard.news.mange',compact('new_edit','images','newsCategories','home_news','newsId','section_child'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $model = $this->news->NewsAttributeCustom($request);
        $new = $this->news->create($model);

        $this->news->createAndUpdateRelatedKeywords($request,$new->id);
        $this->news->createAndUpdateRelatednews($request,$new->id);

        $request->in_home?$this->fixedMedia->HomeNewMedia($request,$new):null;

        return redirect()->route('news.edit',$new->id)->with('success','تم اضافة  خبر بنجاح');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);

         $model = $this->news->NewsAttributeCustom($request,$id);
         $this->news->update($id,$model);
         $this->news->createAndUpdateRelatedKeywords($request,$id);
         $this->news->createAndUpdateRelatednews($request,$id);
         $new = $this->news->getById($id);
         $this->fixedMedia->HomeNewMedia($request,$new);

        return redirect()->route('news.edit',$id)->with('success','تم تحديث الاخبار بنجاح');
    }

    public function destroy($id)
    {

        NewsRelated::where('news_Id',$id)->orWhere('related_Id',$id)->delete();
        FilesNews::where('news_Id',$id)->delete();
        $this->news->deleteById($id);

        return redirect()->route('news.index')->with('success','تم حذف الخبر بنجاح');
    }

    public function show(Request $request)
    {
        $sectionId = $request->sectionId;
        $status = $request->status;
        $keyword = $request->q;

        $news = $this->news->getFilter($sectionId,$status,$keyword);

        $newsCategories = $this->newsCategories->getGroupByKey('parentId',null);
        $newsCategories->prepend(['id'=>'null','name'=>'كل التصنيفات']);

        return view('dashboard.news.index',compact('news','newsCategories'));
    }

    public function inHome(Request $request)
    {
        $newsId = $this->fixedMedia->getByKey('type','NewsFixedHome');
        $news = $this->news->getGroupByKeyWhereIn('id', $newsId->data??[]);

        $editorId = $this->fixedMedia->getByKey('type','editorchoice');
        $editornews = $this->news->getGroupByKeyWhereIn('id', $editorId->data??[]);

        return view('dashboard.news.inhome',compact('news','newsId','editornews'));
    }

    public function inHomeSave(Request $request)
    {
      $this->fixedMedia->saveFixedHome($request);
      return redirect()->route('news.index')->with('success','نم تحديث');
    }

    public function search(Request $request)
    {

      $data =  $this->news->searchByKey('title',$request->q);

      return  response()->json([
          "status" => 1,
          "message" => 'search result',
          "data" => $data
      ], 200);
    }
    public function socailMedia(Request $request)
    {
      $this->fixedMedia->saveSocailMedia($request);
      return redirect('/dashboard')->with('success','نم تحديث');
    }

}
