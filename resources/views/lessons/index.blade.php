@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')
    


    <h2 style="padding: 20px; text-align: center">Расписание на сегодня</h2>

    <div class="row row-cols-1 row-cols-2 row-cols-3">
        @foreach($lessons as $lesson)
            <div class="col">
                <div class="card">
                    <div class="card-body">
          
                        <div class="card-title"><h4>{{$lesson->surname}}</h4></div>
                        <h6>Название: {{$lesson->name}}</h6>
                        <h6>Аудитория: {{$lesson->class}}</h6>
                        <h6>Преподаватель: {{$lesson->teacher}}</h6>
                        <h6>Группа: {{$lesson->group_id}}</h6>
                        <a class="btn btn-outline-dark">Посмотреть</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




@endsection
