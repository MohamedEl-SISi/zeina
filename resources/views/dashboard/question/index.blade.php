@extends('dashboard.layouts.app')
@section('title','َQuestions |')
@section('content')

    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3>الأسئلة</h3>
                </div>
            </div>
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-date-range">
                    <a href="{{ route('question.create') }}" class="button button-8tracks"><span>اضافة سؤال</span></a>
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
                <div class="box-body">
                    @if(count($questions) > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th class="center">الاسم</th>
                            <th class="center">التصنيف</th>
                            <th class="center"></th>
                            @if(auth::user()->role->role_id <= 2)
                            <th class="center"></th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $key=> $record)
                            <tr align="center">
                                <td align="center"> {{ $key+1 }}</td>
                                <td align="center"> {{ $record->question_head }}</td>
                                <td align="center">
                                    <a href="{{ route('question.edit',$record->id) }}" data-clipboard-text="zmdi zmdi-edit"><span>تحديث</span> <i class="zmdi zmdi-edit zmdi-hc-fw"></i> </a>
                                </td>
                                @if(auth::user()->role->role_id <= 2)
                                <td align="center">
                                    <form action="{{ url('dashboard/question/'.$record->id) }}" method="POST" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit"  class="btn hover-btn">
                                             <i class="fa fa-btn fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{ $questions->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
