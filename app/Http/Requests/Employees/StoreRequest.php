<?php

namespace App\Http\Requests\Employees;

use App\Enums\ConditionType;
use App\Rules\UserNameRule;
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
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'middle_name' => ['nullable', 'string', 'max:120'],
            'external_id' => ['nullable'],
            'gender_id' => ['required', 'exists:genders,id'],
            'employment_date' => ['required', 'date_format:d.m.Y'],
            'height' => ['required', 'integer', 'min:120', 'max:230'],
            'size_clothes' => ['required', Rule::exists('sizes', 'id')->whereNull('deleted_at')],
            'size_shoes' => ['required', Rule::exists('sizes', 'id')->whereNull('deleted_at')],
            'size_hats' => ['required', Rule::exists('sizes', 'id')->whereNull('deleted_at')],
            'profession_id' => ['required', Rule::exists('professions', 'id')->whereNull('deleted_at')],
            'department_id' => ['required', Rule::exists('departments', 'id')->whereNull('deleted_at')],

            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', Rule::exists('items', 'id')],
            'items.*.size' => ['required'],
            'items.*.dateType' => ['required', 'in:days,months,years,unlimited'],
            'items.*.dateValue' => ['nullable'],
            'items.*.conditionType' => ['required', Rule::in(ConditionType::ids())],
            'items.*.conditionValue' => ['required', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required' => "Введите Фамилию",
            'last_name.string' => "Введите Фамилию",
            'last_name.max' => "Фамилия должно быть до :max символов",
            'last_name.min' => "Фамилия должно быть от :min символов",

            'first_name.required' => "Введите Имя",
            'first_name.string' => "Введите Имя",
            'first_name.max' => "Имя должно быть до :max символов",
            'first_name.min' => "Имя должно быть от :min символов",

            'middle_name.string' => "Введите Отчество",
            'middle_name.max' => "Отчество должно быть до :max символов",
            'middle_name.min' => "Отчество должно быть от :min символов",

            'gender_id.required' => 'Выберите пол',
            'gender_id.exists' => 'Пол не найден',
            'employment_date.required' => 'Введите дату',
            'employment_date.date_format' => 'Неправильный формат даты. Должно быть Д.М.Г',
            'height.required' => 'Выберите рост',
            'height.integer' => "Выберите рост",
            'height.min' => 'Рост должен быть от :min см',
            'height.max' => 'Рост должен быть до :max см',
            'size_clothes.required' => 'Выберите размер одежды',
            'size_clothes.exists' => 'Размер одежды не найдем',
            'size_shoes.required' => 'Выберите размер обуви',
            'size_shoes.exists' => 'Размер обуви не найден',
            'size_hats.required' => 'Выберите размер головного убора',
            'size_hats.exists' => 'Размер головного убора не найден',
            'profession_id.required' => 'Выберите профессию',
            'profession_id.exists' => 'Профессия не найдена',

            'items.required' => 'Выберите СИЗ',
            'items.min' => 'Выберите СИЗ',
            'items.*.id.required' => 'СИЗ не найден',
            'items.*.id.exists' => 'СИЗ не найден',
            'items.*.size.required' => 'Выберите размер для СИЗ',
            'items.*.dateType.required' => 'Заполните срок эксплуатации для СИЗ',
            'items.*.conditionType.required' => 'Заполните количество для СИЗ',
            'items.*.conditionType.in' => 'Выберите тип количества для СИЗ',
        ];
    }
}
