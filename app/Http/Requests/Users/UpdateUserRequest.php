<?php

namespace App\Http\Requests\Users;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        $user = $this->user();
        $req = $this;

        return [
            'username' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) use ($user) {
                if (User::where('username', $value)
                    ->where('id', '!=', $user->id)
                    ->exists()) {
                    $fail('Username already exists.');
                }
            }],
            'email' => ['nullable', 'string', 'email', 'max:255', function ($attribute, $value, $fail) use ($user) {
                if (User::where('email', $value)
                    ->where('id', '!=', $user->id)
                    ->exists()) {
                    $fail('Email taken.');
                }
            }],
            'new_password' => ['nullable','string', 'min:8'],
        ];
    }
}
