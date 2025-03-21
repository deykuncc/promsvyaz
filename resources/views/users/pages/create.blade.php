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
            <a href="{{route('users.index')}}"
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
                    <h5>Добавить нового сотрудника</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Фамилия</label>
                        <input autocomplete="off" type="search" class="form-control" id="lastName"
                               placeholder="Иванов" required>
                    </div>

                    <div class="mb-3">
                        <label for="firstName" class="form-label">Имя</label>
                        <input autocomplete="off" type="search" class="form-control" id="firstName"
                               placeholder="Иван" required>
                    </div>

                    <div class="mb-3">
                        <label for="middleName" class="form-label">Отчество</label>
                        <input autocomplete="off" type="search" class="form-control" id="middleName"
                               placeholder="Иванович">
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Логин</label>
                        <input autocomplete="off" type="search" class="form-control" name="brand" id="login"
                               placeholder="Ivanov">
                    </div>

                    <div class="mb-3">
                        <label for="model" class="form-label">Пароль</label>
                        <input autocomplete="off" type="search" class="form-control" name="model" id="password"
                               placeholder="Qwerty61">
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Должность</label>
                        <select name="category" id="role" class="form-select">
                            <option selected>Выбрать</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Добавить сотрудника</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{url('assets/js/plugins/jquery.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/custom/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/apps/users/create.js')}}"></script>

</body>
</html>
