<li class="mt-2 list-group-item d-flex justify-content-between align-items-center">
    <div>
        <span>{{$item->name}}</span>
        <span class="fs-7 text-secondary">&nbsp; {{$item->brand != null ? "($item->brand)" : ''}}</span>
    </div>
    <button
        item-name="{{$item->name}}"
        item-id="{{$item->id}}"
        type="button"
        class="btn btn-sm {{empty($remove) ? 'add-siz btn-outline-primary' : 'remove-siz btn-outline-danger'}}">
        {{empty($remove) ? 'Добавить' : "Удалить"}}
    </button>
</li>
