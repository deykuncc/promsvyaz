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

<style>
    .title__header {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        padding: 10px 20px;
        border-bottom: 1px solid #ccc;
        box-sizing: border-box;
    }

    .title__header__content {
        display: grid;
        flex-grow: 1;
        grid-template-columns: 1fr;
    }

    .title__header__main__text {
        display: flex;
        align-items: center;
        color: black;
        font-weight: 700;
        font-size: 24px;
        line-height: 28px;
    }


    .filters__block {
        display: block;
        box-sizing: border-box;
        border-bottom: 1px solid #eaeaea;
    }

    .filters__content {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 15px 5px;
    }

    .ico-hover {
        transition: .2s;
    }

    .ico-hover:hover {
        opacity: 0.6;
    }


</style>

<div>
    @include('employees.components.deleteModal')

    <div class="container">

        <div class="title__header__block">
            <div class="title__header">
                <div class="title__header__content">
                    <div class="title__header__main__text">
                        <div>Список сотрудников</div>
                    </div>
                </div>

                <div class="btn-addon">
                    <a href="{{route('employees.create')}}" type="button"
                       class="btn btn-primary d-flex align-items-center">
                        <svg class="me-1" width="18px" height="18px" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 12H20M12 4V20" stroke="#fff" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                        </svg>
                        <span>Добавить сотрудника</span>
                    </a>
                </div>
            </div>
            <div class="filters__block">
                <form autocomplete="off" method="GET">
                    <div class="filters__content">
                        @include('employees.components.filter', ['professions' => $professions, 'departments' => $departments, 'genders' => $genders])

                        <div class="btn-addon">
                            <button href="#" type="submit" class="btn btn-primary d-flex align-items-center">
                                <svg class="me-1" width="21px" height="21px" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M15 10.5C15 12.9853 12.9853 15 10.5 15C8.01472 15 6 12.9853 6 10.5C6 8.01472 8.01472 6 10.5 6C12.9853 6 15 8.01472 15 10.5ZM14.1793 15.2399C13.1632 16.0297 11.8865 16.5 10.5 16.5C7.18629 16.5 4.5 13.8137 4.5 10.5C4.5 7.18629 7.18629 4.5 10.5 4.5C13.8137 4.5 16.5 7.18629 16.5 10.5C16.5 11.8865 16.0297 13.1632 15.2399 14.1792L20.0304 18.9697L18.9697 20.0303L14.1793 15.2399Z"
                                          fill="#fff"/>
                                </svg>
                                <span>Найти</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
            @include('includes.table-rows',['rows'=>['#', 'ФИО', 'Профессия', 'Подразделение', 'Пол', 'Действия']])
            </thead>
            <tbody>
            @if(!$employees->isEmpty())
                @foreach($employees as $employee)
                    @include('employees.components.employee', ['employee'=>$employee])
                @endforeach
            @endif
            </tbody>
        </table>
        {!! $employees->links() !!}
    </div>
</div>
<script src="{{url('assets/js/plugins/bootstrap.bundle.js')}}"></script>
<script src="{{url('assets/js/plugins/jquery.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/custom/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/apps/employees/index.js')}}"></script>
</body>
</html>
