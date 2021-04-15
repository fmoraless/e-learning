@extends('layouts.learning')

@section('hero')
    @include('partials.learning.courses.hero_single_course')
@endsection
@section('content')
    <div class="container">
        <div id="review-card" class="col-xs-12 p-5">
            <div class="card">
                <div class="card-header text-center">
                    {{ __("Añade una valoracion al curso") }}
                </div>
            </div>
            <div class="card-body">
                @include("partials.form_errors")
                <form
                    method="POST"
                    action="{{ route('courses.reviews.store', ['course' => $course]) }}"
                    id="rating_form"
                >@csrf
                    <input type="hidden" name="stars" value="1">
                    <div class="row">
                        <div class="col-12 text-center">
                            <ul id="list_rating" class="list-inline" style="font-size: 40px;">
                                <li class="list-inline-item star" data-number="1">
                                    <i class="fa fa-star yellow"></i>
                                </li>
                                <li class="list-inline-item star" data-number="2">
                                    <i class="fa fa-star"></i>
                                </li>
                                <li class="list-inline-item star" data-number="3">
                                    <i class="fa fa-star"></i>
                                </li>
                                <li class="list-inline-item star" data-number="4">
                                    <i class="fa fa-star"></i>
                                </li>
                                <li class="list-inline-item star" data-number="5">
                                    <i class="fa fa-star"></i>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <textarea
                                placeholder="{{ __("Escriba una reseña") }}"
                                name="review"
                                id="review" rows="4"
                                class="form-control"
                            >
                            </textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <button type="submit" class="site-btn btn-block text-white">
                                <i class="fa fa-space-shuttle"></i>
                                {{ __("Valorar curso") }}
                            </button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <a href="{{ route('courses.learn', ["course" => $course]) }}"
                               class="btn btn-dark btn-lg p-2 btn-block text-white"
                            >
                                <i class="fa fa-arrow-left"></i>
                                {{ __("Volver curso") }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push("js")
    <script>
        jQuery(document).ready(function () {
            const ratingSelector = jQuery('#list_rating');
            ratingSelector.find('li').on('click', function () {
               const number = $(this).data('number');
               $("#rating_form").find('input[name=stars]').val(number);
               ratingSelector.find('li i').removeClass('yellow').each(function (index) {
                  if ((index + 1) <= number){
                      $(this).addClass('yellow');
                  }
               });
            });
        });
    </script>
@endpush
