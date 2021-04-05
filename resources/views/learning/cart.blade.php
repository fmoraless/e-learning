@extends('layouts.learning')

@section('hero')
    @include('partials.learning.hero_cart')
@endsection

@section('content')
    @inject("cart", "App\Services\Cart)
    {{--{{ $cart->getContent() }}--}}
    <div class="container">
        @include('partials.learning.cart_content')
    </div>

@endsection
