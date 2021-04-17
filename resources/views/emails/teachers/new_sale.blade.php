@component('mail::message')
# Hola {{ $teacher->name }}
<br>
El alumno <b>{{ $student->name }}</b> ha ha comprado tu curso <b>{{ $course->title }}</b> por el importe <b>{{ \App\Helpers\Currency::formatCurrency($course->price) }}</b>.
<br><br>
Felicidades
<br>

@component('mail::button', [
  'url' => env("APP_URL")
])
    Volver a la plataforma
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
