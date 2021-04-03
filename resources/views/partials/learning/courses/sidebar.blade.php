<div class="card" id="course-sidebar">
    <div class="card-header bg-dark text-white text-center">
        {{ __("Informacion del curso") }}
    </div>
    <div class="card-body">
        <div class="card-text">
            {!! __("Fecha de publicación: <span class='badge badge-dark float-right'>:created_at</span>",
                ["created_at" => $course->created_at->format("d/m/Y")])
            !!}
        </div>
        <div class="card-text">
            {!! __("Unidades de archivos: <span class='badge badge-dark float-right'>:units</span>",
                ["units" => $course->totalFileUnits()])
            !!}
        </div>
        <div class="card-text">
            {!! __("Unidades de video: <span class='badge badge-dark float-right'>:units</span>",
                ["units" => $course->totalVideoUnits()])
            !!}
        </div>
        <div class="card-text">
            {!! __("Duración: <span class='badge badge-dark float-right'>:time</span>",
                ["time" => $course->totalTime()])
            !!}
        </div>
    </div>
    <div class="card-footer">
<!--        <a href="{{ route("add_course_to_cart", ["course" => $course]) }}" class="site-btn btn-block">
            {{ __("Tomar el curso") }}
        </a>-->
        @include("partials.learning.courses.purchase_button")
    </div>
</div>
