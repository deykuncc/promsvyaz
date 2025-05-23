<tr data-item-name="{{$item->item->name}}" data-item-has-id="{{$item->item->id}}">
    <td>{{$item->item->name}}</td>
    <td>{{$item?->brand?->name}}</td>
    <td>
        {{ "{$item->quantity} {$item->quantity_type}" }}
    </td>
    @php
        $expiryDate = $item->expiry_date;
        if ($expiryDate == null && !$item->usage_months){
            $expiryDate = "До износа";
        }else if($expiryDate == null && $item->usage_months && !$item->issued_date){
            $expiryDate = "Поставьте дату получения";
        }else if($expiryDate != null && $item->usage_months){
            $expiryDate = "{$item->usage_months} Месяцев";
        }else{
            $expiryDate = "Поставьте дату получения";
        }
    @endphp

    <td>
        {{$expiryDate}}
    </td>
    <td>
        {{\Carbon\Carbon::parse($item->issued_date)->format('d.m.Y')}}
    </td>
    <td>
        {{$item->size == null ? 'Без размера' : $item->size->size}}
    </td>
    <td>
        <span
            data-action="destroyHas"
            title="Удалить"
            class="ico-hover" style="cursor:pointer;">
                <svg style="color: #ff1616" width="21px" height="21px"
                     viewBox="0 0 1024 1024"
                     class="icon"
                     version="1.1"
                     xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M905.92 237.76a32 32 0 0 0-52.48 36.48A416 416 0 1 1 96 512a418.56 418.56 0 0 1 297.28-398.72 32 32 0 1 0-18.24-61.44A480 480 0 1 0 992 512a477.12 477.12 0 0 0-86.08-274.24z"
                    fill="currentColor"/>
                <path
                    d="M630.72 113.28A413.76 413.76 0 0 1 768 185.28a32 32 0 0 0 39.68-50.24 476.8 476.8 0 0 0-160-83.2 32 32 0 0 0-18.24 61.44zM489.28 86.72a36.8 36.8 0 0 0 10.56 6.72 30.08 30.08 0 0 0 24.32 0 37.12 37.12 0 0 0 10.56-6.72A32 32 0 0 0 544 64a33.6 33.6 0 0 0-9.28-22.72A32 32 0 0 0 505.6 32a20.8 20.8 0 0 0-5.76 1.92 23.68 23.68 0 0 0-5.76 2.88l-4.8 3.84a32 32 0 0 0-6.72 10.56A32 32 0 0 0 480 64a32 32 0 0 0 2.56 12.16 37.12 37.12 0 0 0 6.72 10.56zM726.72 297.28a32 32 0 0 0-45.12 0l-169.6 169.6-169.28-169.6A32 32 0 0 0 297.6 342.4l169.28 169.6-169.6 169.28a32 32 0 1 0 45.12 45.12l169.6-169.28 169.28 169.28a32 32 0 0 0 45.12-45.12L557.12 512l169.28-169.28a32 32 0 0 0 0.32-45.44z"
                    fill="currentColor"/>
                </svg>
        </span>
    </td>
</tr>
