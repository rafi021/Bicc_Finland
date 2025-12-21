<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IslamicClassRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'days' => 'nullable|string',
            'time' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'max_students' => 'nullable|integer|min:1',
        ];
    }
}
