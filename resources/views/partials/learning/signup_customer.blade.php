@if(!session('error-login'))
    @include('partials.form_errors')
@endif

<form class="intro-newslatter text-center" action="{{ route('register') }}" method="POST">
    @csrf
    <input type="hidden" name="role" value="{{ \App\Models\User::STUDENT }}">
    <div class="row justify-content-center">
        <div class="col-12 mb-3">
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="{{ __("Nombre") }}"
            />
            <input
                type="text"
                name="email"
                class="last-s"
                value="{{ old('email') }}"
                placeholder="{{ __("Correo electrónico") }}"
            />
        </div>
        <div class="col-12 no-gutters">
            <input
                type="password"
                name="password"
                placeholder="{{ __("Contraseña") }}"
            />
            <input
                type="password"
                name="password_confirmation"
                class="last-s"
                placeholder="{{ __("Confirma la contraseña") }}"
            />
        </div>
        <div class="col-lg-12 mt-3">
            <button type="submit" class="site-btn btn-block">{{ __("Crear cuenta") }}</button>
        </div>
    </div>
</form>
