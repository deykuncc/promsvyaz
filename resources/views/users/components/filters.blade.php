
<select name="role" type="search" class="form-select" style="width: 186px;" aria-label="Категория">
    <option {{isset($_GET['role']) ? '' : 'selected'}}>Должность</option>
    @foreach($roles as $role)
        <option {{isset($_GET['role']) && $_GET['role'] == $role->id ? 'selected' : ''}} value="{{$role->id}}">{{$role->name}}</option>
    @endforeach
</select>
<div>
    <input autocomplete="off" name="name" type="search" value="{{$_GET['name'] ?? null}}" class="form-control"
           placeholder="ФИО">
</div>
