@component('mail::message')
# Hola {{ $student->name }}
<br>
Muchas gracias por haber realizado tu pedido en {{ config('app.name') }}.
<br>
Aquí tienes los datos de tu pedido:
<br>
<ul>
    @foreach($order->order_lines as $order_line)
        <li>
            Curso: {{ $order_line->course->title }} - Precio: {{ \App\Helpers\Currency::formatCurrency($order_line->price) }}
        </li>
    @endforeach
</ul>
@component('mail::button', [
  'url' => env("APP_URL")
])
    Volver a la plataforma
@endcomponent

Atentamente,<br>
{{ config('app.name') }}
@endcomponent
