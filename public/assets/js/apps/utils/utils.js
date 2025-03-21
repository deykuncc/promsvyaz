$('body').on('input', '[data-date]', function () {
    // Удаляем все символы, кроме цифр
    let input = $(this).val().replace(/\D/g, '');
    // Ограничиваем длину до 8 символов (DDMMYYYY)
    if (input.length > 8) {
        input = input.substring(0, 8);
    }
    let day = input.substring(0, 2);
    let month = input.substring(2, 4);
    let year = input.substring(4, 8);
    let formatted = day;
    if (input.length > 2) {
        formatted += '.' + month;
    }
    if (input.length > 4) {
        formatted += '.' + year;
    }
    $(this).val(formatted);
});
