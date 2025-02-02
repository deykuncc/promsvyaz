<?php

namespace App\Http\Requests\Departments;

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
            'name' => ['required', 'max:255', Rule::unique('departments', 'name')->whereNull('deleted_at')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите название участка',
            'name.max' => 'Название участка превышает :max символов',
            'name.unique' => 'Такое название уже существует',
        ];
    }
}
