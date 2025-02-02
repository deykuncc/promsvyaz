<?php

namespace App\Http\Requests\Departments;

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
            'name' => ['required', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите название участка',
            'name.max' => 'Название участка превышает :max символов',
        ];
    }
}
