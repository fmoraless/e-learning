@extends('layouts.learning')

@section('hero')
    @include('partials.learning.hero')
@endsection

@section('content')
    @include('partials.learning.categories')

    @include('partials.learning.search')

    @include('partials.learning.featured_courses')

    @include('partials.learning.signup_teacher')

    @include('partials.learning.join')
@endsection
