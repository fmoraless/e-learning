@extends('layouts.learning')

@section('hero')
    @include('partials.learning.hero_courses')
@endsection

@section('content')
    @include('learning.courses.list')
@endsection
