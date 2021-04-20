<nav class="navbar navbar-expand-lg navbar-dark bg-brand">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="{{ route('student.courses') }}">{{ __("Cursos") }}</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link text-white" href="{{ route('student.orders') }}">{{ __("Facturas") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('student.billing.credit_card_form') }}">{{ __("Datos de pago") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">{{ __("Valoraciones") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="#">{{ __("Certificados") }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('student.wishlist.me') }}">{{ __("Lista de deseos") }}</a>
            </li>
        </ul>
        <ul class="navbar-text">
            <a class="nav-link" href="{{ route('welcome') }}">{{ __("Volver al frontal") }}</a>
        </ul>
    </div>
</nav>
