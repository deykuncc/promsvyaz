$(document).ready(function () {
    $('body').on('click', '[data-action="newBrand"]', function () {
        let parent = $(this).parents('.mb-3').find('.mb-3').one();

        let clonedHtml = parent.clone();

        clonedHtml.find('input').val('').removeAttr('value').removeAttr('readonly');

        $("[data-brand]").append(
            `<div class="mb-3 d-flex justify-content-between">${clonedHtml.html()}</div>`
        );

        let button = $(this).parent().clone();
        $(this).parents('.mb-3').append(button);
        $(this).remove();
    });
});
