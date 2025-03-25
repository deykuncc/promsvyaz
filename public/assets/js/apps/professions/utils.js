$(document).ready(function () {
    $("body").on('click', '.add-siz', function () {
        let element = $(this).parent();
        element.remove();
        let itemName = $(this).attr('item-name');
        let itemBrand = $(this).attr('item-brand');
        let itemId = $(this).attr('item-id');
        let $newItem = $('<li></li>').addClass('list-group-item d-flex justify-content-between align-items-center').attr('item-name', itemName);
        $newItem.append(`
         <div class="d-flex align-items-center w-75 justify-content-between">
            <div class="d-flex flex-column mxw">
                <span>${itemName}</span>
                <span class="text-secondary">${itemBrand}</span>
            </div>
            <div class="d-flex flex-column">
                 <span class="text-secondary fs-7">Срок эксплуатации</span>
                <div class="d-flex align-items-center gap-1">
                       <input  style="display: none; max-width: 60px;" data-expiry-value type="search" class="form-control"/>
                       <select data-select-expiry class="form-select">
                            <option value="">Выберите</option>
                            <option value="unlimited">Бессрочно</option>
                            <option value="months">В месяцах</option>
                        </select>
                  </div>
            </div>
         </div>
        `)
        let $removeButton = $("<button></button>").addClass('btn btn-sm btn-outline-danger remove-siz');
        $removeButton.attr('item-name', itemName);
        $removeButton.attr('item-id', itemId);
        $removeButton.text('Удалить');
        $("#selected-siz").append($newItem);
        $newItem.append($removeButton);

    });

    $('body').on('click', '.remove-siz', function () {
        let element = $(this).parent();
        element.remove();
        let itemName = $(this).attr('item-name');
        let itemId = $(this).attr('item-id');
        let $newItem = $('<li></li>').addClass('list-group-item d-flex justify-content-between align-items-center');
        $newItem.text(itemName);
        let $removeButton = $("<button></button>").addClass('btn btn-sm btn-outline-primary add-siz');
        $removeButton.attr('item-name', itemName);
        $removeButton.attr('item-id', itemId);
        $removeButton.text('Добавить');
        $("#available-siz").append($newItem);
        $newItem.append($removeButton);
    });

    $("body").on('click', '[data-select-expiry]', function () {
        let li = $(this).parents('li');
        if ($(this).val() === 'unlimited') {
            $(this).siblings('input').hide();
            li.removeAttr('expiry-value');
        } else if ($(this).val() === 'months') {
            $(this).siblings('input').show();
            $(this).siblings('input').val('');
            li.attr('expiry-value', 0);
        }

        li.attr('expiry-type', $(this).val());
    });

    $('body').on('input', '[data-expiry-value]', function () {
        $(this).parents('li').attr('expiry-value', $(this).val());
    });

});
