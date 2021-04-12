<thead>
<tr class="text-center">
    <th>{{ __("#ID") }}</th>
    <th>{{ __("Costo total") }}</th>
    <th>{{ __("Cupón") }}</th>
    <th>{{ __("Fecha de pedido") }}</th>
    <th>{{ __("Estado") }}</th>
    <th>{{ __("Numero de cursos") }}</th>
    @if(!$detail)
        <th>{{ __("Acciones") }}</th>
    @endif
</tr>
</thead>
