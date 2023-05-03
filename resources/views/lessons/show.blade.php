@extends('layouts.layout', ['title' => "Карточка №$lesson->id. $lesson->name"])

@section('content')


    <div class="container" style="width: 900px; padding: 20px">
        <div class="row">
            <div class="col-12">
                <h2 style="text-align: center">Карточка №{{$lesson->id}} {{$lesson->name}}</h2>
                <div class="card">
                <div class="card-body">

                    <div class="card-title"><h6>Название: {{$lesson->name}}</h6></div>
                    <div class="card-position"><h6>Аудитория: {{$lesson->class}}</h6></div>
                    <div class="card-age"><h6>Преподаватель: {{$lesson->teacher}}</h6></div>
                    <div class="card-birthday"><h6>Группа: {{$lesson->group_id}}</h6></div>
                    <div class="card-desc"><p>Дата: {{$lesson->date}}</p></div>
                    <ul class="list-inline">
                    
                    </ul>

                    <div class="card-btn" style="margin-top: -10px; margin-bottom: 10px">
                        <a href="{{route('lesson.index')}}" class="btn btn-outline-dark">На главную</a>
                        @auth()
                            @if(Auth::user()->isAdmin())
                                <a href="{{route('lesson.edit',['id'=>$lesson->id])}}"
                                   class="btn btn-outline-secondary">Редактировать</a>
                                <form style="margin-top: -38px;margin-left: 260px"
                                action="{{route('lesson.destroy',['id'=>$lesson->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-outline-danger" value="Удалить">
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            
            </div>
        </div>
    </div>

@endsection
