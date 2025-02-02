<?php

namespace App\Http\Requests\Professions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('professions','name')->whereNull('deleted_at'), 'max:255'],
            'items' => ['required', 'array'],
            'items.*' => ['exists:items,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите название',
            'name.string' => "Введите название",
            'name.unique' => "Такая профессия уже создана",
            'items.required' => 'Выберите СИЗ',
            'items.*.exists' => 'СИЗ не найден',
        ];
    }
}
