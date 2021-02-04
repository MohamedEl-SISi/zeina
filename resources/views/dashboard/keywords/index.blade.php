@extends('dashboard.layouts.app')
@section('title','Keywords |')
@section('content')

    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3>الكلمات الدالة</h3>
                </div>
            </div>
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-date-range">
                    <a href="{{ route('keywords.create') }}" class="button button-8tracks"><span>اضافة كلمة</span></a>
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
        <div class="citizen-wrapper">
            <div class="citizen-container">
                <div class="citizen-list">

              {!!Form::open(array('url'=>url('dashboard/keywords/filter'),'method' => 'get','files'=>true,'style'=>'width: 100%',"class"=>"row "))!!}
              <div class="col-lg-3">
                  {!!Form::text('q',null,array('class'=>'form-control ','placeholder'=>'بحث'))!!}
              </div>
              <div class="col-lg-3">
                  {!!Form::submit('بحث', array('class'=>'button button-primary'))!!}
              </div>
              </form>
                    @if(count($keywords) > 0)
                        <table class="table table-bordered data-table data-table-default">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">الاسم</th>
                                <th class="center"></th>
                                @if(auth::user()->role->role_id <= 2)
                                <th class="center"></th>
                                @endif
                            </tr>
                            </thead>
                            @foreach ($keywords as $key=> $record)
                            <tr align="center">
                                <td align="center"> {{ $key+1 }}</td>
                                <td align="center"> {{ $record->name }}</td>
                                <td align="center">
                                    <a href="{{ route('keywords.edit',$record->id) }}" data-clipboard-text="zmdi zmdi-edit"><span>تحديث</span> <i class="zmdi zmdi-edit zmdi-hc-fw"></i> </a>
                                </td>
                                @if(auth::user()->role->role_id <= 2)
                                <td align="center">
                                    <form action="{{ url('tags/'.$record->_id) }}" method="POST" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" id="delete-task-{{ $record->_id }}" name="id" value="{{$record->_id}}" class="btn hover-btn">
                                           <i class="fa fa-btn fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{ $keywords->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
