<?php

namespace App\Http\Requests\Items;

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
            'name' => ['required', 'string', 'max:128'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string', 'max:1128'],
            'brands' => ['nullable', 'array'],
            'brands.*.id' => ['nullable', 'exists:item_brands,id'],
            'brands.*.name' => ['required', 'string'],
            'brands.*.model' => ['nullable', 'string'],
            'brands.*.article' => ['nullable', 'string'],
            'model' => ['nullable', 'string', 'max:1128'],
            'norm_clause' => ['nullable', 'string', 'max:1128'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Введите название',
            'name.string' => 'Введите название',
            'name.max' => "Название не должно превышать :max символов",
            'category_id.required' => 'Выберите категорию',
            'category_id.exists' => 'Категория не найдена',
            'description.max' => 'Описание не должно превышать :max символов',
            'brands.array' => 'Заполните торговое наименование',
            'brands.min' => 'Заполните торговое наименование',
            'brands.*.name.required' => 'Заполните торговое наименование',
            'brands.*.name.string' => 'Заполните торговое наименование',
            'model.max' => 'Модель не должно превышать :max символов',
            'norm_clause.max' => "Пункт норм превышает :max символов"
        ];
    }
}
