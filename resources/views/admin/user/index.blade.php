@extends('layouts.admin_layout', ['title' => 'Все пользователи'])

@section('content')


    <h2 style="padding: 20px; text-align: center">Все пользователи</h2>

    <table class="table">
        <thead>
        <tr>
            <th style="text-align: center" scope="col">#</th>
            <th style="text-align: center" scope="col">Имя</th>
            <th style="text-align: center" scope="col">E-mail</th>
            <th style="text-align: center" scope="col">Действие</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <th style="text-align: center" scope="row">{{$user->id}}</th>
            <td style="padding: 20px; text-align: center"> {{$user->name}}</td>
            <td style="padding: 20px; text-align: center"> {{$user->email}}</td>
            <td style="padding: 20px; text-align: center">
                <a href="{{route('admin.user.view',['id'=>$user->id])}}"
               class="btn btn-warning">Просмотр карточек</a></td>
        </tr>

        @endforeach
        </tbody>
    </table>




@endsection
