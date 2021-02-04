@extends('dashboard.layouts.app')
@section('title','Roles | Mange |')
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

                    @if(!isset($role) )
                        <h3>Create Role</h3>
                    @else
                        <h3>Update Role</h3>
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

                                    @if(isset($role) )
                                      {!!Form::model($role,array('url'=>url('dashboard/roles/'.$role->id),'method' => 'PATCH','files'=>true,"style"=>"width: 100%"))!!}
                                  @else
                                      {!!Form::open(array('url'=>url('dashboard/roles'),'files'=>true,"style"=>"width: 100%"))!!}
                                  @endif


                                        <div class="col-12 mb-15">
                                            {!! Form::label('name', 'الاسم') !!}
                                            {!!Form::text('name',null,array('class'=>'form-control ','placeholder'=>'الاسم','autocomplete'=>'name','required'=>'required'))!!}
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
        myform.password.value = randomPassword(myform.length.value);
    }

</script>














@endsection
