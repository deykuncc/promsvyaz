<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{url('assets/css/reset.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/table.css')}}">

    <style>
        h3 {
            font-size: 1.3em;
            font-weight: 600;
        }
    </style>
</head>
<body>
<div style="margin-top: 15px;" class="center">
    <button class="btn">Распечатать отчет</button>
</div>
<div style="margin-top: 25px;" id="printable">
    <div>
        <div class="center">
            <h3>ПАО «Навлинский завод «Промсвязь»»</h3>
            <h3 style="margin-top: 12px;">ВЕДОМОСТЬ <span>№{{$_GET['id'] ?? null}}</span> от <span>{{$_GET['date'] ?? null}}</span></h3>
        </div>
    </div>
    <table style="margin-top: 15px;">
        <thead>
        <tr>
            <th>№ п/п</th>
            <th>Участок</th>
            <th>Должность, специальность</th>
            <th>ФИО</th>
            <th>Наименование СИЗ</th>
            <th>Размер</th>
            <th>Дата выдачи</th>
            <th>Подпись</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($rows as $index => $row)
            @foreach ($row->items as $key => $item)
                <tr>
                    @if ($key == 0)
                        <td rowspan="{{ count($row->items) }}">{{ $index + 1 }}</td>
                        <td rowspan="{{ count($row->items) }}">{{ $row->department->name ?? 'Не указан' }}</td>
                        <td rowspan="{{ count($row->items) }}">{{ $row->profession->name ?? 'Не указан' }}</td>
                        <td rowspan="{{ count($row->items) }}">{{ $row->name() }}</td>
                    @endif
                    <td>{{ $item->item->name }}</td>
                    <td>{{ $item->size->size ?? null }}</td>
                    <td>{{ $item->issued_date != null ?  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->issued_date)->format('d.m.Y') : null }}</td>
                    <td></td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>
</div>
</body>

<script src="{{url("assets/js/plugins/jquery.js")}}"></script>
<script src="{{url("assets/js/apps/reports/util.js")}}"></script>
</html>
