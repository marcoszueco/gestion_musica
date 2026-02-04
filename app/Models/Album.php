<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Album extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'artist',
        'release_year',
        'genre',
        'label',
        'track_count',
        'duration',
        'cover_image',
        'format',
        'average_rating',
    ];
    public function user() { return $this->belongsTo('App\Models\User'); }
    public function ratings(){ return $this->hasMany('App\Models\Rating'); }
    public function reviews(){ return $this->hasMany('App\Models\Review'); }

    public function updateAverageRating():bool{ //Devuelve un booleano para saber si el update es correcto o no
        $average = $this->ratings()->avg('score') ?: 0.00;
        return $this->update(['average_rating' => round($average, 2)]);

    }



}
