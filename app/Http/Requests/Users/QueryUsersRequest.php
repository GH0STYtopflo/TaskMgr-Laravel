<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class QueryUsersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['nullable', 'string'],
            'id' => ['nullable', 'integer'],
            'before' => ['nullable', 'date'],
            'after' => ['nullable', 'date'],
        ];
    }
}
