@section('script')
    <script src="{{url('assets\js\plugins\sortable\sortable.min.js')}}"></script>
    <script src="{{url('assets\js\plugins\sortable\sortable.active.js')}}"></script>

    <script src="{{url('assets\js\vendor\popper.min.js')}}"></script>
    <script src="{{url('assets\js\vendor\bootstrap.min.js')}}"></script>

    <script src="{{url('assets\js\plugins\summernote\summernote-bs4.min.js')}}"></script>
    <script src="{{url('assets\js\plugins\summernote\summernote.active.js')}}"></script>
    <script src="{{url('assets\js\plugins\quill\quill.min.js')}}"></script>
    <script src="{{url('assets\js\plugins\quill\quill.active.js')}}"></script>
@endsection
@extends('dashboard.layouts.app')
@section('title','section | Menu order |')
@section('content')
    <link id="cus-style" rel="stylesheet" href="{{url('assets\css\style-primary.css')}}">

    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                        <h3>ترتيب التصنيفات في المنيو</h3>
                </div>
            </div>
        </div>


        <div class="row">
                      <div class="col-12 mb-30">
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
                      </div>

            <div class="col-12 mb-30">
                <div class="box">
                    <div class="box-body">
                        <div class="row mbn-20">
                            <div class="col-lg-12 col-12 mb-20">
                                <div class="row mbn-15">
                                        {!!Form::open(array('url'=>url('dashboard/section/orderSaveMenu'),'files'=>true,'style'=>'width: 100%',"class"=>"row justify-content-center"))!!}

                                        <div class="col-12 mb-15">
                                            {!!Form::submit('حفظ', array('class'=>'button button-primary farda','style'=>'width:100%'))!!}
                                        </div>

                                        <div class="col-lg-8 col-12 mb-30 ">
                                                <div class="box">
                                                   <div class="box-body">
                                                       <ul id="simple-sortable" class="sortable simple-sortable list-group">
                                                          @foreach($order->data??[] as $key =>$id)
                                                            @php
                                                               $section = $sections->where('id',$id)->first();
                                                            @endphp

                                                              @if($section)
                                                             <li class="list-group-item"><input type="hidden" value="{{$section->id}}" name="section[]"> {{$section->name}}  </li>
                                                             @endif

                                                           @endforeach

                                                           @php
                                                            $sections = $sections->whereNotIn('id',$order->data??[]);
                                                          @endphp

                                                          @foreach($sections as $section)
                                                                     <li class="list-group-item"><input type="hidden" value="{{$section->id}}" name="section[]"> {{$section->name}}</li>
                                                           @endforeach
                                                       </ul>
                                                   </div>
                                               </div>

                                        </div>


                                                    </div>

                                                </div>
                                            </div>
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

@endsection
