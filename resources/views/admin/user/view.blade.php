@extends('layouts.admin_layout', ['title' => 'Карточки'])
@section('content')

{{--    <h2>User: {{ $user->id }} - {{ $user->email }}</h2>--}}
{{--    <br/>--}}
{{--    <h2>Posts:</h2>--}}
{{--    @foreach($posts AS $post)--}}
{{--        <p> {{ $post->id }}: {{ $post->fullName }}</p>--}}
{{--    @endforeach--}}
<h1>Все карточки пользователя  {{ $user->email }}</h1>

    <div class="row row-cols-1 row-cols-2 row-cols-3">
        @foreach($posts AS $post)
            <div class="col">
                <div class="card ">
                    <div class="card-body">
                        <div class="card-img"
                             style="background-image: url({{$post->img ?? asset('/img/nophoto.png')}})"></div>
                        <div class="card-title"><h4>{{$post->fullName}}</h4></div>
                        <h6>Никнейм: {{$post->nickname}}</h6>
                        <h6>Позиция: {{$post->position}}</h6>
                        <h6>Возраст: {{$post->age}}</h6>
                        @if($post->trashed())
                            <a href="{{route('admin.user.restore',['id'=>$post->post_id])}}"
                               class="btn btn-outline-success">Восстановить</a>

                        @endif
                        @if(!($post->trashed()))
                            <a href="{{route('post.show',['id'=>$post->post_id])}}"
                               class="btn btn-outline-dark">Посмотреть</a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
