<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use App\Http\Requests\ArtistRequest;
use Illuminate\Support\Facades\File;
use Throwable;
use Illuminate\Support\Facades\DB;
use App\Repositories\Artist\ArtistRepository;

class ArtistController extends Controller
{
    protected $artistRepository;
    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }
    public function index()
    {
        $artists =$this->artistRepository->showAll();

        return view('admin.artist.index', compact('artists'));
    }

    public function create()
    {
        return view('admin.artist.create');
    }

    public function store(ArtistRequest $request)
    {
        $this->artistRepository->create($request->all());

        return redirect()->route('artist.index')->with('susccess', trans('artist.susccessAdd'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $artist = $this->artistRepository->findOrFail($id);

            return view('admin.artist.update', compact('artist'));
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('artist.Noupdate'));
        }
    }

    public function update(Request $request, $id)
    {
        $this->artistRepository->update($id, $request->all());

        return redirect()->route('artist.index')->with('susccess', trans('artist.susccessUpdate'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $this->artistRepository->destroy($id);
            DB::commit();

            return response()->json([
                'error' => false,
            ], 200);
        } catch (Throwable $e) {
            DB::rollBack();
            return redirect()->back()->with('danger', trans('artist.Nodelete'));
        }
    }
}
