<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{url('assets/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/custom/sweetalerts.css')}}">
</head>

<body>
@include('includes.header')
<input type="hidden" id="employeeId" value="{{$employee->id}}">
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-start">
            <a href="{{route('employees.index')}}"
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
    <div style="gap: 24px;" class="row mt-4">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h5>Личная карточка сотрудника</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Фамилия</label>
                        <input autocomplete="off" value="{{$employee->last_name}}" type="search" class="form-control"
                               id="lastName"
                               placeholder="Иванов" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Имя</label>
                        <input autocomplete="off" value="{{$employee->first_name}}" type="search" class="form-control"
                               id="firstName"
                               placeholder="Иван" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Отчество</label>
                        <input autocomplete="off" {{$employee->middle_name}} type="search" class="form-control"
                               id="middleName"
                               placeholder="Иванович">
                    </div>

                    <div class="mb-3">
                        <label for="professionName" class="form-label">Табельный номер</label>
                        <input autocomplete="off" type="number" value="{{$employee->external_id}}" class="form-control"
                               id="externalId"
                               placeholder="Табельный номер" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Пол</label>
                        <select name="gender" id="gender" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($genders as $gender)
                                <option
                                    {{$employee->gender_id === $gender->id ? "selected" : ""}} value="{{$gender->id}}">{{$gender->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="startDate" class="form-label">Дата поступления на работу</label>
                        <input data-date value="{{\Carbon\Carbon::parse($employee->employment_date)->format('d.m.Y')}}"
                               class="form-control"
                               autocomplete="off" placeholder="25.12.2000" type="search"
                               id="startDate">
                    </div>
                    <div class="mb-3">
                        <label for="height" class="form-label">Рост</label>
                        <select name="height" id="height" class="form-select">
                            <option selected>Выбрать</option>
                            @for($i = 135; $i <= 220; $i++)
                                <option {{$employee->height === $i ? "selected" : ''}} value="{{$i}}">{{$i}}см.
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sizeClothes" class="form-label">Размер одежды</label>
                        <select name="sizeClothes" id="sizeClothes" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($clothesSizes as $size)
                                <option
                                    {{$employee->clothes_size_id === $size->id ? "selected" : ''}} value="{{$size->id}}">{{$size->size}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sizeShoes" class="form-label">Размер обуви</label>
                        <select name="sizeShoes" id="sizeShoes" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($shoesSizes as $size)
                                <option
                                    {{$employee->shoes_size_id === $size->id ? "selected" : ''}} value="{{$size->id}}">{{$size->size}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sizeHats" class="form-label">Размер головного убора</label>
                        <select name="sizeHats" id="sizeHats" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($hatsSizes as $size)
                                <option
                                    {{$employee->hats_size_id === $size->id ? "selected" : ''}} value="{{$size->id}}">{{$size->size}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="departmentId" class="form-label">Участок</label>
                        <select name="departmentId" id="departmentId" class="form-select">
                            <option value="0" selected>Выбрать</option>
                            @foreach($departments as $department)
                                <option
                                    {{$employee->department_id == $department->id ? "selected" : ''}} value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="professionId" class="form-label">Профессия</label>
                        <select name="professionId" id="professionId" class="form-select">
                            <option value="0" selected>Выбрать</option>
                            @foreach($professions as $profession)
                                <option
                                    {{$employee->profession_id === $profession->id ? "selected" : ""}} value="{{$profession->id}}">{{$profession->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-end align-items-center">
                        <a href="{{route('reports.employee', ['employee' => $employee->id, 'category' => 'skin'])}}"
                           type="submit"
                           class="btn btn-secondary">Распечатать дерматологические СИЗ</a>
                        <a href="{{route('reports.employee', ['employee' => $employee->id, 'category'=> 'clothes'])}}"
                           type="submit"
                           class="ms-3 btn btn-secondary">Распечатать одежду СИЗ</a>
                        <a href="{{route('reports.employee-back', ['employee' => $employee->id])}}"
                           type="submit"
                           class="ms-3 btn btn-secondary">Распечатать оборотную сторону</a>
                    </div>
                    <div class="" style="display:flex; flex-direction: row; justify-content: center; margin-top: 18px;">
                        <button type="submit" action="saveProfile" class="ms-3 btn btn-primary">Сохранить изменения
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h5>Список выданных СИЗ</h5>
                </div>
                <div class="card-body">
                    <div class="mb-7" id="items">
                        <table id="items" class="table table-striped">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Количество</th>
                                <th scope="col">Срок эксплуатации</th>
                                <th scope="col">Дата получения</th>
                                <th scope="col">Размер</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody id="itemsProfession">
                            @foreach($items as $item)
                                @include('employees.components.item', ['item'=>$item])
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <button type="button" data-action="addItem" class="btn btn-dark">Добавить СИЗ</button>
                            <button type="button" data-action="saveNewItems" class="ms-2 btn btn-primary">Сохранить
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script src="{{url('assets/js/plugins/jquery.js')}}"></script>
<script src="{{url('assets/js/plugins/jquery-ui.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/custom/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/apps/employees/edit.js')}}"></script>
<script src="{{url('assets/js/apps/employees/utils.js')}}"></script>
<script src="{{url('assets/js/apps/utils/utils.js')}}"></script>

</body>
</html>
