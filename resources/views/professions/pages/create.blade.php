<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{url('assets/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/custom/sweetalerts.css')}}">
</head>

<style>
    .mxw {
        max-width: 540px;
        word-break: break-word;
        white-space: pre-wrap;
    }
</style>

<body>
@include('includes.header')

<div class="container">
    <div class="row">
        <div class="d-flex justify-content-start">
            <a href="{{route('professions.index')}}"
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
                    <h5>Добавить новую профессию</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="professionName" class="form-label">Название профессии</label>
                        <input autocomplete="off" type="search" class="form-control" id="name"
                               placeholder="Введите название профессии" required>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label mt-3">Доступные СИЗ</label>
                        </div>
                        <ul class="list-group" style="max-height: 400px; overflow-y: auto;" id="available-siz">
                            @if(!$items->isEmpty())
                                @foreach($items as $item)
                                    @include('professions.components.item',['item' => $item])
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Выбранные СИЗ</label>
                        <ul class="list-group" id="selected-siz">
                            <!-- Добавленные элементы появятся здесь -->
                        </ul>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Добавить профессию</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{url('assets/js/plugins/jquery.js')}}"></script>
<script src="{{url('assets/js/plugins/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/custom/sweetalerts.js')}}"></script>
<script src="{{url('assets/js/apps/professions/utils.js')}}"></script>
<script src="{{url('assets/js/apps/professions/create.js')}}"></script>
</body>
</html>
