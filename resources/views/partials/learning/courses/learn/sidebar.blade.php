<div class="col-xs-12 col-xl-3 col-md-4 col-sm-4 col-lg-3">
    <div class="card">
        <div class="card-header bg-brand text-white text-center">
            {{ __("Duración total: :time", ["time" => $course->totalTime()]) }}
        </div>
        <div class="card-body p-0">
            @php $index = 1 @endphp
            @forelse($course->units as $unit)
                @switch($unit->unit_type)
                    @case(\App\Models\Unit::SECTION)
                    <div class="bg-dark text-white p-0 text-center">
                        {{ $unit->title }}
                    </div>
                    @break
                    @case(\App\Models\Unit::ZIP)
                    <div class="card-text p-2 border-bottom unit">
                        <a
                            id="unit-{{ $index }}"
                            href="#"
                            class="text-black-50"
                            data-type="{{ \App\Models\Unit::ZIP }}"
                            data-unit="{{ $unit }}"
                            data-index="{{ $index }}"
                        >
                            <i class="fa fa-file-zip-o"></i> {{ $unit->title }}
                        </a>
                    </div>
                    @break
                    @case(\App\Models\Unit::VIDEO)
                    <div class="card-text p-2 border-bottom unit">
                        <a
                            id="unit-{{ $index }}"
                            href="#"
                            class="text-black-50"
                            data-type="{{ \App\Models\Unit::VIDEO }}"
                            data-unit="{{ $unit }}"
                            data-index="{{ $index }}"
                        >
                            <i class="fa fa-file-video-o"></i> {{ $unit->title }}
                        </a>
                    </div>
                    @break
                @endswitch
                @if($unit->unit_type !== \App\Models\Unit::SECTION)
                    @php $index++ @endphp
                @endif
            @empty
                <div class="empty-results">
                    {!! __("No hay nada todavía") !!}
                </div>
            @endforelse
        </div>
        {{-- Boton para valorar curso --}}
        @can('review', $course)
            <div class="card-footer">
                <a
                    href="{{ route('courses.reviews.create', ['course' => $course]) }}"
                    class="site-btn btn-block"
                >
                    {{ __("Valorar el curso") }}
                </a>
            </div>
        @endcan
    </div>
</div>

@push("js")
    <script>
        let index = null;
        jQuery(document).ready(function () {
            jQuery(".unit").on("click", function (e) {
                e.preventDefault();
                const link = $(this).find("a");
                $(".unit").removeClass("unit-selected");
                $(this).addClass("unit-selected");
                index = link.data("index");
                const unit = link.data("unit");
                const type = link.data("type");
                const visorHeader = $("#visor-card .card-header");
                const visorBody = $("#visor-card .card-body");
                const visorFooter = $("#visor-card .card-footer");
                const downloadText = '{{ __("Descargar") }}';
                const prevUnitText = '{{ __("Anterior unidad") }}';
                const nextUnitText = '{{ __("Siguiente unidad") }}';
                visorHeader.text(unit.title);
                if (type === '{{ \App\Models\Unit::ZIP }}') {
                    const url = `/storage/units/${unit.file}`;
                    const html = `
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="90%">${unit.file}</td>
                                <td><a href="#" onclick="window.location.href = '${url}'">${downloadText}</a></td>
                            </tr>
                        </tbody>
                    </table>
                `;
                    visorBody.html(html);
                }
                if (type === '{{ \App\Models\Unit::VIDEO }}') {
                    const html = `
                    <div class="embed-responsive embed-responsive-16by9">
                        ${unit.content}
                    </div>
               `;
                    visorBody.html(html);
                }

                let footerButtons = '';
                if ($(`#unit-${index+1}`).length) {
                    footerButtons += `
                  <button class="site-btn float-right loadNextUnit">
				  ${nextUnitText}</button>
               `;
                }
                if ($(`#unit-${index-1}`).length) {
                    footerButtons += `
                  <button class="site-btn float-left loadPrevUnit">
				  ${prevUnitText}</button>
               `;
                }
                visorFooter.html(footerButtons);
            });

            const visor = $("#visor-card");
            visor.on("click", ".loadNextUnit", function () {
                const nextIndex = index += 1;
                $(`#unit-${nextIndex}`).click();
            });
            visor.on("click", ".loadPrevUnit", function () {
                const prevIndex = index -= 1;
                $(`#unit-${prevIndex}`).click();
            });
        })
    </script>
@endpush



