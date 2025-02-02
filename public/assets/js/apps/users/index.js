function destroy(userId) {
    ajaxDestroy(userId).then((response) => {
        showToast(response.message, 1);
        $(`[data-user-id="${userId}"]`).fadeOut(150);
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    });
}

function ajaxDestroy(userId) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/users/${userId}`,
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
        let userId = $(this).parents('tr').attr('data-user-id');
        let userFullName = $(this).parents('tr').attr('data-user-full-name');
        $("[data-target-full-name]").text(userFullName);
        $("#userId").val(userId);
    });

    $('button[data-action="destroy"]').on('click', function () {
        let userId = $("#userId").val();
        destroy(userId);
    });
});
