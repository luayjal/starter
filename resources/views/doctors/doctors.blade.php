@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="text-center h3 m-b-md">
                    الأطباء
                </div>
                <div class="container">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">address</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($doctors)&& $doctors->count()>0)
                            @foreach($doctors as $doctor)
                            <tr class="">
                                <td>{{$doctor->id}}</td>
                                <td>{{$doctor->name}}</td>
                                <td>{{$doctor->title}}</td>

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
