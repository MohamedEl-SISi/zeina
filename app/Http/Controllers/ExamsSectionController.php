<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ZeinaDev\Services\Interfaces\ExamsSectionServiceInterface;
use ZeinaDev\Services\Interfaces\ExamsServiceInterface;

class ExamsSectionController extends Controller
{
    private $section;
    private $exam;

    public function __construct(ExamsSectionServiceInterface $sectionService,ExamsServiceInterface $examService )
    {
        $this->section = $sectionService;
        $this->exam = $examService;
    }

    public function index()
    {
        $section = $this->section->getAllpaginate();
        return view('dashboard.examssection.index',compact('section'));
    }


    public function create()
    {
        return view('dashboard.examssection.mange',compact('images'));
    }

    public function edit($id)
    {
        $section_edit = $this->section->getById($id);

        return view('dashboard.examssection.mange',compact('section_edit'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:articlesections,name',
            'slug' => 'required|unique:articlesections,slug',
        ]);
        $model = $this->section->AttributeCustom($request);
        $this->section->create($model);
        return redirect()->route('examsSection.index')->with('success','تم اضافة التصنيف  بنجاح');
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

        return redirect()->route('examsSection.index')->with('success','تم تحديث التصنيف  بنجاح');
    }
    public function destroy($id)
    {
          $this->exam->updateByKey('sectionId',$id,['sectionId'=>null]);
          $data = $this->section->deleteById($id);

        return redirect()->route('examsSection.index')->with('success','تم حذف التصنيف  بنجاح');
    }
}
