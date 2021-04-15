@extends('layouts.learning')

@section('hero')
    @include('partials.learning.courses.hero_single_course')
@endsection

@section('content')
    @include('learning.courses.single')

    <hr>
    <div class="row pt-1 pb-4 px-5">
        @include('partials.learning.courses.reviews_list')
    </div>
@endsection
