<?php
namespace App\Http\Controllers;
use App\Http\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Images;
use ImageModel;
use ZeinaDev\Services\Interfaces\ImagesServiceInterface;
use Storage;
use Session;

class ImagesController extends Controller
{
    private $images;
    public function __construct(ImagesServiceInterface $imagesService)
    {
        $this->images = $imagesService;
    }

    public function index(Request $request)
    {
        $images = $this->images->getAllpaginate();
        return view('dashboard.images.index',compact('images'));
    }

    public function loadmore(Request $request)
    {
      $images = $this->images->getAllpaginate();
        return  response()->json([
            "status" => 1,
            "message" => 'created successfully',
            "data" => $images->toArray()
        ], 200);
    }

    public function create()
    {
        return view('dashboard.images.mange');
    }
    public function edit($id)
    {
        $image_edit = $this->images->getById($id);

        Session::put('image_previous_url', url()->previous());
        return view('dashboard.images.mange',compact('image_edit'));
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png|max:5000'
        ]);
        $model = $this->images->AttributeCustom($request);
        $image = $this->images->create($model);
        return redirect()->route('image.index')->with('success','تم اضافة الصوره  بنجاح');
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required',

        ]);

        $image = $this->images->getById($id);
        if(empty($image)){
            return redirect('image')
                ->with('error','تعذر الحصول على بيانات');
        }
        $request->id = $id;
        $model = $this->images->AttributeCustom($request,$id);
        $this->images->update($id,$model);
        $url =  Session::get('image_previous_url');
        return  redirect($url)->with('success','تم تحديث الصوره  بنجاح');
    }
    public function destroy($id)
    {
             $this->images->deleteById($id);

            return redirect()->back()->with('success','تم حذف الصوره  بنجاح');
    }

    public function uploads(Request $request)
    {

        return  response()->json([
            "status" => 1,
            "message" => 'created successfully',
            "data" => $this->images->saveImageApi($request,$request->id)
        ], 200);


    }

    public function show(Request $request)
    {
        $keyword = $request->q;
        $images = $this->images->searchByKey('title',$keyword);
        return view('dashboard.images.index',compact('images'));
    }

    public function search(Request $request)
    {
        $data =  $this->images->searchByKey('title',$request->q);
        return  response()->json([
            "status" => 1,
            "message" => 'created successfully',
            "data" => $data->toArray()
        ], 200);
    }

    public function saveAlbum(Request $request)
    {
      $this->images->saveAlbum($request);
      return redirect()->route('image.index')->with('success','تم اضافة الصوره  بنجاح');
    }


}
