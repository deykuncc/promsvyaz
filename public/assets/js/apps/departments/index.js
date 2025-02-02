function destroy(departmentId) {
    ajaxDestroy(departmentId).then((response) => {
        showToast(response.message, 1);
        $(`[data-department-id="${departmentId}"]`).fadeOut(150);
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    });
}

function ajaxDestroy(departmentId) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/departments/${departmentId}`,
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
        let departmentId = $(this).parents('tr').attr('data-department-id');
        let departmentName = $(this).parents('tr').attr('data-department-name');
        $("[data-target-department-name]").text(departmentName);
        $("#departmentId").val(departmentId);
    });

    $('button[data-action="destroy"]').on('click', function () {
        let departmentId = $("#departmentId").val();
        destroy(departmentId);
    });
});
