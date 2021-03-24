<!-- signup section -->
<section class="signup-section spad">
    <div class="signup-bg set-bg" data-setbg="/img/signup-bg.jpg"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="signup-warp">
                    <div class="section-title text-white text-left">
                        <h2>{{ __("¿Quieres ser instructor en :app?", ["app" => env('APP_NAME')]) }}</h2>
                        <p>{{ __("Rellena el formulario y daremos de alta tu perfil de instructor en la plataforma") }}</p>
                    </div>
                    <!-- signup form -->
                    <form
                        autocomplete="off"
                        id="teacher-form"
                        class="signup-form"
                        action="{{ route('register') }}"
                        method="POST"
                    >
                        @csrf
                        <input type="hidden" name="role" value="{{ \App\Models\User::TEACHER }}">
                        <input
                            autocomplete="off"
                            name="name"
                            value="{{old("name")}}"
                            type="text"
                            placeholder="{{ __("Nombre") }}"
                        >
                        <input
                            autocomplete="off"
                            name="email"
                            value="{{old("email")}}"
                            type="text"
                            placeholder="{{ __("Correo electrónico") }}"
                        >
                        <input
                            autocomplete="off"
                            name="password"
                            type="password"
                            placeholder="{{ __("Contraseña") }}"
                        >
                        <input
                            autocomplete="off"
                            name="password_confirmation"
                            type="password"
                            placeholder="{{ __("Confirma tu contraseña") }}"
                        >
                        <button class="site-btn">{{ __("Crear cuenta de instructor") }}</button>
                    </form>
                    <div id="success-teacher-signup" class="section-title text-white text-left">

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- signup section end -->
@push("js")
    <script>
        jQuery(document).ready(function () {
           $("#teacher-form").on("click", function (e) {
               e.preventDefault()
               const fields = ['name', 'email', 'password', 'password_confirmation'];
               fields.map(field => jQuery(`#teacher-form input[name=${field}]`)
               .removeClass('field-is-invalid'));
               jQuery.ajax({
                   method:"POST",
                   url: "{{ route('register') }}",
                   data: $(this).serialize(),
                   success: function(data) {
                       const message = data.message;
                       $("#success-teacher-signup").show().html(`<p>${message}</p>`);
                       setTimeout(() => {
                           window.location.href = '/';
                       }, 3000);
                   },
                   error: function(error) {
                        const teacherForm = jQuery("#teacher-form");
                        const errors = JSON.parse(error.responseText);
                        if (errors.hasOwnProperty('errors')) {
                            for (let error in errors.errors) {
                                teacherForm
                                .find(`input[name=${error}]`)
                                .addClass('field-is-invalid');
                                if (error == 'password') {
                                    teacherForm
                                        .find(`input[name=password_confirmation]`)
                                        .addClass('field-is-invalid');
                                }
                            }
                        }
                   }
               });
           });
        });
    </script>
@endpush
