function create() {
    let name = $("#name").val();

    if (name.length <= 0) {
        return showToast("Введите название участка", 0);
    }

    ajaxCreate(name).then((response) => {
        location.href = "/departments";
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })
}

function ajaxCreate(name) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "/api/departments",
            type: 'post',
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
        create();
    });
});
