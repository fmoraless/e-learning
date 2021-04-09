@extends('layouts.student')

@section('content')
    <div class="container py-5">
        <!---- Title --->
        <div class="row mb-4">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4">{{ __("Tus datos de pago") }}</h1>
            </div>
        </div>
        <!----END Title --->
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="bg-white rounded-lg shadow-sm p-5">
                    <!---- CREDIT CARD FORM TABS --->
                    <ul role="tablist" class="nav bg-dark text-white nav-pills rounded-pill nav-fill mb-3">
                        <li class="nav-item">
                            <a data-toggle="pill" href="#nav-tab-card" class="nav-link rounded-pill">
                                <i class="fa fa-credit-card"></i>
                                {{ __("Información de tu tarjeta en :app", ["app" => env("APP_NAME")]) }}
                            </a>
                        </li>
                    </ul>
                    <!---- END CREDIT CARD FORM TABS --->
                    <div class="content">
                        <div id="nav-tab-card" class="tab-pane fade show active">
                            <form
                                role="form"
                                action="{{ route('student.billing.process_credit_card') }}"
                                method="POST"
                            >@csrf
                                <div class="form-group">
                                    <label for="card_number">{{ __("Número de la tarjeta") }}</label>
                                    <div class="input-group">
                                        <input
                                            type="text"
                                            name="card_number"
                                            placeholder="{{ __("Número de la tarjeta") }}"
                                            class="form-control"
                                            required
                                            value="{{
                                                old('card_number') ?
                                                old('card_number') :
                                                (auth()->user()->card_last_four ? '************' . auth()->user()->card_last_four : null)
                                            }}"
                                        >
                                        <div class="input-group-append">
                                            <span class="input-group-text">
                                                <i class="fa fa-cc-visa mx-1"></i>
                                                <i class="fa fa-cc-mastercard mx-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="">
                                                <span class="hidden-xs">{{ __("Fecha expiración") }}</span>
                                            </label>
                                            <div class="input-group">
                                                <input
                                                    type="number"
                                                    placeholder="{{ __("MM") }}"
                                                    name="card_exp_month"
                                                    class="form-control"
                                                    required
                                                >
                                                <input
                                                    type="number"
                                                    placeholder="{{ __("YY") }}"
                                                    name="card_exp_year"
                                                    class="form-control"
                                                    required
                                                >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4">
                                            <label for="">{{ __("CVC") }}</label>
                                            <input type="text" name="cvc" required class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <button
                                    type="submit" class="site-btn btn-block rounded-pill shadow-sm"
                                >{{ __("Guardar tarjeta") }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
