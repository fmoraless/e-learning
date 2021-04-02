<div class="row p-5">
    <div class="col-xs-12 col-xl-9 col-md-8 col-sm-8 col-lg-9">
        <p>{!! $course->description !!}</p>

        @include("partials.learning.courses.curriculum.index")
    </div>
    <div class="col-xs-12 col-xl-3 col-md-4 col-sm-4 col-lg-3">
        sidebar
    </div>
</div>
