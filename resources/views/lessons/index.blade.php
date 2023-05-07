@extends('layouts.layout', ['title' => 'Главная страница'])

@section('content')
    


    <h2 style="padding: 20px; text-align: center">Расписание на сегодня</h2>

    <div class="row row-cols-1 row-cols-2 row-cols-3">
        @foreach($lessons as $lesson)
            <div class="col">
                <div class="card">
                    <div class="card-body">          
                        <h4>Название: {{$lesson->name}}</h4>
                        <h6>Аудитория: {{$lesson->class}}</h6>
                        <h6>Преподаватель: {{$lesson->teacher}}</h6>
                        <h6>Группа: {{$lesson->name_group}}</h6>
                        <a href="{{route('lesson.show',['id'=>$lesson->id])}}"
                           class="btn btn-outline-dark">Посмотреть</a>
                    </div>
                </div>
            </div>
                
        @endforeach
    </div>




@endsection
