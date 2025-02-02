<div class="modal fade" id="deleteItem" tabindex="-1" aria-labelledby="deleteItemLabel"
     aria-hidden="true">
    <input type="hidden" id="itemId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteItemLabel">Удалить СИЗ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить СИЗ&nbsp;<span class="text-primary" data-target-item-name></span> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" data-action="destroy" data-bs-dismiss="modal" class="btn btn-danger">Удалить</button>
            </div>
        </div>
    </div>
</div>
