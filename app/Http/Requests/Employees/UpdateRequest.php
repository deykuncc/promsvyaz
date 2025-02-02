<?php

namespace App\Http\Requests\Employees;

use App\Enums\ConditionType;
use App\Rules\UserNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', new UserNameRule()],
            'external_id' => ['nullable'],
            'gender_id' => ['required', 'exists:genders,id'],
            'employment_date' => ['required', 'date_format:d.m.Y'],
            'height' => ['required', 'integer', 'min:120', 'max:230'],
            'clothes_size_id' => ['required', Rule::exists('sizes', 'id')->whereNull('deleted_at')],
            'shoes_size_id' => ['required', Rule::exists('sizes', 'id')->whereNull('deleted_at')],
            'hats_size_id' => ['required', Rule::exists('sizes', 'id')->whereNull('deleted_at')],
            'profession_id' => ['required', Rule::exists('professions', 'id')->whereNull('deleted_at')],
            'department_id' => ['required', Rule::exists('departments', 'id')->whereNull('deleted_at')],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите ФИО',
            'name.max' => 'Фио превышает :max символов',
            'gender.required' => 'Выберите пол',
            'gender.exists' => 'Пол не найден',
            'employment_date.required' => 'Введите дату',
            'employment_date.date_format' => 'Неправильный формат даты. Должно быть Д.М.Г',
            'height.required' => 'Выберите рост',
            'height.integer' => "Выберите рост",
            'height.min' => 'Рост должен быть от :min см',
            'height.max' => 'Рост должен быть до :max см',
            'clothes_size_id.required' => 'Выберите размер одежды',
            'clothes_size_id.exists' => 'Размер одежды не найдем',
            'shoes_size_id.required' => 'Выберите размер обуви',
            'shoes_size_id.exists' => 'Размер обуви не найден',
            'hats_size_id.required' => 'Выберите размер головного убора',
            'hats_size_id.exists' => 'Размер головного убора не найден',
            'profession_id.required' => 'Выберите профессию',
            'profession_id.exists' => 'Профессия не найдена',
        ];
    }
}
