<div class="modal fade" id="editItem" tabindex="-1" aria-labelledby="editItemLabel"
     aria-hidden="true">
    <input type="hidden" id="usedId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemLabel">Редактировать СИЗ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Заполните новые данные для&nbsp;<span class="text-primary" data-target-item-name></span>
                <div class="col mt-3">
                    <label for="untilAtDays" class="text-secondary">Дата получения</label>
                    <input autocomplete="off" autocapitalize="off" id="issuedDate" type="text"
                           value="" class="form-control"
                           placeholder="25.12.2000">
                </div>
                <div class="col mt-3">
                    <label for="untilAtDays" class="text-secondary">Срок эксплуатации</label>
                    <input autocomplete="off" autocapitalize="off" id="usageMonths" type="text"
                           value="" class="form-control"
                           placeholder="25.12.2000">
                </div>
                <div class="col mt-3 d-flex align-items-center">
                    <label for="offUntilAt" class="text-secondary">До износа</label>
                    <input autocomplete="off" class="ms-2" id="offExpiryDate" type="checkbox">
                </div>
                <div class="col mt-3 d-flex align-items-center">
                    <label for="isActive" class="text-secondary">Актуально</label>
                    <input autocomplete="off" class="ms-2" id="isActive" type="checkbox">
                </div>
                <div class="col mt-2">
                    <label for="days" class="text-secondary">Размер</label>
                    <div class="d-flex">
                        <select id="sizeType" class="form-select">
                            <option value="" selected>Выбрать</option>
                            @foreach($sizeTypes as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                        <select id="sizeId" class="form-select">
                            <option selected value="">Выбрать</option>
                            @foreach($sizes as $size)
                                <option data-size-option style="display: none" type="{{$size->typeOrig()}}"
                                        value="{{$size->id}}">{{$size->size}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" data-action="update" data-bs-dismiss="modal" class="btn btn-primary">Сохранить
                </button>
            </div>
        </div>
    </div>
</div>
