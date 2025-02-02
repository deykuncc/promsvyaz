<div class="col">
    <label for="category" class="text-secondary">Категория</label>
    <select name="category" type="search" class="form-select" style="width: 186px;" aria-label="Категория">
        <option value="" {{isset($_GET['category']) ? '' : 'selected'}}>Выберите</option>
        @foreach($categories as $category)
            <option
                    {{isset($_GET['category']) && $_GET['category'] == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
</div>

<div class="col">
    <label for="department" class="text-secondary">Участок</label>
    <select name="department" type="select" class="form-select" style="width: 186px;" aria-label="Получено">
        <option value="" selected>Выберите</option>
        @foreach($departments as $department)
            <option {{isset($_GET['department']) && (int) $_GET['department'] === $department->id ? "selected" : "" }} value="{{$department->id}}">{{$department->name}}</option>
        @endforeach
    </select>
</div>

<div class="col">
    <label for="received" class="text-secondary">Получено</label>
    <select name="received" type="select" class="form-select" style="width: 186px;" aria-label="Получено">
        <option value="">Выберите</option>
        <option {{isset($_GET['received']) && (int) $_GET['received'] == 0 ? "selected" : ""}} value="0">Нет</option>
        <option {{isset($_GET['received']) && (int) $_GET['received'] == 1 ? "selected" : ""}} value="1">Да</option>
    </select>
</div>

<div class="col">
    <label for="days" class="text-secondary">Осталось дней</label>
    <input autocomplete="off" name="days" type="search" value="{{$_GET['days'] ?? null}}" class="form-control"
           placeholder="365">
</div>

<div class="col">
    <label for="name" class="text-secondary">ФИО</label>
    <input autocomplete="off" name="name" type="search" value="{{$_GET['name'] ?? null}}" class="form-control"
           placeholder="Иванов Иван Иванович">
</div>

<div class="col">
    <label for="nameItem" class="text-secondary">Название СИЗ</label>
    <input autocomplete="off" name="nameItem" type="search" value="{{$_GET['nameItem'] ?? null}}" class="form-control"
           placeholder="Каска">
</div>


