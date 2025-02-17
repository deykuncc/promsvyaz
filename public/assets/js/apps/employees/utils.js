function showItems(professionId) {
    if (!professionId) {
        return $("#items").fadeOut(100);
    }

    ajaxGetItemsByProfession(professionId).then((response) => {
        constructItems(response.items);
    }).catch((error) => {

    });
    $("#items").fadeIn(100);
}

function constructItems(items) {
    let html = '';
    for (let i in items) {
        let item = items[i];
        html += addItemOfProfession(item);
    }

    $("#itemsProfession").html(html);

    setTimeout(() => {
        setSelectors();
    }, 100);
}

function setSelectors() {
    $('[data-set-after-type-size]').each(function (index) {
        let sizeId = 0;
        let sizeType = $(this).attr('data-set-after-type-size');
        if (sizeType === 'clothesAddon') {
            sizeId = $('#sizeClothes').val();
        } else if (sizeType == 'shoesAddon') {
            sizeId = $("#sizeShoes").val();
        } else if (sizeType == 'hatsAddon') {
            sizeId = $("#sizeHats").val();
        }

        if ($(this).attr('data-condition-type') !== undefined) {
            $(this).find('select[data-condition-type]').val($(this).attr('data-condition-type')).change();
        }

        $(this).find('select[data-id="sizeAddon"]').val($(this).attr('data-set-after-type-size')).change();

        if (sizeId != 0) {
            console.info(sizeId);
            $(this).find('select[data-size-addon-item]').val(sizeId).change();
            console.info('setsize: ', $(this).find('select[data-size-addon-item]').val());
        }
    });
}

function ajaxGetItemsByProfession(professionId) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/professions/${professionId}/items`,
            dataType: "json",
            type: 'get',
        }).done((response) => {
            resolve(response);
        }).fail((errors) => {
            reject(errors);
        })
    });
}

function ajaxGetItems() {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/items`,
            dataType: "json",
            type: 'get',
        }).done((response) => {
            resolve(response);
        }).fail((errors) => {
            reject(errors);
        })
    });
}


function addItem() {
    let itemsHtml = '';
    ajaxGetItems().then((response) => {
        for (let i in response.items) {
            let item = response.items[i];
            let category = item.category.name_eng;

            let conditionType = 0;
            let typeSize = "";
            if (['clothes', 'others', 'hats'].includes(category)) {
                conditionType = 1;
            } else if (['hands', 'shoes'].includes(category)) {
                conditionType = 2;
            } else if (['clear'].includes(category)) {
                conditionType = 3;
            }

            if (category == 'clothes') {
                typeSize = 'clothesAddon';
            } else if (['others', 'hands', 'clear'].includes(category)) {
                typeSize = 'withoutSizeAddon';
            } else if (category == 'hats') {
                typeSize = 'hatsAddon';
            } else if (category == 'shoes') {
                typeSize = 'shoesAddon';
            }


            itemsHtml += `<option
                data-condition-value="1"
                data-condition-type="${conditionType}"
                data-set-after-type-size="${typeSize}"
                value="${item.id}" >${item.name}</option>`;
        }

        let html =
            `
            <tr>
            <td>
                <select data-item-select style="width: 200px;" class="form-select">
                    <option selected>Выберите</option>
                    ${itemsHtml}
                </select>
            </td>
            <td>
                <div class="d-flex align-items-center gap-1">
                    <input autocomplete="off" data-condition-value value="1" style="width: 60px" class="form-control">
                        <select data-condition-type style="width: 85px" class="form-select">
                            <option selected>Выберите</option>
                            <option value="1">Шт</option>
                            <option value="2">Пар</option>
                            <option value="3">Мл</option>
                            <option value="4">Гр</option>
                        </select>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center gap-1">
                    <input autocomplete="off" data-date-value style="width: 60px" class="form-control">
                        <select data-date-type style="width: 125px" class="form-select">
                            <option selected value="months">В месяцах</option>
                            <option value="unlimited">До износа</option>
                        </select>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center gap-1">
                    <select data-size-addon-item style="width: 125px" class="form-select">
                        <option selected>Выбрать</option>
                    </select>
                    <select data-id="sizeAddon" style="width: 125px" class="form-select">
                        <option selected>Выбрать</option>
                        <option value="clothesAddon">Одежда</option>
                        <option value="shoesAddon">Обувь</option>
                        <option value="hatsAddon">Головной убор</option>
                        <option value="withoutSizeAddon">Без размера</option>
                    </select>
                </div>
            </td>
            <td>
                <span
                    data-action="destroy"
                    data-bs-toggle="modal"
                      title="Удалить"
                      class="ico-hover" style="cursor:pointer;">
                <svg style="color: #ff1616" width="21px" height="21px"
                     viewBox="0 0 1024 1024"
                     class="icon"
                     version="1.1"
                     xmlns="http://www.w3.org/2000/svg"><path
                    d="M905.92 237.76a32 32 0 0 0-52.48 36.48A416 416 0 1 1 96 512a418.56 418.56 0 0 1 297.28-398.72 32 32 0 1 0-18.24-61.44A480 480 0 1 0 992 512a477.12 477.12 0 0 0-86.08-274.24z"
                    fill="currentColor"/><path
                    d="M630.72 113.28A413.76 413.76 0 0 1 768 185.28a32 32 0 0 0 39.68-50.24 476.8 476.8 0 0 0-160-83.2 32 32 0 0 0-18.24 61.44zM489.28 86.72a36.8 36.8 0 0 0 10.56 6.72 30.08 30.08 0 0 0 24.32 0 37.12 37.12 0 0 0 10.56-6.72A32 32 0 0 0 544 64a33.6 33.6 0 0 0-9.28-22.72A32 32 0 0 0 505.6 32a20.8 20.8 0 0 0-5.76 1.92 23.68 23.68 0 0 0-5.76 2.88l-4.8 3.84a32 32 0 0 0-6.72 10.56A32 32 0 0 0 480 64a32 32 0 0 0 2.56 12.16 37.12 37.12 0 0 0 6.72 10.56zM726.72 297.28a32 32 0 0 0-45.12 0l-169.6 169.6-169.28-169.6A32 32 0 0 0 297.6 342.4l169.28 169.6-169.6 169.28a32 32 0 1 0 45.12 45.12l169.6-169.28 169.28 169.28a32 32 0 0 0 45.12-45.12L557.12 512l169.28-169.28a32 32 0 0 0 0.32-45.44z"
                    fill="currentColor"/></svg>
                </span>
            </td>
        </tr>
            `;
        $('tbody').append(html);
    });


}


