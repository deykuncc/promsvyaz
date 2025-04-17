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
            text-align: right;
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

        .rotate-90 {
            transform: rotate(-90deg);
            font-size: 11px;
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
            <div class="col" style="width: 100%">
                <p>Оборотная сторона личной карточки</p>
            </div>
        </div>

        <div class="margin-t-15" style="padding: 0 2px">
            <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse; width: 100%;">
                <thead>
                <tr>
                    <th rowspan="3" style="width: 30%;">Наименование СИЗ</th>
                    <th rowspan="3" style="width: 20%;">Модель, марка, артикул, класс защиты СИЗ, дерматологических
                        СИЗ
                    </th>
                    <th colspan="4">ВЫДАНО</th>
                    <th colspan="4">ВОЗВРАЩЕНО**</th>
                </tr>
                <tr>
                    <th rowspan="2" class="rotate-90">Дата</th>
                    <th rowspan="2" class="rotate-90">Количество</th>
                    <th rowspan="2" class="rotate-90">Лично / дозатор*</th>
                    <th rowspan="2" class="rotate-90">Подпись получившего СИЗ</th>
                    <th rowspan="2" class="rotate-90">Дата</th>
                    <th rowspan="2" class="rotate-90">Количество</th>
                    <th rowspan="2" class="rotate-90">Подпись сдавшего СИЗ</th>
                    <th>АКТ Списания</th>
                </tr>
                <tr>
                    <th>(дата, номер)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->item->name}}</td>
                        <td>{{ implode(',',array_filter([$item?->brand?->model, $item?->brand?->article, $item?->brand?->name, $item?->brand?->description],fn($val)=> $val != null))  }}</td>
                        <td>{{$item->issued_date != null ? \Carbon\Carbon::parse($item->issued_date)->format('d.m.Y') : null  }}</td>
                        <td>{{$item->quantity}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex" style="margin-top: 14px;">
            <div class="col" style="width: 100%; text-align: left">
                <p>* - информация указывается только для дерматологических СИЗ</p>
                <p>** - информация указывается для всех СИЗ, кроме дерматологических СИЗ и СИЗ однократного
                    применения</p>
            </div>
        </div>
    </div>
</div>
<script src="{{url("assets/js/plugins/jquery.js")}}"></script>
<script src="{{url("assets/js/apps/reports/util.js")}}"></script>
</body>
</html>
