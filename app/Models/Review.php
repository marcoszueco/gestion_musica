<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = [
        'user_id',
        'album_id',
        'title',
        'content',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

// Relación con el álbum reseñado
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    protected static function booted()
    {
        static::addGlobalScope('ancient', function ($builder) {
            $builder->latest(); // Esto aplica un orderBy('created_at', 'desc') automáticamente
        });
    }
}
