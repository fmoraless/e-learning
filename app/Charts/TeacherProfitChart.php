<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Order;
use App\Models\OrderLine;
use Carbon\Carbon;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class TeacherProfitChart extends BaseChart
{
    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    public ?string $name = 'profit';
    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'teacher.profit';
    /**
     * Determines the prefix that will be used by the chart
     * endpoint.
     */
    public ?string $prefix = 'teacher';
    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    /**
     * @var array|string[]|null
     */
    public ?array $middlewares = ["web", "auth", "teacher"];
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     * @param Request $request
     * @return Chartisan
     */
    public function handler(Request $request): Chartisan
    {
        $from = now()->subMonth();
        $to = now();

        //Rango de fechas
        if ($request->query("from") != "null" && $request->query("to") != "null" ) {
            $from = Carbon::createFromDate($request->query("from"));
            $to = Carbon::createFromDate($request->query("to"));
        }
        $orderLines = OrderLine::with("order", "course.teacher");
        $orderLines = $orderLines->whereBetween(\DB::raw('date(created_at)'), [
            $from, $to
        ]);


        $orderLines = $orderLines->whereHas("order", function ($query) {
            $query->where("status", Order::SUCCESS);
        })
        ->whereHas("course", function ($query) {
            $query->where("user_id", auth()->id());
        })
        ->get()
        ->groupBy(function ($val) {
              return Carbon::parse($val->created_at)->format('d-m-Y');
        });

        /*\Log::info(json_encode($orderLines->toArray()));*/

        $data = [
          "labels" => [] ,
          "dataset" => []
        ];

        //Intervalos de fechas
        $interval = new \DateInterval('P1D'); //Intervalos de un día
        $to->add($interval);
        $period = new \DatePeriod($from, $interval, $to);

        /*\Log::info(json_encode($period));*/

        foreach ($period as $date) {
            $data["labels"][] = $date->format("d-m-Y");
            $data["dataset"][] = 0;
        }

        if ($orderLines->count()) {
            foreach ($orderLines as $date => $orderLine) {
                if (in_array($date, $data["labels"])) {
                    $index = array_search($date, $data["labels"]);
                    $data["dataset"][$index] = $orderLine->sum("price");
                }
            }
        }

        return Chartisan::build()
            ->labels($data["labels"])
            ->dataset(__("Beneficios"), $data["dataset"]);

    }
}
