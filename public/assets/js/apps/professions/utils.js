$(document).ready(function () {
    $("body").on('click', '.add-siz', function () {
        let element = $(this).parent();
        element.remove();
        let itemName = $(this).attr('item-name');
        let itemBrands = JSON.parse($(this).attr('item-brands'));
        let itemId = $(this).attr('item-id');
        let category = $(this).attr('category-name');

        console.info(itemBrands);

        let $newItem = $('<li></li>')
            .addClass('list-group-item d-flex justify-content-between align-items-center')
            .attr('item-name', itemName)
            .attr('category-name', category);

        let additionalBlock = category === 'clear' ? `
            <div class="d-flex flex-column">
                <span class="text-secondary fs-7">Количество</span>
                <div class="d-flex align-items-center gap-1">
                    <input style="display: none; max-width: 60px;" data-condition-value type="search" class="form-control"/>
                    <select data-select-condition class="form-select">
                        <option value="">Выберите</option>
                        <option value="1">Шт</option>
                        <option value="3">Мл</option>
                        <option value="4">Гр</option>
                    </select>
                </div>
            </div>` : '';

        let brands = "";
        for (let x in itemBrands) {
            brands += `<option value="${itemBrands[x]['id']}">${itemBrands[x]['name']}</option>`;
        }

        $newItem.append(`
            <div class="d-flex align-items-center w-75 justify-content-between">
                <div class="d-flex flex-column mxw">
                    <span>${itemName}</span>
                    <div style="margin-top: 10px;" class="d-flex flex-column">
                        <span class="text-secondary fs-7">Торговое наименование</span>
                        <div class="d-flex align-items-center gap-1">
                            <input style="display: none; max-width: 60px;" data-expiry-value type="search" class="form-control"/>
                            <select data-select-brand class="form-select">
                                <option value="">Выберите</option>
                                ${brands}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <span class="text-secondary fs-7">Срок эксплуатации</span>
                    <div class="d-flex align-items-center gap-1">
                        <input style="display: none; max-width: 60px;" data-expiry-value type="search" class="form-control"/>
                        <select data-select-expiry class="form-select">
                            <option value="">Выберите</option>
                            <option value="unlimited">Бессрочно</option>
                            <option value="months">В месяцах</option>
                        </select>
                    </div>
                </div>
                ${additionalBlock}
            </div>
    `);
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

    $("body").on('change', '[data-select-expiry]', function () {
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

    $("body").on('change', '[data-select-condition]', function () {
        let li = $(this).parents('li');
        let input = $(this).siblings('input');
        if ($(this).val() === '') {
            input.hide();
            input.val('');
            li.removeAttr('condition-value');
        } else {
            input.show();
            li.attr('condition-type', $(this).val());
        }

    });

    $('body').on('input', '[data-expiry-value]', function () {
        $(this).parents('li').attr('expiry-value', $(this).val());
    });

    $('body').on('input', '[data-condition-value]', function () {
        $(this).parents('li').attr('condition-value', $(this).val());
    });

    $("body").on("change", '[data-select-brand]', function () {
        let li = $(this).parents('li');
        if ($(this).val() !== '') {
            li.attr('brand-id', $(this).val());
        } else {
            li.removeAttr('brand-id');
        }
    });

});
