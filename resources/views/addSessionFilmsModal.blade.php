<div class="modal fade" id="saveSessionFilmsModal" tabindex="-1" aria-labelledby="saveSessionFilmsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-c-card-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="saveSessionFilmsModalLabel">Добавление сеанса</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/api/film" id="saveSessionFilmsFrame" method="post" enctype="multipart/form-data" target="saveSessionFilmsFrame">
                    <div class="mb-3">
                        <label for="select-films" class="form-label">Фильм</label>
                        <select class="form-control " id="select-films">
                            @foreach ($films as $film)
                                <option id="{{$film['film_id']}}" value="{{$film['film_id']}}" class="exist-film-id">{{$film['name']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="film_start" class="form-label">Дата</label>
                        <input type="datetime-local" name="film_start" class="form-control film_start" id="film_start">
                    </div>
                    <div class="mb-3">
                        <label for="cost" class="form-label">Стоимость</label>
                        <input type="cost" name="cost" class="form-control cost" id="cost">
                    </div>

                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" id="post" class="btn btn-warning save-session" data-bs-dismiss="modal">Сохранить</button>
                </form>
            </div> 
        </div>
    </div>
</div>