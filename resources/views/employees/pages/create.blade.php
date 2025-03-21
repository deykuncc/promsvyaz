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
    <div class="row mt-4">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h5>Добавить сотрудника</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Фамилия</label>
                        <input type="search" class="form-control" id="lastName"
                               placeholder="Иванов" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Имя</label>
                        <input autocomplete="off" type="search" class="form-control" id="firstName"
                               placeholder="Иван" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Отчество</label>
                        <input autocomplete="off" type="search" class="form-control" id="middleName"
                               placeholder="Иванович">
                    </div>

                    <div class="mb-3">
                        <label for="professionName" class="form-label">Табельный номер</label>
                        <input autocomplete="off" type="search" class="form-control" id="externalId"
                               placeholder="Табельный номер" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Пол</label>
                        <select id="gender" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($genders as $gender)
                                <option value="{{$gender->id}}">{{$gender->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="startDate" class="form-label">Дата поступления на работу</label>
                        <input autocomplete="off" class="form-control" type="search"
                               placeholder="25.12.2000" id="startDate">
                    </div>

                    <div class="mb-3">
                        <label for="height" class="form-label">Рост</label>
                        <select id="height" class="form-select">
                            <option selected>Выбрать</option>
                            @for($i = 135; $i <= 220; $i++)
                                <option value="{{$i}}">{{$i}} см.</option>
                            @endfor
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sizeClothes" class="form-label">Размер одежды</label>
                        <select id="sizeClothes" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($clothesSizes as $size)
                                <option value="{{$size->id}}">{{$size->size}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sizeShoes" class="form-label">Размер обуви</label>
                        <select id="sizeShoes" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($shoesSizes as $size)
                                <option value="{{$size->id}}">{{$size->size}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="sizeHats" class="form-label">Размер головного убора</label>
                        <select id="sizeHats" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($hatsSizes as $size)
                                <option value="{{$size->id}}">{{$size->size}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="departmentId" class="form-label">Участок</label>
                        <select id="departmentId" class="form-select">
                            <option value="0" selected>Выбрать</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="professionId" class="form-label">Профессия</label>
                        <select id="professionId" class="form-select">
                            <option value="0" selected>Выбрать</option>
                            @foreach($professions as $profession)
                                <option value="{{$profession->id}}">{{$profession->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-7" style="display: none" id="items">
                        <label for="items" class="form-label">Список СИЗ</label>
                        <table id="items" class="table table-striped">
                            <thead class="table-dark">
                            <tr>
                                <th scope="col">Название</th>
                                <th scope="col">Количество</th>
                                <th scope="col">Срок эксплуатации</th>
                                <th scope="col">Размер</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody id="itemsProfession">

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            <button type="button" data-action="addItem" class="btn btn-dark">Добавить СИЗ</button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Добавить Сотрудника</button>
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
<script src="{{url('assets/js/apps/employees/utils.js')}}"></script>
<script src="{{url('assets/js/apps/employees/create.js')}}"></script>

</body>
</html>
