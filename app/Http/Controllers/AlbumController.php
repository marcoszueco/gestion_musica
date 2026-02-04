<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $albums = Album::with('user')->paginate(15);
        return view('album.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Si llega aquí, los datos ya son válidos
        $validated = $request->validated();
        Album::create($validated);

        return redirect()->route('album.index')->with('success', 'Álbum creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
        return view('album.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
        return view('album.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Album $album)
    {
        //
        $album->update($request->validated());

        return redirect()->route('album.index')->with('success', 'Álbum actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
        $album->delete();
        return redirect()->route('album.index')->with('success', 'Álbum eliminado con éxito.');
    }
}
