<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ZeinaDev\Services\Interfaces\ArticlesServiceInterface;
use  ZeinaDev\Services\Interfaces\ImagesServiceInterface;
use ZeinaDev\Services\Interfaces\ArticleSectionServiceInterface;
use App\ArticlesRelated;

class ArticlesController extends Controller
{
    private $news;
    private $images;
    private $newsCategories;

    public function __construct(ArticlesServiceInterface $newsService , ImagesServiceInterface $imagesService
                                ,ArticleSectionServiceInterface $sectionService )
    {
        $this->news           = $newsService;
        $this->images         = $imagesService;
        $this->newsCategories = $sectionService;
    }

    public function index()
    {
        $news = $this->news->getAllpaginate();
        $newsCategories = $this->newsCategories->getAll();
        $newsCategories->prepend(['id'=>'null','name'=>'كل التصنيفات']);
        return view('dashboard.articles.index',compact('news','newsCategories'));
    }

    public function create()
    {
        $images   = $this->images->getAllpaginate();
        $newsCategories = $this->newsCategories->getAll();

        return view('dashboard.articles.mange',compact('images','newsCategories'));
    }
    public function edit($id)
    {
        $new_edit = $this->news->getById($id);
        $images   = $this->images->getAllpaginate();
        $newsCategories = $this->newsCategories->getAll();

        return view('dashboard.articles.mange',compact('new_edit','images','newsCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'slug' => 'required|unique:articles,slug',
        ]);

        $model = $this->news->NewsAttributeCustom($request);
        $new = $this->news->create($model);

        $this->news->createAndUpdateRelatedKeywords($request,$new->id);
        $this->news->createAndUpdateRelatednews($request,$new->id);


        return redirect()->route('articles.edit',$new->id)->with('success','تم اضافة  خبر بنجاح');
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

        return redirect()->route('articles.edit',$id)->with('success','تم تحديث الاخبار بنجاح');
    }

    public function destroy($id)
    {
        ArticlesRelated::where('article_Id',$id)->orWhere('related_Id',$id)->delete();
        $this->news->deleteById($id);

        return redirect()->route('articles.index')->with('success','تم حذف الخبر بنجاح');
    }

    public function show(Request $request)
    {
        $sectionId = $request->sectionId;
        $status = $request->status;
        $keyword = $request->q;

        $news = $this->news->getFilter($sectionId,$status,$keyword);

        $newsCategories = $this->newsCategories->getAll();
        $newsCategories->prepend(['id'=>'null','name'=>'كل التصنيفات']);

        return view('dashboard.articles.index',compact('news','newsCategories'));
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
}
