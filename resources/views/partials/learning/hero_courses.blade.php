<!-- Hero section -->
<section class="hero-section set-bg" data-setbg="/img/bg.jpg">
    <div class="container">
        <div class="hero-text text-white">
            <h2>{{ __("Los mejores cursos de programación online") }}</h2>
            <p>
                {!! __("En <span class='brand-text'>:app</span> podrás evolucionar rápido con los mejores expertos", [
                    'app' => env('APP_NAME')
                ]) !!}
            </p>
        </div>
        @include('partials.learning.search')
    </div>
</section>
<!-- Hero section end -->
