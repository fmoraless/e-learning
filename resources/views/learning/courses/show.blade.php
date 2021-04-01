@extends('layouts.learning')

@section('hero')
    @include('partials.learning.courses.hero_single_course')
@endsection

@section('content')
    @include('learning.courses.single')
@endsection
