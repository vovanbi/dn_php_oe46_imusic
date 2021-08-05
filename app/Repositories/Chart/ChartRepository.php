<?php

namespace App\Repositories\Chart;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Charts\SongChart;
use Carbon\Carbon;
use App\Models\Song;
use Illuminate\Http\Request;

class ChartRepository extends BaseRepository implements IChartRepository
{
    public function getModel()
    {
        return Song::class;
    }

    public function songChart($data)
    {
        $time = strtotime("january");

        $time = date('m', $time) == date('m') ? $time + 365 * 86400 : $time;

        $jan = date("Y-m-d", strtotime(date("Y-m-d", $time)));
        $feb = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+1 month"));
        $mar = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+2 month"));
        $apr = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+3 month"));
        $may = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+4 month"));
        $jun = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+5 month"));
        $jul = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+6 month"));
        $aug = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+7 month"));
        $sep = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+8 month"));
        $oct = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+9 month"));
        $nov = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+10 month"));
        $dec = date("Y-m-d", strtotime(date("Y-m-d", $time) ."+11 month"));

        $janNextYear = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +12 month"));

        $chart = new SongChart;
        if ($data['time'] == "m") {
            $SongJan  = $this->model::whereBetween('created_at', [$jan, $feb])->count();
            $SongFeb  = $this->model::whereBetween('created_at', [$feb, $mar])->count();
            $SongMar  = $this->model::whereBetween('created_at', [$mar, $apr])->count();
            $SongApr  = $this->model::whereBetween('created_at', [$apr, $may])->count();
            $SongMay  = $this->model::whereBetween('created_at', [$may, $jun])->count();
            $SongJun  = $this->model::whereBetween('created_at', [$jun, $jul])->count();
            $SongJul  = $this->model::whereBetween('created_at', [$jul, $aug])->count();
            $SongAug  = $this->model::whereBetween('created_at', [$aug, $sep])->count();
            $SongSep  = $this->model::whereBetween('created_at', [$sep, $oct])->count();
            $SongOct  = $this->model::whereBetween('created_at', [$oct, $nov])->count();
            $SongNov  = $this->model::whereBetween('created_at', [$nov, $dec])->count();
            $SongDec  = $this->model::whereBetween('created_at', [$dec, $janNextYear])->count();

            $dataset = [
                $SongJan,
                $SongFeb,
                $SongMar,
                $SongApr,
                $SongMay,
                $SongJun,
                $SongJul,
                $SongAug,
                $SongSep,
                $SongOct,
                $SongNov,
                $SongDec
            ];
            $chart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
            $chart->dataset('New songs ', 'bar', $dataset)->color("#00CCCC")
                ->backgroundcolor("#00CCCC");
        }

        if ($data['time'] == 'Y') {
            $OldYear     = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " -24 month"));
            $LastYear    = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " -12 month"));
            $CurrentYear = date("Y-m-d", strtotime(date("Y-m-d", $time)));
            $NextYear    = date("Y-m-d", strtotime(date("Y-m-d", $time)  . " +12 month"));

            $SongOldYear  = $this->model::whereBetween('created_at', [$OldYear, $LastYear])->count();
            $SongLartYear = $this->model::whereBetween('created_at', [$LastYear, $CurrentYear])->count();
            $SongYear  = $this->model::whereBetween('created_at', [$CurrentYear, $NextYear])->count();

            $dataset = [
                $SongOldYear,
                $SongLartYear,
                $SongYear
            ];

            $chart->labels(['2019', '2020', '2021']);
            $chart->dataset('New songs ', 'bar', $dataset)->color("#00CCCC")
            ->backgroundcolor("#00CCCC");
        }

        if ($data['time'] == "Q") {
            $SongFirstquater  = $this->model::whereBetween('created_at', [$jan, $apr])->count();
            $SongSecondquater = $this->model::whereBetween('created_at', [$apr, $jul])->count();
            $SongThirdquater  = $this->model::whereBetween('created_at', [$jul, $oct])->count();
            $SongForthquater  = $this->model::whereBetween('created_at', [$oct, $janNextYear])->count();
            $dataset = [
                $SongFirstquater,
                $SongSecondquater,
                $SongThirdquater,
                $SongForthquater,
            ];

            $chart->labels(['First Quater', 'Second Quater', 'Third Quater', 'Forth Quater']);
            $chart->dataset('New songs ', 'bar', $dataset)->color("#00CCCC")
                ->backgroundcolor("#00CCCC");
        }

        return $chart;
    }
}
