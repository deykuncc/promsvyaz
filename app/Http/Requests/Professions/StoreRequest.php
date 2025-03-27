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
            'name' => ['required', 'string', Rule::unique('professions', 'name')->whereNull('deleted_at'), 'max:255'],
            'items' => ['required', 'array'],
            'items.*.id' => ['exists:items,id'],
            'items.*.expiryType' => ['in:unlimited,months'],
            'items.*.expiryValue' => ['nullable', 'integer', 'max:100'],
            'items.*.conditionValue' => ['nullable', 'integer', 'max:999999'],
            'items.*.conditionType' => ['nullable', 'integer', 'in:1,3,4'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите название',
            'name.string' => "Введите название",
            'name.unique' => "Такая профессия уже создана",
            'items.required' => 'Выберите СИЗ',
            'items.*.id.exists' => 'СИЗ не найден',
            'items.*.expiryType.in' => 'Выберите срок эксплуатации',
            'items.*.expiryValue.integer' => 'Укажите срок эксплуатации',
            'items.*.expiryValue.max' => 'Срок превышает :max месяцев',
            'items.*.conditionValue.integer' => 'Укажите количество',
            'items.*.conditionValue.max' => 'Количество превышает :max',
            'items.*.conditionType.in' => 'Укажите количество',
        ];
    }
}
