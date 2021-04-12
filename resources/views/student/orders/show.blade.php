@extends("layouts.student")

@section("content")
<section class="course-section spad">
    <div class="container">
        <div class="section-title mb-4 mt-0 pt-0">
            <h2>{{ __("Detalle del pedido #:id#", ["id" => $order->id]) }}</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    @include("partials.student.orders.order_thead", ["detail" => true])
                    <tbody>
                    @include("partials.student.orders.order_row", ["detail" => true])
                    </tbody>
                </table>

                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th>{{ __("Curso") }}</th>
                            <th>{{ __("Precio") }}</th>
                            <th>{{ __("Acciones") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->order_lines as $line)
                        <tr class="text-center">
                            <td>{{ $line->course->title }}</td>
                            <td>{{ $line->formatted_price }}</td>
                            <td>
                                <a href="{{ route('courses.show', ['course' => $line->course]) }}">
                                    {{ __("Ir al curso") }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <a href="{{ route('student.orders.download_invoice',["order" => $order]) }}" class="site-btn">
                {{ __("Descargar factura") }}
            </a>
        </div>
    </div>
</section>
@endsection
