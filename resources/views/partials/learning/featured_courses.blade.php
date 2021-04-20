<!-- course section -->
<section class="course-section spad">
    <div class="container">
        <div class="section-title mb-0">
            <h2>{{ __("Cursos destacados") }}</h2>
            <p>{{ __("Aquí tienes los cursos destacados de la plataforma.") }}</p>
        </div>
    </div>
    <div class="course-warp">
        <ul class="course-filter controls">
            <li class="control active" data-filter="all">{{ __("Todos") }}</li>
            @forelse($categories as $category)
                <li class="control" data-filter=".{{ $category->name }}">
                    {{ $category->name }}
                </li>
            @empty
                <div class="empty-results">
                    {!! __("No hay categorías disponibles") !!}
                </div>
            @endforelse
        </ul>
        <div class="row course-items-area">
            @forelse($featuredCourses as $course)
            <!-- course -->
            @include('partials.learning.courses.single')
            @empty
                <div class="empty-results">
                    {!! __("No hay cursos destacados disponibles") !!}
                </div>
            @endforelse
            <!-- course -->

        </div>
    </div>
</section>
<!-- course section end -->
