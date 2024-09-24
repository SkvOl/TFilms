<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-c-card-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="authModalLabel">Зарегистрироваться</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/api/film" id="inForm" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text" name="login" class="form-control auth-login" id="login">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="text" name="password" class="form-control auth-password" id="password">
                    </div>

                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Закрыть</button>
                    <button type="button" id="post" class="btn btn-warning auth-button" data-bs-dismiss="modal">Сохранить</button>
                </form>
            </div> 
        </div>
    </div>
</div>