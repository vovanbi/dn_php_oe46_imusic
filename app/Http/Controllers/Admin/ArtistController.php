<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;
use App\Http\Requests\ArtistRequest;
use Illuminate\Support\Facades\File;
use Throwable;

class ArtistController extends Controller
{

    public function index()
    {
        $artists = Artist::getAll()->paginate(config('app.paginate_num'));

        return view('admin.artist.index', compact('artists', $artists));
    }

    public function create()
    {
        return view('admin.artist.create');
    }

    public function store(ArtistRequest $request)
    {
        $this->insertOrUpdate($request);

        return redirect()->route('artist.index')->with('susccess', trans('artist.susccessAdd'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            $artist = Artist::findOrFail($id);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('artist.Noupdate'));
        }

        return view('admin.artist.update', compact('artist'));
    }

    public function update(Request $request, $id)
    {
        $this->insertOrUpdate($request, $id);

        return redirect()->route('artist.index')->with('susccess', trans('artist.susccessUpdate'));
    }

    public function insertOrUpdate($request, $id = null)
    {
        $artist = new Artist();
        if (is_null($id)) {
            $artist->name = $request->name;
            $artist->info = $request->info;
            $image = $request->avatar;
            $image_path = 'image_artist/' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('/storage/image_artist');
            $image->move($path, $image_path);
            $artist->avatar = $image_path;
            $artist->save();
        } else {
            try {
                $artist = Artist::findOrFail($id);
                $artist->name = $request->name;
                $artist->info = $request->info;
                $image = $request->avatar;
                $image_path = 'image_artist/' . time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('/storage/image_artist');
                $image->move($path, $image_path);
                $artist->avatar = $image_path;
                $artist->save();
            } catch (Throwable $e) {
                return redirect()->back()->with('danger', trans('artist.Noadd'));
            }
        }
    }

    public function destroy($id)
    {
        try {
            $artist = Artist::destroy($id);

                return response()->json([
                    'error' => false,
                    'artist' => $artist
                ], 200);
        } catch (Throwable $e) {
            return redirect()->back()->with('danger', trans('artist.Nodelete'));
        }
    }
}
