@push('css')
    <link rel="stylesheet" href="{{ asset("css/jConfirm.css") }}">
@endpush
<!-- coupon section -->
<section class="course-section spad">
    <div class="container">
        <div class="section-title mb-3 mt-0">
            <h2>{{ __("Tus cupones de descuento") }}</h2>
            <a href="{{ route('teacher.coupons.create') }}" class="site-btn">
                {{ __("Crear cupon") }}
            </a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- coupons -->
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>{{ __("Código") }}</th>
                            <th>{{ __("Habilitado") }}</th>
                            <th>{{ __("Tipo") }}</th>
                            <th>{{ __("Descuento") }}</th>
                            <th>{{ __("Alta") }}</th>
                            <th>{{ __("Expiración") }}</th>
                            <th>{{ __("Acciones") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($coupons as $coupon)
                            <tr class="text-center">
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->enabled ? __("Si") : __("No") }}</td>
                                <td>{{ $coupon->discount_type }}</td>
                                <td>{{ $coupon->discount }}</td>
                                <td>{{ $coupon->created_at->format("d/m/Y") }}</td>
                                <td>{{ $coupon->expires_at ? $coupon->expires_at->format("d/m/Y") : "N/A" }}</td>
                                <td>
                                    <a
                                        class="btn btn-outline-dark"
                                        href="{{route("teacher.coupons.edit", ["coupon" => $coupon]) }}"
                                    >
                                        <i class="fa fa-pencil-square">{{ __(" Editar") }}</i>
                                    </a>
                                    <a
                                        class="btn btn-outline-danger delete-record"
                                        data-route="{{route("teacher.coupons.destroy", ["coupon" => $coupon]) }}"
                                        href="#"
                                    >
                                        <i class="fa fa-trash-o">{{ __(" Eliminar") }}</i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="7">
                                    <div class="empty-results">
                                        {!! __("No tienes ningún cupon todavía: :link", ["link" => "<a href='".route('teacher.coupons.create')."'>Crear mi primer cupón</a>"]) !!}
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
            <!-- coupon end -->

        </div>

        <div class="row">
            @if(count($coupons))
                {{ $coupons->links() }}
            @endif
        </div>
    </div>
</section>
<!-- coupon section end -->
