<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'string|nullable',
            'category_id' => 'nullable|exists:categories,id',
            'date' => 'required|date|date_format:Y-m-d|after:today',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string',
            'max_participants' => 'required|integer|min:1',
        ];
    }
}
