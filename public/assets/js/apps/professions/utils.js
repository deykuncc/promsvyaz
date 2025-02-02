$(document).ready(function () {
    $("body").on('click', '.add-siz', function () {
        let element = $(this).parent();
        element.remove();
        let itemName = $(this).attr('item-name');
        let itemId = $(this).attr('item-id');
        let $newItem = $('<li></li>').addClass('list-group-item d-flex justify-content-between align-items-center');
        $newItem.text(itemName);
        let $removeButton = $("<button></button>").addClass('btn btn-sm btn-outline-danger remove-siz');
        $removeButton.attr('item-name', itemName);
        $removeButton.attr('item-id', itemId);
        $removeButton.text('Удалить');
        $("#selected-siz").append($newItem);
        $newItem.append($removeButton);

    });

    $('body').on('click', '.remove-siz', function () {
        let element = $(this).parent();
        element.remove();
        let itemName = $(this).attr('item-name');
        let itemId = $(this).attr('item-id');
        let $newItem = $('<li></li>').addClass('list-group-item d-flex justify-content-between align-items-center');
        $newItem.text(itemName);
        let $removeButton = $("<button></button>").addClass('btn btn-sm btn-outline-primary add-siz');
        $removeButton.attr('item-name', itemName);
        $removeButton.attr('item-id', itemId);
        $removeButton.text('Добавить');
        $("#available-siz").append($newItem);
        $newItem.append($removeButton);
    });
});
