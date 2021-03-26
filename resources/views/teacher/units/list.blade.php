<!-- unit section -->
<section class="course-section spad">
    <div class="container">
        <div class="section-title mb-3 mt-0">
            <h2>{{ __("Tus unidades") }}</h2>
            <a href="{{ route('teacher.units.create') }}" class="site-btn">
                {{ __("Crear unidad") }}
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <div class="row">
            @if(count($units))
                {{ $units->links() }}
            @endif
        </div>
    </div>
</section>
<!-- unit section end -->
