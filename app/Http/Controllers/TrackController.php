<?php


namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Track;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use function Termwind\render;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Http\Client\Request as ClientRequest;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::where('display', true)->orderBy('title')->get();

        return Inertia::render(('Track/Index'), [
            'tracks' => $tracks,
        ]);
    }

    public function create()
    {
        return Inertia::render('Track/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['string', 'required'],
            'artist' => ['string', 'required'],
            'image' => [
                'image',
                'required',
            ],
            'music' => [
                'file',
                'required',
                File::types(['mp3', 'wav'])
            ],
            'display' => ['boolean', 'required']
        ]);

        $uuid = 'trk-'. Str::uuid();
        $extensionImg = $request->image->extension();
        $imagePath = $request->image->storeAs('tracks/images', $uuid. '.'. $extensionImg);

        $extensionVid = $request->music->extension();
        $musicPath = $request->music->storeAs('tracks/musics', $uuid. '.'. $extensionVid);

        Track::create([
            'uuid'=> $uuid,
            'title'=> $request->title,
            'artist'=> $request->artist,
            'display'=> $request->display,
            'image'=> $imagePath,
            'music'=> $musicPath
        ]);

        return redirect()->route('tracks.index');
    }
}
