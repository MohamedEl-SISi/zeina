@extends('dashboard.layouts.app')
@section('title','News | Fixed In Home |')
@section('content')

@section('script')

    <script src="{{url('assets\js\plugins\select2\select2.full.min.js')}}"></script>
    <script src="{{url('assets\js\plugins\select2\select2.active.js')}}"></script>
    <script src="{{url('assets\js\plugins\nice-select\jquery.nice-select.min.js')}}"></script>
    <script src="{{url('assets\js\plugins\nice-select\niceSelect.active.js')}}"></script>
@endsection
    <style>
        .button
        {
            width: 100%;
            height: 100%;
        }
        .newsDiv .card ,.choosednews .card
        {
          border-radius: 20px;
          height: auto;
          padding-bottom: 2%;
          margin-bottom: 5px;
          padding: 2%;
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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="row">
            <div class="col-12 mb-30">
                <div class="box">
                    <div class="box-body">
                        <div class="row mbn-20">
                            <div class="col-lg-12 col-12 mb-20">
                                <div class="row mbn-15">
                                        {!!Form::open(array('url'=>url('dashboard/fixedNews/inhome/save'),'files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}

                                        @php
                                          foreach($newsId->data??[] as $key =>$id)
                                          {
                                            $choosedNews[$key] = $news->where('id',$id)->first();
                                          }
                                        @endphp



                                        <div class="col-lg-12 mb-15">

                                          {!! Form::label('newsSearch', 'اختيارات المحرر') !!}
                                          {!!Form::text('newsSearch',null,array('class'=>'form-control newsSearch','name-type'=>'editorchoice[]'))!!}
                                          <div class="row col-12 newsDiv">
                                          </div>
                                            <div class="row col-12 choosednews">
                                              @if(isset($editornews))
                                                @foreach($editornews as $news)
                                                <div class="col-2 newsCardDiv   {{$news->id}}" align="center">
                                                 <input type="hidden" name="editorchoice[]" value="{{$news->id}}">
                                                 <div class="card">
                                                   <h4>{{$news->title}}</h4>
                                                   <span class="removenews" data-id="{{$news->id}}">حذف</span>
                                                 </div>
                                               </div>
                                                @endforeach
                                               @endif

                                            </div>

                                        </div>

                                        <div class="col-lg-12  mb-20">
                                            <div class="page-heading">
                                                    <h3>الاخبار المثبته</h3>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-15">

                                          {!! Form::label('newsSearch', 'الخبر الاول') !!}
                                          {!!Form::text('newsSearch',null,array('class'=>'form-control newsSearch','name-type'=>'positionnews[1]'))!!}
                                          <div class="row col-12 newsDiv">
                                          </div>
                                            <div class="row col-12 choosednews">
                                              @if(isset($choosedNews[1]))
                                                <div class="col-2 newsCardDiv   {{$choosedNews[1]->id}}" align="center">
                                                 <input type="hidden" name="positionnews[1]" value="{{$choosedNews[1]->id}}">
                                                 <div class="card">
                                                   <h4>{{$choosedNews[1]->title}}</h4>
                                                   <span class="removenews" data-id="{{$choosedNews[1]->id}}">حذف</span>
                                                 </div>
                                               </div>
                                               @endif

                                            </div>

                                        </div>

                                        <div class="col-lg-12 mb-15" align="center">
                                          <img class="mt-15" style="border: 1px solid #161824;border-radius: 10px;height:200px" src="{{url('img/fix/first.png')}}">
                                        </div>

                                        <div class="col-lg-12 mb-15">

                                          {!! Form::label('newsSearch', 'الخبر الثاني') !!}
                                          {!!Form::text('newsSearch',null,array('class'=>'form-control newsSearch','name-type'=>'positionnews[2]'))!!}
                                          <div class="row col-12 newsDiv">
                                          </div>
                                            <div class="row col-12 choosednews">
                                              @if(isset($choosedNews[2]))
                                                <div class="col-2 newsCardDiv   {{$choosedNews[2]->id}}" align="center">
                                                 <input type="hidden" name="positionnews[2]" value="{{$choosedNews[2]->id}}">
                                                 <div class="card">
                                                   <h4>{{$choosedNews[2]->title}}</h4>
                                                   <span class="removenews" data-id="{{$choosedNews[2]->id}}">حذف</span>
                                                 </div>
                                               </div>
                                               @endif
                                            </div>

                                        </div>

                                        <div class="col-lg-12 mb-15" align="center">
                                          <img class="mt-15" style="border: 1px solid #161824;border-radius: 10px;height:200px" src="{{url('img/fix/second.png')}}">
                                        </div>

                                        <div class="col-lg-12 mb-15">

                                          {!! Form::label('newsSearch', 'الخبر الثالث') !!}
                                          {!!Form::text('newsSearch',null,array('class'=>'form-control newsSearch','name-type'=>'positionnews[5]'))!!}
                                          <div class="row col-12 newsDiv">
                                          </div>
                                            <div class="row col-12 choosednews">
                                              @if(isset($choosedNews[5]))
                                                <div class="col-2 newsCardDiv   {{$choosedNews[5]->id}}" align="center">
                                                 <input type="hidden" name="positionnews[5]" value="{{$choosedNews[5]->id}}">
                                                 <div class="card">
                                                   <h4>{{$choosedNews[5]->title}}</h4>
                                                   <span class="removenews" data-id="{{$choosedNews[5]->id}}">حذف</span>
                                                 </div>
                                               </div>
                                               @endif
                                            </div>

                                        </div>

                                        <div class="col-lg-12 mb-15" align="center">
                                          <img class="mt-15" style="border: 1px solid #161824;border-radius: 10px;height:200px" src="{{url('img/fix/fifth.png')}}">
                                        </div>

                                        <div class="col-lg-12 mb-15">

                                          {!! Form::label('newsSearch', 'الخبر الرابع') !!}
                                          {!!Form::text('newsSearch',null,array('class'=>'form-control newsSearch','name-type'=>'positionnews[3]'))!!}
                                          <div class="row col-12 newsDiv">
                                          </div>
                                            <div class="row col-12 choosednews">
                                              @if(isset($choosedNews[3]))
                                                <div class="col-2 newsCardDiv   {{$choosedNews[3]->id}}" align="center">
                                                 <input type="hidden" name="positionnews[3]" value="{{$choosedNews[3]->id}}">
                                                 <div class="card">
                                                   <h4>{{$choosedNews[3]->title}}</h4>
                                                   <span class="removenews" data-id="{{$choosedNews[3]->id}}">حذف</span>
                                                 </div>
                                               </div>
                                               @endif
                                            </div>

                                        </div>

                                        <div class="col-lg-12 mb-15" align="center">
                                          <img class="mt-15" style="border: 1px solid #161824;border-radius: 10px;height:200px" src="{{url('img/fix/third.png')}}">
                                        </div>


                                        <div class="col-lg-12 mb-15">

                                          {!! Form::label('newsSearch', 'الخبر الخامس') !!}
                                          {!!Form::text('newsSearch',null,array('class'=>'form-control newsSearch','name-type'=>'positionnews[4]'))!!}
                                          <div class="row col-12 newsDiv">
                                          </div>
                                            <div class="row col-12 choosednews">
                                              @if(isset($choosedNews[4]))
                                                <div class="col-2 newsCardDiv   {{$choosedNews[4]->id}}" align="center">
                                                 <input type="hidden" name="positionnews[4]" value="{{$choosedNews[4]->id}}">
                                                 <div class="card">
                                                   <h4>{{$choosedNews[4]->title}}</h4>
                                                   <span class="removenews" data-id="{{$choosedNews[4]->id}}">حذف</span>
                                                 </div>
                                               </div>
                                               @endif
                                            </div>

                                        </div>

                                        <div class="col-lg-12 mb-15" align="center">
                                          <img class="mt-15" style="border: 1px solid #161824;border-radius: 10px;height:200px" src="{{url('img/fix/fourth.png')}}">
                                        </div>


                                        <div class="col-lg-12 mb-15">
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

$(document).on("submit","form", function () {

$('.newsDiv').find('.newsCardDiv').remove();

    return true;
});

$(".newsSearch").bind("change", function(e) {

  var parent = $(this).parent().find('.newsDiv').first();
    if($(this).val()!="")
    { var q = $(this).val();
      var name= $(this).attr('name-type')
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
                      parent.append('<div class="col-2 newsCardDiv '+val.id+'" align="center"> <input type="hidden" name="'+name+'" value="'+val.id+'"> <div class="card"> <h4>'+val.title+'</h4>  <span class="addtonews" data-id="'+val.id+'">تثبيت</span></div></div>')
                  });
              }else
              {
                  parent.find('.newsCardDiv').remove();
              }
          }

      });

    }else
    {
      parent.find('.newsCardDiv').remove();
    }
})

$(document).on("click",".addtonews", function () {

   var divcheck = $(this).attr('data-id');
   var parent = $(this).parent().parent().parent();
  if(! parent.parent().find('.choosednews').find('.'+divcheck).length)
  {
      var card = parent.find('.'+divcheck).clone();
      card.find('.addtonews').addClass('removenews').removeClass('addtonews').text('حذف')
      parent.parent().find('.choosednews').append(card)
  }

});

$(document).on("click",".removenews", function ()
{
  var divcheck = $(this).attr('data-id');
  $(this).parent().parent().parent().parent().find('.choosednews').find('.'+divcheck).remove();
});


</script>


@endsection
