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
                        @include('partials.student.orders.order_thead', ["detail" => false])
                        <tbody>
                            @forelse($orders as $order)
                                @include('partials.student.orders.order_row', ["detail" => false])
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
