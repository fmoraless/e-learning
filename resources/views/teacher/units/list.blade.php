@push('css')
    <link rel="stylesheet" href="/css/jConfirm.css">
@endpush
<!-- unit section -->
<section class="course-section spad">
    <div class="container">
        <div class="section-title mb-3 mt-0">
            <h2>{{ __("Tus unidades") }}</h2>
            <a href="{{ route('teacher.units.create') }}" class="site-btn">
                {{ __("Crear unidad") }}
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <div class="container">
            <table class="table">
                <thead>
                <tr class="text-center">
                    <th>{{ __("Título") }}</th>
                    <th>{{ __("Curso") }}</th>
                    <th>{{ __("Tipo") }}</th>
                    <th>{{ __("Duración") }}</th>
                    <th>{{ __("Alta") }}</th>
                    <th>{{ __("Edición") }}</th>
                    <th>{{ __("Acciones") }}</th>
                </tr>
                </thead>
                <tbody>
                    @forelse($units as $unit)
                        <tr class="text-center">
                            <td>{{ $unit->title }}</td>
                            <td>{{ $unit->course->title }}</td>
                            <td>{{ $unit->unit_type }}</td>
                            <td>{{ $unit->unit_time }}</td>
                            <td>{{ $unit->created_at->format("d/m/Y H:i") }}</td>
                            <td>{{ $unit->updated_at->format("d/m/Y") }}</td>
                            <td>
                                <a
                                    class="btn btn-outline-dark"
                                    href="{{ route('teacher.units.edit', ["unit" => $unit]) }}">
                                    <i class="fa fa-pencil-square"></i>{{ __(" Editar") }}
                                </a>
                                <a
                                    class="btn btn-outline-danger delete-record"
                                    data-route="{{ route('teacher.units.destroy', ["unit" => $unit]) }}"
                                    href="#">
                                    <i class="fa fa-trash-o"></i>{{ __(" Eliminar") }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="7">
                                <div class="empty-results">
                                    {!! __("No tienes ninguna unidad todavía: :link", ["link" => "<a href='".route('teacher.units.create')."'>Crear</a>"]) !!}
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="row">
            @if(count($units))
                {{ $units->links() }}
            @endif
        </div>
    </div>
</section>
<!-- unit section end -->
