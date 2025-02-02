<div class="modal fade" id="deleteProfession" tabindex="-1" aria-labelledby="deleteProfessionLabel"
     aria-hidden="true">
    <input type="hidden" id="professionId">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProfessionLabel">Удалить профессию</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Вы уверены, что хотите удалить профессию <span class="text-primary" data-target-profession-name>*Профессия*</span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button data-action="destroy" type="button" class="btn btn-danger" data-bs-dismiss="modal">Удалить
                </button>
            </div>
        </div>
    </div>
</div>
