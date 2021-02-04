@extends('dashboard.layouts.app')
@section('title','ُExam section | Mange |')
@section('content')
    <style>
        .button
        {
            width: 100%;
            height: 100%;
        }
        .gallery img ,.albums img , .bodyImagesNews img {
    width: 130px;
    height: 130px;
    border-radius: 10px;
    padding: 5px;
}
.imageprofile,.personimagealbum ,.bodyContent
{
    padding: 6px;
    border-radius: 15px;
    cursor: pointer;
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
    </style>
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    @if(isset($section_edit) )
                    <h3>تعديل تصنيف</h3>
                    @else
                    <h3>اضافة تصنيف</h3>
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

          @if (session('message_err'))
              <div class="alert alert-danger" align="center">
                  {{ session('message_err') }}
              </div>
          @endif
        </div>


        <div class="row">
            <div class="col-12 mb-30">
                <div class="box">
                    <div class="box-body">
                        <div class="row mbn-20">
                            <div class="col-lg-12 col-12 mb-20">
                                <div class="row mbn-15">
                                    @if(isset($section_edit) )
                                        {!!Form::model($section_edit,array('url'=>url('dashboard/examsSection/'.$section_edit->id),'method' => 'PATCH','files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
                                    @else
                                        {!!Form::open(array('url'=>url('dashboard/examsSection'),'files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
                                    @endif
                                        <div class="col-12 mb-15">
                                            {!! Form::label('name', ' الاسم التصنيف') !!}
                                            {!!Form::text('name',null,array('class'=>'form-control','id'=>'name','placeholder'=>'الاسم','autocomplete'=>'off','required'=>'required'))!!}
                                        </div>
                                        <div class="col-12 mb-15">
                                          @if(isset($section_edit))
                                                {!! Form::label('slug', 'الرابط الدائم') !!}
                                              <span class="form-control">{{$section_edit->slug}}</span>
                                          @else
                                            {!! Form::label('slug', 'الرابط الدائم') !!}
                                            {!!Form::text('slug',null,array('class'=>'form-control','id'=>'slug','placeholder'=>'الرابط الدائم','autocomplete'=>'off','required'=>'required'))!!}
                                            @endif
                                        </div>
                                        <div class="col-lg-12 mb-15">
                                            {!! Form::label('status', 'الحالة') !!}
                                            {!!Form::select('status',['draft'=>'مسوده','published'=>'منشور'],null ,array('class'=>'form-control ','required'=>'required' ,'id'=>'status'))!!}
                                        </div>



                                    <div class="col-lg-12 mb-15">
                                        {!! Form::label('desc', ' الوصف') !!}
                                        {!!Form::textarea('desc',null,array('class'=>'form-control ','placeholder'=>'الوصف','autocomplete'=>'off','maxlength'=>"160"))!!}
                                    </div>


                                        <div class="col-12 mb-15" align="left">
                                            {!!Form::submit('حفظ', array('class'=>'button button-primary farda'))!!}
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



    <script>
        $('.farda').click(function(){
            $('#loader').addClass('active');
        });

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
    </script>














@endsection
