@extends('dashboard.layouts.app')
@section('title','Keywords | Mange |')
@section('content')
    <style>
        .button
        {
            width: 100%;
            height: 100%;
        }
    </style>
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">

                    @if(isset($category_edit) )
                        <h3>تعديل كلمة دالة</h3>
                    @else
                        <h3>اضافة كلمة دالة</h3>
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
                                    @if(isset($keywords_edit) )
                                      {!!Form::model($keywords_edit,array('url'=>url('dashboard/keywords/'.$keywords_edit->id),'method' => 'PATCH','files'=>true,'style'=>'width: 100%'))!!}
                                    @else
                                        {!!Form::open(array('url'=>url('dashboard/keywords'),'files'=>true,'style'=>'width: 100%'))!!}
                                    @endif
                                        <div class="col-12 mb-15">
                                            {!! Form::label('name', '  الكلمات الدالة') !!}
                                            {!!Form::text('name',null,array('class'=>'form-control ','id'=>'name','placeholder'=>'الكلمات الدالة','autocomplete'=>'name','required'=>'required'))!!}
                                        </div>

                                        <div class="col-12 mb-15">
                                          @if(isset($keywords_edit))
                                                {!! Form::label('slug', 'الرابط الدائم') !!}
                                              <span class="form-control">{{$keywords_edit->slug}}</span>
                                          @else
                                            {!! Form::label('slug', 'الرابط الدائم') !!}
                                            {!!Form::text('slug',null,array('class'=>'form-control','id'=>'slug','placeholder'=>'الرابط الدائم','required'=>'required'))!!}
                                            @endif
                                        </div>

                                        <div class="col-12 mb-15">
                                            {!!Form::submit('حفظ', array('class'=>'button button-primary'))!!}
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
