<tr class="text-center">
    <td>{{ $order->id }}</td>
    <td>{{ $order->formatted_total_amount }}</td>
    <td>{{ $order->coupon_code }}</td>
    <td>{{ $order->created_at->format("d/m/Y") }}</td>
    <td>{{ $order->formatted_status }}</td>
    <td>{{ $order->order_lines_count }}</td>
    @if(!$detail)
        <td>
            <a class="btn btn-outline-dark" href="{{ route('student.orders.show', ['order' => $order]) }}">
                <i class="fa fa-eye"></i>{{ __("Ver detalle") }}
            </a>
        </td>
    @endif
</tr>
