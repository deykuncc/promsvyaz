function create() {
    let itemName = $("#itemName").val();
    let itemCategoryId = $("#itemCategoryId").val();
    let itemBrand = $("#itemBrand").val();
    let itemModel = $("#itemModel").val();
    let itemDescription = $("#itemDescription").val();
    let normClause = $("#normClause").val();

    if (itemName.length <= 0) {
        return showToast('Введите название СИЗ', 0);
    }

    if (itemCategoryId.length <= 0) {
        return showToast('Выберите категорию', 0);
    }

    ajaxCreate(itemName, itemDescription, itemCategoryId, itemBrand, itemModel, normClause).then((response) => {
        location.href = "/items";
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })


}

function ajaxCreate(itemName, itemDescription, itemCategoryId, itemBrand, itemModel, normClause) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "/api/items",
            type: 'post',
            dataType: 'json',
            data: {
                name: itemName,
                category_id: itemCategoryId,
                description: itemDescription,
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
        create();
    });
});
