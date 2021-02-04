@extends('dashboard.layouts.app')

@section('script')
    <script src="{{url('croppie/croppie.js')}}"></script>
@endsection

@section('back_url',url('/image'))

@section('content')

    <link rel="stylesheet" href="{{url('croppie/croppie.css')}}">
    <style>
        .button
        {
            width: 100%;
            height: 100%;
        }
        .modal-dialog{
            max-width:750px;
        }
        .modal-content {
            max-height: fit-content;
            overflow-y: scroll;
            overflow-y: hidden;
            overflow-x: hidden;
        }
        .crop_image
        {
            cursor: pointer;
            padding: 5px;
            border-radius: 4px;
            background-color: #428bfa;
            color: white;
        }
        .imageDiV
        {
            /*   border: 1px solid #ccc;
              */ padding: 15px;
            border-radius: 10px;
        }
    </style>
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    @if(!isset($image_edit) )
                        <h3>اضافة صوره</h3>
                    @else
                        <h3>تعديل صوره</h3>
                    @endif
                </div>
            </div>
        </div>

        @if(session()->has('success'))

            <div class="alert alert-success" align="center">
                {{ session()->get('success') }}
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

                                    @if(isset($image_edit) )
                                        {!!Form::model($image_edit,array('url'=>url('dashboard/image/'.$image_edit->id),'method' => 'PATCH','files'=>true,'style'=>'width: 100%'))!!}

                                        <input type="hidden" id="id" value="{{$image_edit->id}}">
                                    @else
                                        {!!Form::open(array('url'=>url('dashboard/image'),'files'=>true,'style'=>'width: 100%'))!!}
                                    @endif

                                    <div class="col-12 mb-15">
                                        {!! Form::label('title', ' عنوان ') !!}
                                        {!!Form::text('title',null,array('class'=>'form-control ','placeholder'=>'الاسم','autocomplete'=>'off','required'=>'required'))!!}
                                    </div>



                                    <div class="col-12 mb-15">
                                        {!! Form::label('photo', ' صوره ') !!}
                                        {!!Form::file('photo',array('accept'=>"image/*",'type'=>'file','class'=>'dropify','required'=>'required','data-height'=>'220','id'=>'file',"data-default-file"=>$image_edit??"" ?$image_edit->image_thumb:null))!!}
                                        <span class="form-help-text" id="size">حد اقصي للصوره 5M</span>
                                        <input type="hidden" name="tat" id="test">
                                    </div>

                                    @if(isset($image_edit) )
                                        <div class="row justify-content-center">
                                            @php
                                                $mediaSizes = explode(",", getenv('MediaSizes'));
                                            @endphp
                                            @foreach ($mediaSizes as $size)
                                                @php
                                                    $Helper= new App\Http\Helpers\Helpers;
                                                    $imageUrl = $Helper->getImageUrl($image_edit->fileName,$size,$image_edit->path);
                                                 $width= explode('x', $size)[0];
                                                $height= explode('x', $size)[1];
                                                @endphp

                                                <div class="col-lg-6 imageDiV mb-20 row justify-content-right">
                                                    <div class="col-lg-5">
                                                        <span >  مقاس الصوره :{{$size}}</span>
                                                        <input data-width="{{$width}}" data-height="{{$height}}" data-size="{{$size}}" class="_file" type="button" value="تعديل المقاس"/>

                                                    </div>

                                                    <div class="col-lg-10  text-center">
                                                        <img src="{{$imageUrl}}??{{time()}}">
                                                    </div>


                                                </div>
                                            @endforeach
                                        </div>
                                    @endif


                                    <div id="uploadimageModal" class="modal" role="dialog" style="direction: ltr">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-header justify-content-center">
                                                    <h4 class="modal-title">تعديل و حفظ الصوره</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <div id="image_demo" style="width:350px; margin-top:30px"></div>

                                                        </div>
                                                        <div class="col-md-12 text-center" >
                                                            <span class=" crop_image">تعديل و حفظ الصوره</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-15">

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

      if($( "input[name='title']" ).val().length && $('.dropify-render').find('img').length)
        {
            $('#loader').addClass('active');
        }else
        {
            $('#loader').removeClass('active')
        }
    });

    @if(isset($image_edit) )

        $(document).ready(function(){
            start_crop()
        });

        $('#uploadimageModal').on('hidden.bs.modal', function () {
            $('#loader').addClass('active');
            location.reload();
        });

        function start_crop(){
            let _inputs = document.querySelectorAll('._file')
            for(let i=0;i<_inputs.length;i++){
                  _inputs[i].addEventListener('click',()=>{
                                $image_crop = $('#image_demo').croppie({
                        enableExif: true,
                        viewport: {
                            width:_inputs[i].getAttribute('data-width'),
                            height:_inputs[i].getAttribute('data-height'),
                            type:'square' //circle
                        },
                        boundary:{
                            width:700,
                            height:400
                        }
                    });

                    $image_crop.croppie('bind', {
                        url: "{{$Helper->getImageUrl($image_edit->fileName,'src',$image_edit->path)}}"
                    }).then(function(){
                    });

                    $('#uploadimageModal').modal('show');

                    $('.crop_image').click(function(event){

                        $image_crop.croppie('result', {
                            type: 'canvas',
                            size: 'viewport'
                        }).then(function(response){
                            $('#loader').addClass('active');
                            var id = $('#id').val();
                            var size = _inputs[i].getAttribute('data-size')
                            $.ajax({
                                url:"{{url('/')}}/api/image/upload",
                                type: "POST",
                                data:{"image": response,"id":id,"size":size},
                                success:function(data)
                                {

                                    $('#uploadimageModal').modal('hide');
                                    if(data.data)
                                    {
                                        window.location.href ='{{url("dashboard/image")}}';
                                    }else
                                    {
                                        $('#loader').removeClass('active');
                                    }
                                }
                            });
                        })
                    });
                })
            }
        }

        @endif


        Filevalidation = () => {
            const fi = document.getElementById('file');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

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
    </script>

@endsection
