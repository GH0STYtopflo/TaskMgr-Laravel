<?php

namespace App\Http\Requests\Subtasks;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubtaskStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'is_done' => ['nullable', 'string']
        ];
    }
}
