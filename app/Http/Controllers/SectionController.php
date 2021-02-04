<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ZeinaDev\Services\Interfaces\SectionServiceInterface;
use  ZeinaDev\Services\Interfaces\ImagesServiceInterface;
use ZeinaDev\Services\Interfaces\NewsServiceInterface;
use ZeinaDev\Services\Interfaces\FixedMediaInterface;

class SectionController extends Controller
{
    private $section;
    private $images;
    private $news;
    private $fixedMedia;

    public function __construct(SectionServiceInterface $sectionService ,ImagesServiceInterface $imagesService
                                      ,FixedMediaInterface $fixedMedia,NewsServiceInterface $newsService )
    {
        $this->section = $sectionService;
        $this->images  = $imagesService;
        $this->news    = $newsService;
        $this->fixedMedia = $fixedMedia;
    }

    public function index()
    {
        $section = $this->section->getAllpaginate();
        return view('dashboard.section.index',compact('section'));
    }

    public function child(Request $request)
    {
        $sections = $this->section->getGroupByKey('parentId',$request->id);
        if($sections->count())
        {
          $sections->prepend(['id'=>0,'name'=>'بدون تصنيف فرعي']);
        }
        return  response()->json([
            "status" => 1,
            "message" => 'created successfully',
            "data" => $sections
        ], 200);
    }


    public function create()
    {
        $section = $this->section->getGroupByKey('parentId',null);
        $section->count() ? $section->prepend(['id'=>0,'name'=>'تصنيف رئيسى']):($section = collect([])->prepend(['id'=>0,'name'=>'تصنيف رئيسى']) );
        $images   = $this->images->getAllpaginate();

        return view('dashboard.section.mange',compact('section','images'));
    }

    public function edit($id)
    {
        $section_edit = $this->section->getById($id);
        $section = $this->section->getGroupByKey('parentId',null)->where('id','!=',$id);
        $section->count() ? $section->prepend(['id'=>0,'name'=>'تصنيف رئيسى']):($section = collect([])->prepend(['id'=>0,'name'=>'تصنيف رئيسى']) );
        $images   = $this->images->getAllpaginate();

        return view('dashboard.section.mange',compact('section','section_edit','images'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:sections,name',
            'slug' => 'required|unique:sections,slug',
        ]);
        $model = $this->section->AttributeCustom($request);
        $this->section->create($model);
        return redirect()->route('section.index')->with('success','تم اضافة التصنيف  بنجاح');
    }

    public function Show(Request $request)
    {
      if(request()->segment(3)=='menu')
      {
        $sections = $this->section->getGroupByKey('in_menu',1);
        $order = $this->fixedMedia->getByKey('type','SectionsOrderMenu');
        // dd($order);
      return view('dashboard.section.orderMenu',compact('sections','order'));
      }
      else
      {
        $sections = $this->section->GetpublishedAndHome();
        $order = $this->fixedMedia->getByKey('type','SectionsOrder');

      return view('dashboard.section.order',compact('sections','order'));

      }
    }

    public function saveOrder(Request $request)
    {
      $this->fixedMedia->SectionOrder($request);
      return redirect()->route('section.index')->with('success','تم تحديث التصنيف  بنجاح');
    }

    public function saveOrderMenu(Request $request)
    {
      $this->fixedMedia->SectionOrderMenu($request);
      return redirect()->route('section.index')->with('success','تم تحديث التصنيف  بنجاح');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $section_name = $this->section->getById($id);
        if(empty($section_name)){
            return redirect('section')
                ->with('error','تعذر الحصول على بيانات');
        }

        $model = $this->section->AttributeCustom($request,$id);
        $this->section->update($id,$model);

        return redirect()->route('section.index')->with('success','تم تحديث التصنيف  بنجاح');
    }
    public function destroy($id)
    {
          $this->section->updateByKey('parentId',$id,['parentId'=>null]);
          $this->news->updateByKey('sectionId',$id,['sectionId'=>null]);
          $this->news->updateByKey('subSectionId',$id,['subSectionId'=>null]);
          $data = $this->section->deleteById($id);

        return redirect()->route('section.index')->with('success','تم حذف التصنيف  بنجاح');
    }
}
