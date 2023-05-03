@extends('layouts.layout', ['title' => "Редактирование занятия №$lesson->id"])

@section('content')
    <div class="container-create">
        <form action="{{url('lesson/update/'.$lesson->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <h2>Редактирование занятия</h2>
            @include('lessons.parts.lesson')
            <input type="submit" value="Редактировать занятие" class="btn btn-outline-dark">
        </form>
    </div>
@endsection
