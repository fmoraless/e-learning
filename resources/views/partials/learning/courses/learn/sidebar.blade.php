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
                @if($unit->unit_type !== \App\Models\Unit::SECTION )
                    @php $index++ @endphp
                @endif
            @empty
                <div class="empty-results">
                    {!! __("No hay nada todavía") !!}
                </div>
            @endforelse
        </div>
    </div>
</div>

@push("js")
    <script>
        let index = null;
        jQuery(document).ready(function () {
            jQuery(".unit").on("click", function (e) {
               e.preventDefault();
               const link = $(this).find("a");
               /*const type = link.data("type");
               const unit = link.data("unit");
               console.log(type);
               console.log(unit);*/
                $(".unit").removeClass("unit-selected");
                $(this).addClass("unit-selected");
                index = link.data("index");
            });
        });
    </script>
@endpush
