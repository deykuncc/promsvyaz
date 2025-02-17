function receivedChange(id) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/used/${id}/received`,
            type: 'patch',
            dataType: 'json',
        }).done((response) => {
            resolve(response);
        }).fail((error) => {
            reject(error);
        });
    });
}

function update() {
    let id = $("#usedId").val();
    let untilAt = $("#untilAtDays").val();
    let sizeId = $("#sizeId").val();
    let isUnlimited = $("#offUntilAt").prop('checked') ? 1 : 0;

    let data = {
        until_at: untilAt,
        size_id: sizeId,
        is_unlimited: isUnlimited,
    };

    ajaxUpdate(id, data).then((response) => {
        location.reload();
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    });
}

function ajaxUpdate(id, data) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/used/${id}`,
            type: 'put',
            dataType: 'json',
            data: data,
        }).done((response) => {
            resolve(response);
        }).fail((error) => {
            reject(error);
        });
    });
}


function changeSizeType(type) {
    $("#sizeId").val("");

    $("option[data-size-option]").fadeOut(100);
    $(`option[data-size-option][type="${type}"]`).fadeIn(100);

    if (type === 'nosize' || type === '') {
        $("#sizeId").fadeOut(0);
    } else {
        $("#sizeId").fadeIn(0);
    }
}

$(document).ready(function () {
    $("input[data-received][type='checkbox']").on('click', function () {
        let id = $(this).parents('tr').attr('data-id');
        receivedChange(id).then((response) => {

        }).catch((error) => {
            showToast(error.responseJSON.message, 0);
        });
    });

    $('[data-action="openReport"]').on('click', function () {
        let dateStatement = $("#statementDate").val();
        let statementId = $("#statementId").val();

        location.href = `/reports/statement?date=${dateStatement}&id=${statementId}`;
    });

    $('[data-action="openReportOrder"]').on('click', function () {
        let untilAt = parseInt($("#untilAtReport").val()) > 0 ? parseInt($("#untilAtReport").val()) : 31;

        location.href = `/reports/order?until_at=${untilAt}`;
    });

    $('[data-action="update"]').on('click', function () {
        update();
    });

    $('[data-action="edit"]').on('click', function () {
        let id = $(this).parents('tr').attr('data-id');
        let itemName = $(this).parents('tr').attr('data-item-name');
        let typeSize = $(this).parents('tr').attr('data-type-size');
        let size = $(this).parents('tr').attr('data-size');
        let untilAt = $(this).parents('tr').attr('data-until');

        $('#untilAtDays').val(untilAt);

        $("#sizeType").val(typeSize);
        $('[data-target-item-name]').text(itemName);
        changeSizeType(typeSize);
        $("#sizeId").val(size);
        console.info(untilAt);
        if (untilAt.length <= 0) {
            $('#offUntilAt').prop('checked', 1);
        }
        $("#usedId").val(id);
    });

    $("#sizeType").on('change', function () {
        let type = $(this).val();
        changeSizeType(type);
    });
});
