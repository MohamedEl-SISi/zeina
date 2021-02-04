@section('script')
    <script src="{{url('assets\js\plugins\sortable\sortable.min.js')}}"></script>
    <script src="{{url('assets\js\plugins\sortable\sortable.active.js')}}"></script>

    <script src="{{url('assets\js\vendor\popper.min.js')}}"></script>
    <script src="{{url('assets\js\vendor\bootstrap.min.js')}}"></script>

    <script src="{{url('assets\js\plugins\summernote\summernote-bs4.min.js')}}"></script>
    <script src="{{url('assets\js\plugins\summernote\summernote.active.js')}}"></script>
    <script src="{{url('assets\js\plugins\quill\quill.min.js')}}"></script>
    <script src="{{url('assets\js\plugins\quill\quill.active.js')}}"></script>
@endsection
@extends('dashboard.layouts.app')

@section('title','News | Mange |')

@section('content')
    <link id="cus-style" rel="stylesheet" href="{{url('assets\css\style-primary.css')}}">
    <style>

        .single-wrap_box__bottom .note-style,.single-wrap_box__bottom  .note-fontname,.single-wrap_box__bottom  .note-color,
        .single-wrap_box__bottom .note-table,.single-wrap_box__bottom .note-insert [aria-label="Video"],.single-wrap_box__bottom  .note-view
        {
          display: none;
        }
        .single-wrap_box__bottom  .note-insert [aria-label="Picture"]
        {
            display: none;
        }

        .gallery img ,.albums img , .bodyImagesNews img {
            width: 130px;
            height: 130px;
            border-radius: 10px;
            padding: 5px;
        }
        .personimageprofile,.personimagealbum ,.bodyContent
        {
            padding: 6px;
            border-radius: 15px;
            cursor: pointer;
        }
        .hidenow
        {
            display:none;
        }
        .radioimage,.checkimage
        {
            display:none;
        }
        .imagecheck
        {
            border: 2px solid black;
            opacity: 0.5;
        }
        .personsDiv ,.tagsDiv
        {
          padding: 10px;
        }
        .personsDiv  .card img
        {
          border-radius: 10px;
          padding: 5px;
          width: 70%;
          padding-top: 10%;
        }
        .personsDiv .card ,.choosedPerson .card,
        .workDiv .card , .choosedworkcard .card,
        .cinemaDiv .card , .choosedcinema .card,
        .channelCardDiv .card ,.choosedchannel .card,
        .newsDiv .card ,.choosednews .card,
        .newsDiv .card , .choosednews .card,
        .tagsDiv .card , .choosedtags .card
        {
          border-radius: 20px;
          height: auto;
          padding-bottom: 2%;
          margin-bottom: 5px;
          padding-top: 2%;
        }
        .addtoPerson ,.removePerson ,
        .addtoWorkCard ,.removeWorkcard,
        .addtoCinema  ,.removecinema,
        .addtochannel ,.removechannel,
        .addtonews ,.removenews,
        .addtotags ,.removetags
        {
          width: 80%;
          border-radius: 10px;
          background-color: #20cc5d;
          padding: 1.5%;
          color: white;
          margin: 0 auto;
            cursor: pointer;
        }
        .removePerson , .removeWorkcard ,.removecinema ,.removenews ,.removechannel ,.removetags
        {
          background-color:  #cc3020
        }
        .inhomedivSwitch,.inHomeDiv
        {
            display: none;
        }
        .newsDiv
        {
            margin-top: 10px;
        }
        .card h4
        {
            font-size: 15px;
            padding: 4px;
        }

        .body-content
        {
            /*border: 2px solid #0001086e;*/
            /*border-radius: 30px;*/
            /*padding-top: 20px;*/
            /*padding-bottom: 20px;*/
        }
        /*.note-editor.note-frame .note-btn*/
        /*{*/
            /*color:blue;*/
        /*}*/
        /*.link-dialog*/
        /*{*/
            /*direction: ltr;*/
        /*}*/
        .full-width{
            width: 100%;
        }
        .expand_and_collapse_container{
            position: relative;
            width: 100%;
        }
        .single-wrap_box{
            position: relative;
            margin-bottom: 15px;
            border-bottom: 1px solid #00000075;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .single-wrap_box__top{
            height: 60px;
            position: relative;
            border-bottom: none;
            border: 1px solid #00000075;
            border-bottom: none;
            border-radius: 8px;
        }
        .expand_click{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 38px;
            background: #9f9f9f;
            position: absolute;
            left: 1.5%;
            top: 10px;
            border-radius: 6px;
        }

        .single-wrap_box__top .add_click
        {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            position: absolute;
            left: 5%;
            top: 10px;
        }
        .expand_click i{
            display: inline-block;

            color: #fff;
        }
        .single-wrap_box__bottom{
            padding: 15px;
            border:1px solid #00000075;
            border-bottom: 0;
            border-top: none;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .single-wrap_box__top.active .expand_click i{
            transform: rotate(180deg);

        }
        .single-wrap_box__top.active {
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }
        .removefromBody {
    border-radius: 50px;
    position: absolute;
    top: 0px;
    font-size: 15px;
  }
  @media only screen and (max-width: 600px) {
    .single-wrap_box__top .add_click {
      left: 15%;
    }
    .single-wrap_box__bottom  .note-insert
    {
      display: none;
    }
    .add-more {
    left: 0.5%;
    width: 35px;
    }
}
    </style>
      <link id="cus-style" rel="stylesheet" href="assets\css\style-primary.css">
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">

                    @if(isset($new_edit) )
                        <h3>تعديل خبر</h3>
                    @else
                        <h3>اضافة خبر</h3>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-12">
          @if (session('message'))
              <div class="alert alert-success" align="center">
                  {{ session('message') }}
              </div>
          @endif
          @if(session()->has('error'))

            <div class="alert alert-danger" align="center">
                {{ session()->get('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12 mb-30">
                <div class="box">
                    <div class="box-body">
                        <div class="row mbn-20">
                            <div class="col-lg-12 col-12 mb-20">
                                <div class="row mbn-15">
                                    @if(isset($new_edit))
                                          {!!Form::model($new_edit,array('url'=>url('dashboard/news/'.$new_edit->id),'method' => 'PATCH','files'=>true,'style'=>'width: 100%',"class"=>"row justify-content-center"))!!}

                                            @php
                                              $Helper= new App\Http\Helpers\Helpers;
                                              $mainmage = $Helper->getImageUrl($new_edit->photo['id']??0,'300x250',$new_edit->photo['path']??"");

                                               foreach ($new_edit->newsCatagory??[] as $category)
                                                {
                                                    $filterCategory = collect($newsCategories)->where('name',$category['name'])->first();

                                                    $serialzeCategory[] = $filterCategory?$filterCategory['id']:null;
                                                }
                                            @endphp
                                    @else
                                        {!!Form::open(array('url'=>url('dashboard/news'),'files'=>true,'style'=>'width: 100%',"class"=>"row justify-content-center"))!!}
                                    @endif

                                      @php
                                        $mediaSizes = explode(",", getenv('MediaSizes'));
                                        $mediaSizes = array_map(function($size) {
                                            $newSize = ['name'=>$size ,'id'=>$size];
                                          return $newSize;
                                        },$mediaSizes);
                                        $src = ['name'=>'src','id'=>'src'];
                                        $mediaSizes = array_merge([$src],$mediaSizes);
                                      @endphp

                                        <div class="col-lg-6 mb-15">
                                            {!! Form::label('title', ' عنوان الخبر') !!}
                                            {!!Form::text('title',null,array('class'=>'form-control ','placeholder'=>'عنوان الخبر','autocomplete'=>'off','required'=>'required','id'=>'name'))!!}
                                        </div>

                                        <div class="col-lg-6 mb-15">
                                            {!! Form::label('slug', 'الرابط الدائم') !!}
                                            @if(isset($new_edit))
                                                @if(is_null($new_edit->slug))
                                                      {!!Form::text('slug',null,array('class'=>'form-control ','placeholder'=>'عنوان الخبر','id'=>'slug','autocomplete'=>'off','required'=>'required'  ))!!}
                                                @else
                                                  <span>{{$new_edit->slug}}</span>
                                                @endif

                                            @else
                                                {!!Form::text('slug',null,array('class'=>'form-control ','placeholder'=>'عنوان الخبر','id'=>'slug','autocomplete'=>'off','required'=>'required'  ))!!}
                                            @endif
                                        </div>

                                        @if(auth::user()->role->role_id <= 3)
                                        <div class="col-lg-4 mb-15">
                                            {!! Form::label('status', 'الحالة') !!}
                                            {!!Form::select('status',['draft'=>'مسوده','published'=>'منشور'],$section_edit??null ?serialize($section_edit->section):null,array('class'=>'form-control ','required'=>'required' ,'id'=>'status'))!!}
                                        </div>
                                        @endif
                                        <div class="col-lg-4 mb-15">
                                            {!! Form::label('publisher_name', 'اسم الناشر') !!}
                                            {!!Form::text('publisher_name',null,array('class'=>'form-control ','placeholder'=>'اسم الناشر','autocomplete'=>'off','id'=>'name'))!!}
                                        </div>


                                        <div class="col-lg-4 mb-15">
                                            {!! Form::label('sectionId', 'تصنيف الخبر') !!}
                                            {!!Form::select('sectionId',collect($newsCategories)->pluck('name','id'), $serialzeCategory??null,array('class'=>'form-control maintype','required'=>'required'))!!}
                                        </div>
                                        <div class="col-12 mb-15 hidenow" @if(count($section_child??[])) style="display: block" @endif>
                                            {!! Form::label('subtype', ' نوع الفرعي للعمل') !!}
                                            {!!Form::select('subSectionId',collect($section_child??[])->pluck('name','id'), $serialzeType_child??null,array('class'=>'form-control '))!!}
                                        </div>
                                        <div class="col-lg-8 col-12 mb-30 inHomeDiv">
                                           <label class="adomx-switch"><input type="checkbox" id="home_switcher" name="in_home" @if(isset($new_edit)) @if($new_edit->in_home) checked @endif @endif > <i class="lever"></i> <span class="text"> تثبيت في الرئيسية</span></label>
                                           <div class="inhomedivSwitch">
                                               <div class="box">
                                                   <div class="box-head">
                                                       <h4 class="title">تحديد الترتيب في الصفحه الرئيسة</h4>
                                                       <small> <span>اخر خبر في الترتيب يتم حذفها من الرئيسه</span> </small>
                                                   </div>
                                                   <div class="box-body">
                                                       <ul id="simple-sortable" class="sortable simple-sortable list-group">
                                                           @if(count($home_news??[]))

                                                           @foreach((!is_null($newsId))?$newsId->data:[] as $key=> $id)

                                                             @if($id != 'new')
                                                               @php
                                                               $new = $home_news->where('id',$id)->first();
                                                               @endphp
                                                               <li class="list-group-item @if(isset($new_edit))   @if( $new->id == $new_edit->id ) newNewList  @else @endif    @endif"><input type="hidden" name="inHomeNews[]" @if(isset($new_edit))   @if( $new->id == $new_edit->id )  value="new" @else @endif value="{{$new->id}}"  @else  value="{{$new->id}}" @endif > {{$new->title}}</li>
                                                            @endif
                                                           @endforeach

                                                           @if(isset($new_edit))
                                                               @if($new_edit->in_home)
                                                                   @if(!in_array($new_edit->id  ,(!is_null($newsId))?$newsId->data:[]) )
                                                                   <li class="list-group-item newNewList"><input type="hidden" name="inHomeNews[]" @if(isset($new_edit))    value="new"  @endif   > {{$new_edit->title}}</li>
                                                                   @endif
                                                                 @endif
                                                            @endif

                                                           @endif
                                                       </ul>
                                                   </div>
                                               </div>
                                           </div>

                                        </div>

                                        <div class="col-12 mb-15">
                                            @if(isset($new_edit))
                                                @php
                                                    $new_edit->desc = strip_tags($new_edit->desc);
                                                @endphp
                                            @endif
                                            {!! Form::label('desc', ' نص  مختصر عن الخبر') !!}
                                            {!!Form::textarea('desc',null,array('class'=>'form-control','maxlength'=>"160"))!!}
                                        </div>

                                  <div class="expand_and_collapse_container">


                                        <div class="col-12 mb-15">
                                          <h4>تفاصيل الخبر</h4>

                                          <label class="adomx-switch">
                                            <input type="checkbox" id="paragraph_body" name="paragraph_body" @if(isset($new_edit)) @if($new_edit->paragraph_body) checked @endif @endif >
                                             <i class="lever"></i> <span class="text">متعدد الفقرات</span>
                                           </label>
                                        </div>

                                          <div class="col-lg-12 blockBody mb-15">
                                                <div class="full-width row justify-content-center body-content mb-15 mt-15">

                                                    <div class="col-12 mb-10 blockbody">
                                                        {!! Form::label('body', ' نص الخبر') !!}
                                                        {!!Form::textarea('block',isset($new_edit)?((is_array($new_edit->body))?null:$new_edit->body):null,array('class'=>'summernote' ))!!}
                                                    </div>
                                                  </div>
                                          </div>
                                        <div  class="paragraph_body col-lg-12">
                                        @if(isset($new_edit))
                                          @if(is_array($new_edit->body))
                                            @forelse($new_edit->body??[] as $key => $content)

                                                    <div class="single-wrap_box">
                                                        <div class="single-wrap_box__top  active">
                                                            <div class="expand_click"><i class="fa fa-chevron-down"></i> </div>

                                                            <div class="add_click" >
                                                            @if($key)
                                                                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>-</button>
                                                                @else
                                                                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i>+</button>
                                                                @endif
                                                            </div>

                                                        </div>

                                                        <div class="single-wrap_box__bottom">
                                                            <div class="full-width row justify-content-center body-content mb-15 mt-15">
                                                                <div class="col-lg-6 mb-10">
                                                                    {!! Form::label('title-body', 'عنوان الفقرة') !!}
                                                                    {!!Form::text('content['.$key.'][title]',$content['title']??null,array('class'=>'form-control'))!!}
                                                                </div>

                                                                <div class="col-lg-6 mb-10">
                                                                    {!! Form::label('youtube-body', 'فيديو youtube') !!}
                                                                    {!!Form::text('content['.$key.'][youtube]',$content['youtube']??null,array('class'=>'form-control'))!!}
                                                                </div>

                                                                <div class="col-12 mb-10">
                                                                    {!! Form::label('video-body', 'كود  للفقرة') !!}
                                                                    {!!Form::textarea('content['.$key.'][video]',$content['video']??null,array('class'=>'form-control'))!!}
                                                                </div>

                                                                <button class="btn btn-primary openModel" type="button" data-toggle="modal" data-number="{{$key}}" data-target="#bodyImages">
                                                                  <i class="glyphicon glyphicon-plus"></i>اختار صور  البوم </button>
                                                                <div class="col-12 mb-10 row bodyImagesNews" data-div-number="{{$key}}" >

                                                                  <div class="col-lg-12 mt-15 mb-15" align="center">
                                                                      {!! Form::label('photo-body', 'صوره الفقرة') !!}
                                                                  </div>
                                                                        @foreach($content['photos']??[] as $indexAlbum => $album_image)
                                                                            <div class="col-lg-2 col-md-2 mb-10" align="center">
                                                                            <button class="btn btn-danger removefromBody" type="button"><i class="glyphicon glyphicon-remove"></i>X</button>
                                                                            <img src="{{$album_image['image_thumb']}}">
                                                                              {!!Form::checkbox('content['.$key.'][photos][]',$album_image['id'],true,array('class'=>'checkimage ','id'=>'newsBody'.$album_image['id']))!!}
                                                                              {!!Form::select('content['.$key.'][size][]',collect($mediaSizes)->pluck('name','id'),isset($content['size'])?$content['size'][$indexAlbum]:'600x400',array('class'=>'form-control '))!!}
                                                                            </div>
                                                                        @endforeach

                                                                </div>
                                                                @php
                                                                    $content['content'] = strip_tags($content['content']??'');
                                                                @endphp
                                                                <div class="col-12 mb-10">
                                                                    {!! Form::label('body', ' نص الخبر') !!}
                                                                    {!!Form::textarea('content['.$key.'][content]',$content['content']??null,array('class'=>'form-control textareTosummer' ,"onpaste"=>"removestyle()"))!!}
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                @empty

                                                    <div class="single-wrap_box">
                                                        <div class="single-wrap_box__top active">
                                                            <div class="expand_click"><i class="fa fa-chevron-down"></i> </div>

                                                            <div class="add_click" >
                                                                <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i>+</button>
                                                            </div>
                                                        </div>

                                                        <div class="single-wrap_box__bottom">
                                                            <div class="full-width row justify-content-center body-content mb-15 mt-15">

                                                                <div class="col-lg-6 mb-10">
                                                                    {!! Form::label('title-body', 'عنوان الفقرة') !!}
                                                                    {!!Form::text('content[0][title]',null,array('class'=>'form-control'))!!}
                                                                </div>

                                                                <div class="col-lg-6 mb-10">
                                                                    {!! Form::label('youtube-body', 'فيديو youtube') !!}
                                                                    {!!Form::text('content[0][youtube]',null,array('class'=>'form-control'))!!}
                                                                </div>

                                                                <div class="col-12 mb-10">
                                                                    {!! Form::label('video-body', 'كود  للفقرة') !!}
                                                                    {!!Form::textarea('content[0][video]',null,array('class'=>'form-control'))!!}
                                                                </div>

                                                                <button class="btn btn-primary openModel" type="button" data-toggle="modal" data-number="0" data-target="#bodyImages"><i class="glyphicon glyphicon-plus"></i>اختار صور  البوم </button>
                                                                <div class="col-12 mb-10 row bodyImagesNews" data-div-number="0" >
                                                                  <div class="col-lg-12 mt-15 mb-15" align="center">
                                                                      {!! Form::label('photo-body', 'صوره الفقرة') !!}
                                                                  </div>

                                                                </div>
                                                                <div class="col-12 mb-10">
                                                                    {!! Form::label('body', ' نص الخبر') !!}
                                                                    {!!Form::textarea('content[0][content]',null,array('class'=>'form-control' ,"onpaste"=>"removestyle()"))!!}
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                @endforelse
                                                @else
                                                    <div class="single-wrap_box">
                                                        <div class="single-wrap_box__top active">
                                                            <div class="expand_click"><i class="fa fa-chevron-down"></i> </div>

                                                            <div class="add_click" >
                                                                <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i>+</button>
                                                            </div>
                                                        </div>

                                                        <div class="single-wrap_box__bottom">
                                                            <div class="full-width row justify-content-center body-content mb-15 mt-15">

                                                                <div class="col-lg-6 mb-10">
                                                                    {!! Form::label('title-body', 'عنوان الفقرة') !!}
                                                                    {!!Form::text('content[0][title]',null,array('class'=>'form-control'))!!}
                                                                </div>

                                                                <div class="col-lg-6 mb-10">
                                                                    {!! Form::label('youtube-body', 'فيديو youtube') !!}
                                                                    {!!Form::text('content[0][youtube]',null,array('class'=>'form-control'))!!}
                                                                </div>

                                                                <div class="col-12 mb-10">
                                                                    {!! Form::label('video-body', 'كود  للفقرة') !!}
                                                                    {!!Form::textarea('content[0][video]',null,array('class'=>'form-control'))!!}
                                                                </div>

                                                                <button class="btn btn-primary openModel" type="button" data-toggle="modal" data-number="0" data-target="#bodyImages"><i class="glyphicon glyphicon-plus"></i>اختار صور  البوم </button>
                                                                <div class="col-12 mb-10 row bodyImagesNews" data-div-number="0" >
                                                                  <div class="col-lg-12 mt-15 mb-15" align="center">
                                                                      {!! Form::label('photo-body', 'صوره الفقرة') !!}
                                                                  </div>

                                                                </div>
                                                                <div class="col-12 mb-10">
                                                                    {!! Form::label('body', ' نص الخبر') !!}
                                                                    {!!Form::textarea('content[0][content]',null,array('class'=>'form-control',"onpaste"=>"removestyle()"))!!}
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>


                                                @endif
                                            @else
                                                <div class="single-wrap_box">
                                                    <div class="single-wrap_box__top active">
                                                        <div class="expand_click"><i class="fa fa-chevron-down"></i> </div>

                                                        <div class="add_click" >
                                                            <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i>+</button>
                                                        </div>
                                                    </div>

                                                    <div class="single-wrap_box__bottom">
                                                        <div class="full-width row justify-content-center body-content mb-15 mt-15">

                                                            <div class="col-lg-6 mb-10">
                                                                {!! Form::label('title-body', 'عنوان الفقرة') !!}
                                                                {!!Form::text('content[0][title]',null,array('class'=>'form-control'))!!}
                                                            </div>

                                                            <div class="col-lg-6 mb-10">
                                                                {!! Form::label('youtube-body', 'فيديو youtube') !!}
                                                                {!!Form::text('content[0][youtube]',null,array('class'=>'form-control'))!!}
                                                            </div>

                                                            <div class="col-12 mb-10">
                                                                {!! Form::label('video-body', 'كود  للفقرة') !!}
                                                                {!!Form::textarea('content[0][video]',null,array('class'=>'form-control'))!!}
                                                            </div>

                                                            <button class="btn btn-primary openModel" type="button" data-toggle="modal" data-number="0" data-target="#bodyImages"><i class="glyphicon glyphicon-plus"></i>اختار صور  البوم </button>
                                                            <div class="col-12 mb-10 row bodyImagesNews" data-div-number="0" >
                                                              <div class="col-lg-12 mt-15 mb-15" align="center">
                                                                  {!! Form::label('photo-body', 'صوره الفقرة') !!}
                                                              </div>

                                                            </div>
                                                            <div class="col-12 mb-10">
                                                                {!! Form::label('body', ' نص الخبر') !!}
                                                                {!!Form::textarea('content[0][content]',null,array('class'=>'form-control',"onpaste"=>"removestyle()"))!!}
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>



                                        @endif

                                        <div class="after-add-more row"></div>
                                      </div>

                                    </div>




                                        <div class="col-12 row mb-15">
                                            {!! Form::label('relatednews', 'اخبار متعلقه') !!}
                                            {!!Form::text('newsSearch',null,array('class'=>'form-control','id'=>'newsSearch'))!!}

                                            <div class="row col-12 newsDiv">
                                            </div>

                                            <div class="row col-12 choosednews">
                                              @if(isset($new_edit))
                                                @foreach($new_edit->related??[] as $new)

                                                <div class="col-2 newsCardDiv   {{$new->relatedNews->id}}" align="center">
                                                 <input type="hidden" name="relatednews[]" value="{{$new->relatedNews->id}}">
                                                 <div class="card">
                                                   <h4>{{$new->relatedNews->title}}</h4>
                                                   <span class="removenews" data-id="{{$new->relatedNews->id}}">حذف</span>
                                                 </div>
                                               </div>
                                               @endforeach
                                               @endif
                                            </div>

                                        </div>

                                        <div class="col-12 row mb-15">
                                            {!! Form::label('relatedTags', 'كلمات متعلقه') !!}
                                            {!!Form::text('newsSearch',null,array('class'=>'form-control','id'=>'tagsSearch'))!!}

                                            <div class="row col-12 tagsDiv">
                                            </div>

                                            <div class="row col-12 choosedtags">
                                                @if(isset($new_edit))

                                                    @foreach($new_edit->keywords??[] as $tag)
                                                        <div class="col-2 tagsCardDiv  {{$tag->keyword->id}}" align="center">
                                                            <input type="hidden" name="relatedTags[]" value="{{$tag->keyword->id}}">
                                                            <div class="card">
                                                                <h4>{{$tag->keyword->name}}</h4>
                                                                <span class="removetags" data-id="{{$tag->keyword->id}}">حذف</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                        </div>


                                        <div class="col-5 mb-15" align="center">

                                            {!! Form::label('photo', ' صوره ') !!}


                                            {!!Form::file('photo',array('accept'=>"image/*",'type'=>'file','class'=>'dropify','data-height'=>'220','id'=>'file','onchange'=>'Filevalidation()',"data-default-file"=>$new_edit??"" ?(is_null($new_edit->image)?"null":$new_edit->image->getImageThumbAttribute()):null))!!}

                                            <span class="form-help-text" id="size">حد اقصي للصوره 5M</span>

                                            <div class="box">
                                                <br>
                                                <button class="btn btn-primary " type="button" data-toggle="modal" data-target="#exampleModal"><i class="glyphicon glyphicon-plus"></i>اختار صوره</button>

                                                <div class="modal fade" id="exampleModal">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">اختار صوره </h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row justify-content-center">
                                                                    <div class="col-lg-8 mb-15">
                                                                        <input class="form-control search-image-keyword" type="text"  placeholder="بحث بعنوان الصوره">
                                                                    </div>
                                                                    <div class="col-lg-4 mb-15">
                                                                        <span class="btn button-primary search-image-submit" data-image-class="personimageprofile" data-btn="loadmoreimages"  placeholder="بحث بعنوان الصوره">بحث في مكتبه الصور</span>
                                                                    </div>
                                                                    @foreach($images as$image)
                                                                        <div class="col-3">
                                                                            <img class="personimageprofile" src="{{$image->image_thumb}}" id="{{$image->id}}" alt="{{$image->title}}">
                                                                            <input type="radio" class="radioimage" id="personal{{$image->id}}" name="imageselector"  value="{{$image->id}}" />
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer justify-content-center">
                                                                <button class="button button-round button-primary loadmoreimages" type="button">المزيد </button>
                                                                <button class="button button-round button-danger  " data-dismiss="modal">اغلاق</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="bodyImages">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">اختار من الصور </h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-8 mb-15">
                                                                <input class="form-control search-image-keyword" type="text"  placeholder="بحث بعنوان الصوره">
                                                            </div>
                                                            <div class="col-lg-4 mb-15">
                                                                <span class="btn button-primary search-image-submit"  data-btn="loadmoreimages_body" data-image-class="bodyContent" placeholder="بحث بعنوان الصوره">بحث في مكتبه الصور</span>
                                                            </div>
                                                            @foreach($images as $image)
                                                                <div class="col-3">
                                                                    <img class="bodyContent" src="{{$image->image_thumb}}" id="{{$image->id}}" alt="{{$image->title}}">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button class="button button-round button-primary loadmoreimages_body" type="button">المزيد </button>
                                                        <button class="button button-round button-danger  " data-dismiss="modal">اغلاق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mb-15">
                                            {!!Form::submit('حفظ', array('class'=>'button button-primary farda','style'=>'width:100%'))!!}
                                        </div>

                                    {!!Form::close()!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>


    <div class="copy" id="copy" style="display:none;">
        <div class="single-wrap_box">
            <div class="single-wrap_box__top active">
                <div class="expand_click"><i class="fa fa-chevron-down"></i> </div>

                <div class="add_click" >
                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>-</button>
                </div>
            </div>
            <div class="single-wrap_box__bottom">
                <div class="full-width row justify-content-center body-content mb-15 mt-15">

                    {{--<div class="col-12 mb-15" align="left">--}}
                        {{--<button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>-</button>--}}
                    {{--</div>--}}

                    <div class="col-lg-6 mb-10">
                        {!! Form::label('title-body', 'عنوان الفقرة') !!}
                        {!!Form::text('content[index][title]',null,array('class'=>'form-control'))!!}
                    </div>

                    <div class="col-lg-6 mb-10">
                        {!! Form::label('youtube-body', 'فيديو youtube') !!}
                        {!!Form::text('content[index][youtube]',null,array('class'=>'form-control'))!!}
                    </div>

                    <div class="col-12 mb-10">
                        {!! Form::label('video-body', 'كود  للفقرة') !!}
                        {!!Form::textarea('content[index][video]',null,array('class'=>'form-control'))!!}
                    </div>
                    <button class="btn btn-primary openModel" type="button" data-toggle="modal" data-number="index" data-target="#bodyImages"><i class="glyphicon glyphicon-plus"></i>اختار صور  البوم </button>
                    <div class="col-12 mb-10 row bodyImagesNews" data-div-number="index" >
                      <div class="col-lg-12 mt-15 mb-15" align="center">
                          {!! Form::label('photo-body', 'صوره الفقرة') !!}
                      </div>

                    </div>
                    <div class="col-12 mb-10">
                        {!! Form::label('body', ' نص الخبر') !!}
                        {!!Form::textarea('content[index][content]',null,array('class'=>"textareTosummer form-control","onpaste"=>"removestyle()"))!!}
                    </div>

                </div>
            </div>
        </div>


    </div>


    <!-- <script type="text/javascript">
     window.onbeforeunload = function () {
      return 'Dont Forget to Save';
     }

     window.addEventListener('beforeunload', (event) => {
       // Cancel the event as stated by the standard.
       // event.preventDefault();
       // Chrome requires returnValue to be set.
       // event.returnValue = '';
       console.log(event)
     });
    </script> -->

    <script>



    $("#name").keyup(function(){
      createslug()
    });

function createslug() {
  var box1 = $('#name');
  var box2 = $('#slug');
  var slug = box1.val().replace(/[^\w\u0621-\u064A\s]/gi, '-');
    var slug = slug.replace(/[0-9]/g, '');
    box2.val(slug.split(' ').join('-'));
}
    $(document).ready(function() {
          $mainCategory = $('.maintype option:selected').val()
          if($('.hidenow').css('display') == "none")
          {
            ajaxforchildScection($mainCategory)
          }
        });

        var typeid=0;
        $('.maintype').on('change', function() {
             typename = $("option:selected", this).val();
            $('.hidenow select').find('option').remove();
            ajaxforchildScection(typename)
        });
        function ajaxforchildScection(section)
        {
          $.ajax
          ({
              url: "{{url('api/section/child')}}",
              data: {"id": section},
              type: 'get',
              success: function (result) {
                  var section = result.data;
                  if(section.length)
                  {
                      jQuery.each( section, function( i, val ){
                          $('.hidenow select').append(new Option(val.name, val.id))
                          $('.hidenow').show()
                      });
                  }else
                  {
                      $('.hidenow select').find('option').remove();
                      $('.hidenow').hide();
                  }
              }
          });
        }




        $('form input').keydown(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });

        $(document).on("click",".openModel", function () {
            $('#bodyImages').attr('div-data',$(this).attr("data-number"))
        });

        $(document).on("click",".bodyContent", function () {


          var divBodyIndex = $('#bodyImages').attr('div-data')
            var bodyImagesNews = $('[data-div-number="'+divBodyIndex+'"]')

            if(bodyImagesNews.find('#newsBody'+this.id).length)
            {
                bodyImagesNews.find('img[src="'+this.src+'"]').parent().remove();
                $('#newsBody'+this.id).remove();
            }else
            {
            bodyImagesNews.append('<div class="col-lg-2 col-md-2 mb-10" align="center"> <button class="btn btn-danger removefromBody" type="button"><i class="glyphicon glyphicon-remove"></i>X</button> <img src="'+this.src+'"><input type="checkbox" class="checkimage" id="newsBody'+this.id+'" name="content['+divBodyIndex+'][photos][]"  checked="true"  value="'+this.id+'" />'+
            '<select class="form-control " name="content['+divBodyIndex+'][size][]"><option value="src" >src</option><option value="600x400">600x400</option><option selected="selected" value="300x250">300x250</option><option value="120x90">120x90</option><option value="300x550">300x550</option><option value="600x230">600x230</option></select> </div');
            }

        });

        $(document).on("click",".removefromBody", function () {
                $(this).parent().remove();
        });

        var loadmoreimages_body=2;
        $(document).on("click",".loadmoreimages_body", function () {
            var row=$(this).parent().parent().find('.row');

            var page = loadmoreImage_personal++;
            $.ajax
            ({
                url: "{{url('api/images/loadmore')}}",
                data: {"page": page},
                type: 'get',
                success: function(result)
                {
                    var newimages = result.data.data;

                    if(newimages.length)
                    {

                        jQuery.each( newimages, function( i, val ){
                            row.append('<div class="col-3"> <img class="bodyContent" src="'+val.image_thumb+'" id="'+val.id+'" alt="'+val.title+'"> <input type="radio" class="radioimage" id="personal'+val.id+'" name="imageselector"  value="'+val.id+'" /></div>')
                        });
                    }else
                    {
                        $('.loadmoreimages_body').remove();
                    }
                }
            });

        });

        var countcopy=$('.row  .body-content').length;
        $(document).ready(function() {
            $(".add-more").click(function(){
                var html = document.getElementById('copy').innerHTML;

                html =   html.replace("index",countcopy );
                html =   html.replace("index",countcopy );
                html =   html.replace("index",countcopy );
                html =   html.replace("index",countcopy );
                html =   html.replace("index",countcopy );
                html =   html.replace("index",countcopy );

                countcopy++;

                $(".after-add-more").before(html);

                // $('.textareTosummer').eq(($('.textareTosummer').length)-2).summernote()

            });
            $("body").on("click",".remove",function(){

                $(this).parents(".single-wrap_box").remove();
            });

        });

        var loadmore_logo_search = 1;
        $('.search-image-submit').click(function(){
            var row = $(this).closest('.row');

            var keyword = row.find('.search-image-keyword').val();

            if(keyword.length >= 3)
            {
                var input = $('.'+$(this).attr('data-btn')).addClass('loadMoreSearchLogo')
                input.removeClass($(this).attr('data-btn'))

               var picture = $(this).attr('data-image-class')

                if(!input.length)
                {
                    input = $('.loadMoreSearchLogo');
                    input.show();
                }
                $('#loader').addClass('active');

                loadmore_logo_search = 1;
                search(keyword,loadmore_logo_search,row,input,picture);
            }


        });

        $(document).on("click",".loadMoreSearchLogo", function () {
            var row = $(this).parent().parent().find('.row');
            var keyword = row.find('.search-image-keyword').val();
            if(keyword.length >= 3)
            {
                loadmore_logo_search++;
                var picture  = row.find('.search-image-submit').attr('data-image-class');
                search(keyword,loadmore_logo_search,row,$(this),picture);
            }
        });


        function search(keyword,page,row,input,picture)
        {

            $.ajax
            ({
                url: "{{url('api/search/image')}}",
                data: {"page": page,"q":keyword},
                type: 'get',
                success: function(result)
                {
                    $('#loader').removeClass('active');
                    var newimages = result.data.data;

                    if(newimages.length)
                    {

                        if(page == 1)
                        {
                            row.find('.col-3').remove();
                        }
                        jQuery.each( newimages, function( i, val ){
                            row.append('<div class="col-3"> <img class="'+picture+'" src="'+val.image_thumb+'" id="'+val.id+'" alt="'+val.title+'"> <input type="radio" class="radioimage" id="personal'+val.id+'" name="imageselector"  value="'+val.id+'" /></div>')
                        });
                    }else
                    {
                        input.hide();
                    }
                }
            });
        }


        $('.farda').click(function(){

            $('#loader').addClass('active');
            if($( "input[name='title']" ).val().length && $( "input[name='slug']" ).val().length)
            {
                $('#loader').addClass('active');
            }else
                {
                    $('#loader').removeClass('active')
                }

        });


        $(document).ready(function() {

            if($("#status").val()=='published')
            {
                $('.inHomeDiv').show();
            }
            if($("#home_switcher").is(":checked"))
            {
                $('.inhomedivSwitch').show();
            }
            if($("#paragraph_body").is(":checked"))
            {
                $('.paragraph_body').show();
                $('.blockBody').hide();
            }else
            {
              $('.paragraph_body').hide();
              $('.blockBody').show();
            }

        });

        $("#status").bind("change", function(e) {

            if($(this).val()=='published')
            {
                $('.inHomeDiv').show();
            }else
                {
                    $('.inHomeDiv').hide();
                }

        });

        $("#paragraph_body").bind("change", function(e) {
            if($(this).is(":checked"))
            {
              $('.paragraph_body').show();
              $('.blockBody').hide();

              }else
                {
                  $('.paragraph_body').hide();
                  $('.blockBody').show();
                }

        })

        $("#home_switcher").bind("change", function(e) {
            if($(this).is(":checked"))
            {
              // console.log($('#simple-sortable').find('input'))
                var title =$('#name').val();
                if(title.length)
                {

                        if (!$('#simple-sortable').find('.newNewList').length)
                        {
                            $('#simple-sortable').append('<li class="list-group-item newNewList" > <input type="hidden" name="inHomeNews[]" value="new"> '+title+'</li>');
                        }

                    $('.inhomedivSwitch').show();
                }else
                    {
                        $(this). prop("checked", false);
                        alert('برجاء ادخال اسم الخبر اولا')
                    }
            }else
                {
                    $('.inhomedivSwitch').hide();
                }

        })

    $(document).on("submit","form", function () {

    $('.newsDiv').find('.newsCardDiv').remove();
    $('.tagsDiv').find('.tagsCardDiv').remove();

        return true;
    });


                $("#newsSearch").bind("change", function(e) {
                    if($(this).val()!="")
                    { var q = $(this).val();
                      $.ajax
                      ({
                          url: "{{url('api/search/news')}}",
                          data: {"q": q,},
                          type: 'get',
                          success: function(result)
                          {
                              var person = result.data;
                              if(person.length)
                              {

                                  $('.newsDiv').find('.newsCardDiv').remove();
                                  jQuery.each( person, function( i, val ){
                                      $('.newsDiv').append('<div class="col-2 newsCardDiv '+val.id+'" align="center"> <input type="hidden" name="relatednews[]" value="'+val.id+'"> <div class="card"> <h4>'+val.title+'</h4>  <span class="addtonews" data-id="'+val.id+'">تثبيت</span></div></div>')
                                  });
                              }else
                              {
                                  $('.newsDiv').find('.newsCardDiv').remove();
                              }
                          }

                      });

                    }else
                    {
                      $('.newsDiv').find('.newsCardDiv').remove();
                    }
                })

                $(document).on("click",".addtonews", function () {

                   var divcheck = $(this).attr('data-id');
                  if(!$('.choosednews').find('.'+divcheck).length)
                  {
                      var card = $(this).parents().find('.newsDiv').find('.'+divcheck).clone();

                      card.find('.addtonews').addClass('removenews').removeClass('addtonews').text('حذف')
                      card.appendTo(".choosednews");
                  }

                });

                $(document).on("click",".removenews", function ()
                {
                  var divcheck = $(this).attr('data-id');
                  $('.choosednews').find('.'+divcheck).remove();
                });



        $("#tagsSearch").bind("change", function(e) {
            if($(this).val()!="")
            { var q = $(this).val();
                $.ajax
                ({
                    url: "{{url('api/search/keywords')}}",
                    data: {"q": q,},
                    type: 'get',
                    success: function(result)
                    {
                        var person = result.data;
                        if(person.length)
                        {

                            $('.tagsDiv').find('.tagsCardDiv').remove();
                            jQuery.each( person, function( i, val ){
                                $('.tagsDiv').append('<div class="col-2 tagsCardDiv '+val.id+'" align="center"> <input type="hidden" name="relatedTags[]" value="'+val.id+'"> <div class="card"> <h4>'+val.name+'</h4>  <span class="addtotags" data-id="'+val.id+'">تثبيت</span></div></div>')
                            });
                        }else
                        {
                            $('.tagsDiv').find('.tagsCardDiv').remove();
                        }
                    }

                });

            }else
            {
                $('.tagsDiv').find('.tagsCardDiv').remove();
            }
        })

        $(document).on("click",".addtotags", function () {

            var divcheck = $(this).attr('data-id');
            if(!$('.choosedtags').find('.'+divcheck).length)
            {

                var card = $(this).parents().find('.tagsDiv').find('.'+divcheck).clone();

                card.find('.addtotags').addClass('removetags').removeClass('addtotags').text('حذف')
                card.appendTo(".choosedtags");
            }

        });

        $(document).on("click",".removetags", function ()
        {
            var divcheck = $(this).attr('data-id');
            $('.choosedtags').find('.'+divcheck).remove();
        });




        $(document).on("click",".personimageprofile", function () {
            $('.radioimage').prop('checked', false);
            $(".personimageprofile").removeClass("imagecheck");
            $(this).addClass("imagecheck");
            document.querySelector(`#personal${this.id}`).checked = true;

            if($('.dropify-render').find('img').length)
            {
                $('.dropify-render img').attr('src',this.src);
            }else
            {
                $('.dropify-render').parent().css('display','block');
                $('.dropify-render').append('<img src='+this.src+' >');
            }


            $('#exampleModal').removeClass('show');
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('#exampleModal').css('display','none')
            $('#exampleModal').css('padding-right','0px')
            const fi = document.getElementById('file');
            fi.value="";
        });


        var loadmoreImage_personal=2;
            $(document).on("click",".loadmoreimages", function () {
            var row=$(this).parent().parent().find('.row');

            var page = loadmoreImage_personal++;
            $.ajax
            ({
                url: "{{url('api/images/loadmore')}}",
                data: {"page": page},
                type: 'get',
                success: function(result)
                {
                    var newimages = result.data.data;

                    if(newimages.length)
                    {

                        jQuery.each( newimages, function( i, val ){
                            row.append('<div class="col-3"> <img class="personimageprofile" src="'+val.image_thumb+'" id="'+val.id+'" alt="'+val.title+'"> <input type="radio" class="radioimage" id="personal'+val.id+'" name="imageselector"  value="'+val.id+'" /></div>')
                        });
                    }else
                    {
                        $('.loadmoreimages').remove();
                    }
                }
            });

        });






        $(document).on("click",".personimagealbum", function () {

            $(this).toggleClass("imagecheck");
            if($('#album'+this.id).length)
            {

                $('.albums img[src="'+this.src+'"]').remove();
                $('#album'+this.id).remove();
            }else
            {
                $('.albums ').append('<img src="'+this.src+'"><input type="checkbox" class="checkimage" id="album'+this.id+'" name="albumelector[]"  checked="true"  value="'+this.id+'" />');
            }

        });

        var loadmoreImage_album=2;
            $(document).on("click",".loadmoreimages_album", function () {
            var row=$(this).parent().parent().find('.row');

            var page_album = loadmoreImage_album++;
            $.ajax
            ({
                url: "{{url('api/images/loadmore')}}",
                data: {"page": page_album},
                type: 'get',
                success: function(result)
                {
                    var newimages = result.data.data;
                    if(newimages.length)
                    {
                        jQuery.each( newimages, function( i, val ){
                            if($(".albums input").length)
                            {
                                $(".albums input").each(function() {
                                    if($(this).val()==val.id)
                                    {
                                        if($(this).val()==val.id)
                                        {

                                            if($("#album"+val.id).hasClass('checkimage'))
                                            {

                                                row.append('<div class="col-3"> <img class="personimagealbum imagecheck" src="'+val.image_thumb+'" id="'+val.id+'" alt="'+val.title+'"> </div>')
                                            }

                                        }else
                                        {

                                            if(!$("#"+val.id).hasClass('personimagealbum') && !$("#album"+val.id).hasClass('checkimage') )
                                            {

                                                row.append('<div class="col-3"> <img class="personimagealbum" src="'+val.image_thumb+'" id="'+val.id+'" alt="'+val.title+'"> </div>')
                                            }
                                        }


                                    }else
                                    {

                                        if(!$("#"+val.id).hasClass('personimagealbum') && !$("#album"+val.id).hasClass('checkimage') )
                                        {

                                            row.append('<div class="col-3"> <img class="personimagealbum" src="'+val.image_thumb+'" id="'+val.id+'" alt="'+val.title+'"> </div>')
                                        }
                                    }
                                });
                            }else
                            {

                                row.append('<div class="col-3"> <img class="personimagealbum" src="'+val.image_thumb+'" id="'+val.id+'" alt="'+val.title+'"> </div>')
                            }


                        });
                    }else
                    {
                        $('.loadmoreimages_album').remove();
                    }
                }
            });


        });



        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;

                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }

                        reader.readAsDataURL(input.files[i]);
                    }
                }

            };

            $('#gallery-photo-add').on('change', function() {
                // $('div.gallery > img').remove();

                imagesPreview(this, 'div.gallery');
            });
        });
        Filevalidation = () => {
            const fi = document.getElementById('file');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (var i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));

                    // The size of the file.
                    if (file >= 5120) {

                        document.getElementById('size').innerHTML ='حجم الملف اكبر من 5 M';
                        fi.value="";
                        document.getElementById('size').style.color="red"
                    }
                    else {
                        document.getElementById('size').innerHTML = '<b>'
                            + file + '</b> KB';
                        document.getElementById('size').style.color="#999999";
                    }
                }
            }
        }

        FileAlbumvalidation = () => {
            const fi = document.getElementById('gallery-photo-add');

            $('.gallery img').remove();
            if (fi.files.length > 0) {
                for (var i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));


                    if (file >= 3072) {
                        document.getElementById('mutiple_album').innerHTML ='حجم الملف اكبر من 3MB';
                        fi.value="";
                        document.getElementById('mutiple_album').style.color="red"
                    }
                    else {
                        document.getElementById('mutiple_album').innerHTML = '<b>'
                            + file + '</b> KB';
                        document.getElementById('mutiple_album').style.color="#999999";
                    }

                }

            }
        }


        expand_collapse = () =>{
            $(document).on('click',".expand_click",function(){

                $(this).parent().toggleClass('active')
                $(this).parent().siblings('.single-wrap_box__bottom').slideToggle(200);
            })

        }

        expand_collapse()

    </script>





@endsection
