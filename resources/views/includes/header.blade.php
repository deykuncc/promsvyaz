<header class="p-3 mb-3 border-bottom">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{route('home')}}" class="nav-link px-2 link-secondary">Главная</a></li>
                <li><a href="{{route('employees.index')}}" class="nav-link px-2 link-body-emphasis">Сотрудники</a></li>
                <li><a href="{{route('professions.index')}}" class="nav-link px-2 link-body-emphasis">Профессии</a></li>
                <li><a href="{{route('departments.index')}}" class="nav-link px-2 link-body-emphasis">Участки</a></li>
                <li><a href="{{route('items.index')}}" class="nav-link px-2 link-body-emphasis">СИЗ</a></li>
                <li><a href="{{route('used.index')}}" class="nav-link px-2 link-body-emphasis">Выданные СИЗ</a></li>
                <li><a href="{{route('users.index')}}" class="nav-link px-2 link-body-emphasis">Персонал ПУ</a></li>
            </ul>

            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item" href="#">Настройки</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Выйти</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>
