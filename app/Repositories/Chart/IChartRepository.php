<?php

namespace App\Repositories\Chart;

interface IChartRepository
{
    public function songChart($data);
    public function albumChart($data);
}
