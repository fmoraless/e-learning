@extends('layouts.learning')

@section('hero')
    @include('partials.learning.hero_cart', ['title' => __('Finalizar mi pedido')])
@endsection

@section('content')
    @inject('cart', 'App\Services\Cart')
    <div class="container">
        @include('partials.learning.cart_content')

        @if($cart->hasProducts())
            <div class="row">
                <div class="col-12 mt-2 mb-2">
                    <form method="POST" action="{{ route('process_checkout') }}">
                        @csrf
                        <button type="submit" class="site-btn float-right">
                            {{ __("Pagar") }}
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
@endsection
