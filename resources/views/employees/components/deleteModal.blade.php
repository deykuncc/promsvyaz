<div class="modal fade" id="deleteEmployee" tabindex="-1" aria-labelledby="deleteEmployeeLabel"
     aria-hidden="true">
    <input type="hidden" id="employeeId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteEmployeeLabel">Удалить сотрудника</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить сотрудника <span class="text-primary" data-target-employee-name>*Сотрудник*</span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button data-action="destroy" type="button" class="btn btn-danger" data-bs-dismiss="modal">Удалить
                </button>
            </div>
        </div>
    </div>
</div>
