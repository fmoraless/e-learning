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
                <div class="mix col-lg-3 col-md-4 col-sm-6 @foreach($course->categories as $category) {{ $category->name }} @endforeach">
                    <div class="course-item">
                        <div class="course-thumb set-bg" data-setbg="{{ $course->imagePath() }}">
                            <div class="price">{{ __("Precio:price $", ["price" => $course->price]) }}</div>
                        </div>
                        <div class="course-info">
                            <div class="course-text">
                                <h5>{{ $course->title }}</h5>
                                <div class="students">{{ __(":count Estudiantes", ['count' => $course->students_count]) }}</div>
                            </div>
                            <div class="course-author">
                                <div class="ca-pic set-bg" data-setbg="/img/authors/1.jpg"></div>
                                <p>{{ $course->teacher->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
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
