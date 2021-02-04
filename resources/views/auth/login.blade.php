@extends('.dashboard.authentication.app')

@section('content')

    <div class="login-register-wrap">
        <div class="row">

            <div class="d-flex align-self-center justify-content-center order-2 order-lg-1 col-lg-5 col-12">
                <div class="login-register-form-wrap">

                    <div class="content">
                        <h1>تسجيل دخول</h1>
                    </div>

                    <div class="login-register-form">
                        {!!Form::open(array('url'=>url('login'),'class'=>'login-form','files'=>true))!!}
                            <div class="row">
                                <div class="col-12 mb-20">
                                    {!!Form::email('email',null,array('class'=>'form-control ','id'=>'email','placeholder'=>'البريد الإلكترونى','autocomplete'=>'email','required'=>'required'))!!}
                                </div>
                                <div class="col-12 mb-20">
                                    {!!Form::password('password',array('placeholder'=>'كلمة المرور','id'=>'password','required'=>'required','autocomplete'=>'current-password','class'=>'form-control'))!!}
                                </div>
                                <div class="col-12 mb-20">
                                    <label for="remember" class="adomx-checkbox-2">
                                        {!!Form::checkbox('remember',false,null,array('class'=>'form-check-input','id'=>'remember',))!!}
                                        <i class="icon"></i>تذكرنى
                                    </label>
                                </div>
                                <div class="col-12 mt-10">
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    {!!Form::submit(' تسجيل دخول', array('class'=>'button button-primary button-outline'))!!}
                                </div>
                            </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>

            <div class="login-register-bg order-1 order-lg-2 col-lg-7 col-12" style="background-size: 50%;">
                <div class="content">
                    <h1>تسجيل دخول</h1>
                </div>
            </div>

        </div>
    </div>



@endsection
