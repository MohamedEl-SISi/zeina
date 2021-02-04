@extends('dashboard.layouts.app')
@section('title','Roles |')
@section('content')


    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3>Roles</h3>
                </div>
            </div>
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-date-range">
                    <a href="{{route('roles.create')}}" class="button button-8tracks"><span>Create Role</span></a>
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
                    @if(count($roles) > 0)
                        <table class="table ">
                            <thead>
                            <tr>
                                <th class="center">#</th>
                                <th class="center">الاسم</th>
                                <th class="center"></th>
                                <th class="center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $key=> $record)
                                <tr>
                                    <td align="center">{{ $key+1 }}</td>
                                    <td align="center">{{ $record->name }}</td>

                                    <td align="center">
                                        <a href="{{ url('dashboard/roles/'.$record->id) }}" data-clipboard-text="zmdi zmdi-edit">
                                          <span>تحديث</span> <i class="zmdi zmdi-edit zmdi-hc-fw"></i>
                                        </a>
                                    </td>
                                    <td align="center">
                                      <form action="{{ url('dashboard/roles/'.$record->id) }}" method="POST" style="display: inline-block">
                                          {{ csrf_field() }}
                                          {{ method_field('DELETE') }}
                                          <button type="submit" id="delete-task-{{ $record->id }}" name="id" value="{{$record->id}}" class="btn hover-btn">
                                               <i class="fa fa-btn fa-trash"></i>
                                          </button>
                                      </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $roles->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
