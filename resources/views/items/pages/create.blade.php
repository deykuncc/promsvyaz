<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{url('assets/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/custom/sweetalerts.css')}}">
</head>

<body>
@include('includes.header')

<div class="container">
    <div class="row">
        <div class="d-flex justify-content-start">
            <a href="{{route('items.index')}}"
               class="text-decoration-none d-flex align-items-center text-primary">
                <svg width="26px" height="26px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 12H18M6 12L11 7M6 12L11 17" stroke="currentColor" stroke-width="1"
                          stroke-linecap="round"
                          stroke-linejoin="round"/>
                </svg>
                <span>Назад</span>
            </a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h5>Добавить новый СИЗ</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="category" class="form-label">Категория</label>
                        <select name="category" id="itemCategoryId" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="professionName" class="form-label">Наименование СИЗ</label>
                        <input autocomplete="off" type="text" class="form-control" id="itemName"
                               placeholder="Введите наименование СИЗ" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea type="text" name="itemDescription" class="form-control" id="itemDescription"
                                  placeholder="Введите название СИЗ"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Торговое наименование</label>
                        <input autocomplete="off" type="text" class="form-control" name="brand" id="itemBrand"
                               placeholder="Введите торговое наименование">
                    </div>

                    <div class="mb-3">
                        <label for="model" class="form-label">Модель, артикул</label>
                        <input autocomplete="off" type="text" class="form-control" name="model" id="itemModel"
                               placeholder="Введите название СИЗ">
                    </div>

                    <div class="mb-3">
                        <label for="model" class="form-label">Основание выдачи СИЗ</label>
                        <input autocomplete="off" type="text" class="form-control" name="normClause" id="normClause"
                               placeholder="П. 165">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Добавить СИЗ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{url('assets/js/plugins/jquery.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/custom/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/apps/items/create.js')}}"></script>

</body>
</html>
