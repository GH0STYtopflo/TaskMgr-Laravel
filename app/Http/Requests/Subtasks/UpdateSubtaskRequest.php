<?php

namespace App\Http\Requests\Subtasks;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubtaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string'],
            'is_done' => ['nullable', 'string'],
        ];
    }
}
