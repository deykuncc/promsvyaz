function destroy(itemId) {
    ajaxDestroy(itemId).then((response) => {
        showToast(response.message, 1);
        $(`[data-item-id="${itemId}"]`).fadeOut(150);
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    });
}

function ajaxDestroy(itemId) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/items/${itemId}`,
            type: 'delete',
            dataType: 'json',
        }).done((response) => {
            resolve(response);
        }).fail((error) => {
            reject(error);
        })
    });
}

$(document).ready(function () {
    $('span[data-action="destroy"]').on('click', function () {
        let itemId = $(this).parents('tr').attr('data-item-id');
        let itemName = $(this).parents('tr').attr('data-item-name');
        $("[data-target-item-name]").text(itemName);
        $("#itemId").val(itemId);
    });

    $('button[data-action="destroy"]').on('click', function () {
        let itemId = $("#itemId").val();
        destroy(itemId);
    });
});
