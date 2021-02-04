<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ZeinaDev\Services\Interfaces\FilesServiceInterface;
use App\FilesNews;

class FilesController extends Controller
{
    private $files;

    public function __construct(FilesServiceInterface $filesService   )
    {
        $this->files = $filesService;
    }

    public function index()
    {
        $files = $this->files->getAllpaginate();
        return view('dashboard.files.index',compact('files'));
    }

    public function create()
    {
        return view('dashboard.files.mange');
    }

    public function edit($id)
    {
        $file_edit = $this->files->getById($id);
        return view('dashboard.files.mange',compact('file_edit'));
    }

    public function store(Request $request)
    {
        $model = $this->files->AttributeCustom($request);
        $file = $this->files->create($model);

        $this->files->createAndUpdateRelatedNews($request,$file->id);

        return redirect()->route('files.index')->with('success','تم اضافة التصنيف  بنجاح');
    }


    public function update(Request $request, $id)
    {

        $model = $this->files->AttributeCustom($request,$id);
        $this->files->update($id,$model);
        $this->files->createAndUpdateRelatedNews($request,$id);
        return redirect()->route('files.index')->with('success','تم تحديث التصنيف  بنجاح');
    }
    public function destroy($id)
    {
          FilesNews::where('file_Id',$id)->delete();
          $data = $this->files->deleteById($id);
        return redirect()->route('files.index')->with('success','تم حذف التصنيف  بنجاح');
    }
}
