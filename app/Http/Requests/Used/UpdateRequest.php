<?php

namespace App\Http\Requests\Used;

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
            'is_unlimited' => ['nullable', 'boolean'],
            'size_id' => ['nullable'],
            'usage_months' => ['nullable', 'integer', 'max: 120'],
            'issued_date' => ['required', 'date', 'date_format:d.m.Y'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'issued_date.required' => 'Заполните дату получения',
            'issued_date.date' => 'Заполните дату получения',
            'issued_date.date_format' => 'Дата получения должна быть в формате День.Месяц.Год',
            'is_active.required' => 'Выберите актуальность',
        ];
    }
}
