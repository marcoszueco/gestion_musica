<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // Importante para las relaciones

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Tarea 1: Añadido 'role' a $fillable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* -------------------------------------------------------------------------- */
    /* RELACIONES (HasMany)                         */
    /* -------------------------------------------------------------------------- */

    /**
     * Tarea 2: Relación con el contenido (Álbumes)
     */
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    /**
     * Tarea 3: Relación con ratings
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Tarea 4: Relación con reviews
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /* -------------------------------------------------------------------------- */
    /* MÉTODOS HELPER                               */
    /* -------------------------------------------------------------------------- */

    /**
     * Tarea 5: Verificar si es administrador
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Tarea 6: Verificar si es usuario estándar
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }
}
