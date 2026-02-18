<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Rating;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'score' => 'required|integer|min:1|max:5',
        ]);

        // Usamos updateOrCreate para que un usuario no vote dos veces al mismo álbum
        // Guardamos el resultado en una variable para inspeccionarla
        $voto = Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'album_id' => $request->album_id
            ],
            [
                'score' => $request->score
            ]
        );

        // PRUEBA DE FUEGO: Si el código llega aquí, el ID debe existir
        if (!$voto->wasRecentlyCreated && !$voto->wasChanged()) {
            // Si no se creó ni se cambió, algo raro pasa con la lógica
            dd("El modelo dice que no hubo cambios. ID actual: " . $voto->id);
        }

        // Actualizamos el promedio en el álbum
        $album = Album::find($request->album_id);
        $album->updateAverageRating();

        return back()->with('success', '¡Voto registrado!');
    }
}
