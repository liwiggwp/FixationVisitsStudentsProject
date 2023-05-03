@extends('layouts.admin_layout', ['title' => 'Все карточки'])

@section('content')


    <h2 style="padding: 20px; text-align: center">Все карточки</h2>

    <div class="row row-cols-1 row-cols-2 row-cols-3">
        @foreach($lessons as $lesson)
            <div class="col">
                <div class="card ">
                    <div class="card-body">                
                             <div class="card-title"><h4>{{$lesson->surname}}</h4></div>
                        <h4>Название: {{$lesson->name}}</h4>
                        <h6>Аудитория: {{$lesson->class}}</h6>
                        <h6>Преподаватель: {{$lesson->teacher}}</h6>
                        <h6>Группа: {{$lesson->group_id}}</h6>
                        @if($lesson->trashed())
                            <a href="{{route('admin.lesson.restore',['id'=>$lesson->id])}}"
                               class="btn btn-outline-success">Восстановить</a>
                            <form action="{{route('admin.lesson.destroy',['id'=>$lesson->id])}}" method="post">                               @csrf
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-outline-danger" value="Удалить">
                            </form>

                        @endif
                        @if(!($lesson->trashed()))
                        <a href="{{route('lesson.show',['id'=>$lesson->id])}}"
                           class="btn btn-outline-dark">Посмотреть</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="pagination-block">
        <ul class="pagination justify-content-center">
            @if(!isset($_GET['search']))
                {{  $lessons->appends(request()->input())->links('layouts.paginationlinks') }}
            @endif
        </ul>
    </div>


@endsection
