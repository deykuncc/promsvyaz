<?php

namespace App\Http\Requests\Professions;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'items' => ['required', 'array'],
            'items.*' => ['exists:items,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите название',
            'name.string' => "Введите название",
            'items.required' => 'Выберите СИЗ',
            'items.*.exists' => 'СИЗ не найден',
        ];
    }
}
