@extends('dashboard.layouts.app')
@section('content')
    <style>
        .dataTables_length,.paging_simple_numbers,.dataTables_info
        {
            display: none!important;
        }
        .card-title
        {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
    <link id="cus-style" rel="stylesheet" href="assets\css\style-primary.css">
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3>مكتبه الصور</h3>
                </div>
            </div>
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-date-range">
                    <a href="{{ route('image.create') }}" class="button button-8tracks"><span>اضافة صوره</span></a>
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

        <div class="col-lg-12 col-12 mb-30">


            <div class="box">
                <div class="row">

                  {!!Form::open(array('url'=>url('dashboard/image/saveAlbum'),'method' => 'post','files'=>true,'style'=>'width: 100%',"class"=>"row justify-content-right mt-15 mb-15 mr-15"))!!}
                    {!!Form::file('album[]',array('accept'=>"image/*",'type'=>'file',"multiple"=>"",'class'=>'album','required'=>'required'))!!}

                    <div class="col-lg-3 ">
                        {!!Form::text('title',null,array('class'=>'form-control ','placeholder'=>'الاسم','autocomplete'=>'off','required'=>'required'))!!}
                    </div>
                    <div class="col-lg-3">
                        {!!Form::submit('save Album', array('class'=>'button button-primary farda'))!!}
                    </div>

                  </form>


                  {!!Form::open(array('url'=>url('dashboard/image/filter'),'method' => 'get','files'=>true,'style'=>'width: 100%',"class"=>"row justify-content-right mt-15 mb-15 mr-15"))!!}
                  <div class="col-lg-3">
                      {!!Form::text('q',null,array('class'=>'form-control ','placeholder'=>'بحث'))!!}
                  </div>
                    <div class="col-lg-3">
                        {!!Form::submit('بحث', array('class'=>'button button-primary'))!!}
                    </div>
                  </form>



                    @if(count($images) > 0)

                            @foreach ($images as $key=> $record)
                            <div class="col-lg-2 mb-15 ">
                                <div class="card" >
                                    <img class="card-img-top" src="{{$record->image_thumb}}?{{time()}}" alt="Card image cap">
                                    <div class="card-body">
                                        <div class="card-title">{{$record->title}}</div>
                                        <a href="{{ url('dashboard/image/'.$record->id.'/edit') }}" data-clipboard-text="zmdi zmdi-edit"><span>تحديث</span> <i class="zmdi zmdi-edit zmdi-hc-fw"></i> </a>
                                        <!-- <form action="{{ url('dashboard/image/'.$record->id) }}" method="POST" style="display: inline-block">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" id="delete-task-{{ $record->id }}" name="id" value="{{$record->id}}" class="btn hover-btn">
                                                 <i class="fa fa-btn fa-trash"></i>
                                            </button>
                                        </form> -->

                                    </div>
                                </div>
                            </div>

                            @endforeach
                                <div class="col-lg-12 mb-15">
                        {{ $images->appends($_GET)->links() }}
                                </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

<script>


$('.farda').click(function(){

  if($( "input[name='title']" ).val().length && $('input[type=file]').get(0).files.length)
    {
        $('#loader').addClass('active');
    }else
    {
        $('#loader').removeClass('active')
    }
});
</script>

@endsection
