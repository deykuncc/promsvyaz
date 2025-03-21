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

<input type="hidden" value="{{$department->id}}" id="departmentId">
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-start">
            <a href="{{route('departments.index')}}"
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
                    <h5>Редактировать участок</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="professionName" class="form-label">Название участка</label>
                        <input autocomplete="off" value="{{$department->name}}" type="search" class="form-control" id="name"
                               placeholder="Введите название участка" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Обновить участок</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('assets/js/plugins/jquery.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/custom/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/apps/departments/edit.js')}}"></script>
</body>
</html>
