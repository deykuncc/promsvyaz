<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{url('assets/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap/bootstrap.css')}}">
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
    <input type="hidden" value="{{$item->id}}" id="itemId">
    <div class="row mt-4">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h5>Редактировать СИЗ</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="category" class="form-label">Категория</label>
                        <select name="category" id="itemCategoryId" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($categories as $category)
                                <option
                                    {{$item->category_id == $category->id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="professionName" class="form-label">Наименование СИЗ</label>
                        <input autocomplete="off" type="search" class="form-control" value="{{$item->name}}"
                               id="itemName"
                               placeholder="Введите наименование СИЗ" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Эксплуатационные характеристики</label>
                        <textarea type="search" name="description" class="form-control"
                                  id="itemDescription"
                                  placeholder="Введите эксплуатационные характеристики СИЗ">{{$item->description}}</textarea>
                    </div>

                    <div class="mb-3" data-brand>
                        <div class="d-grid" style="grid-template-columns: auto auto 165px;">
                            <span class="form-label">Торговое наименование</span>
                            <span class="form-label">Модель</span>
                            <span class="form-label">Артикул</span>
                        </div>
                        @if(!$item->brands->isEmpty())
                            @foreach($item->brands as $key => $brand)
                                <div class="mb-3 d-flex justify-content-between" brand-id="{{$brand->id}}">
                                    <input autocomplete="off" value="{{$brand->name}}" type="search"
                                           class="form-control w-25"
                                           placeholder="Введите торговое наименование" data-brand-value>
                                    <input autocomplete="off" value="{{$brand->model}}" type="search"
                                           class="form-control w-25"
                                           placeholder="Введите модель" data-model-value>
                                    <input autocomplete="off" value="{{$brand->article}}" type="search"
                                           class="form-control w-25"
                                           placeholder="Введите артикул" data-article-value>
                                </div>
                                @if($item->brands->count() == ($key + 1))
                                    <div class="d-flex justify-content-center">
                                        <button data-action="newBrand" type="button"
                                                class="btn btn-primary d-flex align-items-center">
                                            <span class="me-2">Добавить</span>
                                            <svg width="18px" height="18px" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 12H20M12 4V20" stroke="#fff" stroke-width="2"
                                                      stroke-linecap="round"
                                                      stroke-linejoin="round"></path>
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="mb-3 d-flex gap-2">
                                <input autocomplete="off" type="search"
                                       class="form-control"
                                       data-brand-value
                                       placeholder="Введите торговое наименование">
                                <button data-action="newBrand" type="button"
                                        class="btn btn-primary d-flex align-items-center">
                                    <svg class="me-1" width="18px" height="18px" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4 12H20M12 4V20" stroke="#fff" stroke-width="2"
                                              stroke-linecap="round"
                                              stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="model" class="form-label">Основание выдачи СИЗ</label>
                        <input autocomplete="off" value="{{$item->norm_clause}}" type="search" class="form-control"
                               name="normClause"
                               id="normClause"
                               placeholder="П. 165">
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Обновить СИЗ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{url('assets/js/plugins/jquery.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/custom/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/apps/items/edit.js')}}"></script>
<script src="{{url('assets/js/apps/items/utils.js')}}"></script>

</body>
</html>
