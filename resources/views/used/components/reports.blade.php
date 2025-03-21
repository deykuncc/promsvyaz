<div class="modal fade" id="report" tabindex="-1" aria-labelledby="reportLabel"
     aria-hidden="true">
    <input type="hidden" id="itemId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportLabel">Печать ведомости</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Заполните данные для печати
                <div class="col mt-3">
                    <label for="days" class="text-secondary">Номер ведомости</label>
                    <input autocomplete="off" autocapitalize="off" name="statementId" id="statementId" type="search" value="" class="form-control"
                           placeholder="78159">
                </div>
                <div class="col mt-2">
                    <label for="days" class="text-secondary">Дата ведомости</label>
                    <input autocomplete="off" autocapitalize="off" name="statementDate" id="statementDate" type="search" value="" class="form-control"
                           placeholder="365">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" data-action="openReport" data-bs-dismiss="modal" class="btn btn-danger">Открыть
                </button>
            </div>
        </div>
    </div>
</div>
