@component('mail::message')
# Hola {{ $wishList->course->teacher->name }},
<br>
El alumno <b>{{ $wishList->user->name }}</b> ha añadido tu curso <b>{{ $wishList->course->title }}</b>
<br><br>

¡Felicidades!


@component('mail::button', [
    'url' => env('APP_URL')
])
    Volver a la plataforma
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
