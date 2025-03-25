function update(removedItems) {
    let professionId = $("#professionId").val();
    let name = $("#name").val();
    let items = [];

    $(".remove-siz").each(function (index) {
        if ($(this).attr('has') !== undefined) return;

        let li = $(this).parents('li');
        let itemName = li.attr('item-name');
        let expiryType = li.attr('expiry-type');
        let expiryValue = li.attr('expiry-value') ?? 0;

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
        });
    });

    if (items.length <= 0) {
        return showToast('Выберите СИЗ', 0);
    }

    ajaxUpdate(professionId, name, removedItems, items).then((response) => {
        location.reload();
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })


}

function ajaxUpdate(professionId, name, removedItems, newItems) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/professions/${professionId}`,
            type: 'put',
            dataType: 'json',
            data: {
                name: name,
                items: newItems,
                removed_items: removedItems,
            }
        }).done((response) => {
            resolve(response);
        }).fail((error) => {
            reject(error);
        })
    });
}


$(document).ready(function () {
    let removedItems = [];
    $("button[type='submit']").on('click', function () {
        update(removedItems);
    });

    $(".remove-siz[has]").on('click', function () {
        removedItems.push(parseInt($(this).attr('item-id')));
    });

});
