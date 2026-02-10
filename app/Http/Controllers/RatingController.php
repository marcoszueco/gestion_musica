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
        // Validación de datos
        $request->validate([
            'album_id' => 'required|exists:albums,id',
            'score' => 'required|integer|min:1|max:5',
        ]);
        try {
            // Tarea 2 y 3: Detectar existente y permitir actualizar (updateOrCreate lo hace internamente)
            Rating::updateOrCreate(
                ['user_id' => $request->user()->id, 'album_id' => $request->album_id],
                ['score' => $request->score]
            );

            // 2. Buscamos el álbum para actualizar el promedio
            // Si te dice que no encuentra find o where, prueba escribirlo EXACTAMENTE así:
            $album = Album::where($request->album_id);

            $album->updateAverageRating();

            return back()->with('success', '¡Voto registrado!');

        } catch (QueryException $e) {
            // Tarea 5: Manejar excepciones de duplicados (Error 23000 es duplicado en SQL)
            if ($e->getCode() == 23000) {
                return back()->with('error', 'Ya has valorado este álbum anteriormente.');
            }

            return back()->with('error', 'Ocurrió un error inesperado en la base de datos.');
        }
    }
}
