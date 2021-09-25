<div class="p-5">
    <div class="row">
        <div class="col-5">
            {{ Form::date("from", null, ["class" => "form-control", "id" => "from"]) }}
        </div>
        <div class="col-5">
            {{ Form::date("to", null, ["class" => "form-control", "id" => "to"]) }}
        </div>
        <div class="col-2">
            <button class="btn btn-sm btn-dark btn-block p-2" onclick="filter.clear()">{{ __("Limpiar") }}</button>
        </div>
    </div>
    <div id="chart" style="height: 300px;"></div>

</div>

@push("js")
    <!-- Charting library -->
    <script src="https://unpkg.com/chart.js@^2.9.3/dist/Chart.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/chartjs@^2.1.0/dist/chartisan_chartjs.umd.js"></script>
    <script>
        let from = null, to = null, fromVal = null, toVal = null;

        const chart = new Chartisan({
           el: '#chart',
           url: `/api/chart/teacher/profit/?from=${fromVal}&to=${toVal}`,
            hooks: new ChartisanHooks()
                .colors(['#f1094a', '#041a2c'])
                .responsive()
                .beginAtZero()
                .legend({
                    position: 'bottom'
                 })
                .title('{{ __("Aqui tienes tus derechos en :app", ["app" => env("APP_NAME")]) }}')
                .datasets([{type: 'line', fill: true}])
            .tooltip({
                callbacks: {
                    label: function (data) {
                        return `Beneficios: ${data.value} $`;
                    }
                }
            })
        });
        const filter = {
            setFrom: (val) => {
                if (!val) return;
                const toInput = $("#to");
                toVal = toInput.val();
                from = new Date(val);
                //si hemos cambiado la fecha hasta
                if (to) {
                    //la fecha inicial tiene que ser inferior a la fecha final.
                    if (to.getTime() < from.getTime()) {
                        toInput.val(val);
                        $("#from").val(toVal);
                    }
                    filter.search();
                }
            },
            setTo: (val) => {
                if (!val) return;
                const fromInput = $("#from");
                fromVal = fromInput.val();
                to = new Date(val);
                //si hemos cambiado la fecha hasta
                if (from) {
                    //la fecha inicial tiene que ser inferior a la fecha final.
                    if (to.getTime() < from.getTime()) {
                        fromInput.val(val);
                        $("#to").val(fromVal);
                    }
                    filter.search();
                }
            },
            clear: () => {
                to = null;
                from = null;
                $("#to, #from").val(null);
                chart.update({
                    url: `/api/chart/teacher/profit/?from=null&to=null`
                });
            },
            search: () => {
                chart.update({
                   url: `/api/chart/teacher/profit/?from=${$("#from").val()}&to=${$("#to").val()}`
                });
            }
        }

        jQuery(document).ready(function () {
           $("#from").on("input", function () {
               const thisVal = $(this).val();
               filter.setFrom(thisVal);
           });
            $("#to").on("input", function () {
                const thisVal = $(this).val();
                filter.setTo(thisVal);
            });

        });
    </script>
@endpush
