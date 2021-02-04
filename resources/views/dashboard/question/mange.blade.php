@extends('dashboard.layouts.app')
@section('title','Question | Mange |')
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
                    @if(isset($question_edit) )
                    <h3>تعديل سؤال</h3>
                    @else
                    <h3>اضافة سؤال</h3>
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
                                    @if(isset($question_edit) )
                                        {!!Form::model($question_edit,array('url'=>url('dashboard/question/'.$question_edit->id),'method' => 'PATCH','files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
                                    @else
                                        {!!Form::open(array('url'=>url('dashboard/question'),'files'=>true,'style'=>'width: 100%','class'=>'row justify-content-center'))!!}
                                    @endif

                                        <div class="col-12 mb-15">
                                            {!! Form::label('question_head', ' الاسم السؤال') !!}
                                            {!!Form::text('question_head',null,array('class'=>'form-control','autocomplete'=>'off','placeholder'=>'راس السؤال','required'=>'required'))!!}
                                        </div>

                                        <div class="col-lg-9 mb-15">
                                            {!! Form::label('answer_1', 'الأجابة الاولى') !!}
                                            {!!Form::text('answer_1',null,array('class'=>'form-control','autocomplete'=>'off','placeholder'=>'الأجابة الاولى','required'=>'required'))!!}
                                        </div>
                                        <div class="col-lg-3 mb-15">
                                            {!! Form::label('answer_1_value', 'قيمة الاجابة') !!}
                                            {!!Form::number('answer_1_value',null,array('class'=>'form-control','autocomplete'=>'off','placeholder'=>'قيمة الاجابة','required'=>'required'))!!}
                                        </div>

                                        <div class="col-lg-9 mb-15">
                                            {!! Form::label('answer_2', 'الاجابه الثانيه') !!}
                                            {!!Form::text('answer_2',null,array('class'=>'form-control','placeholder'=>'الاجابه الثانيه','autocomplete'=>'off','required'=>'required'))!!}
                                        </div>
                                        <div class="col-lg-3 mb-15">
                                            {!! Form::label('answer_2_value', 'قيمة الاجابة') !!}
                                            {!!Form::number('answer_2_value',null,array('class'=>'form-control','autocomplete'=>'off','placeholder'=>'قيمة الاجابة','required'=>'required'))!!}
                                        </div>

                                        <div class="col-lg-9 mb-15">
                                            {!! Form::label('answer_3', 'الاجابه الثالثه') !!}
                                            {!!Form::text('answer_3',null,array('class'=>'form-control','autocomplete'=>'off','placeholder'=>'الاجابه الثالثه'))!!}
                                        </div>
                                        <div class="col-lg-3 mb-15">
                                            {!! Form::label('answer_3_value', 'قيمة الاجابة') !!}
                                            {!!Form::number('answer_3_value',null,array('class'=>'form-control','autocomplete'=>'off','placeholder'=>'قيمة الاجابة'))!!}
                                        </div>

                                        <div class="col-lg-9 mb-15">
                                            {!! Form::label('answer_4', 'الاجابه الرابعة') !!}
                                            {!!Form::text('answer_4',null,array('class'=>'form-control','autocomplete'=>'off','placeholder'=>'الاجابه الرابعة'))!!}
                                        </div>

                                        <div class="col-lg-3 mb-15">
                                            {!! Form::label('answer_4_value', 'قيمة الاجابة') !!}
                                            {!!Form::number('answer_4_value',null,array('class'=>'form-control','autocomplete'=>'off','placeholder'=>'قيمة الاجابة'))!!}
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

          if($( "input[name='question_head']" ).val().length
          && $( "input[name='answer_1']" ).val().length  && $( "input[name='answer_1_value']" ).val().length
          && $( "input[name='answer_2']" ).val().length  && $( "input[name='answer_2_value']" ).val().length
 )
            {
                $('#loader').addClass('active');
            }else
            {
                $('#loader').removeClass('active')
            }
        });

    </script>














@endsection
