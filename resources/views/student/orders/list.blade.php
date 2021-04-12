<!-- order section -->
<section class="order-section spad">
    <div class="container">
        <div class="section-title mb-3 mt-0">
            <h2>{{ __("Tus Pedidos procesados") }}</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- order -->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="text-center">
                                <th>{{ __("#ID") }}</th>
                                <th>{{ __("Costo total") }}</th>
                                <th>{{ __("Cupón") }}</th>
                                <th>{{ __("Fecha de pedido") }}</th>
                                <th>{{ __("Estado") }}</th>
                                <th>{{ __("Numero de cursos") }}</th>
                                <th>{{ __("Acciones") }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr class="text-center">
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->formatted_total_amount }}</td>
                                    <td>{{ $order->coupon_code }}</td>
                                    <td>{{ $order->created_at->format("d/m/Y") }}</td>
                                    <td>{{ $order->formatted_status }}</td>
                                    <td>{{ $order->order_lines_count }}</td>
                                    <td>
                                        <a class="btn btn-outline-dark" href="#">
                                            <i class="fa fa-eye"></i>{{ __("Ver detalle") }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <div class="text-center">
                                    <td colspan="7">
                                        <div class="empty-results">
                                            {!! __("No tienes ningún pedido todavía: :link", ["link" => "<a href='".route('orders.index')."'>Ver pedidos</a>"]) !!}
                                        </div>
                                    </td>
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- order end -->
        </div>

        <div class="row">
            @if(count($orders))
                {{ $orders->links() }}
            @endif
        </div>
    </div>
</section>
<!-- order section end -->
