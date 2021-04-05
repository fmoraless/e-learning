@extends('layouts.learning')

@section('hero')
    @include('partials.learning.hero_cart')
@endsection

@section('content')
    @inject("cart", "App\Services\Cart)
    {{--{{ $cart->getContent() }}--}}
    <div class="container">
        @include('partials.learning.cart_content')

        @if($cart->hasProducts())
            <div class="row">
                <div class="col-12 mb-5">
                    <a href="{{ route('checkout-form') }}" class="site-btn float-right">
                        {{ __("Procesar pedido") }}
                    </a>
                </div>
            </div>
        @endif
    </div>

@endsection
