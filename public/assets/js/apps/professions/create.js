function create() {
    let name = $("#name").val();
    let items = [];
    let error = false;

    $(".remove-siz").each(function (index) {
        let li = $(this).parents('li');
        let categoryName = li.attr('category-name');
        let itemName = li.attr('item-name');
        let expiryType = li.attr('expiry-type') ?? undefined;
        let expiryValue = li.attr('expiry-value') ?? 0;
        let conditionValue = li.attr('condition-value') ?? 0;
        let conditionType = li.attr('condition-type') ?? null;

        if (categoryName === 'clear' && (isNaN(conditionType) || conditionValue <= 0 || conditionValue === undefined || isNaN(conditionValue))){
            error = true;
            return showToast(`Выберите количество для ${itemName}`);
        }

        if (expiryType === undefined || expiryType.length <= 0) {
            error = true;
            return showToast(`Выберите срок эксплуатации для ${itemName}`);
        }

        if (expiryType === 'months' && expiryValue <= 0 || isNaN(parseInt(expiryValue))) {
            error = true;
            return showToast(`Укажите срок эксплуатации для ${itemName}`);
        }

        items.push({
            id: parseInt($(this).attr('item-id')),
            expiryType: expiryType,
            expiryValue: !isNaN(parseInt(expiryValue)) ? parseInt(expiryValue) : null,
            conditionType: categoryName === 'clear' ? parseInt(conditionType) : null,
            conditionValue: categoryName === 'clear' ? parseInt(conditionValue) : null,
        });
    });

    if (error) return;

    if (items.length <= 0) {
        return showToast('Выберите СИЗ', 0);
    }

    ajaxCreate(name, items).then((response) => {
        location.href = "/professions";
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })


}

function ajaxCreate(name, items) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "/api/professions", type: 'post', dataType: 'json', data: {
                name: name, items: items,
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
