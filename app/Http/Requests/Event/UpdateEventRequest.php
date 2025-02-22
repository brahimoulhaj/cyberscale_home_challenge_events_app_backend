<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title' => 'string',
            'description' => 'string|nullable',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'date|date_format:Y-m-d|after:today',
            'time' => 'date_format:H:i',
            'location' => 'string',
            'map_location' => 'array',
            'map_location.latitude' => 'numeric',
            'map_location.longitude' => 'numeric',
            'max_participants' => 'integer|min:1',
        ];
    }
}