function addItemOfProfession(item) {
    let category = item.item.category.name_eng;
    let conditionType = 0;
    let typeSize = "";
    if (['clothes', 'others', 'hats'].includes(category)) {
        conditionType = 1;
    } else if (['hands', 'shoes'].includes(category)) {
        conditionType = 2;
    } else if (['clear'].includes(category)) {
        conditionType = 3;
    }

    if (category == 'clothes') {
        typeSize = 'clothesAddon';
    } else if (['others', 'hands', 'clear'].includes(category)) {
        typeSize = 'withoutSizeAddon';
    } else if (category == 'hats') {
        typeSize = 'hatsAddon';
    } else if (category == 'shoes') {
        typeSize = 'shoesAddon';
    }


    let html =
        `
        <tr
        data-item-name="${item.item.name}"
        data-item-id="${item.item.id}"
        data-condition-type="${conditionType}"
        data-condition-value="1"
        data-set-after-type-size="${typeSize}"
        >
            <td>${item.item.name}</td>
            <td>
                <div class="d-flex align-items-center gap-1">
                   <input autocomplete="off" data-condition-value value="1" style="width: 60px" class="form-control">
                    <select data-condition-type style="width: 85px" class="form-select">
                        <option>Выберите</option>
                        <option ${['clothes', 'others', 'hats'].includes(category) ? 'selected' : ''} value="1">Шт</option>
                        <option ${['hands', 'shoes'].includes(category) ? 'selected' : ''} value="2">Пар</option>
                        <option ${['clear'].includes(category) ? 'selected' : ''} value="3">Мл</option>
                        <option value="4">Гр</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center gap-1">
                    <input autocomplete="off" data-date-value style="width: 60px" class="form-control">
                    <select data-date-type style="width: 125px" class="form-select">
                            <option selected value="months">В месяцах</option>
                            <option value="unlimited">До износа</option>
                    </select>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center gap-1">
                    <select data-size-addon-item style="width: 125px" class="form-select">
                        <option selected>Выбрать</option>
                    </select>
                    <select data-id="sizeAddon" style="width: 125px" class="form-select">
                        <option selected>Выбрать</option>
                        <option value="clothesAddon">Одежда</option>
                        <option value="shoesAddon">Обувь</option>
                        <option value="hatsAddon">Головной убор</option>
                        <option value="withoutSizeAddon">Без размера</option>
                    </select>
                </div>
            </td>
            <td>
                    <span
                     data-action="destroy"
                     data-bs-toggle="modal"
                          title="Удалить"
                          class="ico-hover" style="cursor:pointer;">
                    <svg style="color: #ff1616" width="21px" height="21px"
                         viewBox="0 0 1024 1024"
                         class="icon"
                         version="1.1"
                         xmlns="http://www.w3.org/2000/svg"><path
                                d="M905.92 237.76a32 32 0 0 0-52.48 36.48A416 416 0 1 1 96 512a418.56 418.56 0 0 1 297.28-398.72 32 32 0 1 0-18.24-61.44A480 480 0 1 0 992 512a477.12 477.12 0 0 0-86.08-274.24z"
                                fill="currentColor"/><path
                                d="M630.72 113.28A413.76 413.76 0 0 1 768 185.28a32 32 0 0 0 39.68-50.24 476.8 476.8 0 0 0-160-83.2 32 32 0 0 0-18.24 61.44zM489.28 86.72a36.8 36.8 0 0 0 10.56 6.72 30.08 30.08 0 0 0 24.32 0 37.12 37.12 0 0 0 10.56-6.72A32 32 0 0 0 544 64a33.6 33.6 0 0 0-9.28-22.72A32 32 0 0 0 505.6 32a20.8 20.8 0 0 0-5.76 1.92 23.68 23.68 0 0 0-5.76 2.88l-4.8 3.84a32 32 0 0 0-6.72 10.56A32 32 0 0 0 480 64a32 32 0 0 0 2.56 12.16 37.12 37.12 0 0 0 6.72 10.56zM726.72 297.28a32 32 0 0 0-45.12 0l-169.6 169.6-169.28-169.6A32 32 0 0 0 297.6 342.4l169.28 169.6-169.6 169.28a32 32 0 1 0 45.12 45.12l169.6-169.28 169.28 169.28a32 32 0 0 0 45.12-45.12L557.12 512l169.28-169.28a32 32 0 0 0 0.32-45.44z"
                                fill="currentColor"/></svg>
                    </span>
            </td>
         </tr>
        `;

    return html;
}


