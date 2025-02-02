<select name="category" type="search" class="form-select" style="width: 186px;" aria-label="Категория">
    <option {{isset($_GET['category']) ? '' : 'selected'}} value="">Категория</option>
    @foreach($categories as $category)
        <option {{isset($_GET['category']) && $_GET['category'] == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
    @endforeach
</select>
<div>
    <input autocomplete="off" name="name" type="search" value="{{$_GET['name'] ?? null}}" class="form-control"
           placeholder="Название">
</div>
