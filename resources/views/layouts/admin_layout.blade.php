<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport"
          content="width-device-width, user-scalable=no, initial-scale=1.0,maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
            integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('sass/style.css')}}">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto" style="">
            <li class="nav-item">
                <a class="nav-link active " aria-current="page" href="/" style="color: white">Главная</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('admin.lesson.index')}}" style="color: white">Карточки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('admin.user.index')}}" style="color: white">Пользователи</a>
            </li>

            <li class="nav-item">
                <a class="nav-link active" aria-current="page"  style="color: white; font-size: 20pt; margin-left: 200px">Admin-панель</a>
            </li>
        </ul>

    </div>
</nav>



<div class="container" style="width: 1000px;">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <div> {{session('success')}} </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @yield('content')
</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
