<!-- search section -->
<section class="search-section">
    <div class="container">
        <div class="search-warp">
            <div class="section-title text-white">
                <h2>{{ __("Busca tu curso") }}</h2>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <!-- search form -->
                    <form
                        class="course-search-form"
                        action="{{ route('courses.search') }}"
                        method="POST"
                    >
                        @csrf
                        <input
                            type="text"
                            autocomplete="off"
                            value="{{ session('search[courses]') }}"
                            name="search"
                            placeholder="{{ __("¿Que curso buscas?") }}"
                        >
                        <button type="submit" class="site-btn">{{ __("Buscar cursos") }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- search section end -->
