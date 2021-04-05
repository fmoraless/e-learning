<div class="row">
    <div class="table-responsive pt-5 mt-5">
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
            <tr>
                <th>{{ __("Curso") }}</th>
                <th>{{ __("Precio") }}</th>
                <th>{{ __("Acciones") }}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($cart->getContent() as $course)
                <tr>
                    <td>{{ $course->title }}</td>
                    <td>{{ $course->formatted_price }}</td>
                    <td>
                        <a href="{{ route("remove_course_from_cart", ["course" => $course]) }}"
                           class="btn btn-outline-danger"
                        >
                            {{ __("Eliminar") }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="empty-results">
                            {!! __("No tienes ningun curso en el carrito.") !!}
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
            <tfoot class="bg-dark brand-text font-weight-bold">
            <tr>
                <td colspan="2">
                    @include("partials.learning.courses.coupon_form")
                </td>
                <td>
                    <div class="pt-2" style="font-size: 25px">
                        {{ __("Total :total", ["total" => $cart->totalAmount()]) }}
                    </div>
                </td>
            </tr>
            @if(session()->has("coupon"))
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td>
                        <div class="pt-2" style="font-size: 25px">
                            {{ __("Con descuento total :total", ["total" => $cart->totalAmountWithDiscount()]) }}
                        </div>
                    </td>
                </tr>
            @endif
            </tfoot>
        </table>
    </div>
</div>

