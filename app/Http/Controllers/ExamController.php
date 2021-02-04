<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ZeinaDev\Services\Interfaces\ExamsServiceInterface;
use  ZeinaDev\Services\Interfaces\ImagesServiceInterface;
use  ZeinaDev\Services\Interfaces\ExamsSectionServiceInterface;
use App\ExamsQuestion;

class ExamController extends Controller
{
    private $exam;
    private $images;
    private $section;

    public function __construct(ExamsServiceInterface $examService , ImagesServiceInterface $imagesService ,ExamsSectionServiceInterface $sectionService  )
    {
        $this->exam = $examService;
        $this->images = $imagesService;
        $this->section = $sectionService;
    }

    public function index()
    {
        $exams = $this->exam->getAllpaginate();
        return view('dashboard.exam.index',compact('exams'));
    }

    public function create()
    {
        $images   = $this->images->getAllpaginate();
        $newsCategories = $this->section->getAll();
        return view('dashboard.exam.mange',compact('images','newsCategories'));
    }

    public function edit($id)
    {
        $exam_edit = $this->exam->getById($id);
        $images   = $this->images->getAllpaginate();
        $newsCategories = $this->section->getAll();
        return view('dashboard.exam.mange',compact('exam_edit','images','newsCategories'));
    }

    public function store(Request $request)
    {
        $model = $this->exam->AttributeCustom($request);
        $exam = $this->exam->create($model);
        $this->exam->createAndUpdateRelatedQuestions($request,$exam->id);

        return redirect()->route('exam.index')->with('success','تم اضافة التصنيف  بنجاح');
    }


    public function update(Request $request, $id)
    {

        $model = $this->exam->AttributeCustom($request,$id);
        $this->exam->update($id,$model);
        $this->exam->createAndUpdateRelatedQuestions($request,$id);
        return redirect()->route('exam.index')->with('success','تم تحديث التصنيف  بنجاح');
    }
    public function destroy($id)
    {
          ExamsQuestion::where('exam_id',$id)->delete();
          $data = $this->exam->deleteById($id);

        return redirect()->route('exam.index')->with('success','تم حذف التصنيف  بنجاح');
    }
}
