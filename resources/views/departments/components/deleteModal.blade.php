<div class="modal fade" id="deleteDepartment" tabindex="-1" aria-labelledby="deleteDepartmentLabel"
     aria-hidden="true">
    <input type="hidden" id="departmentId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDepartmentLabel">Удалить участок</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить участок <span class="text-primary" data-target-department-name>*Участок*</span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button data-action="destroy" type="button" class="btn btn-danger" data-bs-dismiss="modal">Удалить
                </button>
            </div>
        </div>
    </div>
</div>
