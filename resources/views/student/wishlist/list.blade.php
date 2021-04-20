<!-- wishlist section -->
<section class="course-section spad">
    <div class="container">
        <div class="section-title mb-3 mt-0">
            <h2>{{ __("Tu lista de deseos") }}</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>{{ __("") }}</th>
                            <th>{{ __("Curso") }}</th>
                            <th>{{ __("Comprar") }}</th>
                            <th>{{ __("Eliminar") }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($wishlist as $item)
                        <tr>
                            <td class="align-middle">
                                <img width="200" src="{{ $item->course->imagePath() }}" class="img-fluid">
                            </td>
                            <td class="align-middle">{{ $item->course->title }}</td>
                            <td class="align-middle">
                                <a href="{{ route('add_course_to_cart', ["course" => $item->course]) }}"
                                    class="site-btn"
                                >
                                    {{ __("Tomar el curso por :price", ["price" => $item->course->formatted_price]) }}
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('student.wishlist.destroy', ["id" => $item->id]) }}"
                                   class="btn btn-outline-danger btn-lg"
                                >
                                    {{ __("Eliminar de la lista") }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="4">
                                <div class="empty-results">
                                    {!! __("No tienes ningun curso en tu lista de deseos,") !!}
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            @if(count($wishlist))
                {{ $wishlist->links() }}
            @endif
        </div>
    </div>
</section>
<!-- end wishlist section -->
