<div class="modal fade" id="reportOrder" tabindex="-1" aria-labelledby="reportOrderLabel"
     aria-hidden="true">
    <input type="hidden" id="itemId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportOrderLabel">Печать ведомости</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Заполните данные для печати
                <div class="col mt-3">
                    <label for="untilAtReport" class="text-secondary">Остаток дней</label>
                    <input autocomplete="off" autocapitalize="off" name="untilAtReport" id="untilAtReport" type="search"
                           value="" class="form-control"
                           placeholder="30">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" data-action="openReportOrder" data-bs-dismiss="modal" class="btn btn-primary">Открыть
                </button>
            </div>
        </div>
    </div>
</div>
