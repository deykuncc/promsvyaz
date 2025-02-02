<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{url('assets/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/custom/sweetalerts.css')}}">
</head>
<body>

<div class="d-flex justify-content-center align-items-center vh-100"
     style="background-color: hsl(0, 0%, 96%)">
    <div class="container">
        <div class="row gx-lg-5 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="my-5 display-3 fw-bold ls-tight">
                    Промсвязь <br/>
                    <span class="text-primary">Учет СИЗ</span>
                </h1>
                <p style="color: hsl(217, 10%, 50.8%)">
                    Добро пожаловать на сайт учета средств индивидуальной защиты (СИЗ) завода "Промсвязь". Здесь вы
                    можете отслеживать сроки использования СИЗ сотрудников, контролировать остатки, а также планировать
                    и оформлять заказы на новые средства защиты. Для доступа к системе войдите с использованием ваших
                    учетных данных.
                </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card">
                    <div class="card-body py-5 px-md-5">
                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="login">Логин</label>
                            <input autocomplete="off" type="text" id="login" class="form-control"/>
                        </div>


                        <div data-mdb-input-init class="form-outline mb-4">
                            <label class="form-label" for="password">Пароль</label>
                            <input autocomplete="off" type="password" id="password" class="form-control"/>
                        </div>


                        <button type="submit"
                                class="w-100 btn btn-primary btn-block mb-4">
                            Войти в аккаунт
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('assets/js/plugins/jquery.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/custom/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/auth/auth.js')}}"></script>
</body>
</html>
