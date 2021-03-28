@if(session('message'))
    <div class="row justify-content-center mt-3 mb-0 pb-0">
        <div class="col-md-10">
            <div class="alert alert-{{ session('message')[0] }}">
                <h4 class="alert-heading">{{ __("Mensaje informativo") }}</h4>
                <p>{{ session('message')[1] }}</p>
            </div>
        </div>
    </div>
@endif
