<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title'=> 'required|string',
            'artist' => 'required|string',
            'release_year' => 'required|integer|min:1900|max:'.date('Y'),
            'genre' => 'string',
            'label' => 'string',
            'track_count' => 'integer',
            'duration' => 'integer',
            'cover_image' => 'string',
            'format' => 'required|in:vinyl,cd,digital',
            'average_rating' => 'integer',
        ];
    }
    public function messages(): array
    {
        return [
            // Título
            'title.required' => 'El título del álbum es obligatorio.',
            'title.string'   => 'El título debe ser una cadena de texto válida.',

            // Artista
            'artist.required' => 'El nombre del artista es obligatorio.',
            'artist.string'   => 'El nombre del artista debe ser texto.',

            // Año de lanzamiento
            'release_year.required' => 'El año de lanzamiento es obligatorio.',
            'release_year.integer'  => 'El año debe ser un número entero.',
            'release_year.min'      => 'El año no puede ser anterior a 1900.',
            'release_year.max'      => 'El año no puede ser superior al año actual (:max).',

            // Género y Sello
            'genre.string' => 'El género debe ser una cadena de texto.',
            'label.string' => 'El sello discográfico debe ser texto.',

            // Conteos y duración
            'track_count.integer'    => 'El número de canciones debe ser un valor numérico.',
            'duration.integer'       => 'La duración debe expresarse como un número entero (segundos).',
            'average_rating.integer' => 'La calificación promedio debe ser un número entero.',

            // Imagen
            'cover_image.string' => 'La ruta o URL de la imagen de portada debe ser texto.',

            // Formato
            'format.required' => 'Es necesario especificar el formato.',
            'format.in'       => 'El formato seleccionado no es válido. Opciones: Vinilo, CD o Digital.',
        ];
    }

}
