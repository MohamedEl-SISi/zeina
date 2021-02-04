<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ZeinaDev\Services\Interfaces\QuestionServiceInterface;
use App\ExamsQuestion;

class QuestionController extends Controller
{
    private $question;


    public function __construct(QuestionServiceInterface $questionService   )
    {
        $this->question = $questionService;
    }

    public function index()
    {
        $questions = $this->question->getAllpaginate();
        return view('dashboard.question.index',compact('questions'));
    }

    public function create()
    {
        return view('dashboard.question.mange');
    }

    public function edit($id)
    {
        $question_edit = $this->question->getById($id);
        return view('dashboard.question.mange',compact('question_edit'));
    }

    public function store(Request $request)
    {
        $model = $this->question->AttributeCustom($request);
         $this->question->create($model);
        return redirect()->route('question.index')->with('success','تم اضافة التصنيف  بنجاح');
    }


    public function update(Request $request, $id)
    {

        $model = $this->question->AttributeCustom($request,$id);
        $this->question->update($id,$model);

        return redirect()->route('question.index')->with('success','تم تحديث التصنيف  بنجاح');
    }
    public function destroy($id)
    {
           ExamsQuestion::where('question_id',$id)->delete();

          $data = $this->question->deleteById($id);

        return redirect()->route('question.index')->with('success','تم حذف التصنيف  بنجاح');
    }

    public function search(Request $request)
    {
        $data =  $this->question->searchByKey('question_head',$request->q);
        return  response()->json([
            "status" => 1,
            "message" => 'search result',
            "data" => $data
        ], 200);
    }
}
