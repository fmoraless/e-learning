@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endpush

<!-- units section -->
<section class="units-section spad">
    <div class="section-title mb-3">
        <h2>{{ $title }}</h2>
        <a href="{{ route('teacher.units') }}" class="site-btn">
            {{ __("Volver al listado de unidades") }}
        </a>
    </div>

    <div class="container">
        @include("partials.form_errors")
        {{ Form::model($unit, $options) }}
        @isset($update)
            @method("PUT")
        @endisset

        <div class="form-group">
            {!! Form::label('title', __("Título")) !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('course_id', __("Selecciona el curso")) !!}
            {!! Form::select('course_id', $courses->pluck("title", "id"), null, ["class" => "form-control"]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('free', __("¿Unidad gratuita?")) !!}
            {!! Form::select('free', [
                    0 => __("No"),
                    1 => __("Sí"),
                ], null, ["class" => "form-control"])
            !!}
        </div>

        <div class="form-group">
            {!! Form::label('unit_type', __("Tipo de unidad")) !!}
            {!! Form::select('unit_type', [
                    \App\Models\Unit::VIDEO => __("Vídeo"),
                    \App\Models\Unit::ZIP => __("Archivo comprimido"),
                    \App\Models\Unit::SECTION => __("Sección")
                ], null, ["class" => "form-control"])
            !!}
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </div>
                    {!! Form::number('unit_time', null, ['class' => 'form-control', 'placeholder' => __("Duración de la unidad si es vídeo")]) !!}
                </div>

            </div>
        </div>

        <div class="form-group">
            {!! Form::label('content', __("Añade el contenido, por ejemplo, el iframe de Vimeo")) !!}
            {!! Form::textarea('content', old('content') ?? $unit->content, ['id' => 'summernote']) !!}
        </div>

        <div class="custom-file">
            {!! Form::file('file', ['class' => 'custom-file-input', 'id' => 'file']) !!}
            {!! Form::label('file', __("Escoge un archivo"), ['class' => 'custom-file-label']) !!}
        </div>

        {!! Form::submit($textButton, ['class' => 'site-btn mt-2 float-right']); !!}

        {{ Form::close() }}
    </div>
</section>
<!-- units end section -->

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
            });
        });
    </script>
@endpush
