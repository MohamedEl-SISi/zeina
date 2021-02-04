@extends('dashboard.layouts.app')
@section('title','Article section |')
@section('content')

    <div class="content-body">
        <div class="row justify-content-between align-items-center mb-10">
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-heading">
                    <h3>التصنيفات المقالات</h3>
                </div>
            </div>
            <div class="col-12 col-lg-auto mb-20">
                <div class="page-date-range">
                    <a href="{{ route('articleSection.create') }}" class="button button-8tracks"><span>اضافة تصنيف</span></a>
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
                    @if(count($section) > 0)
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th class="center">الاسم</th>
                            <th class="center">حالة</th>
                            <th class="center"></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($section as $key=> $record)
                            <tr align="center">
                                <td align="center"> {{ $key+1 }}</td>
                                <td align="center"> {{ $record->name }}</td>
                                <td align="center"> {{ $record->status }}</td>

                                <td align="center">
                                    <a href="{{ route('articleSection.edit',$record->id) }}" data-clipboard-text="zmdi zmdi-edit"><span>تحديث</span> <i class="zmdi zmdi-edit zmdi-hc-fw"></i> </a>
                                </td>
                                <td align="center">

                                    <form action="{{ url('dashboard/articleSection/'.$record->id) }}" method="POST" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit"  class="btn hover-btn">
                                             <i class="fa fa-btn fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        {{ $section->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
