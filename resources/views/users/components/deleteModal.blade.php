<div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel"
     aria-hidden="true">
    <input type="hidden" id="userId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserLabel">Удалить сотрудника</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить сотрудника&nbsp;<span class="text-primary" data-target-full-name></span> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" data-action="destroy" data-bs-dismiss="modal" class="btn btn-danger">Удалить</button>
            </div>
        </div>
    </div>
</div>
