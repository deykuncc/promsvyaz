<li class="mt-2 list-group-item d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center w-75 justify-content-between">
        <div class="d-flex flex-column mxw">
            <span>{{$item->name}}</span>
            <span class="text-secondary">{{$item->brand}}</span>
        </div>
        @if(!empty($remove) && $remove === true)
            <div class="d-flex flex-column">
                <span class="text-secondary fs-7">Срок эксплуатации</span>
                <div class="d-flex align-items-center gap-1">
                    @if($professionItem->expiry_months != null)
                        <span>{{$professionItem->expiry_months}}</span>
                    @endif
                    <span>{{$professionItem->expiry_months != null ? 'Месяцев' : 'Бессрочно'}}</span>
                </div>
            </div>
            @if($item->category->name_eng === 'clear')
                <div class="d-flex flex-column">
                    <span class="text-secondary fs-7">Количество</span>
                    <div class="d-flex align-items-center gap-1">
                        <span>{{$professionItem->quantity}}</span>
                        <span>{{$professionItem->quantity_type}}</span>
                    </div>
                </div>
            @endif
        @endif
    </div>

    <button
        item-brand="{{$item->brand ?? ''}}"
        item-name="{{$item->name}}"
        item-id="{{$item->id}}"
        category-name="{{$item->category->name_eng}}"
        {{ !empty($professionItem) && $professionItem->item_id == $item->id ? 'has' : ''}}
        type="button"
        class="btn btn-sm {{empty($remove) ? 'add-siz btn-outline-primary' : 'remove-siz btn-outline-danger'}}">
        {{empty($remove) ? 'Добавить' : "Удалить"}}
    </button>
</li>
