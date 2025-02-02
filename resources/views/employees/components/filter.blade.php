<select name="profession" class="form-select" style="width: 186px;" aria-label="Профессия">
    <option {{empty($_GET['profession']) ? "selected" : ""}} value="">Профессия</option>
    @foreach($professions as $profession)
        <option
            {{!empty($_GET['profession']) && $_GET['department'] == $profession->id ? 'selected' : ''}} value="{{$profession->id}}">{{$profession->name}}</option>
    @endforeach
</select>
<select name="department" class="form-select" style="width: 186px;" aria-label="Подразделение">
    <option {{empty($_GET['department']) ? "selected" : ""}} value="">Подразделение</option>
    @foreach($departments as $department)
        <option
            {{!empty($_GET['department']) && $_GET['department'] == $department->id ? 'selected' : ''}} value="{{$department->id}}">{{$department->name}}</option>
    @endforeach
</select>
<select name="gender" class="form-select" style="width: 186px;" aria-label="Пол">
    <option {{empty($_GET['gender']) ? "selected" : ""}} value="">Пол</option>
    @foreach($genders as $gender)
        <option
            {{!empty($_GET['gender']) && $_GET['gender'] == $gender->id ? 'selected' : ''}} value="{{$gender->id}}">{{$gender->name}}</option>
    @endforeach
</select>
<div>
    <input autocomplete="off" value="{{$_GET['name'] ?? null}}" name="name" type="search" class="form-control"
           placeholder="Фио">
</div>
