<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date', 'after_or_equal:now'],
            'users' => ['nullable', 'array'],
            'categories' => ['nullable', 'array'],
            'subtasks' => ['nullable', 'string', 'max:5000'],
            'priority' => ['required', 'integer', 'min:1', 'max:20'],
        ];
    }
}
