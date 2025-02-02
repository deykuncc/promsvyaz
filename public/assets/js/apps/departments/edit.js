function update() {
    let name = $("#name").val();
    let departmentId = $("#departmentId").val();

    if (name.length <= 0) {
        return showToast("Введите название участка", 0);
    }

    ajaxUpdate(name, departmentId).then((response) => {
        location.href = "/departments";
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })
}

function ajaxUpdate(name, departmentId) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: `/api/departments/${departmentId}`,
            type: 'put',
            dataType: 'json',
            data: {
                name: name,
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
