<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
<script>
    var $j = jQuery.noConflict();
</script>
<script src="https://polygit.org/components/webcomponentsjs/webcomponents-lite.js"></script>
<link rel="import" href="frevvo-date-time.html">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" type="text/css" href="http://www.w3schools.com/lib/w3.css" />
<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ru.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Название" required value="{{$lesson->name ?? ''}}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="class" placeholder="Аудитория" required value="{{$lesson->class ?? ''}}">
</div>
<!-- <div class="form-group">
    <input type="text" class="form-control" name="teacher" placeholder="Преподаватель" required value="{{$lesson->teacher ?? ''}}">
</div> -->
<div class="form-group">
    <select class="form-control input-sm" name="teacher">
        <option value="">Выбор</option>
        
        <option value="1" required value="{{$lesson->teacher ?? ''}}">Преподаватель Преподаватель Преподаватель</option>
        <option value="2" required value="{{$lesson->teacher ?? ''}}">Преподаватель2 Преподаватель2 Преподаватель2</option>
        <option value="3" required value="{{$lesson->teacher ?? ''}}">Преподаватель3 Преподаватель3 Преподаватель3</option>
        <option value="4" required value="{{$lesson->teacher ?? ''}}">Преподаватель4 Преподаватель4 Преподаватель4</option>
    </select>
</div>

<!-- <div class="form-group">
    <input type="text" class="form-control" name="group_id" placeholder="Группа" required value="{{$lesson->group_id ?? ''}}">
</div> -->

<div class="form-group">
    <select class="form-control input-sm" name="group_id">
        <option value="">Выбор</option>
        
        <option value="1" required value="{{$lesson->group_id ?? ''}}">ИП-22-11</option>
        <option value="2" required value="{{$lesson->group_id ?? ''}}">ИП-22-14</option>
        <option value="3" required value="{{$lesson->group_id ?? ''}}">ЗИО-21-09</option>
    </select>
</div>

<div class="form-group">
    <input type="datetime-local" class="form-control" name="date" required value="{{$lesson->date ?? ''}}">
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    
    config = {
        enableTime: true,
        dateFormat: 'Y-m-d H:i',
        "locale": "ru"
    }
    flatpickr("input[type=datetime-local]", config);
</script>

<!-- <script>
        $(function () {
            var loader = $('#loader'),
                category = $('select[name="group_id"]'),
                categor = $('select[name="teacher"]');

            loader.hide();          
        })
    </script> -->