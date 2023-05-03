@extends('layouts.admin_layout', ['title' => 'Карточки'])

@section('content')

    <div class="row row-cols-1 row-cols-2 row-cols-3">
        @foreach(Auth::user()->posts as $post)
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
                            <a href="{{route('admin.post.restore',['id'=>$post->post_id])}}"
                               class="btn btn-outline-success">Восстановить</a>
                            <form action="{{route('admin.post.destroy',['id'=>$post->post_id])}}" method="post">                               @csrf
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-outline-danger" value="Удалить">
                            </form>

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


    <div class="pagination-block">
        <ul class="pagination justify-content-center">
            @if(!isset($_GET['search']))
                {{  $posts->appends(request()->input())->links('layouts.paginationlinks') }}


            @endif
        </ul>
    </div>
@endsection
