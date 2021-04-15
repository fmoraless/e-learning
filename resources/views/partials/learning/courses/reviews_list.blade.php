<div class="col-12 pt-0 mt-4">
    <h2 class="text-muted">{{ __("Valoraciones") }}</h2>
    <hr>
</div>
@forelse($course->reviews as $review)
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                {{ $review->author->name }} ({{ $review->created_at->format('d/m/Y') }})
            </div>
            <div class="card-body pl-3">
                @include('partials.learning.courses.rating', ['rating' => $review->stars, 'hideCounter' => true])
                <hr>
                <div class="price"><small>{{ $review->review }}</small></div>
            </div>
        </div>
    </div>
@empty
<div class="alert alert-dark">
    <i class="fa fa-info-circle"></i>
    {{ __("Este curso taodavóa no tiene valoraciones") }}
</div>
@endforelse
