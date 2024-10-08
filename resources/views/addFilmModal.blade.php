<div class="modal fade" id="saveFilmModal" tabindex="-1" aria-labelledby="saveFilmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-c-card-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="saveFilmModalLabel">Добавление фильма</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="get" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Название</label>
                        <input type="text" name="name" class="form-control name" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Изображение</label>
                        <input type="file" name="photo" class="form-control photo" id="photo">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <input type="text" name="description" class="form-control description" id="description">
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Продолжительность</label>
                        <input type="time" name="duration" class="form-control duration" id="duration">
                    </div>
                    <div class="mb-3">
                        <label for="age_restrictions" class="form-label">Возрастное ограничение</label>
                        <input type="text" name="age_restrictions" class="form-control age_restrictions" id="age_restrictions">
                    </div>

                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" id="post" class="btn btn-warning save-film" data-bs-dismiss="modal">Сохранить</button>
                </form>
            </div> 
        </div>
    </div>
</div>
