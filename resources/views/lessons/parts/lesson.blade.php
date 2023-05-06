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
<div class="form-group">
    <input type="text" class="form-control" name="teacher" placeholder="Преподаватель" required value="{{$lesson->teacher ?? ''}}">
</div>
<!-- <div class="form-group">
    <input type="text" class="form-control" name="group_id" placeholder="Группа" required value="{{$lesson->group_id ?? ''}}">
</div> -->

<div class="form-group">
    <select class="form-control input-sm" name="group_id">
        <option value="">Выбор</option>
        
        <option value="1" required value="{{$lesson->group_id ?? ''}}">Группа 1</option>
        <option value="2" required value="{{$lesson->group_id ?? ''}}">Группа 2</option>
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
    }
    flatpickr("input[type=datetime-local]", config);
</script>

<script>
        $(function () {
            var loader = $('#loader'),
                category = $('select[name="group_id"]');

            loader.hide();           

            // category.change(function() {
            //     var id= $(this).val();
            //     if(id){
            //         loader.show();
            //         subcategory.attr('disabled','disabled')

            //         $.get('{{url('/dropdown-data?cat_id=')}}'+id)
            //             .success(function(data){
            //                 var s='<option value="">---select--</option>';
            //                 data.forEach(function(row){
            //                     s +='<option value="'+row.id+'">'+row.name+'</option>'
            //                 })
            //                 subcategory.removeAttr('disabled')
            //                 subcategory.html(s);
            //                 loader.hide();
            //             })
            //     }

            // })
        })
    </script>