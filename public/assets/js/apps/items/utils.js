$(document).ready(function () {
    $('body').on('click', '[data-action="newBrand"]', function () {
        let parent = $(this).parents('.mb-3');

        let clonedHtml = parent.clone();

        clonedHtml.find('input').val('').removeAttr('value').removeAttr('readonly').attr('data-brand-value','');

        $("[data-brand]").append(
            `<div class="mb-3 d-flex gap-2">${clonedHtml.html()}</div>`
        );

        $(this).remove();
    });
});
