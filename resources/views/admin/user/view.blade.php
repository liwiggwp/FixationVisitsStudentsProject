@extends('layouts.admin_layout', ['title' => 'Карточки'])
@section('content')

{{-- <h2>User: {{ $user->id }} - {{ $user->email }}</h2>--}}
{{-- <br/>--}}
{{-- <h2>Posts:</h2>--}}
{{-- @foreach($posts AS $post)--}}
{{-- <p> {{ $post->id }}: {{ $post->fullName }}</p>--}}
{{-- @endforeach--}}
<h1>Пользователь {{ $user->name }}</h1>

<h1>Профиль</h1>
<div class="row">
    <div class="col-6 mx-auto">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h4>Данные пользователя </h4>
                </div>
                <h6>ФИО: {{ $user->surname}} {{ $user->name}} {{ $user->patronymic}}</h6>           
                <h6>E-mail :{{ $user->email }}</h6>
            </div>
        </div>
    </div>
</div>

@endsection