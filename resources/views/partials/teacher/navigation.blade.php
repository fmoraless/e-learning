<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link brand-text" href="{{ route('teacher.courses') }}">{{ __("Cursos") }}</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link brand-text" href="{{ route('teacher.units') }}">{{ __("Unidades") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link brand-text" href="{{ route('teacher.coupons') }}">{{ __("Cupones") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link brand-text" href="#">{{ __("Alumnos") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link brand-text" href="#">{{ __("Valoraciones") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link brand-text" href="#">{{ __("Promociones") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link brand-text" href="{{ route('teacher.profits') }}">{{ __("Ganancias") }}</a>
            </li>
        </ul>
        <ul class="navbar-text">
            <a class="nav-link" href="{{ route('welcome') }}">{{ __("Volver al frontal") }}</a>
        </ul>
    </div>
</nav>
