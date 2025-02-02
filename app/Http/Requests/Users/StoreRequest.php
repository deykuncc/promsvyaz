<?php

namespace App\Http\Requests\Users;

use App\Rules\UserNameRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120', 'min:3', new UserNameRule()],
            'login' => ['required', 'string', 'min:3', 'max:120', 'unique:users,login'],
            'password' => ['required', 'string', 'min:6', 'max:64'],
            'role_id' => ['required', 'exists:roles,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => "Введите ФИО",
            'name.string' => "Введите ФИО",
            'name.max' => "ФИО должно быть до :max символов",
            'name.min' => "ФИО должно быть от :min символов",
            'login.required' => "Введите Логин",
            'login.string' => "Введите Логин",
            'login.max' => "Логин должен быть до :max символов",
            'login.min' => "Логин должен быть от :min символов",
            'login.unique' => "Логин уже существует",
            'password.required' => 'Введите пароль',
            'password.string' => 'Введите пароль',
            'password.min' => 'Пароль должен быть от :min символов',
            'password.max' => 'Пароль должен быть до :max символов',
            'role_id.required' => "Выберите должность",
            'role_id.exists' => 'Должность не найдена',
        ];
    }

}
