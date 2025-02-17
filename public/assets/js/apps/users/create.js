function create() {
    let lastName = $("#lastName").val();
    let firstName = $("#firstName").val();
    let middleName = $("#middleName").val();
    let login = $("#login").val();
    let password = $("#password").val();
    let role = $("#role").val();

    if (lastName.length <= 0) {
        return showToast('Введите Фамилию', 0);
    }

    if (firstName.length <= 0) {
        return showToast('Введите Имя', 0);
    }

    if (login.length <= 0) {
        return showToast('Введите Логин', 0);
    }

    if (password.length <= 0) {
        return showToast('Введите Пароль', 0);
    }

    if (role.length <= 0) {
        return showToast('Выберите должность', 0);
    }

    ajaxCreate(lastName, firstName, middleName, login, password, role).then((response) => {
        location.href = "/users";
    }).catch((error) => {
        showToast(error.responseJSON.message, 0);
    })


}

function ajaxCreate(lastName, firstName, middleName, login, password, role) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: "/api/users",
            type: 'post',
            dataType: 'json',
            data: {
                last_name: lastName,
                first_name: firstName,
                middle_name: middleName,
                login: login,
                password: password,
                role_id: role,
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
