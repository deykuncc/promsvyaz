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
            'until_at' => ['nullable', 'date'],
            'is_unlimited' => ['nullable', 'boolean'],
            'size_id' => ['nullable'],
        ];
    }
}
