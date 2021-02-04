@extends('dashboard.layouts.app')
@section('title','Article section | Mange |')
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
                                        {!!Form::model($section_edit,array('url'=>url('dashboard/articleSection/'.$section_edit->id),'method' => 'PATCH','files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
                                    @else
                                        {!!Form::open(array('url'=>url('dashboard/articleSection'),'files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
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

                                        <div class="col-lg-2 mb-15 inHomeDiv">
                                         <label class="adomx-switch">
                                           <input type="checkbox" name="in_home" @if(isset($section_edit)) @if($section_edit->in_home)  checked @endif @endif >
                                           <i class="lever"></i>
                                           <span class="text">في الصفحه الرئيسة</span>
                                         </label>
                                      </div>
                                      <div class="col-lg-2 mb-15 inHomeDiv">
                                       <label class="adomx-switch">
                                         <input type="checkbox" name="in_menu"  @if(isset($section_edit)) @if($section_edit->in_menu)  checked @endif @endif >
                                         <i class="lever"></i>
                                         <span class="text">في المنيو</span>
                                       </label>
                                    </div>

                                    <div class="col-lg-12 mb-15">
                                        {!! Form::label('desc', ' الوصف') !!}
                                        {!!Form::textarea('desc',null,array('class'=>'form-control ','placeholder'=>'الوصف','autocomplete'=>'off','maxlength'=>"160"))!!}
                                    </div>

                                    <div class="col-lg-6 mb-15" align="center">
                                            {!! Form::label('photo', ' صوره ') !!}
                                             <br>
                                             {!!Form::file('photo',array('accept'=>"image/*",'type'=>'file','class'=>'dropify','data-height'=>'220','id'=>'file','onchange'=>'Filevalidation()',"data-default-file"=>$section_edit??"" ?($section_edit->image?$section_edit->image->getImageThumbAttribute():null):null))!!}
                                             <input type="hidden" id="imageprofileId" name="imageprofileId" @if(isset($section_edit)) value="{{$section_edit->image?$section_edit->image->id:null}}" @endif>
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
                                                                        <span class="btn button-primary search-image-submit" data-image-class="imageprofile" data-btn="loadmoreimages"  placeholder="بحث بعنوان الصوره">بحث في مكتبه الصور</span>
                                                                    </div>
                                                                    @foreach($images as$image)
                                                                        <div class="col-3">
                                                                            <img class="imageprofile" src="{{$image->image_thumb}}" id="{{$image->id}}" alt="{{$image->title}}">
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


    $(document).on("click",".imageprofile", function () {
      $('.radioimage').prop('checked', false);
      $(".imageprofile").removeClass("imagecheck");
      $(this).addClass("imagecheck");
      document.querySelector(`#personal${this.id}`).checked = true;
      $('#imageprofileId').val(this.id);
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
                      row.append('<div class="col-3"> <img class="imageprofile" src="'+val.image_thumb+'" id="'+val.imageId+'" alt="'+val.title+'"> <input type="radio" class="radioimage" id="personal'+val.imageId+'" name="imageselector"  value="'+val.imageId+'" /></div>')
                  });
              }else
              {
                  $('.loadmoreimages').remove();
              }
          }
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
                            row.append('<div class="col-3"> <img class="'+picture+'" src="'+val.image_thumb+'" id="'+val.imageId+'" alt="'+val.title+'"> <input type="radio" class="radioimage" id="personal'+val.imageId+'" name="imageselector"  value="'+val.imageId+'" /></div>')
                        });
                    }else
                    {
                        input.hide();
                    }
                }
            });
        }

    </script>














@endsection
