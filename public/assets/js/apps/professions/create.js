function create() {
    let name = $("#name").val();
    let items = [];

    $(".remove-siz").each(function (index) {
        items.push(parseInt($(this).attr('item-id')));
    });

    if (items.length <= 0) {
        return showToast('Выберите СИЗ', 0);
    }

    ajaxCreate(name, items).then((response) => {
        location.href = "/professions";
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })


}

function ajaxCreate(name, items) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "/api/professions",
            type: 'post',
            dataType: 'json',
            data: {
                name: name,
                items: items,
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
