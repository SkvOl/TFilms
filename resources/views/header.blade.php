<header class="bg-c-body d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4">
    <a href="/" class="nav-c-link-logo d-flex align-items-center col-md-3 mb-2 mb-md-0 text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">TFilms</span>
    </a>

    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-c-link px-2">Список фильмов</a></li>
        <li><a href="#" class="nav-c-link px-2">Профиль</a></li>
        @if($isAuthorized)
            <li><a href="#" class="nav-c-link px-2" data-bs-toggle="modal" data-bs-target="#saveFilmModal">Добавить фильм</a></li>
        @endif
    </ul>

    <div class="col-md-3 text-end">
        @if(!$isAuthorized)
            <button type="button" class="btn btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#inModal">Войти</button>
            <button type="button" class="btn btn-warning me-3" data-bs-toggle="modal" data-bs-target="#authModal">Зарегистрироваться</button>
        @else
            <button type="button" class="btn btn-outline-warning me-2 out-auth">Выйти</button>
        @endif
    </div>
</header>

