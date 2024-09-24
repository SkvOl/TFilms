<div class="modal fade" id="changeSessionFilmModal" tabindex="-1" aria-labelledby="changeSessionFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-c-card-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="changeSessionFilmModalLabel">Изменение сеанса</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/api/film" id="changeSessionFilmFrame" method="post" enctype="multipart/form-data" target="changeSessionFilmFrame">
                    <div class="mb-3">
                        <label for="film_start" class="form-label">Дата</label>
                        <input type="datetime-local" name="film_start" class="form-control film_start" id="change_film_start">
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">Стоимость</label>
                        <input type="cost" name="cost" class="form-control cost" id="change_cost">
                    </div>

                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" id="post" class="btn btn-outline-warning delete-session" data-bs-dismiss="modal">Удалить</button>
                    <button type="button" id="patch" class="btn btn-warning save-session" data-bs-dismiss="modal">Сохранить</button>
                </form>
            </div> 
        </div>
    </div>
</div>