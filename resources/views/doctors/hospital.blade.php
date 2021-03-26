@extends('layouts.app')
@section('content')
<div class="container">
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="text-center h3  m-b-md">
               المستشفيات
            </div>
            <div class="container">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">address</th>
                        <th scope="col">الاجراءات</th>
                    </tr>
                    </thead>
                    <tbody>
                   @if(isset($hospitals)&& $hospitals->count()>0)
                    @foreach($hospitals as $hospital)
                        <tr class="">
                            <td scope="row">{{$hospital -> id}}</td>
                            <td>{{$hospital -> name}}</td>
                            <td>{!!$hospital -> address!!}</td>
                            <td>
                                <a href="{{route('hospital.doctors',$hospital -> id)}}" class="btn btn-primary">عرض الأطباء</a>
                                <a href="{{route('hospital.delete',$hospital->id)}}" class="btn btn-danger">حذف</a>
                            </td>
                        </tr>
                    @endforeach
                   @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@stop
@section('scripts')
@stop
