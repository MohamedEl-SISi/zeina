@extends('dashboard.layouts.app')
@section('title','Articles |')
@section('content')

<style>
.table td:nth-child(2), .table th:nth-child(2)
{
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 600px;
}
</style>
    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3>المقالات</h3>
                </div>
            </div>
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-date-range">
                    <a href="{{ route('articles.create') }}" class="button button-8tracks"><span>اضافة مقال</span></a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
          @if (session('message'))
              <div class="alert alert-success" align="center">
                  {{ session('message') }}
              </div>
          @endif

          @if (session('message_err'))
              <div class="alert alert-danger" align="center">
                  {{ session('message_err') }}
              </div>
          @endif
        </div>

        <div class="col-lg-12 col-12 mb-30">
            <div class="box">
                <div class="box-body">

                    {!!Form::open(array('url'=>url('dashboard/articles/filter'),'method' => 'get','files'=>true,'style'=>'width: 100%',"class"=>"row "))!!}
                    <div class="col-lg-2 ">
                        {!!Form::select('status',['draft'=>'مسوده','published'=>'منشور'],null ,array('class'=>'form-control'))!!}
                    </div>
                    <div class="col-lg-2 ">
                        {!!Form::select('sectionId',collect($newsCategories)->pluck('name','id'), null,array('class'=>'form-control'))!!}
                    </div>
                    <div class="col-lg-2">
                        {!!Form::text('q',null,array('class'=>'form-control ','placeholder'=>'بحث'))!!}
                    </div>
                    <div class="col-lg-2">
                        {!!Form::submit('بحث', array('class'=>'button button-primary'))!!}
                    </div>
                    </form>

                    @if(count($news) > 0)
                        <table class="table table-bordered data-table data-table-default">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">الاسم</th>
                                <th class="center">status</th>
                                <th class="center">section</th>

                                <th class="center">تاريخ النشر</th>
                                <th class="center"></th>
                                @if(auth::user()->role->role_id <= 2)
                                <th class="center"></th>
                                @endif
                            </tr>
                            </thead>
                            @foreach ($news as $key=> $record)
                            <tr align="center">
                                <td align="center"> {{ $key+1 }}</td>
                                <td align="center" ><span class="tittlemax" > {{ $record->title }}<span> </td>
                                <td align="center"> {{ $record->status }}</td>
                                <td align="center"> {{ $record->section?$record->section->name:"-"}}</td>

                                <td align="center">
                                    @if(is_null($record->publish_date))
                                        -
                                    @else
                                    {{Carbon\carbon::parse($record->publish_date)->diffForHumans()}}
                                    @endif
                                </td>
                                <td align="center">
                                    <a href="{{ route('articles.edit',$record->id) }}" data-clipboard-text="zmdi zmdi-edit"><span>تحديث</span> <i class="zmdi zmdi-edit zmdi-hc-fw"></i> </a>
                                </td>
                                @if(auth::user()->role->role_id <= 2)
                                <td align="center">
                                    <form action="{{ url('dashboard/articles/'.$record->id) }}" method="POST" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-task-{{ $record->id }}" name="id" value="{{$record->id}}" class="btn hover-btn">
                                             <i class="fa fa-btn fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{ $news->appends($_GET)->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
