@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')
    


    <h2 style="padding: 20px; text-align: center">Расписание на сегодня</h2>

    <div class="row row-cols-1 row-cols-2 row-cols-3">
        @foreach($lessons as $lessons)
            <div class="col">
                <div class="card">
                    <div class="card-body">
          
                        <div class="card-title"><h4>{{$lessons->surname}}</h4></div>
                        <h6>Название: {{$lessons->name}}</h6>
                        <h6>Аудитория: {{$lessons->class}}</h6>
                        <h6>Преподаватель: {{$lessons->teacher}}</h6>
                        <h6>Группа: {{$lessons->group_id}}</h6>
                        <a class="btn btn-outline-dark">Посмотреть</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




@endsection
