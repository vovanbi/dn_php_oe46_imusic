<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Song\ISongRepository;
use App\Http\Controllers\Controller;
use App\Repositories\Chart\IChartRepository;

class HomeController extends Controller
{
    protected $songRepository;
    protected $chartRepository;

    public function __construct(
        ISongRepository $songRepository,
        IChartRepository $chartRepository
    ) {
        $this->songRepository = $songRepository;
        $this->chartRepository = $chartRepository;
    }
    public function index()
    {
        $songViews = $this->songRepository->topTrending();

        return view('admin.index', ['songViews' => $songViews ]);
    }

    public function statistiSong(Request $request)
    {
        $songViews = $this->songRepository->topTrending();
        $chart = $this->chartRepository->songChart($request->all());

        return view('admin.index', ['chart' => $chart, 'songViews' => $songViews ]);
    }

    public function albumChart(Request $request)
    {
        $songViews = $this->songRepository->topTrending();
        $albumChart = $this->chartRepository->albumChart($request->all());

        return view('admin.index', compact('albumChart', 'songViews'));
    }
}
