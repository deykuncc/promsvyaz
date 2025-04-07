<?php

namespace App\Http\Requests\Employees;

use App\Enums\ConditionType;
use App\Rules\UserNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'items' => ['nullable', 'array'],
            'items.*.id' => ['required', Rule::exists('items', 'id')],
            'items.*.size' => ['required'],
            'items.*.dateType' => ['required', 'in:days,months,years,unlimited'],
            'items.*.dateValue' => ['nullable'],
            'items.*.conditionType' => ['required', Rule::in(ConditionType::ids())],
            'items.*.conditionValue' => ['required', 'min:1'],
            'items.*.issuedDate' => ['required', 'date', 'date_format:d.m.Y'],
            'items.*.brandId' => ['required', 'exists:item_brands,id'],
            'deleted_items' => ['nullable', 'array']
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Выберите СИЗ',
            'items.min' => 'Выберите СИЗ',
            'items.*.id.required' => 'СИЗ не найден',
            'items.*.id.exists' => 'СИЗ не найден',
            'items.*.size.required' => 'Выберите размер для СИЗ',
            'items.*.dateType.required' => 'Заполните срок эксплуатации для СИЗ',
            'items.*.conditionType.required' => 'Заполните количество для СИЗ',
            'items.*.conditionType.in' => 'Выберите тип количества для СИЗ',
            'items.*.issuedDate.required' => 'Укажите дату получения',
            'items.*.issuedDate.date' => 'Неправильный форматы даты получения',
            'items.*.issuedDate.date_format' => 'Неправильный форматы даты получения',
            'items.*.brandId.required' => 'Выберите бренд',
            'items.*.brandId.exists' => 'Выберите бренд',
        ];
    }
}
