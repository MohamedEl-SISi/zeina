@extends('dashboard.layouts.app')
@section('title','Users | Mange |')
@section('content')
    <style>
        .btn
        {
            width: 100%;
            height: 100%;
        }
    </style>
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">

                    @if(!isset($user) )
                        <h3>اضافة مستخدم</h3>
                    @else
                        <h3>تعديل مستخدم</h3>
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


                                    @if(isset($user) )
                                        {!!Form::model($user,array('url'=>url('dashboard/users/'.$user->id),'method' => 'PATCH','files'=>true,'name'=>'myform','style'=>'width: 100%'))!!}
                                    @else
                                        {!!Form::open(array('url'=>url('dashboard/users'),'files'=>true,'name'=>'myform','style'=>'width: 100%'))!!}
                                    @endif

                                        <div class="col-12 mb-15">
                                            {!! Form::label('name', 'الاسم') !!}
                                            {!!Form::text('name',null,array('class'=>'form-control ','placeholder'=>'الاسم','autocomplete'=>'name','required'=>'required'))!!}
                                        </div>
                                        <div class="col-12 mb-15">
                                          @if(isset($user))
                                              {!! Form::label('email', 'Email') !!}
                                              <span class="form-control">{{$user->email}}</span>
                                          @else
                                            {!! Form::label('email', 'البريد الالكتروني') !!}
                                            {!!Form::email('email',null,array('class'=>'form-control ','placeholder'=>'البريد الإلكترونى','autocomplete'=>'email','required'=>'required'))!!}
                                          @endif
                                        </div>

                                        <div class="col-12 mb-15">
                                            {!! Form::label('password', 'كلمة السر') !!}
                                        <div class="control-group row">
                                            <div class="col-10 mb-15">
                                                {!!Form::text('password',null,array('class'=>'form-control ','placeholder'=>'كلمة المرور'))!!}
                                            </div>
                                            <div class="col-2 mb-15" align="center">
                                                <input type="button" class="btn btn-danger" value="انشاء كلمة سر" onClick="generate();" tabindex="1">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-12 mb-15">
                                            {!! Form::label('role', 'وظيفة') !!}
                                            {!!Form::select('role',$roles->pluck('name','id'),$user??null ?$user->role->role->id:null,array('class'=>'form-control ','required'=>'required'))!!}
                                        </div>

                                        <div class="col-12 mb-15" align="left">
                                            {!!Form::submit('حفظ', array('class'=>'btn button-primary'))!!}
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
function randomPassword(length) {
        var chars = "abcdefghijklmnopqrstuvwxyzA@#BCDEFGHIJKLMNOP1234567890";
        var pass = "";
        for (var x = 0; x < length; x++) {
            var i = Math.floor(Math.random() * chars.length);
            pass += chars.charAt(i);
        }
        return pass;
    }

    function generate() {
        myform.password.value = randomPassword(8);
    }

</script>














@endsection
