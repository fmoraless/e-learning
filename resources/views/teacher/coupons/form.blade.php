<section class="courses-section spad">
    <div class="section-title mb-3">
        <h2>{{ $title }}</h2>
        <a href="{{ route('teacher.coupons') }}" class="site-btn">
            {{ __("Volver al listado de cupones") }}
        </a>
    </div>
    <div class="container">
        @include('partials.form_errors')


        {!! Form::model($coupon, $options) !!}
            @isset($update)
                @method("PUT")
            @endisset


        <div class="form-group">
            {!! Form::label('code', __("Código")) !!}
            {!! Form::text('code', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('courses[]', __("Selecciona los cursos")) !!}
            {!! Form::select('courses[]', \App\Models\Course::pluck("title", "id"), null, ["class" => "form-control", "multiple" => true]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('discount_type', __("Escoge el tipo de descuento")) !!}
            {!! Form::select('discount_type', [\App\Models\Coupon::discountTypes()], null, ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('discount', __("Escoge un descuento para tus cursos.")) !!}
            {!! Form::text('discount', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('enabled', __("¿Está habilitado?")) !!}
            {!! Form::select('enabled', [
                    0 => __("No"),
                    1 => __("Sí"),
                ], null, ['class' => 'form-control'])
            !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', __("Añade una descripción a tu cupón.")) !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', "rows" => 3]) !!}
        </div>
        <div class="form-group">
            {!! Form::label('expires_at', __("Expira")) !!}
            {!! Form::date('expires_at', $coupon->expires_at, ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit($textButton, ['class' => 'site-btn mt-2 float-right']) !!}

        {!! Form::close() !!}
    </div>
</section>

