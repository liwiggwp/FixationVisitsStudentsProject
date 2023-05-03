@extends('layouts.layout',['title' => 'Создание нового занятия'])

@section('content')
    <div class="container-create">
        <form action="{{url('lesson/store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h2 style="margin-top: 20px">Создать занятие</h2>
            @include('posts.parts.post')
            <input type="submit" value="Создать занятие" class="btn btn-outline-dark">
        </form>
    </div>
@endsection
