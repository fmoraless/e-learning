@extends('layouts.learning')

@section('hero')
    @include('partials.learning.hero_cart', ['title' => __('Finalizar mi pedido')])
@endsection

@section('content')
    @inject('cart', 'App\Services\Cart')
    <div class="container">
        @include('partials.learning.cart_content')
    </div>
@endsection
