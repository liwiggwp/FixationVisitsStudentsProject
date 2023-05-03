<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Название" required value="{{$lesson->name ?? ''}}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="class" placeholder="Аудитория" required value="{{$lesson->class ?? ''}}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="teacher" placeholder="Преподаватель" required value="{{$lesson->teacher ?? ''}}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="group_id" placeholder="Группа" required value="{{$lesson->group_id ?? ''}}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="date" placeholder="Дата" required value="{{$lesson->date ?? ''}}">
</div>

