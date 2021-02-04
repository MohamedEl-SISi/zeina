@extends('dashboard.layouts.app')
@section('title','Files | Mange |')
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

.newsDiv .card , .choosednews .card
{
  border-radius: 20px;
  height: auto;
  padding-bottom: 2%;
  margin-bottom: 5px;
  padding-top: 2%;
}
.addtonews ,.removenews
{
  width: 80%;
  border-radius: 10px;
  background-color: #20cc5d;
  padding: 1.5%;
  color: white;
  margin: 0 auto;
    cursor: pointer;
}
.removenews
{
  background-color:  #cc3020
}
    </style>
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    @if(isset($file_edit) )
                    <h3>تعديل ملف</h3>
                    @else
                    <h3>اضافة ملف</h3>
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
                                    @if(isset($file_edit) )
                                        {!!Form::model($file_edit,array('url'=>url('dashboard/files/'.$file_edit->id),'method' => 'PATCH','files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
                                    @else
                                        {!!Form::open(array('url'=>url('dashboard/files'),'files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
                                    @endif
                                        <div class="col-12 mb-15">
                                            {!! Form::label('title', ' الاسم الملف') !!}
                                            {!!Form::text('title',null,array('class'=>'form-control','id'=>'name','placeholder'=>'الاسم','autocomplete'=>'off','required'=>'required'))!!}
                                        </div>
                                        <div class="col-12 mb-15">
                                          @if(isset($file_edit))
                                                {!! Form::label('slug', 'الرابط الدائم') !!}
                                              <span class="form-control">{{$file_edit->slug}}</span>
                                          @else
                                            {!! Form::label('slug', 'الرابط الدائم') !!}
                                            {!!Form::text('slug',null,array('class'=>'form-control','id'=>'slug','autocomplete'=>'off','placeholder'=>'الرابط الدائم','required'=>'required'))!!}
                                            @endif
                                        </div>

                                    <div class="col-lg-12 mb-15">
                                        {!! Form::label('desc', ' الوصف') !!}
                                        {!!Form::textarea('desc',null,array('class'=>'form-control ','placeholder'=>'الوصف','autocomplete'=>'off','maxlength'=>"160"))!!}
                                    </div>


                                    <div class="col-12 row mb-15">
                                        {!! Form::label('relatednews', 'اخبار متعلقه') !!}
                                        {!!Form::text('newsSearch',null,array('class'=>'form-control','id'=>'newsSearch'))!!}

                                        <div class="row col-12 newsDiv">
                                        </div>

                                        <div class="row col-12 choosednews">
                                          @if(isset($file_edit))

                                            @foreach($file_edit->news??[] as $new)

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
          if($( "input[name='title']" ).val().length)
            {
                $('#loader').addClass('active');
            }else
            {
                $('#loader').removeClass('active')
            }
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



        $(document).on("submit","form", function () {

        $('.newsDiv').find('.newsCardDiv').remove();
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
    </script>

@endsection
