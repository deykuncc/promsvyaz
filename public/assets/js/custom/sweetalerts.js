function showToast(message, type) {
    Swal.fire({
        title: type ? 'Успешно' : "Ошибка",
        text: message,
        icon: type,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: type ?'#d4edda' : "#ffe0e0",
        color: type ? '#5aa56d' : '#ef6666',
        customClass: {
            popup: 'swal2-toast'
        }
    });
}
