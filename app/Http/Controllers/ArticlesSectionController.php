<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ZeinaDev\Services\Interfaces\ArticleSectionServiceInterface;
use  ZeinaDev\Services\Interfaces\ImagesServiceInterface;
use ZeinaDev\Services\Interfaces\ArticlesServiceInterface;

class ArticlesSectionController extends Controller
{
    private $section;
    private $images;
    private $news;

    public function __construct(ArticleSectionServiceInterface $sectionService ,ImagesServiceInterface $imagesService  ,ArticlesServiceInterface $newsService)
    {
        $this->section = $sectionService;
        $this->images  = $imagesService;
        $this->news    = $newsService;

    }

    public function index()
    {
        $section = $this->section->getAllpaginate();
        return view('dashboard.articlesection.index',compact('section'));
    }


    public function create()
    {
        $images   = $this->images->getAllpaginate();
        return view('dashboard.articlesection.mange',compact('images'));
    }

    public function edit($id)
    {
        $section_edit = $this->section->getById($id);
        $images   = $this->images->getAllpaginate();

        return view('dashboard.articlesection.mange',compact('section_edit','images'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:articlesections,name',
            'slug' => 'required|unique:articlesections,slug',
        ]);
        $model = $this->section->AttributeCustom($request);
        $this->section->create($model);
        return redirect()->route('articleSection.index')->with('success','تم اضافة التصنيف  بنجاح');
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $section_name = $this->section->getById($id);
        if(empty($section_name)){
            return redirect('articleSection')
                ->with('error','تعذر الحصول على بيانات');
        }

        $model = $this->section->AttributeCustom($request,$id);
        $this->section->update($id,$model);

        return redirect()->route('articleSection.index')->with('success','تم تحديث التصنيف  بنجاح');
    }
    public function destroy($id)
    {
          $this->news->updateByKey('sectionId',$id,['sectionId'=>null]);
          $data = $this->section->deleteById($id);

        return redirect()->route('articleSection.index')->with('success','تم حذف التصنيف  بنجاح');
    }
}
