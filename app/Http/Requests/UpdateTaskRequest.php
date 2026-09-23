<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
     */
    public function authorize(): bool
    {
        //TODO: Configure
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
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
            'subIsDone*' => ['required', 'string'],
            'existingSub*' => ['required', 'string', 'max:5000'],
        ];
    }
}
