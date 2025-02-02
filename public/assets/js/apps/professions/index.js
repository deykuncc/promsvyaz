function destroy(professionId) {
    ajaxDestroy(professionId).then((response) => {
        showToast(response.message, 1);
        $(`[data-profession-id="${professionId}"]`).fadeOut(150);
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    });
}

function ajaxDestroy(itemId) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/professions/${itemId}`,
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
        let professionId = $(this).parents('tr').attr('data-profession-id');
        let professionName = $(this).parents('tr').attr('data-profession-name');
        $("[data-target-profession-name]").text(professionName);
        $("#professionId").val(professionId);
    });

    $('button[data-action="destroy"]').on('click', function () {
        let professionId = $("#professionId").val();
        destroy(professionId);
    });
});
