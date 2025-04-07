function create() {
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

    let items = [];

    $("tr[data-item-id]").each(function (index) {
        let id = $(this).attr('data-item-id');
        let size = $(this).attr('data-item-size');
        let dateType = $(this).attr('data-date-type');
        let dateValue = $(this).attr('data-date-value');
        let itemName = $(this).attr('data-item-name');
        let brandId = $(this).attr('data-brand-id');
        let conditionType = $(this).attr('data-condition-type');
        let conditionValue = $(this).attr('data-condition-value');
        let issuedDate = $(this).attr('data-issued-date');

        if (!brandId || brandId === undefined) {
            return showToast(`Выберите бренд для ${itemName}`, 0);
        }

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

        if (!issuedDate) {
            return showToast(`Укажите дату получения для ${itemName}`, 0);
        }

        items.push(
            {
                id: id,
                size: size,
                dateType: dateType,
                dateValue: dateValue,
                conditionType: conditionType,
                conditionValue: conditionValue,
                issuedDate: issuedDate,
                brandId: brandId,
            }
        );
    });


    if (items.length <= 0) {
        return showToast('Выберите СИЗ', 0);
    }

    if (firstName.length <= 0) {
        return showToast('Введите Имя', 0);
    }

    if (lastName.length <= 0) {
        return showToast('Введите Фамилию', 0);
    }

    if (gender.length <= 0) {
        return showToast('Выберите пол', 0);
    }

    if (startDate.length <= 0) {
        return showToast('Выберите дату поступления на работу', 0);
    }

    if (height.length <= 0) {
        return showToast('Выберите рост', 0);
    }

    if (sizeClothes.length <= 0) {
        return showToast('Выберите размер одежды', 0);
    }

    if (sizeShoes.length <= 0) {
        return showToast('Выберите размер обуви', 0);
    }

    if (sizeHats.length <= 0) {
        return showToast('Выберите размер головного убора', 0);
    }

    if (departmentId.length <= 0) {
        return showToast('Выберите участок', 0);
    }

    if (professionId.length <= 0) {
        return showToast('Выберите профессию', 0);
    }

    ajaxCreate(lastName, firstName, middleName, externalId, gender, startDate, height, sizeClothes, sizeShoes, sizeHats, departmentId, professionId, items).then((response) => {
        location.href = "/employees";
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })


}

function ajaxCreate(lastName, firstName, middleName, externalId, gender, startDate, height, sizeClothes, sizeShoes, sizeHats, departmentId, professionId, items) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "/api/employees",
            type: 'post',
            dataType: 'json',
            data: {
                last_name: lastName,
                first_name: firstName,
                middle_name: middleName,
                external_id: externalId,
                gender_id: gender,
                employment_date: startDate,
                height: height,
                size_clothes: sizeClothes,
                size_shoes: sizeShoes,
                size_hats: sizeHats,
                profession_id: professionId,
                department_id: departmentId,
                items: items,
            }
        }).done((response) => {
            resolve(response);
        }).fail((error) => {
            reject(error);
        })
    });
}


$(document).ready(function () {
    $("button[type='submit']").on('click', function () {
        create();
    });
});
