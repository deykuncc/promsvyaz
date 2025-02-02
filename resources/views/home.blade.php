<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap/reset.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">
</head>


<body>
@include('includes.header')

<div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="{{route('employees.index')}}" class="box card text-black bg-boxshadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Сотрудники</h5>
                        <p class="card-text">Всего: {{$employeesCount}}</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{route('items.index')}}" class="box card text-black bg-boxshadow mb-3">
                    <div class="card-body">
                        <h5 class="card-title">СИЗ</h5>
                        <p class="card-text">Всего: {{$itemsCount}}</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{route('used.index')}}" class="box card text-black bg-boxshadow-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Выданные СИЗ</h5>
                        <p class="card-text">Всего: {{$employeesItemsCount}}</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{route('used.index',)}}" class="box card text-black bg-boxshadow-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Просроченные СИЗ</h5>
                        <p class="card-text">Кол-во: {{$employeesItemsExpiredCount}}</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
