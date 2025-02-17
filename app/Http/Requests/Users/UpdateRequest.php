<?php

namespace App\Http\Requests\Users;

use App\Rules\UserNameRule;
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
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['required', 'string', 'max:120'],
            'middle_name' => ['nullable', 'string', 'max:120'],
            'login' => ['required', 'string', 'min:3', 'max:120'],
            'password' => ['nullable', 'string', 'min:6', 'max:64'],
            'role_id' => ['required', 'exists:roles,id'],
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

            'login.required' => "Введите Логин",
            'login.string' => "Введите Логин",
            'login.max' => "Логин должен быть до :max символов",
            'login.min' => "Логин должен быть от :min символов",
            'password.required' => 'Введите пароль',
            'password.string' => 'Введите пароль',
            'password.min' => 'Пароль должен быть от :min символов',
            'password.max' => 'Пароль должен быть до :max символов',
            'role_id.required' => "Выберите должность",
            'role_id.exists' => 'Должность не найдена',
        ];
    }

}
