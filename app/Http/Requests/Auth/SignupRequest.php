<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
