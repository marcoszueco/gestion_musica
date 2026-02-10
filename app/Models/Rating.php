<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    /**
     * Tarea 2: Definir campos asignables masivamente
     */
    protected $fillable = [
        'user_id',
        'album_id', // En tu caso es album_id (el content_id del proyecto)
        'score'
    ];

    /**
     * Tarea 3: Relación con el Usuario (Un rating pertenece a un usuario)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Tarea 4: Relación con el Álbum (Un rating pertenece a un álbum)
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Tarea 5: Validación de score (Lógica sugerida)
     * Aunque la validación fuerte se hace en el Controller,
     * podemos asegurar que el score siempre sea entre 1 y 5.
     */
}
