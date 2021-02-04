<?php
namespace App\Http\Controllers;
use App\Http\Helpers\Helpers;
use ZeinaDev\Services\Interfaces\KeywordsServiceInterface;
use Illuminate\Http\Request;
use App\NewsKeywords;
use App\ArticlesKeywords;

class KeywordsController extends Controller
{
    private $keywords;
    public function __construct(KeywordsServiceInterface $keywordsService )
    {
        $this->keywords = $keywordsService;
    }

    public function index()
    {
        $keywords = $this->keywords->getAllpaginate();
        return view('dashboard.keywords.index',compact('keywords'));
    }

    public function create()
    {
        return view('dashboard.keywords.mange');
    }
    public function edit($id)
    {
        $keywords_edit = $this->keywords->getById($id);
        return view('dashboard.keywords.mange',compact('keywords_edit'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:keywords,name',
            'slug' => 'required|unique:keywords,slug',
        ]);
        $model = $this->keywords->AttributeCustom($request);
        $this->keywords->create($model);
        return redirect()->route('keywords.index')->with('success','تم اضافة الكلمة  بنجاح');
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $category_name = $this->keywords->getById($id);
        if(empty($category_name)){
            return redirect('category')
                ->with('error','تعذر الحصول على بيانات');
        }
        $model = $this->keywords->AttributeCustom($request,$id);
        $this->keywords->update($id,$model);
        $this->keywords->updateRelated($id);

        return redirect()->route('keywords.index')->with('success','تم تحديث الكلمة  بنجاح');
    }
    public function destroy($id)
    {
        NewsKeywords::where('keyword_Id',$id)->delete();
        ArticlesKeywords::where('keyword_Id',$id)->delete();
        $this->keywords->deleteById($id);
        return redirect()->route('keywords.index')->with('success','تم حذف الكلمة  بنجاح');
    }

    public function search(Request $request)
    {
        $data =  $this->keywords->searchByKey('name',$request->q);
        return  response()->json([
            "status" => 1,
            "message" => 'search result',
            "data" => $data
        ], 200);
    }

    public function show(Request $request)
    {
        $keyword = $request->q;
        $keywords = $this->keywords->getFilter($keyword);

        return view('dashboard.keywords.index',compact('keywords'));

    }
}
