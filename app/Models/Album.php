<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        public function user(): BelongsTo
        { return $this->belongsTo('App\Models\User'); }
        public function ratings(){ return $this->hasMany('App\Models\Rating'); }
        public function reviews(){ return $this->hasMany('App\Models\Review'); }

        public function updateAverageRating()
        {
            $average = $this->ratings()->avg('score') ?: 0; // Si es null, que sea 0

            $this->update([
                'average_rating' => round($average, 1) // round es más seguro que number_format para operaciones matemáticas
            ]);
        }



    }
