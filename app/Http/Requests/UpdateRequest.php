<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title'          => 'sometimes|required|string',
            'artist'         => 'sometimes|required|string',
            'release_year'   => 'sometimes|required|integer|min:1900|max:' . date('Y'),
            'genre'          => 'nullable|string',
            'label'          => 'nullable|string',
            'track_count'    => 'nullable|integer',
            'duration'       => 'nullable|integer',
            'cover_image'    => 'nullable|string',
            'format'         => 'sometimes|required|in:vinyl,cd,digital',
            'average_rating' => 'nullable|integer',
        ];
    }
}
