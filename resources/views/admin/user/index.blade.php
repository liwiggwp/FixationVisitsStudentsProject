@extends('layouts.admin_layout', ['title' => 'Все пользователи'])

@section('content')


<h2 style="padding: 20px; text-align: center">Все пользователи</h2>
<a href="{{ route('admin.register.create') }}" class="btn btn-dark">Создать</a>
         
                              
<table class="table">
    <thead>
        <tr>
            <th style="text-align: center" scope="col">#</th>
            <th style="text-align: center" scope="col">Имя</th>
            <th style="text-align: center" scope="col">E-mail</th>
            <th style="text-align: center" scope="col">Группа</th>
            <th style="text-align: center" scope="col">Действие</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <th style="text-align: center" scope="row">{{$user->id}}</th>
            <td style="padding: 20px; text-align: center"> {{$user->name}}</td>
            <td style="padding: 20px; text-align: center"> {{$user->email}}</td>
            <td>

                <div class="form-group">
                    <select class="form-control input-sm" name="group_id">
                        <option value="">{{$user->name_group}}</option>
                        @foreach($groups as $group)
                        <option value="{{$group->id ?? ''}}" required value="{{$user_group->group_id ?? ''}}">{{$group->name_group}}</option>
                        @endforeach
                    </select>
                </div>
            </td>
            <!-- <td style="padding: 20px; text-align: center"> </td> -->
            <td style="padding: 10px; text-align: center">
                <form  style="padding: 5px;" action="{{route('admin.user.update',['id'=>$user->id])}}" method="post">
                    @csrf
                    <input type="submit" class="btn btn-primary" name="{{$group->id ?? ''}}" value="Сохранить">
                </form>
            
            
                <a href="{{route('admin.user.view',['id'=>$user->id])}}" class="btn btn-warning">Просмотр</a>
            </td>
        </tr>

        @endforeach
    </tbody>
</table>



<script>
    $(function() {
        var loader = $('#loader'),
            category = $('select[name="group_id"]');

        loader.hide();
    })
</script>
@endsection