function login() {
    let login = $("#login").val();
    let password = $("#password").val();

    ajaxLogin(login, password).then((response) => {
        showToast(response.message, 1);
        setTimeout(() => {
            location.reload();
        }, 1000);
    }).catch((errors) => {
        showToast(errors.responseJSON.message, 0);
    });
}

function ajaxLogin(login, password) {
    return new Promise(function (resolve, reject) {
        $.ajax({
            url: '/api/auth/login',
            type: 'post',
            dataType: 'json',
            data: {
                login: login,
                password: password,
            }
        }).done((response) => {
            resolve(response);
        }).fail((errors) => {
            reject(errors);
        })
    });
}

$(document).ready(function () {
    $('button[type="submit"]').on('click', function () {
        login();
    });
});
