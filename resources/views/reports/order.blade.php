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
            font-size: 22px;
            font-weight: 600;
        }

        h3 {
            font-size: 22px;
            font-weight: 600;
            letter-spacing: 7px;
            line-height: 30px;
        }

        .d-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .max-100 {
            max-width: 100%;
            max-height: 100%;
            width: 100%;
            height: 100%;
        }

        .img {
            width: 220px;
            height: 120px;
        }

        .text-center {
            text-align: center;
        }

        .b-text {
            font-size: 26px;
        }

        .info-company {
            border-top: 1px solid black;
            padding: 5px;
            border-bottom: 2px solid black;
        }

        .d-flex-1 {
            justify-content: space-between;
            display: flex;
        }

        .addon-info {
            display: flex;
            justify-content: space-between;
        }

        .flex {
            display: flex;
        }

        .addon-info {
            margin-top: 3px;
            border-top: 2px solid black;
            padding-top: 20px;
            padding-bottom: 5px;
            border-bottom: 1px solid black;
        }

        .col {
            display: flex;
            flex-direction: column;
        }

        .title-order {
            text-align: center;
            margin-top: 20px;
        }

        h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .undertitle-order {
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        footer {
            margin-top: 25px;
        }

        .col-gap {
            display: flex;
            gap: 18px;
            flex-direction: column;
        }

        .flex-space-between {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
<div>
    <div style="margin: 15px 0;" class="center">
        <button class="btn">Распечатать заявку</button>
    </div>
    <div id="printable" class="container">
        <div class="d-flex">
            <div class="img">
                <img class="max-100" src="{{url('assets/img/logo.jpeg')}}"/>
            </div>
            <div class="text-center">
                <h3>
                    Акционерное Общество
                    <br>
                    Навлинский завод
                    <br>
                    <span class="b-text">"Промсвязь"</span>
                </h3>
            </div>
        </div>

        <div class="info-company">
            <div class="d-flex-1">
                <ul>
                    <li>Россия, 242130, Брянская обл., пос. Навля</li>
                    <li>Ул. Комсомольская, 1</li>
                    <li>Телефон: (48342) 2-20-83</li>
                    <li>Тел/факс: (48342) 2-24-33</li>
                    <li>E-mail: promsvyaz1999@mail.ru</li>
                    <li>WWW.promsvyaz32.ru</li>
                </ul>
                <ul>
                    <li>р/c 40702810308130100135</li>
                    <li>в Отделении №8605 Сбербанка России г.Брянск</li>
                    <li>к/с 30101810300000000601</li>
                    <li>БИК 041501601</li>
                    <div class="d-flex-1">
                        <div>
                            <ul>
                                <li>ИНН 3221002080</li>
                                <li>ОКПО 01132784</li>
                                <li>ОКВЭД 29.20</li>
                            </ul>
                        </div>
                        <div>
                            <ul>
                                <li>КПП 324501001</li>
                                <li>ОКОНХ 14971</li>
                                <li>ОГРН 1023202536411</li>
                                <li>ОКМТО 15638151</li>
                            </ul>
                        </div>
                    </div>
                </ul>
            </div>
        </div>

        <div class="addon-info">
            <div class="flex">
                <span style="min-width: 200px;">Исх. №</span>
                <span>от «&nbsp;&nbsp;&nbsp;» {!! $date !!}&nbsp;г.</span>
            </div>

            <div style="min-width: 285px;" class="col">
                <span style="text-align: right">Директору торгового представительства</span>
                <span style="text-align: left">АО «ТД ТРАКТ» в г. Орел Бокову О.Д.</span>
            </div>
        </div>

        <div class="title-order">
            <h2>ЗАЯВКА</h2>
            <p class="undertitle-order">На приобретение спецодежды и СИЗ для сотрудников АО «Навлинский завод
                «Промсвязь»</p>
        </div>

        <div style="padding: 0 2px;">
            <table>
                <thead>
                <tr>
                    <th>№</th>
                    <th>Наименование СИЗ</th>
                    <th>Размер</th>
                    <th>Количество</th>
                    <th>Название участка</th>
                </tr>
                </thead>
                <tbody>
                @php $count = 1 @endphp
                @foreach ($sizData as $siz)
                    @php $rowspan = count($siz['sizes']) @endphp
                    @foreach ($siz['sizes'] as $index => $size)
                        <tr>
                            @if ($index == 0)
                                <td rowspan="{{ $rowspan }}">{{ $count }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $siz['name'] }}</td>
                                <td>{{ $size['size'] }}</td>
                                <td>{{ $size['count'] }}</td>
                                <td rowspan="{{ $rowspan }}">{{ $siz['department'] }}</td>
                            @else
                                <td>{{ $size['size'] }}</td>
                                <td>{{ $size['count'] }}</td>
                            @endif
                        </tr>
                    @endforeach
                    @php $count++ @endphp
                @endforeach
                </tbody>
            </table>
        </div>

        <footer class="col-gap">
            <div>
                <p>Оплату гарантируем.</p>
            </div>
            <div class="col-gap">
                <div class="flex-space-between">
                    <span>Генеральный директор</span>
                    <span>М.А. Синотин</span>
                </div>
                <div class="flex-space-between">
                    <span>Гл. бухгалтер</span>
                    <span>А.В. Будаева</span>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="{{url("assets/js/plugins/jquery.js")}}"></script>
<script src="{{url("assets/js/apps/reports/util.js")}}"></script>
</body>
</html>
