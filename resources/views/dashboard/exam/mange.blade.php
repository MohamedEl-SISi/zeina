@extends('dashboard.layouts.app')
@section('title','Exam | Mange |')
@section('content')
    <style>

    .questionDiv
      {
        padding: 10px;
      }
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

.addtoQuestion,.removeQuestion
{
  width: 80%;
  border-radius: 10px;
  background-color: #20cc5d;
  padding: 1.5%;
  color: white;
  margin: 0 auto;
    cursor: pointer;
}
.removeQuestion
{
  background-color:  #cc3020
}
  .questionDiv .card ,.choosedQuestion .card
{
  border-radius: 20px;
      height: auto;
      padding-bottom: 2%;
      margin-bottom: 5px;
      padding-top: 2%;
}
    </style>
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    @if(isset($exam_edit) )
                    <h3>تعديل أختبار</h3>
                    @else
                    <h3>اضافة أختبار</h3>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-12">
          @if ($errors->any())
              <div class="alert alert-danger" >
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
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
                                    @if(isset($exam_edit) )
                                        {!!Form::model($exam_edit,array('url'=>url('dashboard/exam/'.$exam_edit->id),'method' => 'PATCH','files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
                                    @else
                                        {!!Form::open(array('url'=>url('dashboard/exam'),'files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
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
                                        <div class="col-12 mb-15">
                                            {!! Form::label('title', ' الاسم الأختبار') !!}
                                            {!!Form::text('title',null,array('class'=>'form-control','id'=>'name','placeholder'=>'الاسم','autocomplete'=>'off','required'=>'required'))!!}
                                        </div>
                                        <div class="col-12 mb-15">
                                          @if(isset($exam_edit))
                                                {!! Form::label('slug', 'الرابط الدائم') !!}
                                              <span class="form-control">{{$exam_edit->slug}}</span>
                                          @else
                                            {!! Form::label('slug', 'الرابط الدائم') !!}
                                            {!!Form::text('slug',null,array('class'=>'form-control','id'=>'slug','autocomplete'=>'off','placeholder'=>'الرابط الدائم','required'=>'required'))!!}
                                            @endif
                                        </div>
                                        <div class="col-lg-4 mb-15">
                                            {!! Form::label('sectionId', 'تصنيف الاختبار') !!}
                                            {!!Form::select('sectionId',collect($newsCategories)->pluck('name','id'), $serialzeCategory??null,array('class'=>'form-control maintype','required'=>'required'))!!}
                                        </div>
                                        <div class="col-lg-12 mb-15">
                                            {!! Form::label('type', 'نوع الاختبار') !!}
                                            {!!Form::select('type',['oneQuestion'=>'من سؤال  واحد','multipleQuestions'=>'متعدد الاسأله'],null ,array('class'=>'form-control ','required'=>'required' ,'id'=>'type'))!!}
                                        </div>

                                    <div class="col-lg-12 mb-15">
                                        {!! Form::label('desc', ' الوصف') !!}
                                        {!!Form::textarea('desc',null,array('class'=>'form-control ','placeholder'=>'الوصف','autocomplete'=>'off','maxlength'=>"160"))!!}
                                    </div>

                                    <div class="col-12 row mb-15">
                                        {!! Form::label('searchQuestion', 'اسئلة') !!}
                                        {!!Form::text('searchQuestion',null,array('class'=>'form-control','id'=>'questionsSearch'))!!}

                                        <div class="row col-12 questionDiv">
                                        </div>

                                        <div class="row col-12 choosedQuestion">
                                            @if(isset($exam_edit))

                                                @foreach($exam_edit->questions??[] as $q)
                                                    <div class="col-2 questionCardDiv  {{$q->Question->id}}" align="center">
                                                        <input type="hidden" name="relatedQuestions[]" value="{{$q->Question->id}}">
                                                        <div class="card">
                                                            <h4>{{$q->Question->question_head}}</h4>
                                                            <span class="removeQuestion" data-id="{{$q->Question->id}}">حذف</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>


                                    </div>

                                    <div class="col-lg-12 col-12 mb-30 ResultDiv">
                                            <div class="box">
                                                <div class="box-head">
                                                    <h4 class="title">نتيجه الاختبار</h4>
                                                </div>
                                                <div class="box-body">

                                                    @forelse($exam_edit->result??[] as $key=>$result)

                                                      <div class="row justify-content-center control-group">
                                                        <div class="col-lg-2 mb-15">
                                                            {!! Form::label('result['.$key.'][from]', 'من ') !!}
                                                            {!!Form::text('result['.$key.'][from]',null,array('class'=>'form-control ','placeholder'=>'من'))!!}
                                                        </div>

                                                        <div class="col-lg-2 mb-15">
                                                            {!! Form::label('result['.$key.'][to]', 'الي') !!}
                                                            {!!Form::text('result['.$key.'][to]',null,array('class'=>'form-control ','placeholder'=>'الي'))!!}
                                                        </div>

                                                        <div class="col-lg-6 mb-15">
                                                            {!! Form::label('result['.$key.'][text]', 'نص النتيجه') !!}
                                                            {!!Form::text('result['.$key.'][text]',null,array('class'=>'form-control ','placeholder'=>'نص النتيجه'))!!}
                                                        </div>

                                                        <div class="col-lg-2 mb-15">
                                                          <button class="btn btn-primary openModel" type="button" data-toggle="modal" data-number="{{$key}}" data-target="#bodyImages"><i class="glyphicon glyphicon-plus"></i>اختار صور  البوم </button>
                                                        </div>

                                                        <div class="col-lg-11 mb-10 row bodyImagesNews" data-div-number="{{$key}}" >
                                                          <div class="col-lg-12 mt-15 mb-15" align="center">
                                                              {!! Form::label('photo-body', 'صوره الفقرة') !!}
                                                          </div>

                                                          @if(isset($result['photos']))
                                                              <div class="col-lg-2 col-md-2 mb-10" align="center">
                                                              <button class="btn btn-danger removefromBody" type="button"><i class="glyphicon glyphicon-remove"></i>X</button>
                                                              <img src="{{$result['photos']['image_thumb']}}">
                                                                {!!Form::checkbox('result['.$key.'][photos]',$result['photos']['id'],true,array('class'=>'checkimage ','id'=>'newsBody'.$result['photos']['id']))!!}
                                                                {!!Form::select('result['.$key.'][size]',collect($mediaSizes)->pluck('name','id'),isset($result['size'])?$result['size']:'600x400',array('class'=>'form-control '))!!}
                                                              </div>
                                                          @endif
                                                        </div>

                                                           @if($key)
                                                                <div class="col-1 mb-15">
                                                                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>-</button>
                                                                </div>
                                                            @else
                                                                <div class="col-1 mb-15">
                                                                    <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i>+</button>
                                                                </div>
                                                            @endif
                                                            </div>
                                                    @empty
                                                        <div class="row justify-content-center control-group">
                                                            <div class="col-lg-2 mb-15">
                                                                {!! Form::label('result[0][from]', 'من ') !!}
                                                                {!!Form::text('result[0][from]',null,array('class'=>'form-control ','placeholder'=>'من'))!!}
                                                            </div>

                                                            <div class="col-lg-2 mb-15">
                                                                {!! Form::label('result[0][to]', 'الي') !!}
                                                                {!!Form::text('result[0][to]',null,array('class'=>'form-control ','placeholder'=>'الي'))!!}
                                                            </div>

                                                            <div class="col-lg-6 mb-15">
                                                                {!! Form::label('result[0][text]', 'نص النتيجه') !!}
                                                                {!!Form::text('result[0][text]',null,array('class'=>'form-control ','placeholder'=>'نص النتيجه'))!!}
                                                            </div>

                                                            <div class="col-lg-2 mb-15">
                                                              <button class="btn btn-primary openModel" type="button" data-toggle="modal" data-number="0" data-target="#bodyImages"><i class="glyphicon glyphicon-plus"></i>اختار صور  البوم </button>
                                                            </div>

                                                            <div class="col-lg-11 mb-10 row bodyImagesNews" data-div-number="0" >
                                                              <div class="col-lg-12 mt-15 mb-15" align="center">
                                                                  {!! Form::label('photo-body', 'صوره الفقرة') !!}
                                                              </div>
                                                            </div>

                                                            <div class="col-1 mb-15">
                                                                <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i>+</button>
                                                            </div>




                                                        </div>
                                                        @endforelse
                                                    <div class="after-add-more row"></div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 mb-15" align="center">
                                                {!! Form::label('photo', ' صوره ') !!}
                                                 <br>
                                                {!!Form::file('photo',array('accept'=>"image/*",'type'=>'file','class'=>'dropify','data-height'=>'220','id'=>'file','onchange'=>'Filevalidation()',"data-default-file"=>$exam_edit??"" ?($exam_edit->image?$exam_edit->image->getImageThumbAttribute():null):null))!!}
                                                <input type="hidden" id="imageprofileId" name="imageprofileId" @if(isset($section_edit)) value="{{$exam_edit->image?$exam_edit->image->id:null}}" @endif>
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



    <div class="copy" id="copy" style="display:none;">

        <div class="row justify-content-center control-group">

          <div class="col-lg-2 mb-15">
              {!! Form::label('result[index][from]', 'من ') !!}
              {!!Form::text('result[index][from]',null,array('class'=>'form-control ','placeholder'=>'من'))!!}
          </div>

          <div class="col-lg-2 mb-15">
              {!! Form::label('result[index][to]', 'الي') !!}
              {!!Form::text('result[index][to]',null,array('class'=>'form-control ','placeholder'=>'الي'))!!}
          </div>

          <div class="col-lg-6 mb-15">
              {!! Form::label('result[index][text]', 'نص النتيجه') !!}
              {!!Form::text('result[index][text]',null,array('class'=>'form-control ','placeholder'=>'نص النتيجه'))!!}
          </div>
          <div class="col-lg-2 mb-15">
            <button class="btn btn-primary openModel" type="button" data-toggle="modal" data-number="index" data-target="#bodyImages"><i class="glyphicon glyphicon-plus"></i>اختار صور  البوم </button>
          </div>

          <div class="col-lg-11 mb-10 row bodyImagesNews" data-div-number="index" >
            <div class="col-lg-12 mt-15 mb-15" align="center">
                {!! Form::label('photo-body', 'صوره الفقرة') !!}
            </div>
          </div>

            <div class="col-1 mb-15">
                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>-</button>
            </div>

        </div>

    </div>

    <script>

    $(document).on("click",".openModel", function () {
        $('#bodyImages').attr('div-data',$(this).attr("data-number"))
    });
        $('.farda').click(function(){
          if($( "input[name='title']" ).val().length)
            {
                $('#loader').addClass('active');
            }else
            {
                $('#loader').removeClass('active')
            }
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
            bodyImagesNews.append('<div class="col-lg-2 col-md-2 mb-10" align="center"> <button class="btn btn-danger removefromBody" type="button"><i class="glyphicon glyphicon-remove"></i>X</button> <img src="'+this.src+'"><input type="checkbox" class="checkimage" id="newsBody'+this.id+'" name="result['+divBodyIndex+'][photos]"  checked="true"  value="'+this.id+'" />'+
            '<select class="form-control " name="result['+divBodyIndex+'][size]"><option value="src" >src</option><option value="600x400">600x400</option><option selected="selected" value="300x250">300x250</option><option value="120x90">120x90</option><option value="300x550">300x550</option><option value="600x230">600x230</option></select> </div');
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

    var countcopy=$('.row  .control-group').length ;
          $(document).ready(function() {
              $(".add-more").click(function(){
                  var html = document.getElementById('copy').innerHTML;

                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );
                  html =   html.replace("index",countcopy );

                  countcopy++;

                  $(".after-add-more").before(html);
              });
              $("body").on("click",".remove",function(){

                  $(this).parents(".control-group").remove();
              });
          });


          $(document).ready(function() {

              $type = $('#type option:selected').val();

              TypeDiv($type)

          });
          $('#type').on('change', function() {

              TypeDiv($(this).val());
          });

          function TypeDiv(Val)
          {
              if(Val=="oneQuestion")
              {
                $('.ResultDiv').hide()
              }else if (Val == "multipleQuestions")
              {
                $('.ResultDiv').show()
              }
          }



          $("#questionsSearch").bind("change", function(e) {
              if($(this).val()!="")
              { var q = $(this).val();
                  $.ajax
                  ({
                      url: "{{url('api/search/question')}}",
                      data: {"q": q,},
                      type: 'get',
                      success: function(result)
                      {
                          var person = result.data;
                          if(person.length)
                          {
                              $('.questionDiv').find('.questionCardDiv').remove();
                              jQuery.each( person, function( i, val ){
                                  $('.questionDiv').append('<div class="col-2 questionCardDiv '+val.id+'" align="center"> <input type="hidden" name="relatedQuestions[]" value="'+val.id+'"> <div class="card"> <h4>'+val.question_head+'</h4>  <span class="addtoQuestion" data-id="'+val.id+'">تثبيت</span></div></div>')
                              });
                          }else
                          {
                              $('.questionDiv').find('.questionCardDiv').remove();
                          }
                      }

                  });

              }else
              {
                  $('.questionDiv').find('.questionCardDiv').remove();
              }
          })

          $(document).on("click",".addtoQuestion", function () {

              var divcheck = $(this).attr('data-id');
              if(!$('.choosedQuestion').find('.'+divcheck).length)
              {

                  var card = $(this).parents().find('.questionDiv').find('.'+divcheck).clone();

                  card.find('.addtoQuestion').addClass('removeQuestion').removeClass('addtoQuestion').text('حذف')
                  card.appendTo(".choosedQuestion");
              }

          });

          $(document).on("click",".removeQuestion", function ()
          {
              var divcheck = $(this).attr('data-id');
              $('.choosedQuestion').find('.'+divcheck).remove();
          });

          $(document).on("submit","form", function () {
            $('.questionDiv').find('.questionCardDiv').remove();
              return true;
          });

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
