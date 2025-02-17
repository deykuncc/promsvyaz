function update() {
    let employeeId = $("#employeeId").val();
    let lastName = $("#lastName").val();
    let firstName = $("#firstName").val();
    let middleName = $("#middleName").val();
    let externalId = $("#externalId").val();
    let gender = $("#gender").val();
    let startDate = $("#startDate").val();
    let height = $("#height").val();
    let sizeClothes = $("#sizeClothes").val();
    let sizeShoes = $("#sizeShoes").val();
    let sizeHats = $("#sizeHats").val();
    let departmentId = $('#departmentId').val();
    let professionId = $('#professionId').val();

    ajaxUpdate(employeeId, lastName, firstName, middleName, externalId, gender, startDate, height, sizeClothes, sizeShoes, sizeHats, departmentId, professionId).then((response) => {
        // location.reload();
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })
}

function ajaxUpdate(employeeId, lastName, firstName, middleName, externalId, gender, startDate, height, sizeClothes, sizeShoes, sizeHats, departmentId, professionId) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/employees/${employeeId}`,
            type: 'put',
            dataType: 'json',
            data: {
                last_name: lastName,
                first_name: firstName,
                middle_name: middleName,
                external_id: externalId,
                gender_id: gender,
                employment_date: startDate,
                height: height,
                clothes_size_id: sizeClothes,
                shoes_size_id: sizeShoes,
                hats_size_id: sizeHats,
                profession_id: professionId,
                department_id: departmentId,
            }
        }).done((response) => {
            resolve(response);
        }).fail((error) => {
            reject(error);
        })
    });
}

function saveItems() {
    let items = [];
    let deletedItems = [];
    let employeeId = $("#employeeId").val();

    $("tr[data-item-id]").each(function (index) {
        let id = $(this).attr('data-item-id');
        let size = $(this).attr('data-item-size');
        let dateType = $(this).attr('data-date-type');
        let dateValue = $(this).attr('data-date-value');
        let itemName = $(this).attr('data-item-name');
        let conditionType = $(this).attr('data-condition-type');
        let conditionValue = $(this).attr('data-condition-value');

        if (!size || size === undefined) {
            return showToast(`Выберите размер для ${itemName}`, 0);
        }

        if (!dateValue || dateValue === undefined || !dateType || dateType === undefined) {
            if (dateType != 'unlimited') {
                return showToast(`Укажите срок эксплуатации для ${itemName}`, 0);
            }
        }

        if (!conditionType || conditionType === undefined || !conditionValue || conditionValue === undefined) {
            return showToast(`Укажите количество для ${itemName}`, 0);
        }

        items.push(
            {
                id: id,
                size: size,
                dateType: dateType,
                dateValue: dateValue,
                conditionType: conditionType,
                conditionValue: conditionValue,
            }
        );
    });

    $("tr[deleted-has]").each(function (index) {
        deletedItems.push(parseInt($(this).attr('data-item-has-id')));
    });

    ajaxSaveNewItems(employeeId, items, deletedItems).then((response) => {
        location.reload();
    }).catch((error) => {
        return showToast(error.responseJSON.message, 0);
    });
}

function ajaxSaveNewItems(employeeId, items, deletedItems) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/employees/${employeeId}/items`,
            dataType: 'json',
            type: 'post',
            data: {
                items: items,
                deleted_items: deletedItems,
            }
        }).done((response) => {
            resolve(response);
        }).fail((error) => {
            reject(error);
        })
    });
}

$(document).ready(function () {
    $("button[type='submit'][action='saveProfile']").on('click', function () {
        update();
    });

    $('[data-action="destroyHas"]').on('click', function () {
        $(this).parents('tr').attr('deleted-has', true);
        $(this).parents('tr').fadeOut(50);
    });

    $("[data-action='saveNewItems']").on('click', function () {
        saveItems();
    });
});
