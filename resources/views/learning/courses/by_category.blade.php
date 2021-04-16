@extends('layouts.learning')

@section('hero')
    @include('partials.learning.hero_categories')
@endsection

@section('content')
    @include('learning.courses.list')
@endsection
