function destroy(employeeId) {
    ajaxDestroy(employeeId).then((response) => {
        showToast(response.message, 1);
        $(`[data-profession-id="${employeeId}"]`).fadeOut(150);
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    });
}

function ajaxDestroy(itemId) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/employees/${itemId}`,
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
        let employeeId = $(this).parents('tr').attr('data-employee-id');
        let employeeName = $(this).parents('tr').attr('data-employee-name');
        $("[data-target-employee-name]").text(employeeName);
        $("#employeeId").val(employeeId);
    });

    $('button[data-action="destroy"]').on('click', function () {
        let employeeId = $("#employeeId").val();
        destroy(employeeId);
        $(`[data-employee-id="${employeeId}"]`).remove();
    });
});
