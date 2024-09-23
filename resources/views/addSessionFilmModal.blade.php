<div class="modal fade" id="saveSessionFilmModal" tabindex="-1" aria-labelledby="saveSessionFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-c-card-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="saveSessionFilmModalLabel">Добавление сеанса</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/api/film" id="saveSessionFilmFrame" method="post" enctype="multipart/form-data" target="saveSessionFilmFrame">
                    <div class="mb-3">
                        <label for="film_start" class="form-label">Дата</label>
                        <input type="datetime-local" name="film_start" class="form-control" id="film_start">
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">Стоимость</label>
                        <input type="cost" name="cost" class="form-control" id="cost">
                    </div>

                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-warning save-session" data-bs-dismiss="modal">Сохранить</button>
                </form>
            </div> 
        </div>
    </div>
</div>