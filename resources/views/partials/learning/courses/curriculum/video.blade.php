<div class="card-text">
    <p class="pl-2 pt-1 pb-0 mb-0">
        {{ $unit->title }}
        <span class="float-right mr-2">
            <i class="fa-1x fa fa-file-video-o"></i>
        </span>
        <span class="badge badge-dark float-right mr-1 mt-2">
            {{ __(":duration minutos", ["duration" => $unit->unit_time]) }}
        </span>
        @if($unit->free)
            <span class="badge badge-success float-right mr-1 mt-2">
                {{ __("Gratis") }}
            </span>
        @endif
    </p>
</div>
