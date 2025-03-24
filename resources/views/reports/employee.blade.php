<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/table.css')}}">
    <title>{{$title}}</title>
    <style>
        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .d-flex {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .col {
            display: flex;
            flex-direction: column;
            gap: 8px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
        }

        h3 {
            font-size: 15px;
            font-weight: 600;
        }

        .flex {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .col-c {
            display: flex;
            flex-direction: column;
        }

        .margin-t-35 {
            margin-top: 35px;
        }

        .flex-col {
            display: flex;
            align-items: flex-end;
        }

        .col-name {
            min-width: 100px;
            margin-right: 15px;
        }

        .enter-data {
            padding-bottom: 10px;
            border-bottom: 1px solid black;
            padding: 0 35px;
            min-width: 70px;
        }

        .item-col + .item-col {
            margin-top: 15px;
        }

        .col-c + .col-c {
            margin-left: 10px;
        }

        .margin-t-15 {
            margin-top: 15px;
        }
    </style>
</head>
<body>
<div>
    <div style="margin: 15px 0;" class="center">
        <button class="btn">Распечатать отчет</button>
    </div>
    <div id="printable" class="container">
        <div class="d-flex">
            <div class="col">
                <h1>Личная карточка №{{$employee->external_id}}</h1>
                <h3>{{$description}}</h3>
            </div>
        </div>

        <div class="flex margin-t-35">
            <ul class="col-c">
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Фамилия</div>
                        <div class="enter-data">
                            <span>{{$employee->last_name}}</span>
                        </div>
                    </div>
                </li>

                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Имя</div>
                        <div class="enter-data">
                            <span>{{$employee->first_name}}</span>
                        </div>
                    </div>
                </li>

                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Отчество</div>
                        <div class="enter-data">
                            <span>{{$employee->middle_name}}</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Табельный номер</div>
                        <div class="enter-data">
                            <span>{{$employee->external_id}}</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Структурное <br/>подразделение</div>
                        <div class="enter-data">
                            <span>{{$employee->department->name ?? null}}</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Профессия<br/>(должность)</div>
                        <div class="enter-data">
                            <span>{{$employee->profession->name ?? null}}</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Дата поступления<br/> на работу</div>
                        <div class="enter-data">
                            <span>{{\Carbon\Carbon::parse($employee->employment_date)->format('d.m.Y')}}г</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div style="max-width: 200px;" class="col-name">Дата изменения профессии (должности) или
                            перевода в другое структурное
                            подразделение
                        </div>
                        <div class="enter-data">
                            <span>&nbsp;</span>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="col-c">
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Пол</div>
                        <div class="enter-data">
                            <span>{{mb_substr(mb_lcfirst($employee->gender->name), 0, 1)}}</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Рост</div>
                        <div class="enter-data">
                            <span>{{$employee->height}}</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Размер одежды</div>
                        <div class="enter-data">
                            <span>{{explode(' ', $employee->clothesSize->size)[0] ?? null}}</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Размер обуви</div>
                        <div class="enter-data">
                            <span>{{$employee->shoesSize->size ?? null}}</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">Размер головного<br> убора</div>
                        <div class="enter-data">
                            <span>{{explode(' ', $employee->hatsSize->size)[0] ?? null}}</span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">СИЗОД</div>
                        <div class="enter-data">
                            <span></span>
                        </div>
                    </div>
                </li>
                <li class="item-col">
                    <div class="flex-col">
                        <div class="col-name">СИЗ РУК</div>
                        <div class="enter-data">
                            <span></span>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="margin-t-15" style="padding: 0 2px">
            <table>
                <thead>
                <tr>
                    <th>Наименование СИЗ</th>
                    <th>Пункт Норм</th>
                    <th style="max-width: 100px;">Единица измерения, периодичность выдачи измерения</th>
                    <th style="max-width: 100px;">Количество на период на год</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->item->brand}}</td>
                        <td>{{$item->item->norm_clause}}</td>
                        <td>{{$item->quantity_type}}</td>
                        <td>{{$item->quantity}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{url("assets/js/plugins/jquery.js")}}"></script>
<script src="{{url("assets/js/apps/reports/util.js")}}"></script>
</body>
</html>
