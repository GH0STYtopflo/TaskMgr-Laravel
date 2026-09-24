<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class QueryCommentsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['nullable', 'string'],
            'task_id' => ['nullable', 'integer'],
            'after' => ['nullable', 'date'],
            'before' => ['nullable', 'date'],
            'keyword' => ['nullable', 'string'],
        ];
    }
}
