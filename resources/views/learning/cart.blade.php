@extends('layouts.learning')

@section('hero')
    @include('partials.learning.hero_cart')
@endsection

@section('content')
    @inject("cart", "App\Services\Cart)
    {{--{{ $cart->getContent() }}--}}
    <div class="container">
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
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>
                                {{ __("Total :total", ["total" => $cart->totalAmount()]) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

@endsection