$(document).ready(function () {

    $("body").on('change', '[data-id="sizeAddon"]', function () {
        let size = $(this).val();
        let html = '';
        switch (size) {
            case 'clothesAddon':
                html = $("#sizeClothes").html();
                break;
            case 'shoesAddon':
                html = $("#sizeShoes").html();
                break;
            case 'hatsAddon':
                html = $("#sizeHats").html();
                break;
            case 'withoutSizeAddon':
                $(this).parents('tr').attr('data-item-size', "without");
                html = false;
                break;
            default:
                break;
        }
        if (html === false) {
            $(this).siblings('select').fadeOut(50);
        } else {
            $(this).siblings('select').fadeIn(50);
        }

        $(this).siblings('select').html(html);
    });

    $("body").on('change', 'select[data-size-addon-item]', function () {
        let size = $(this).val();
        $(this).parents('tr').attr('data-item-size', size);
    });

    $("body").on('change', 'select[data-date-type]', function () {
        if ($(this).val() === 'unlimited') {
            $(this).siblings('input').fadeOut(50);
            $(this).parents('tr').attr('data-date-type', $(this).val());
        } else {
            $(this).siblings('input').fadeIn(50);
            let count = $(this).siblings('input').val();
            if ($(this).val() != "Выберите") {
                $(this).parents('tr').attr('data-date-type', $(this).val());
            } else {
                $(this).parents('tr').attr('data-date-type', null);
            }
            $(this).parents('tr').attr('data-date-value', count);
        }
    });

    $("body").on('input', 'input[data-date-value]', function () {
        let count = $(this).val();
        let type = $(this).siblings('select').val();
        if (type != "Выберите") {
            $(this).parents('tr').attr('data-date-type', type);
        }
        $(this).parents('tr').attr('data-date-value', count);
    });

    $("body").on('change', 'select[data-item-select]', function () {
        let option = $(this).find("option:selected");
        let itemId = $(this).val();
        let itemName = option.text();
        $(this).parents('tr').attr('data-item-id', itemId);
        $(this).parents('tr').attr('data-item-name', itemName);
        $(this).parents('tr').attr('data-condition-type', option.attr('data-condition-type'));
        $(this).parents('tr').attr('data-set-after-type-size', option.attr('data-set-after-type-size'));
        setSelectors();
    });

    $('body').on('change', 'select[data-condition-type]', function () {
        let conditionType = $(this).val();
        let conditionValue = $(this).siblings('input').val();
        $(this).parents('tr').attr('data-condition-type', conditionType);
        $(this).parents('tr').attr('data-condition-value', conditionValue);
    });

    $('body').on('input', 'input[data-condition-value]', function () {
        let conditionValue = $(this).val();
        let conditionType = $(this).siblings('select').val();
        $(this).parents('tr').attr('data-condition-type', conditionType);
        $(this).parents('tr').attr('data-condition-value', conditionValue);
    });

    $("body").on('click', '[data-action="destroy"]', function () {
        $(this).parents('tr').remove();
    });

    $("#professionId").on('change', function () {
        let professionId = parseInt($(this).val());
        showItems(professionId);
    });

    $('[data-action="addItem"]').on('click', function () {
        addItem();
    });

});
