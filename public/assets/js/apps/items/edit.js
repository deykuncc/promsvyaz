function update() {
    let itemId = $("#itemId").val();
    let itemName = $("#itemName").val();
    let itemDescription = $("#itemDescription").val();
    let itemCategoryId = $("#itemCategoryId").val();
    let itemBrand = $("#itemBrand").val();
    let itemModel = $("#itemModel").val();
    let normClause = $("#normClause").val();

    if (itemName.length <= 0) {
        return showToast('Введите название СИЗ', 0);
    }

    if (itemCategoryId.length <= 0) {
        return showToast('Выберите категорию', 0);
    }


    ajaxUpdate(itemId, itemName, itemDescription, itemCategoryId, itemBrand, itemModel, normClause).then((response) => {
        location.href = "/items";
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })


}

function ajaxUpdate(itemId, itemName, itemDescription, itemCategoryId, itemBrand, itemModel, normClause) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/items/${itemId}`,
            type: 'put',
            dataType: 'json',
            data: {
                name: itemName,
                description: itemDescription,
                category_id: itemCategoryId,
                brand: itemBrand,
                model: itemModel,
                norm_clause: normClause,
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
        update();
    });
});
